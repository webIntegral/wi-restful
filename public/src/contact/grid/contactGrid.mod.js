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
	
	// @todo: Enable one field filtering with button
	// @todo: Enable external filtering
	// @todo: Enable external sorting
	
	// Cell template to enable row click event | Cell template para habilitar evento click en cada fila
	var cellTemplate = '<div ng-click="grid.appScope.rowClick(row)" class="ui-grid-cell-contents">{{COL_FIELD CUSTOM_FILTERS}}</div>';
	
	// Grid Column Definition | Definición de las columnas del datagrid
	var columns = [
   		{name: '#', field: 'id', visible: true, enableSorting: true, enableFiltering: true, width: '10%', cellTemplate: cellTemplate},
		{name: 'Name', field: 'name', visible: true, enableSorting: true, enableFiltering: true, width: '40%', cellTemplate: cellTemplate}
   		// @todo: Add other columns here
    ];
	
	// Paging initial setup | Inicializar la paginación
	var page = 0;
	var page_size = 12;		// @todo: change to 50.
	var page_count = null;
	var total_items = null;
	
	// Init search string | Inicializar el search string
	var search = '';
	
	// Init sorts | Inicializar la ordenación
	var sorts = [];
	
	// Init datagri data variable | Inicializar la variable que contiene los datos del datagrid
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
	        $scope.gridApi.infiniteScroll.on.needLoadMoreData($scope, $scope.getData);
        }
	};
	
	// Get Data | Obtener los datos
	$scope.getData = function () {
		
		// Promise to stop virtual scrolling | Promise para detener el virtual scrolling
		var promise = $q.defer();
		
		// Increment page number | Incrementar el número de la página
		page = page+1;
		
		// Request page | Solicitar la página
		ContactEntity.query(
			{
				page: page,
				page_size: page_size,
				search: search,
				sorts: sorts
			}
		// On success | Si se reciben datos con éxito
		).$promise.then(function (data) {
			
			// Extract new data | Extraer los nuevos datos
			var newData = data._embedded.contact;
			
			// Add new data to grid | Agregar los nuevos datos al datagrid
			$scope.data = $scope.data.concat(newData);
			
			// Save page count | Guardar el número de páginas 
	        page_count = data.page_count;
	        
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
	});
	
	// Search Event listener
	$scope.$on('gridBar.search', function(event, data) {
        console.log('Search Event! String: ' + data);
    });
	
	// Previous page Event
	$scope.$on('gridBar.prevPage', function(event, data) {
		console.log('Previous page Event!');
	});
	
	// Next page Event
	$scope.$on('gridBar.nextPage', function(event, data) {
		console.log('Next page Event!');
		getMoreData();
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
		// Don't search empty strings | No buscar strings vacíos 
		if ('' != $scope.searchString) {
			console.log('Search Click');
			$scope.$emit('gridBar.search', $scope.searchString);
		}
	};
	
	// Previous page Event 
	$scope.prevPageClk = function() {
		console.log('Previous Page Click');
		$scope.$emit('gridBar.prevPage')
	};
	
	// Next page Event
	$scope.nextPageClk = function() {
		console.log('Next Page Click');
		$scope.$emit('gridBar.nextPage');
	};

}]) // GridSearchBarCtrl
;



























