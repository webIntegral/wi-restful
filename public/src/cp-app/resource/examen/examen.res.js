/**
 * cp.resource.examen
 * mario@webintegral.com.co
 * 
 * This resource handles server access for Examen entities and collections.
 */
(function() {
	'use strict';
	
	angular
		.module('cp.resource.examen')
		.factory('ExamenResource', ExamenResource);
	
	ExamenResource.$inject = ['$resource'];
	
	function ExamenResource($resource) {
		return $resource('/examen/:id', {
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
	} // ExamenResource
})();