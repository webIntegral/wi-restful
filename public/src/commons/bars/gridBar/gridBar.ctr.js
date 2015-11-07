

/**
 * Grid Bar Ctrlr | Controlador de la Barra del Grid
 */
.controller('GridBarCtrl', ['$scope', 
function ($scope) {	
	
	// *** CREATE | CREAR ***
	
	// Create button click event | Evento clic en el botón Crear
	$scope.createClk = function() {
		console.log('Create Click');
		$scope.$emit('mainGridBar.create');
	};
	
	// *** DELETE | BORRAR ***
	
	// Delete button click event | Evento clic en el botón Borrar 
	$scope.deleteClk = function() {
		console.log('Delete Click');
		$scope.$emit('gridBar.delete');
	};
	
	// *** SEARCH | BUSCAR ***
	
	// Search String | String de búsqueda
	$scope.searchString = '';
	
	// Search button click event | Evento clic en el botón Búsqueda
	$scope.searchClk = function() {
		$scope.$emit('gridBar.search', $scope.searchString);
	};
	
	// Search input Intro key event | Evento tecla en el campo de búsqueda
	$scope.searchKey = function(keyEvent) {
		// Only search on intro key |
		// Solo buscar con enter
		if (keyEvent.which === 13) {
			$scope.$emit('gridBar.search', $scope.searchString);
		}
	}

}]) // GridBarCtrl

;