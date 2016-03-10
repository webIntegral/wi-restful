(function() {
	'use strict';
	
	angular
		.module('wi.resource.logout')
		.factory('LogoutResource', LogoutResource);
	
	LogoutResource.$inject = ['$resource'];
	
	function LogoutResource($resource) {
		return $resource('/token', {
			
		}, {
			
		});
	} //LogoutResource
})();