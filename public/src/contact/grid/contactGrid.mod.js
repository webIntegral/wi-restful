/**
 * wi.contact.grid
 * 
 * Module to handle Contact Data Grid
 * 
 * Modulo para manejar el Datagrid Contactos
 */
angular.module('wi.contact.grid', ['ui.grid', 'ui.grid.autoResize', 'ui.grid.resizeColumns', 'ui.grid.selection', 'ui.grid.pagination'])

.controller('ContactGridCtrl', ['$scope', 'uiGridConstants',
function ($scope, uiGridConstants) {
	
	$scope.myData = [
         {
             "firstName": "Cox",
             "lastName": "Carney",
             "company": "Enormo",
             "employed": true
         },
         {
             "firstName": "Lorraine",
             "lastName": "Wise",
             "company": "Comveyer",
             "employed": false
         },
         {
             "firstName": "Nancy",
             "lastName": "Waters",
             "company": "Fuelton",
             "employed": false
         }
     ];
	
	/*
	 * Grid Configuration
	 * Configuración del Grid
	 */
	$scope.gridOptions = {
		
		// Habilitar filtering
		enableFiltering: true,
		// Habilitar Multiselect
		multiSelect: true,
		// Pagination Config
	    paginationPageSizes: [25, 50, 75],
	    paginationPageSize: 25,
	    
		data: $scope.myData
	}
	
	
}])

;