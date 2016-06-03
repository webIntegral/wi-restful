/**
 * CpExamenGridCtr Controller
 * mario@webintegral.com.co
 * 
 * This controller handles Examen Data Grid, search, select, create, edit and delete.
 */
(function() {
	'use strict';
	
	angular
		.module('cp.examen.grid')
		.controller('CpExamenGridCtr', CpExamenGridCtr);
	
	CpExamenGridCtr.$inject = ['$scope', 'acl', '$q', '$state', '$stateParams', 'ExamenResource', 'uiGridConstants', '$uibModal'];		//~
		
	function CpExamenGridCtr($scope, acl, $q, $state, $stateParams, Resource, uiGridConstants, $uibModal) {		//~
    	/* jshint validthis: true */
    	var vm = this;
    	
    	// load acl
    	vm.acl = acl;
    	
    	// flags
    	vm.busy = true;			// busy
    	vm.error = false;		// error
    	vm.selected = false; 	// are there selected items 
    	
    	// search string var
    	vm.search = '';
    	
    	// grid variables
    	vm.collectionName = 'examen';		//~
    	vm.page = 0;
    	vm.page_size = 50;
    	vm.sorts = {id: 'DESC'};
    	vm.data = [];
    	
    	// Cell templates
    	var cellTemplate = '<div ng-click="grid.appScope.vm.rowClick(row)" class="ui-grid-cell-contents">{{COL_FIELD CUSTOM_FILTERS}}</div>';
    	var cellTmpBoolean = '<div ng-click="grid.appScope.vm.rowClick(row)" class="ui-grid-cell-contents"><i ng-show="row.entity[col.field]" class="fa fa-check" aria-hidden="true"></i><i ng-show="!row.entity[col.field]" class="fa fa-pencil-square-o" aria-hidden="true"></i></div>'
    	
    	// Grid Column Definition			// c/p: change column definition
    	vm.columns = [
       		{name: '#', field: 'id', visible: true, enableSorting: true, cellTemplate: cellTemplate},
       		{name: 'Pendiente', field: 'definitivo', visible: true, enableSorting: true, cellTemplate: cellTmpBoolean},
    		{name: 'Tipo Examen', field: '_embedded.examenTipo.tipo', visible: true, enableSorting: true, cellTemplate: cellTemplate},
    		{name: 'medico', field: '_embedded.medico.nombre', visible: true, enableSorting: true, cellTemplate: cellTemplate},
    		{name: 'Fecha', field: 'created.date', visible: true, enableSorting: true, cellTemplate: cellTemplate}
       		// @todo: Add other columns here
        ];
    	
    	// grid options
    	vm.gridOptions = {
			// Columns
			columnDefs: vm.columns,
			// Enable row selection
			multiSelect: true,
			// Enable menu to select columns
			enableGridMenu: true,
			// Enable external sorting
			useExternalSorting: true,
			// How many rows before request new data (infinite scroll)
		    infiniteScrollRowsFromEnd: 30,
		    // Data origin
		    data: 'vm.data',
		    // Grid Api events
		    onRegisterApi: function(gridApi) {
		    	$scope.gridApi = gridApi;
		    	// Infinite Scroll more data event
		        $scope.gridApi.infiniteScroll.on.needLoadMoreData($scope, getData);
		        // sortChanged event
		        $scope.gridApi.core.on.sortChanged($scope, sortChanged);
		        $scope.gridApi.selection.on.rowSelectionChanged($scope, areSelected);
		        $scope.gridApi.selection.on.rowSelectionChangedBatch($scope, areSelected);
	        }
    	};
    	
    	// bindable functions
    	vm.goBack = goBack;
    	vm.select = select;
    	vm.refresh = refresh;
    	vm.create = create;
    	vm.listCreate = listCreate;
    	vm.openConfirmModal = openConfirmModal;
    	vm.okModal = okModal;
    	vm.cancelModal = cancelModal;
    	vm.del = del;
    	vm.doSearch = doSearch;
    	vm.searchKey = searchKey;
    	vm.clearSearch = clearSearch;    	
    	vm.rowClick = rowClick; 
    	
    	activate();
    	
    	///////////
    	
    	/*
    	 * Activate Controller
    	 */
    	function activate() {
    		// Get busy
    		getBusy();

    		// Get data
    		getData().then(function() {
	    		// Not busy
		    	vm.busy = false;
    		}, function (error) {
				// display error
				vm.error = error;
	    		// Not busy
		    	vm.busy = false;
    		});
    	} // activate
    	
    	/*
    	 * Go back to previous page
    	 */
    	function goBack() {
    		$state.go('main.afiliado.edit', {afiliadoId: $stateParams.afiliadoId});	//~
    	}
    	
    	/*
    	 * Get selected from datagrid
    	 */
    	function select() {
            // @todo: Implement selection if needed
    	} // select
    	
    	/*
    	 * Refresh data
    	 */
    	function refresh() {
    		// Get busy
    		getBusy();
    		// Reset Grid and request getData
    		resetGrid();
    		// Get data
    		getData().then(function() {
	    		// Not busy
		    	vm.busy = false;
    		}, function (error) {
				// display error
				vm.error = error;
	    		// Not busy
		    	vm.busy = false;
    		});
    	} // refresh
    	
    	/*
    	 * Create a new entity
    	 */
    	function create() {
    		$state.go('main.afiliado.edit.examen.edit', {examenId: 'new'});		//~
    	} // create
    	
    	function listCreate() {
    		$state.go('main.afiliado.edit.examen.listcreate');		//~
    	}
		
		/*
		 * Open modal to confirm deletion
		 */
		function openConfirmModal() {
			// Open confirm modal
			vm.confirmModal = $uibModal.open({
				template: ''
					+'<div class="modal-body">¿Seguro que quiere borrar los registros seleccionados?</div>'
					+'<div class="modal-footer">'
					+'<button ng-click="vm.okModal()" type="button" class="btn btn-success btn-sm"><i class="fa fa-check"></i><span class="hidden-sm hidden-xs"> Confirmar</span></button>'
					+'<button ng-click="vm.cancelModal()" type="button" class="btn btn-danger btn-sm"><i class="fa fa-times"></i><span class="hidden-sm hidden-xs"> Cancelar</span></button>'
					+'</div>',
				scope: $scope
			});
		} // openConfirmModal
		
		/*
		 * Confirm deletion
		 */
		function okModal() {
			// execute deletion
			vm.del();
			// close confirm modal
			vm.confirmModal.close();
		} // okModal
		
		/*
		 * Abort deletion
		 */
		function cancelModal() {
			// close confirm modal
			vm.confirmModal.close();
		} // cancelModal
		
    	/*
    	 * Delete selected rows
    	 */
    	function del() {
    		// get Busy
    		getBusy();
    		
			// Request delete
			delRows().then(function(data) {
				// Not busy
				vm.busy = false;
			}, function(error) {
				// Show error
				vm.error = error;
				vm.busy = false;
			});
    	} // del
    	
    	/*
    	 * Search
    	 */
    	function doSearch() {
    		// Reset grid and request new data
    		resetGrid();
    		getData();
    	} // doSearch
    	
    	/*
    	 * search on intro key
    	 */
    	function searchKey(keyEvent) {
    		if (keyEvent.which === 13) {
    			doSearch();
    		}
    	} searchKey
    	
    	/*
    	 * Clear search
    	 */
    	function clearSearch() {
    		// Delete search box and reload data
    		vm.search = '';
    		doSearch();
    	} // clearSearch
    	
    	/*
    	 * Row Click
    	 */
    	function rowClick(row) {
    		// Go to edit row
    		$state.go('main.afiliado.edit.examen.edit', {examenId: row.entity.id});
    	} // rowClick
    	
    	///////////
    	
    	/*
    	 * Get data for datagrid
    	 */
    	function getData() {
    		return $q(function(resolve, reject){
    			// Init promise for infiniteScroll
        		var promise = $q.defer();
    			// Increment page number
        		vm.page = vm.page+1;
        		
        		// Request new page
        		Resource.query({
    				page: vm.page,
    				page_size: vm.page_size,
    				search: vm.search,
    				sorts: vm.sorts,
    				filters: {
    					afiliadoId: $stateParams.afiliadoId		//~
    				}
    			})
        		// On success
        		.$promise.then(function (data) {
        			// Add new data to grid
        			var newData = data._embedded[vm.collectionName];
        			vm.data = vm.data.concat(newData);
        	        // Tell grid that data is loaded. Disable needLoadMoreData event if last page
        	        $scope.gridApi.infiniteScroll.dataLoaded(false, data.page < data.page_count).then(function() {
        	        	promise.resolve();
        	        });
        	        resolve();
        	        
                // On error
        	    }, function (error) {
        	    	// Notify infinite scroll that data loading finished
        	    	$scope.gridApi.infiniteScroll.dataLoaded();
    				// return appropiated error message
    				var errorMsg;
    				switch (error.status) {
						default:
							errorMsg = 'Error al intentar crear el registro. Por favor intente nuevamente.';
							break;
					}
    				// reject
    				reject(errorMsg);
        	    });
    		});
    	}; // getData()
    	
    	/*
    	 * Sort Change event handler
    	 */
    	function sortChanged(grid, sortColumns) {
    		// Get busy
    		getBusy();
    		// Reset sort variable
    		vm.sorts = {};
    		
    		// Check if there are sorts to do
    		if (sortColumns.length > 0) {
    			// Add each field sorted to sorts | Agregar cada campo ordenado a sorts
    			for (var i=0; i < sortColumns.length; i++) {
    				vm.sorts[sortColumns[i].field] = sortColumns[i].sort.direction;
    			}			
    		}
    		
    		// Reset Grid and request getData
    		resetGrid();
    		// Get first data page
    		getData().then(function() {
	    		// Not busy
		    	vm.busy = false;
    		}, function (error) {
				// display error
				vm.error = error;
	    		// Not busy
		    	vm.busy = false;
    		});
    	} // sortChanged
    	
    	/*
    	 * Reset datagrid data and paging
    	 */
    	function resetGrid() {
            // Reset paging and grid data
            vm.page = 0;
            vm.data = [];	
    	} // resetGrid
    	
    	/*
    	 * Check if there are selected items
    	 */
    	function areSelected() {
    		// Get selected rows
    		var rows = $scope.gridApi.selection.getSelectedRows();
    		
    		// If no selection, show error
    		if (rows.length > 0) {
    			vm.selected = true;
    		} else {
    			vm.selected = false;
    		}
    	} // areSelected
    	
    	/*
    	 * Delete selected grid rows
    	 */
    	function delRows() {
    		return $q(function(resolve, reject) {
        		// for each selected row (entity)
        		angular.forEach($scope.gridApi.selection.getSelectedRows(), function(row, index) {
        			// Ask server to delete entity
        			Resource.remove({id: row.id}, row)
    	    			// On success
    	    			.$promise.then(function(data) {
    	    				// Remove entity from datagrid
    	    				vm.data.splice(vm.data.lastIndexOf(row), 1);
    	    				// Only resolve if finished
    	    				if (0 == $scope.gridApi.selection.getSelectedRows().length - 1) {
    	    					resolve();
    	    				}
    					// On error
    	    			}, function(error){
            				// return appropiated error message
            				var errorMsg;
            				switch (error.status) {
    							default:
    								errorMsg = 'Error al intentar borrar los registros seleccionados. Por favor intente nuevamente.';
    								break;
    						}
            				// reject
            				reject(errorMsg);
            				// stope foreach
            				return;
        			});
        		});
    		});
    	} // delRows
    	
    	/*
    	 * get Busy
    	 */
    	function getBusy() {
    		// Clean errors
    		vm.error = false;
    		// Get busy
    		vm.busy = true;
    	} // getBusy
    	
	} // CpExamenGridCtr
})();