/**
 * wi.contact.grid
 * 
 * Module to handle Contact Data Grid
 * 
 * Modulo para manejar el Datagrid Contactos
 */
angular.module('wi.contact.grid', ['ngResource', 'ui.grid', 'ui.grid.autoResize', 'ui.grid.resizeColumns', 'ui.grid.selection', 'ui.grid.pagination'])

/**
 * Contact Entity
 */
.factory('ContactEntity', function($resource) {
	return $resource('/contact/:id', {
		id: '@_id.$oid'
	}, {
		query: {
			method: 'GET',
			isArray: true,
			transformResponse: function(data, headers) {
				// Extraer los datos
				var dData = angular.fromJson(data);
				return dData._embedded.contact;
			}
		},
		get: {
			
		},
		update: {
			
		},
		save: {
			
		}
	});
}) // ContactEntity

/**
 * Contact Grid Controller | Controlador del Grid Contact
 */
.controller('ContactGridCtrl', ['$scope', 'uiGridConstants', 'ContactEntity',
function ($scope, uiGridConstants, ContactEntity) {
	
	$scope.myData = ContactEntity.query();
    /*ContactEntity.query().$promise.then(function (data) {
        $scope.myData = data;
        
    }, function () {
        alert('failed');
        
    });*/
	
	/*
	 * Grid Configuration
	 * Configuración del Grid
	 */
	$scope.gridOptions = {
		// Data origin
		data: 'myData',
		// Habilitar filtering
		enableFiltering: true,
		// Habilitar Multiselect
		multiSelect: true,
		// Pagination Config
	    paginationPageSizes: [5, 25, 50, 75],
	    paginationPageSize: 5,
	}
	
}]) // ContactGridCtrl




;



























