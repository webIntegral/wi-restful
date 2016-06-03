/**
 * Afiliado Search Controller
 * mario@webintegral.com.co
 * 
 * This controller handles Afiliado searching and navigation to afiliado related entities 
 * 
 */
(function() {
	'use strict';
	
	angular
		.module('cp.afiliado.searchForm')
		.controller('CpAfiliadoSearchCtr', CpAfiliadoSearchCtr);
	
	// Inject dependencies
	CpAfiliadoSearchCtr.$inject = ['$scope', '$q', 'acl', '$state', '$stateParams', 'AfiliadoResource'];		//~
	
	// Controller definition
	function CpAfiliadoSearchCtr($scope, $q, acl, $state, $stateParams, Resource) {		//~
    	/* jshint validthis: true */
    	var vm = this;
    	
    	// load acl
    	vm.acl = acl;
    	
    	// flags
    	vm.busy = false;		// busy
    	vm.error = false;		// error
    	vm.empty = true;		// empty search result
    	vm.showAlert = false;	// show empty alert
    	vm.hasChages = false;	// has changes to save
    	
    	// init empty entities	//~
    	vm.entity = {};
    	var emptyEntity = {};
    	vm.search = {
			tipoDocumento: '1',		// CC by default
			numeroDocumento: ''
    	};
    	
    	// Bindable functions
    	vm.doSearch = doSearch;
    	vm.searchKey = searchKey;
    	vm.goBack = goBack;
    	vm.gotoExamenes = gotoExamenes;
    	vm.gotoCitas = gotoCitas;
    	vm.gotoAutorizaciones = gotoAutorizaciones;
    	vm.save = save;
    	vm.changed = changed;
    	vm.isEditable = isEditable;
    	
    	activate();
    	
    	///////////
    	
    	/*
    	 * Activate Controller
    	 */
    	function activate() {
    		// get busy
    		getBusy();
    		
    		// if route id param is valid
    		if ('' != $stateParams.afiliadoId) {
    			if (angular.isNumber(parseInt($stateParams.afiliadoId))) {
    				// load existing entity
    				loadEntity().then(function(data){
        	    		// Not busy
        		    	vm.busy = false;
    				}, function(error) {
        				// display error
        				vm.error = error;
        	    		// Not busy
        		    	vm.busy = false;
    				});
				// else, show error
    			} else {
    				// Set error
    				vm.error = 'El parámetro id de la ruta no es válido.';
    				// do not allow edition nor save
    				$scope.allowEdit = false;
    			}
    		}
    		// Not busy
	    	vm.busy = false;
    	} // activate
    	
    	/*
    	 * search button binding for Afiliado Search
    	 */
    	function doSearch() {
    		// get busy
    		getBusy();
    		
    		// do search
    		searchEntity().then(function() {
	    		// Not busy
		    	vm.busy = false;
    		}, function(error) {
				// display error
				vm.error = error;
	    		// Not busy
		    	vm.busy = false;
    		});
    	} // doSearch
    	
    	/*
    	 * search on intro key
    	 */
    	function searchKey(keyEvent) {
    		if (keyEvent.which === 13) {
    			doSearch();
    		}
    	} // searchKey
    	
    	/*
    	 * Go Back
    	 */
    	function goBack() {
    		$state.go('main');		//~
    	} // goBack
    	
    	/*
    	 * Go to Examenes
    	 */
    	function gotoExamenes() {
    		// Go to examenes
    		$state.go('main.afiliado.search.examen.list');		//~
    	} //gotoExamenes
    	
    	/*
    	 * Go to Citas
    	 */
    	function gotoCitas() {
    		// @todo: Code when needed
    	} //gotoCitas
    	
    	/*
    	 * Go to Autorizaciones
    	 */
    	function gotoAutorizaciones() {
    		// @todo: Code when needed
    	} //gotoAutorizaciones
    	
    	/*
    	 * Save changes
    	 */
    	function save() {
    		// get busy
    		getBusy();
    		
			// Update entity
			update().then(function(data) {
    			// disable flags
    			vm.hasChanges = false;
				vm.busy = false;
			}, function(error) {
				// Show error
				vm.error = error;
				vm.busy = false;
			});
    	} // save
    	
    	/*
    	 * Detect model changes
    	 */
    	function changed() {
    		// enable change flag
    		vm.hasChanges = true;
    	} // changed
    	
    	/*
    	 * Prevent typing if allowEdit is false
    	 */
    	function isEditable(event) {
    		// If editable
    		if (!vm.acl.allowEdit) {
    			// Prevent input change
    			event.preventDefault();
                return false;
    		}
    	} // isEditable
    	
    	///////////
    	
    	/*
    	 * Load entity from routeId parameter
    	 */
    	function loadEntity() {
    		return $q(function(resolve, reject) {
        		// Request entity to server		//~
        		Resource.get({id: $stateParams.afiliadoId})
        			// On success
        			.$promise.then(function(data) {
        				// load data into entity
        				vm.entity = data;
        				// Not empty
        				vm.empty = false;
        				// resolve
        				resolve(data);
    				
    				// On error
        			}, function(error) {
						// Empty
						vm.empty = true;
        				// return appropiated error message
        				var errorMsg;
        				switch (error.status) {
							case 404:
								errorMsg = 'No se encontró el registro solicitado.';
								break;
	
							default:
								errorMsg = 'Error al cargar el registro. Por favor intente nuevamente.';
								break;
						}
        				// reject
        				reject(errorMsg);
        		});    			
    		});
    	} // loadEntity
    	
    	/*
    	 * Search Entity
    	 */
    	function searchEntity() {
    		return $q(function(resolve, reject) {
        		// Clean entity
        		vm.entity = emptyEntity;
        		vm.empty = true;
        		// Hide alert
        		vm.showAlert = false;
        		
        		// Query server for search
        		Resource.query(vm.search)
    				// On success
        		.$promise.then(function(data) {
        			// if data is empty		//~
        			if (data._embedded.afiliado.length == 0) {
        				// Show alert
        				vm.showAlert = true;
        				
    				// otherwise, load data into entity
        			} else {
        				// Load data
            			vm.entity = data._embedded.afiliado[0];
            			// update route parameter
                		$state.transitionTo('main.afiliado.search', {afiliadoId: vm.entity.id}, { notify: false });		//~
        				// disable empty flag
        				vm.empty = false;
        			}
            		// Resolve
    				resolve();
        			
    			// On error
        		}, function(error) {
    				// return appropiated error message
    				var errorMsg;
    				switch (error.status) {
    					default:
    						errorMsg = 'Error al buscar el registro. Por favor intente nuevamente.';
    						break;
    				}
    				// reject
    				reject(errorMsg);
        		});
    		});
    	} //searchEntity
    	
    	/*
    	 * Update existing entity
    	 */
    	function update() {
    		return $q(function(resolve, reject) {
    			// Request update to server		//~
    			Resource.update({id: vm.entity.id}, 
					{
						id: vm.entity.id,			//~
						movil: vm.entity.movil,
						telefono: vm.entity.telefono
					}	
    			)    			
        			// On success
        			.$promise.then(function(data) {
        				// Here we do not reload into entity to avoid dealing
        				// with XML retrieval again
        				
        				// Resolve
        				resolve(data);
        				
    				// On error
        			}, function(error) {
        				// return appropiated error message
        				var errorMsg;
        				switch (error.status) {
							default:
								errorMsg = 'Error al intentar actualizar el registro. Por favor intente nuevamente.';
								break;
						}
        				// reject
        				reject(errorMsg);
    			}); // update
    		}); 
    	} // update
    	
    	/*
    	 * get Busy
    	 */
    	function getBusy() {
    		// Clean errors
    		vm.error = false;
    		// Get busy
    		vm.busy = true;
    	} // getBusy
    	
	} // CpAfiliadoSearchCtr
})();