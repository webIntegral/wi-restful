(function() {
	'use strict';
	
	angular
		.module('wi.resource.contact')
		.factory('ContactResource', ContactResource);
	
	ContactResource.$inject = ['$resource'];
	
	function ContactResource($resource) {
		return $resource('/contact/:id', {
			id: '@_id.$oid'
		}, {
			query: {
				method: 'GET',
				transformResponse: function(data, headers) {
					var dData = angular.fromJson(data);
					return dData;
				}
			},
			get: {
				
			},
			update: {
				
			},
			save: {
				
			}
		});
	} // ContactResource
})();