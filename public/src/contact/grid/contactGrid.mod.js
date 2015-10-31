/*
 * wi.contact.grid
 * 
 * Module to handle Contact Data Grid
 * 
 * Modulo para manejar el Datagrid Contactos
 */
angular.module('wi.contact.grid', ['ui.grid'])

.controller('ContactGridCtrl', ['$scope',
function ($scope) {
	
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
	
	
}])

;