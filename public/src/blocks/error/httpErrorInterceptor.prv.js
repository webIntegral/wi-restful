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
	        	
	        	switch (error.status) {
					case 401:
						console.log('Unauthorized '+ error.status);
						
						// @todo: Redirect somewhere else
						break;
	
					default:
						// @todo: Code What to do with unknown errors
						// @todo: Code what to do with error 500, 404
						break;
				}
	        	
	        	return $q.reject(error);
	        }
	        
		}
		
	} // httpErrorInterceptor
	
})();