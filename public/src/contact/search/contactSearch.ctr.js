/**
 * 
 */
(function() {
    'use strict';
    
	angular
		.module('wi.contact.search')
		.controller('ContactSearchCtr', ContactSearchCtr);
	
	ContactSearchCtr.$inject = ['$scope', 'name'];
	
	function ContactSearchCtr($scope, name) {
		/* jshint validthis: true */
		var vm = this;
		
		activate();
		
		// Activate controller | Enable controller
		function activate() {
			
		}
		
		// Grid Bar Event listeners
		
		// Create event listener
		$scope.$on('mainGridBar.create', function(event, data) {
			console.log('Create Event!');
			
			// Request the datagrid to go to create route
		});
		
		// Create event listener
		$scope.$on('mainGridBar.delete', function(event, data) {
			console.log('Delete Event!');
			
			// Request the datagrid to delete selected 
		});
		
		// Search Event listener
		$scope.$on('mainGridBar.search', function(event, data) {
	        // Set search string | Setear el search string
	        var search = data;
	        console.log('Search Event:' + search);
	        
	        // Send search string to datagrid and request search
	    });
		
		// Datagrid Event listeners
		$scope.$on('grid.rowClick', function(event, data) {
			
		});
		
	} // ContactSearchCtrl
	
})();