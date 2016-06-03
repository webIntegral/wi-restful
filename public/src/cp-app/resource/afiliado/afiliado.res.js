/**
 * cp.resource.afiliado
 * mario@webintegral.com.co
 * 
 * This resource handles server access for Afiliado entities and collections.
 */
(function() {
	'use strict';
	
	angular
		.module('cp.resource.afiliado')
		.factory('AfiliadoResource', AfiliadoResource);
	
	AfiliadoResource.$inject = ['$resource', 'wiDateFormater'];
	
	function AfiliadoResource($resource, wiDateFormater) {
		return $resource('/afiliado/:id', {
			id: '@_id.$oid'
		}, {
			query: {
				/*
				 * Get method accepts regular pagination or specific parameteres to
				 * find an entity like this:
				 * {
				 * 	tipoDocumento: '1',
				 * 	numeroDocumento: '12345678'
				 * }
				 */
				method: 'GET',
				transformResponse: function(data, headers) {
					var dData = angular.fromJson(data);
					return dData;
				}
			},
			get: {
				transformResponse: function(data, headers) {
					// Json decode
					var dData = angular.fromJson(data);
					
					// Format dates
					dData.fechaNacimiento.date = wiDateFormater.toDate(dData.fechaNacimiento.date);
					dData.fechaAsignacion.date = wiDateFormater.toDate(dData.fechaAsignacion.date);
					dData.fechaAfiliacion.date = wiDateFormater.toDate(dData.fechaAfiliacion.date);
					// Return data
					return dData;
				}
			},
			save: {
				method: 'POST',
				transformRequest: function(data, headers) {
					// Format dates
					data.fechaNacimiento.date = wiDateFormater.toString(data.fechaNacimiento.date);
					data.fechaAsignacion.date = wiDateFormater.toString(data.fechaAsignacion.date);
					data.fechaAfiliacion.date = wiDateFormater.toString(data.fechaAfiliacion.date);
					// Encode and return data
					return angular.toJson(data);
				},
				transformResponse: function(data, headers) {
					// Json decode
					var dData = angular.fromJson(data);
					// Format dates
					dData.fechaNacimiento.date = wiDateFormater.toDate(dData.fechaNacimiento.date);
					dData.fechaAsignacion.date = wiDateFormater.toDate(dData.fechaAsignacion.date);
					dData.fechaAfiliacion.date = wiDateFormater.toDate(dData.fechaAfiliacion.date);
					// Return data
					return dData;
				}				
			},
			update: {
				method: 'PUT',
				transformRequest: function(data, headers) {
					// Format dates
					data.fechaNacimiento.date = wiDateFormater.toString(data.fechaNacimiento.date);
					data.fechaAsignacion.date = wiDateFormater.toString(data.fechaAsignacion.date);
					data.fechaAfiliacion.date = wiDateFormater.toString(data.fechaAfiliacion.date);
					// Encode and return data
					return angular.toJson(data);
				},
				transformResponse: function(data, headers) {
					// Json decode
					var dData = angular.fromJson(data);
					// Format dates
					dData.fechaNacimiento.date = wiDateFormater.toDate(dData.fechaNacimiento.date);
					dData.fechaAsignacion.date = wiDateFormater.toDate(dData.fechaAsignacion.date);
					dData.fechaAfiliacion.date = wiDateFormater.toDate(dData.fechaAfiliacion.date);
					// Return data
					return dData;
				}
			}
		});
	} //AfiliadoResource
	
})();