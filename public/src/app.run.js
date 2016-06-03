(function() {
	'use strict';
	
	angular
		.module('wi.app')
		.run(appRun);
	
	appRun.$inject = ['$rootScope', '$state', 'routerHelper', '$auth', 'AuthService'];
	/* @ngInject */
	function appRun($rootScope, $state, routerHelper, $auth, AuthService) {
		
		/*
		 * 1. Verificar si hay un token disponible.
		 * 2. Si no, no hacer nada, puede que sea un guest, el redireccionamiento lo tiene que hacer el stateChangeStart event.
		 * 3. Si hay token, Solicitar el usuario al servidor
		 * 4. Si hay error (401), no hacer nada, puede que sea un guest, el redireccionamiento lo tiene que hacer el stateChangeStart event.
		 * 5. Si se devuelve el usuario, almacenarlo (guardar también el rol) en un servicio.
		 */
		
		// On route change Event Handler
		$rootScope.$on('$stateChangeStart', function(event, to, toParams, from, fromParams) {
			
			// Check if login condition is defined in route
			if ('undefined' != typeof to.access.login) {
				// Check if login is required
				if (to.access.login) {
					
					// Is authenticated?
					AuthService.isAuthenticated()
						// Yes, it is Authenticated
	        			.then(function() {

	        				// Get User
	    	        		AuthService.getUser()
	    	        			// On success getting user
			        			.then(function(data) {
			        				
			        				// If user has no role
			        				if ('undefined' == typeof data.role) {
			        					/*
			        					 * No se. Si el usuario no tiene rol, generar un error y
			        					 * deslogear el usuario y mandarlo al login.
			        					 */
			        				}
			        				
			        				// If user is not allowed
			        				if (-1 == to.access.allowedRoles.indexOf(data.role)) {
			        					
			        					/*
			        					 * @todo: Sí el usuario no puede entrar a esta ruta, devolverlo a la ruta de la
			        					 * que viene y notificarle que no puede hacer eso.
			        					 * 
			        					 * @todo: La opción es crear una ruta con menú y demás que muestre el error.
			        					 */
			        					from;
			        					//$location.path(from.url);
			        					
			        				}
			        				
		        			}); // getUser()
	        				
        				// No, it's not authenticated 
	        			}).catch(function() {
	        				
	        				// Save current route to redirect after login
	        				AuthService.holdRoute(to.name);
	        				// Request login
	        				return $state.go('login');
	        				
    				}); // isAuthenticated()
				}
			}			
			
			
			// @todo: This is the place to handle breadcrumbs
			
		});
	}
	
})();