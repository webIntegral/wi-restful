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
		
		HttpErrorInterceptor.$inject = [];
		/* @ngInject */
		function HttpErrorInterceptor() {
			
	        var service = {
		            responseError: responseError
	        };

	        return service;
			
	        ///////////////
	        
	        // Handle errors
	        function responseError(error) {
	        	
	        	switch (error.status) {
				case 401:
					console.log('Unauthorized '+error.status)
					
					// @todo: Redirect somewhere else
					break;

				default:
					// @todo: Code What to do with unknown errors
					break;
				}
	        }
	        
		}
		
	} // httpErrorInterceptor
	
})();