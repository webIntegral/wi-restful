/**
 * cp.resource.examenTipo
 * mario@webintegral.com.co
 * 
 * This resource handles server access for ExamenTipo entities and collections.
 */
(function() {
	'use strict';
	
	angular
		.module('cp.resource.examenTipo')
		.factory('ExamenTipoResource', ExamenTipoResource);
	
	ExamenTipoResource.$inject = ['$resource'];
	
	function ExamenTipoResource($resource) {
		return $resource('/examen-tipo/:id', {
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
	} // ExamenTipoResource
})();