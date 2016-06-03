/**
 * cm.resource.medico
 * mario@webintegral.com.co
 * 
 * This resource handles server access for Medico entities and collections.
 */
(function() {
	'use strict';
	
	angular
		.module('cp.resource.medico')
		.factory('MedicoResource', MedicoResource);
	
	MedicoResource.$inject = ['$resource'];
	
	function MedicoResource($resource) {
		return $resource('/medico/:id', {
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
	} // MedicoResource
})();