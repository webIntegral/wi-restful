/**
 * Auth Service
 * This service takes care of login, logout, get current user, 
 * refresh access and refresh tokens and check if user is authenticated.
 */
(function() {
	'use strict';
	
	angular
		.module('wi.oauth')
		.factory('AuthService', AuthService);
	
	// Inject dependencies
	AuthService.$inject = ['$auth', '$state', '$q', '$http', '$interval', 'CurrentUserResource'];
	
	// Service Definition
	function AuthService($auth, $state, $q, $http, $interval, CurrentUserResource) {
		
		// Grant credentials
		var grant = {
 		    grant_type: 'password',
 		    client_id: 'restful-wi'
		}
		
		var refreshToken = '';		// var to save refresh token
		var refreshInterval;		// refresh interval
		
		var route = '';				// var to save the route on hold for login
		var user = {};				// var to save current user
		
		// Service definition
		var service = {
			holdRoute: holdRoute,
			login: login,
			logout: logout,
			getUser: getUser,
			getNewToken: getNewToken,
			isAuthenticated: isAuthenticated
		};
		
		// Start interval to refresh token before it expires
		startRefreshInterval();
		
		// return service
		return service;
		
		///////////////
		
		/**
		 * hold Route
		 * Stores a route into 'route' var to automatically redirect there after login
		 */
		function holdRoute(routeToHold) {
			route = routeToHold;
		}
		
		/**
		 * login function
		 * parameter credentials {username: username, password: password}
		 */
		function login(credentials) {
			return $q(function(resolve, reject) {
				// Add user name and password to grant request
				grant.username = credentials.username;
				grant.password = credentials.password;
				
				// Request login to server
	    		$auth.authenticate(grant.client_id, grant)
	    			// On success
	            	.then( function(response) {
	            		// Save refresh token
	            		refreshToken = response.data.refresh_token;
	            		// get User
	            		getUser();
	            		
	            		// If there is a route on hold
	            		var toRoute;
	            		if('' != route) {
	            			
	            			// Load route on aux var
	            			toRoute = route;
	            			// Clean route var
	            			route = '';
	            			
            			// Otherwise redirect to main
	            		} else {
	            			toRoute = 'main';
	            		}
	            		
	            		// @todo uncomment redirect
	            		console.log('Redirecting to route: '+ toRoute);
	            		$state.go(toRoute);
	            		
            			// Redirect to that route
	            		resolve();
            			return $state.go(toRoute);
	            		
	            		// resolve login
	            		resolve();			// @todo: Esto es neceario? Sí ocurre después del redirec? mejor resolverlo antes?
	            		
	        		// On error
	                }, function(error) {
	                	// return error to show on login form
	                	reject(error);
	            });				
			})
		}
		
		/**
		 * Logout function
		 * Tries to delete current token on server (if it's not possible, it ignores any problem.
		 * Then deletes local tokens and current user and redirects to login page.
		 */
		function logout() {
			return $q(function(resolve, reject) {
				
				// Request to try to delete current token on server
				var req = {
					method: 'DELETE',
					url: '/token',
					headers: {
						'Content-Type': 'application/json',
						'Accept': 'application/json'
					}
				}
				// Excecute request.
				$http(req).then();
				
    			// Delete local Tokens and current user
    			$auth.logout();
    			refreshToken = '';
    			user = {};
    			
    			// Resolve deferred
    			//resolve();
    			
    			console.log('Here, redirect to logout');
    			// Redirect to login
    			// return $state.go('login');
			});
		}
		
		/**
		 * Get User
		 * Returns user
		 * User is loaded during login
		 * If not loaded, it loads user from server
		 */
		function getUser() {
			return $q(function(resolve, reject) {
				// If user is loaded return it
				if (false/*'undefined' != typeof user.id*/) {	// @todo: Descomentar esto. Esto es solo para testing.
					resolve(user);
					
				// Otherwise load user from server
				} else {
					// Request user from server
					CurrentUserResource.get()
						// On success
			        	.$promise.then(function(data) {
			        		user = data;
		        			resolve(user);
		    			// On error
			        	}, function(error) {
			        		reject(error);
		        	});
				}				
			});
		}
		
		/**
		 * Get New Token
		 * Ask server for new access_token and refresh_token and
		 * renew them at satellizer (access_token) and at var refreshToken (refres_token)
		 */
		function getNewToken() {
			return $q(function(resolve, reject) {
				// If refreshToken is present
				if ('' != refreshToken) {
					// Request Token Refresh
					var req = {
						method: 'POST',
						url: '/oauth',
						headers: {
							'Content-Type': 'application/json',
							'Accept': 'application/json'
						},
						data: {
						    "grant_type": "refresh_token",
						    "refresh_token": refreshToken,
						    "client_id": grant.client_id
						}
					}
					
					// Execute request
					$http(req).
						// On success
						then(function(data){
							// Update access token
							$auth.setToken(data.data.access_token);
							// Update refresh token
							refreshToken = data.data.refresh_token;
							resolve();
						// On error
						}, function(error){
							reject(error);
					});
					
				// Since there is no refreshToken
				} else {
					reject("Can't refresh. There is no refresh token avaliable. Please login.");
				}				
			});
		}
		
		/**
		 * is Authenticated
		 * Check if client is authenticated
		 * if not, try to refresh token before asking user to relogin
		 */
		function isAuthenticated() {
			return $q(function(resolve, reject) {
				
				// If valid refresh and access tokens
				if ('' != refreshToken && $auth.isAuthenticated()) {
					
					/*
					 * Request User Status to server
					 * Success means user is authenticate
					 * Error means user is not authenticated
					 * Keep in mind: HttpErrorInterceptor doesn't intercept user-status response
					 */	
					var req = {
						method: 'GET',
						url: '/user-status',
						headers: {
							'Content-Type': 'application/json',
							'Accept': 'application/json'
						},
					}
					
					$http(req).
						// On success
						then(function(data) {
							resolve('Already authenticated');
						// On error httpErrorInterceptor doesn't cought 401 errors for user-status
						// instead ignores theme to let us try to refresh the token
						}, function(error) {
							
							// Try to refresh token
							getNewToken()
								// If token refresh
			        			.then(function() {
			        				resolve('Token refreshed');
			        				
		        				// If token doesn't refresh
			        			}).catch(function() {
			        				reject();
		        			});
					});
					
				// Else, reject
				} else {
					reject();
				} // endif
				
			});
		}
		
		/**
		 * Start Refresh Interval
		 * This functions starts an interval that refresh acces and refresh tokens every 30 minutes.
		 * When interval count happens, it checks if user is authenticated.
		 * If it's not, it doesn't do anything. If it is, it requests tokens refresh.
		 */
		function startRefreshInterval() {
			// Set refresh interval
			refreshInterval = $interval(function() {
				// If user is authenticated
        		isAuthenticated()
        			// Refresh tokens
	    			.then(function() {
	    				getNewToken()
		        			.then(function() {
		        				
		        			}).catch(function(error) {
		        				/*
		        				 * @todo: Si esto ocurre es porque la sesión murió (ctrl+shif+supr)
		        				 * 		Poner aquí un condicional donde se pregunte en cual ruta está.
		        				 * 		Sí la ruta es diferente a '/login' redireccionar al login.
		        				 */
	        			});//getNewToken
    			}); //isAuthenticated
			}, 1800000, 0) //refreshInterval
		}
		
	} // AuthService
	
})();