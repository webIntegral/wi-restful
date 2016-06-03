/**
 * wi.blocks.error
 * 
 * Http Error Interceptor Provider
 * 
 * Provider that handles Http error response
 * 
 */
(function() {
	'use strict';
	
	angular
		.module('wi.blocks.error')
		.provider('httpErrorInterceptor', httpErrorInterceptorProvider);
	
	httpErrorInterceptorProvider.$inject = [];
	/* @ngInject */
	function httpErrorInterceptorProvider() {
		/* jshint validthis:true */
		this.$get = HttpErrorInterceptor;
		
		HttpErrorInterceptor.$inject = ['$q'];
		/* @ngInject */
		function HttpErrorInterceptor($q) {
			
	        var service = {
		            responseError: responseError
	        };

	        return service;
			
	        ///////////////
	        
	        // Handle errors
	        function responseError(error) {
	        	
	        	// Skip user-status from checks, since 401 of this service is used to
	        	// check i user is authenticated.
	        	if ('/user-status' == error.config.url) {
	        		return $q.reject(error);
	        	}
	        	
	        	error;
	        	
	        	switch (error.status) {
	        		case 400:
	        			// 400 on /oauth means invalid refresh token, then needs to login again
	        			if ('/oauth' == error.config.url) {
	        				/*
	        				 * @todo: Request logout
	        				 * 
	        				 */
	        			}
	        			
	        			break;
	        		
	        		case 401:
	        			
	        			// 401 on /oauth means wrong username or password, then just pass the error
	        			if ('/oauth' == error.config.url) {
	        				return $q.reject(error);
	        			}
	        			
			        	// Skip user-status from checks, since 401 of this service is used to
			        	// check if user is authenticated.
			        	if ('/user-status' == error.config.url) {
			        		return $q.reject(error);
			        	}
			        	
			        	/*
			        	 * @todo: Un 401 en cualquier otro servicio significa token expirado,
			        	 * lo que es raro, debido a que hay un servicio actualizandolo todo el tiempo
			        	 * Solicitar logout();
			        	 */
	        			
	        			break;
	        			
        			// Means Login requiered
	        		case 403:
	        			return $state.go('login');
	        			break;
	
					default:
						// @todo: Code What to do with unknown errors
						// @todo: Code what to do with error 500, 404
						break;
				}
	        	
	        	// return $q.reject(error);
	        }
	        
		} // HttpErrorInterceptor
	} // httpErrorInterceptorProvider
	
})();