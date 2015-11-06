angular.module('wi.bar.mainGridBar', [])

/**
 * Grid Bar Ctrlr | Controlador de la Barra del Grid
 */
.controller('GridBarCtrl', ['$scope',
function ($scope) {
	
	// Search String | String de búsqueda
	$scope.searchString = '';
	
	// Create Event
	$scope.createClk = function() {
		console.log('Create Click');
		$scope.$emit('gridBar.create');
	};
	
	// Delete Event
	$scope.deleteClk = function() {
		console.log('Delete Click');
		$scope.$emit('gridBar.delete');
	};
	
	// Search Event
	$scope.searchClk = function() {
		$scope.$emit('gridBar.search', $scope.searchString);
	};
	
	// Search input enter Event
	$scope.searchKey = function(keyEvent) {
		// Only search on intro key |
		// Solo buscar con enter
		if (keyEvent.which === 13) {
			$scope.$emit('gridBar.search', $scope.searchString);
		}
	}

}]) // GridBarCtrl

;