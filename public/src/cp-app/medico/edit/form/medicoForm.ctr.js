/**
 * Medico Form Controller
 * mario@webintegral.com.co
 * 
 * This controller handles Medico Form, creation and edition.
 */
(function() {
	'use strict';
	
	angular
		.module('cp.medico.form')
		.controller('CpMedicoFormCtr', CpMedicoFormCtr);
	
	CpMedicoFormCtr.$inject = ['$scope', 'acl', '$q', '$state', '$stateParams', 'MedicoResource'];	//~
	
	function CpMedicoFormCtr($scope, acl, $q, $state, $stateParams, Resource) {		//~
    	/* jshint validthis: true */
    	var vm = this;
    	
    	// load acl
    	vm.acl = acl;
    	
    	// flags
    	vm.busy = true;			// busy
    	vm.hasChanges = false;	// changes without save
    	vm.error = false;		// error
    	
    	// init empty entities	//~
    	vm.entity;
    	var emptyEntity = {
			nombre: '',
			telefono: '',
			especialidad: '',
			activo: 0
		};
    	
    	// Bindable functions
    	vm.goBack = goBack;
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

    		// if create new	//~
    		if ($stateParams.medicoId === 'new') {
    			// if allowCreate is false, return to datagrid
    			if (!vm.acl.allowCreate) {
    				$state.go('main.medico.list');	//~
    			}
    			// Load new entity
    			loadNewEntity().then(function(){
    				// Not busy
        	    	vm.busy = false;
    			});
    			
    		// Otherwise load existing entity
    		} else {
    			// If id is valid	//~
    			if (angular.isNumber(parseInt($stateParams.medicoId))) {
    				// load existing entity
    				loadEntity().then(function(data){
        	    		// Not busy
        		    	vm.busy = false;
    				}, function(error) {
        				// display error
        				vm.error = error;
        				// do not allow edition nor save
        				vm.acl.allowEdit = false;
        	    		// Not busy
        		    	vm.busy = false;
    				});
    				
				// else, show error
    			} else {
    				// Set error
    				vm.error = 'El parámetro id de la ruta no es válido.';
    				// do not allow edition nor save
    				vm.acl.allowEdit = false;
    	    		// Not busy
    		    	vm.busy = false;
    			}
    		}
    	} // activate
    	
    	/*
    	 * Go back to list state
    	 */
    	function goBack() {
    		$state.go('main.medico.list');	//~
    	} // goBack
    	
    	/*
    	 * Save changes
    	 */
    	function save() {
    		// get busy
    		getBusy();
    		
    		// If it's a new entity		//~
    		if ($stateParams.medicoId === 'new') {
    			// Create new entity
    			create().then(function(data) {
    				// disable flags
        			vm.hasChanges = false;
    				vm.busy = false;
    			}, function(error) {
    				// Show error
    				vm.error = error;
    				vm.busy = false;
    			});
    			
			// otherwise, just editing existing entity
    		} else {
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
    		} // if
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
    	 * Load new entity
    	 */
    	function loadNewEntity() {
    		return $q(function(resolve, reject) {
    			// Load new entity
    			vm.entity = emptyEntity;
    			//resolve
    			resolve();
    		});
    	} // loadNewEntity
    	
    	/*
    	 * Load entity from routeId parameter
    	 */
    	function loadEntity() {
    		return $q(function(resolve, reject) {
        		// Request entity to server		//~
        		Resource.get({id: $stateParams.medicoId})
        			// On success
        			.$promise.then(function(data) {
        				// load data into entity
        				vm.entity = data;
        				// resolve
        				resolve(data);
    				
    				// On error
        			}, function(error) {
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
    	 * Create entity
    	 */
    	function create() {
    		return $q(function(resolve, reject) {
    			// Request creation to server	//~
    			Resource.save(vm.entity)    			
        			// On success
        			.$promise.then(function(data) {
        				// Load new entity
        				vm.entity = data;
        				// Update route parameter with the new ID	//~
        				$state.transitionTo('main.medico.edit', {medicoId: vm.entity.id}, { notify: false });
        				// Resolve
        				resolve(data);
        				
    				// On error
        			}, function(error) {
        				// return appropiated error message
        				var errorMsg;
        				switch (error.status) {
							default:
								errorMsg = 'Error al intentar crear el registro. Por favor intente nuevamente.';
								break;
						}
        				// reject
        				reject(errorMsg);
    			}); // save
    		});
    	} // create
    	
    	/*
    	 * Update existing entity
    	 */
    	function update() {
    		return $q(function(resolve, reject) {
    			// Request update to server		//~
    			Resource.update({id: vm.entity.id}, vm.entity)    			
        			// On success
        			.$promise.then(function(data) {
        				// Load updated entity
        				vm.entity = data;
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
    	
	} // CpMedicoFormCtr
	
})();