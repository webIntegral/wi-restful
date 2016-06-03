/**
 * wi.resource.role RoleResource definition
 * mario@webintegral.com.co
 */
(function() {
	'use strict';
	
	angular
		.module('wi.resource.role')
		.factory('RoleResource', RoleResource);
	
	RoleResource.$inject = ['$resource'];
	
	function RoleResource($resource) {
		return $resource('/role/:id', {
			id: '@_id.$oid'
		}, {
			query: {
				method: 'GET',
				transformResponse: function(data, headers) {
					var dData = angular.fromJson(data);
					return dData;
				}
			},
			update: {
				method: 'PUT'
			}
		});
	} // RoleResource
})();