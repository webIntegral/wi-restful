/**
 * wi.contact.grid
 * 
 * Module to handle Contact Data Grid
 * 
 * Modulo para manejar el Datagrid Contactos
 */
angular.module('wi.contact.grid', ['ngResource', 'ui.grid', 'ui.grid.autoResize', 'ui.grid.selection',  'ui.grid.infiniteScroll'])

/**
 * Contact Entity
 */
.factory('ContactEntity', function($resource) {
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
}) // ContactEntity

/**
 * Contact Grid Controller | Controlador del Grid Contact
 */
.controller('ContactGridCtrl', ['$scope', '$q', 'uiGridConstants', 'ContactEntity',
function ($scope, $q, uiGridConstants, ContactEntity) {
	
	// @todo: Enable external sorting
	// @todo: Enable delete button only when data is selected
	// @todo: Enable collection deleting from datagrid view
	// @todo: Make unsuscribe when distroy. Check http://stackoverflow.com/questions/11252780/whats-the-correct-way-to-communicate-between-controllers-in-angularjs
	
	// Cell template to enable row click event | Cell template para habilitar evento click en cada fila
	var cellTemplate = '<div ng-click="grid.appScope.rowClick(row)" class="ui-grid-cell-contents">{{COL_FIELD CUSTOM_FILTERS}}</div>';
	
	// Grid Column Definition | Definición de las columnas del datagrid
	var columns = [
   		{name: '#', field: 'id', visible: true, enableSorting: true, enableFiltering: true, width: '10%', cellTemplate: cellTemplate},
		{name: 'Name', field: 'name', visible: true, enableSorting: true, enableFiltering: true, width: '40%', cellTemplate: cellTemplate}
   		// @todo: Add other columns here
    ];
	
	// Page number | Número de Página
	$scope.page = 0;
	
	// rows per page | filas por página
	$scope.page_size = 12;		// @todo: change to 50.
	
	// Search string | String de búsqueda
	$scope.search = '';
	
	// Sorts | Ordenación  
	$scope.sorts = {};
	
	// Grid data variable | Variable que contiene los datos del datagrid
	$scope.data = [];
	
	/*
	 * Grid Configuration
	 * Configuración del Grid
	 */
	$scope.gridOptions = {
		// Columns | Campos
		columnDefs: columns,
		// Enable row selection | Habilitar seleccionar fila
		multiSelect: true,
		// Enable menu to select columns | Habilitar el menú para seleccionar las columnas
		enableGridMenu: true,
		// Enable external sorting | Habilitar la ordenación en el servidor
		useExternalSorting: true,
		// How many rows before request new data (infinite scroll) | Cuantas filas antes se solicitan más datos (infinite scroll)
	    infiniteScrollRowsFromEnd: 5,	// @todo: change to 20 or more. Test.
	    // Data origin | Origen de datos
	    data: 'data',
	    // Grid Api events
	    onRegisterApi: function(gridApi) {
	    	$scope.gridApi = gridApi;
	    	// Infinite Scroll more data event
	        $scope.gridApi.infiniteScroll.on.needLoadMoreData($scope, $scope.getData);
	        // sortChanged
	        $scope.gridApi.core.on.sortChanged( $scope, $scope.sortChanged );
        }
	};
	
	// Get Data | Obtener los datos
	$scope.getData = function () {
		
		// Promise to stop virtual scrolling | Promise para detener el virtual scrolling
		var promise = $q.defer();
		
		// Increment page number | Incrementar el número de la página
		$scope.page = $scope.page+1;
		
		// Request page | Solicitar la página
		ContactEntity.query(
			{
				page: $scope.page,
				page_size: $scope.page_size,
				search: $scope.search,
				sorts: $scope.sorts
			}
		// On success | Si se reciben datos con éxito
		).$promise.then(function (data) {
			
			// Extract new data | Extraer los nuevos datos
			var newData = data._embedded.contact;
			
			// Add new data to grid | Agregar los nuevos datos al datagrid
			$scope.data = $scope.data.concat(newData);
	        
	        // Tell grid that data is loaded. Disable needLoadMoreData event if last page |
	        // Decirle al grid que ya se cargaron los datos. Evitar que se carguen más datos si es la última página
	        $scope.gridApi.infiniteScroll.dataLoaded(false, data.page < data.page_count).then(function() {
	        	promise.resolve();
	        });
        // On error | Si hay un error
	    }, function (error) {
	    	$scope.gridApi.infiniteScroll.dataLoaded();
	    	promise.reject();
	    });
		
		// Return promise | Devolver el promise al evento
		return promise.promise;
		
	}; // getData()
	
	// Sort Change event handler | Manejador del evento sortChange (cambio en la ordenación
	$scope.sortChanged = function ( grid, sortColumns ) {
			
		// Reset sort variable | Resetear la variable de la ordenación
		$scope.sorts = {};
		
		// Check if there are sorts to do | Checkear si sí hay campos para ordenar
		if (sortColumns.length > 0) {
			// Add each field sorted to sorts | Agregar cada campo ordenado a sorts
			for (i=0; i < sortColumns.length; i++) {
				$scope.sorts[sortColumns[i].field] = sortColumns[i].sort.direction;
			}			
		}
		
		// Reset Grid | Resetear el Grid
		$scope.resetGrid();
		// Request data | Solicitar los datos
		$scope.getData();
	};
	
	// Erase Grid data and set paging to 0 | Borrar los datos y setear la página a 0
	$scope.resetGrid = function () {
        // Reset paging | Resetear la paginación
        $scope.page = 0;
        // Reset grid data | Resetear los datos del grid
        $scope.data = [];		
	};
	
	// Request first data stream | Solicitar primera tanda de datos
	$scope.getData();
	
	// Event Listeners | Manejadores de Eventos

	
	// Row click Event Listernr
	$scope.rowClick = function (row) {
		alert('Eso! '+row.entity.id);
	};
	
	// Create Event listener
	$scope.$on('gridBar.create', function(event, data) {
		console.log('Create Event!');
	});
	
	// Delete Event listener
	$scope.$on('gridBar.delete', function(event, data) {
		console.log('Delete Event!');
		var collection = $scope.gridApi.selection.getSelectedRows();
		// @todo: Send collection to server, so it can delete it
		debugger;
	});
	
	// Search Event listener
	$scope.$on('gridBar.search', function(event, data) {
        // Set search string | Setear el search string
        $scope.search = data;
		// Reset Grid | Resetear el Grid
		$scope.resetGrid();
        // Request data | Solicitar los datos
        $scope.getData();
    });
	
}]) // ContactGridCtrl


/**
 * Contact Grid Controller | Controlador del Grid Contact
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


}]) // GridSearchBarCtrl
;



























