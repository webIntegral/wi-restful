/**
 * cp.afiliado.form controller
 * mario@webintegral.com.co
 */
(function() {
	'use strict';
	
	angular
		.module('cp.afiliado.form')
		.controller('CpAfiliadoFormCtr', CpAfiliadoFormCtr);
	
	CpAfiliadoFormCtr.$inject = ['$scope', 'acl', '$q', '$state', '$stateParams', 'AfiliadoResource'];	//~
	
	function CpAfiliadoFormCtr($scope, acl, $q, $state, $stateParams, Resource) {		//~
    	/* jshint validthis: true */
    	var vm = this;
    	
    	// load acl
    	vm.acl = acl;
    	
    	// flags
    	vm.busy = true;			// busy
    	vm.hasChanges = false;	// changes without save
    	vm.error = false;		// error
    	
    	// Controls properties init
    	vm.controls = {
			fechaNacimiento: {
				opened: false,
				options: {}
			},
			fechaAfiliacion: {
				opened: false,
				options: {}
			},
			fechaAsignacion: {
				opened: false,
				options: {}
			}
    	};
    	
    	// TODO: Replace this with dinamic query
    	// tiposId select options
    	vm.tiposId = [
             {id: 1, label: 'CC'},
             {id: 2, label: 'NIT'},
             {id: 3, label: 'TI'},
             {id: 4, label: 'CE'},
             {id: 5, label: 'FN'},
             {id: 6, label: 'RC'},
             {id: 7, label: 'NUIP'}
        ];
    	
    	// init empty entities	//~
    	vm.entity;
    	var emptyEntity = {
			fechaNacimiento: {date: null},
			fechaAfiliacion: {date: null},
			fechaAsignacion: {date: null}
		};
    	
    	// Bindable functions
    	vm.goBack = goBack;
    	vm.save = save;
    	vm.changed = changed;
    	vm.gotoExamenes = gotoExamenes;
    	vm.isEditable = isEditable;
    	vm.toggleFechaNacimiento = toggleFechaNacimiento;
    	vm.toggleFechaAfiliacion = toggleFechaAfiliacion;
    	vm.toggleFechaAsignacion = toggleFechaAsignacion;
    	
    	activate();
    	
    	///////////
    	
    	/*
    	 * Activate Controller
    	 */
    	function activate() {
    		// get busy
    		getBusy();

    		// if create new	//~
    		if ($stateParams.afiliadoId === 'new') {
    			// if allowCreate is false, return to datagrid
    			if (!vm.acl.allowCreate) {
    				$state.go('main.afiliado.list');	//~
    			}
    			// Load new entity
    			loadNewEntity().then(function(){
    				// Not busy
        	    	vm.busy = false;
    			});
    			
    		// Otherwise load existing entity
    		} else {
    			// If id is valid	//~
    			if (angular.isNumber(parseInt($stateParams.afiliadoId))) {
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
    		$state.go('main.afiliado.list');	//~
    	} // goBack
    	
    	/*
    	 * Save changes
    	 */
    	function save() {
    		// get busy
    		getBusy();
    		
    		// If it's a new entity		//~
    		if ($stateParams.afiliadoId === 'new') {
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
    	 * Go to Examenes
    	 */
    	function gotoExamenes() {
    		// Go to examenes
    		$state.go('main.afiliado.edit.examen.list');		//~
    	} //gotoExamenes
    	
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
    	
    	/*
    	 * toggle FechaNacimiento date picker
    	 */
    	function toggleFechaNacimiento() {
    		vm.controls.fechaNacimiento.opened = true;
    	}
    	
    	/*
    	 * toggle FechaAfiliacion date picker
    	 */
    	function toggleFechaAfiliacion() {
    		vm.controls.fechaAfiliacion.opened = true;
    	}
    	
    	/*
    	 * toggle FechaAsignacion date picker
    	 */
    	function toggleFechaAsignacion() {
    		vm.controls.fechaAsignacion.opened = true;
    	}
    	
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
        		Resource.get({id: $stateParams.afiliadoId})
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
        				$state.transitionTo('main.afiliado.edit', {afiliadoId: vm.entity.id}, { notify: false });
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
    			// Request update to server
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
    	
	} // CpAfiliadoFormCtr
	
})();