(function() {
	'use strict';
	
	/**
	 * Current User Resource
	 * Resource to get current user from server.
	 * Server uses Satellizer's Acces Token to find user.
	 */
	
	angular
		.module('wi.resource.currentUser')
		.factory('CurrentUserResource', CurrentUserResource);
	
	CurrentUserResource.$inject = ['$resource'];
		
	function CurrentUserResource($resource) {
		return $resource('/user-by-token', {
			
		}, {
			get: {
				transformResponse: function(data, headers) {
					var dData = angular.fromJson(data);
					return dData;
				}
			}
		});
	} //CurrentUserResource
})();