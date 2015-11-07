/**
 * wi contact search
 *
 * Module to handle all data grid implementation (create + delete buttons + search bar)
 * 
 * Módulo para lidiar con la implementación completa del datagrid (botones de crear y borrar + search bar)
 */

 // @todo: Explicar la arquitectura del modulo

angular.module('wi.contact.search', ['wi.bar.mainGridBar'])


.controller('ContactSearchCtrl', ['$scope', 'name', function($scope, name) {
	
	alert(name);
	
	// Event listeners | Manejadores de eventos
	
	// Create Event listener
	$scope.$on('mainGridBar.create', function(event, data) {
		console.log('Create Event!');
	});
	
	
}]) // ContactSearchCtrl

;