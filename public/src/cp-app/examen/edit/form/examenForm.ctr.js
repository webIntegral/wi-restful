/**
 * Examen Form Controller
 * mario@webintegral.com.co
 * 
 * This controller handles Examen Form, creation and edition.
 */
(function() {
	'use strict';
	
	angular
		.module('cp.examen.form')
		.controller('CpExamenFormCtr', CpExamenFormCtr);
	
	CpExamenFormCtr.$inject = ['$scope', 'acl', '$q', '$state', '$stateParams', 'ExamenResource', 'ExamenTipoResource', 'MedicoResource'];	//~
	
	function CpExamenFormCtr($scope, acl, $q, $state, $stateParams, ExamenResource, ExamenTipoResource, MedicoResource) {	//~
    	/* jshint validthis: true */
    	var vm = this;
    	
    	// load acl
    	vm.acl = acl;
    	
    	// flags
    	vm.busy = true;			// busy
    	vm.hasChanges = false;	// changes without save
    	vm.error = false;		// error
    	vm.loadingMedico;		// loading data in typeahead
    	
    	// init empty entities		//~
    	vm.entity;
    	var emptyEntity = {
			examen: {},
			tmp: {				// Load custom values for tmp fields 	//TODO: Delete this!
				idUsuario: '',
				tipoIdUsuario: '1',
				nuipUsuario: '',
				codigoCausaExterna: '',
				codigoEntidadResponsable: '',
				valorCostoEps: '',
				valorCuotaModeradora: '',
				codigoClaseServicio: '',
				idPrestador: '',
				tipoIdPrestador: ''
			},
			_embedded: {
				afiliado: {
					id: $stateParams.afiliadoId,	//~
				}
			},
		};
    	
    	// Bindable functions
    	vm.goBack = goBack;
    	vm.save = save;
    	vm.getMedico = getMedico;
    	vm.tipoExamenChange = tipoExamenChange;	// on exam type change
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
    		
    		// Load controls data
    		loadExamenTipo();	//~

    		// if create new	//~
    		if ($stateParams.examenId === 'new') {
    			// if allowCreate is false, return to datagrid
    			if (!vm.acl.allowCreate) {
    				$state.go('main.afiliado.edit.examen.list', {afiliadoId: $stateParams.afiliadoId});	//~
    			}
    			// Load new entity
    			loadNewEntity().then(function(){
    				// Not busy
        	    	vm.busy = false;
    			});
    			
    		// Otherwise load existing entity
    		} else {
    			// If id is valid	//~
    			if (angular.isNumber(parseInt($stateParams.examenId))) {
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
    		$state.go('main.afiliado.edit.examen.list', {afiliadoId: $stateParams.afiliadoId});
    	} // goBack
    	
    	/*
    	 * Save changes
    	 */
    	function save() {
    		// get busy
    		getBusy();
    		
    		// If it's a new entity		//~
    		if ($stateParams.examenId === 'new') {
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
    	 * Load Medico for typeahead
    	 */
    	function getMedico($viewValue) {
    		// Request server
    		return MedicoResource.query({
    			search: $viewValue,
    			page_size: 6,
    			sorts: {nombre: 'ASC'},
    			filters: {activo: 1}
    		})
	    		// On success
	    		.$promise.then(function(data) {
	    			return vm.medico = data._embedded.medico;
    			// On error
	    		}, function(error) {
    		});
    	} // getMedico
    	
    	/*
    	 * Clean entity when tipoExamen changes
    	 */
    	function tipoExamenChange() {
    		// Clean examen content
    		vm.entity.examen = {};
    		// Call changed
    		changed();
    	} // tipoExamenChange
    	
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
    	 * Load ExamenTipo select options	//~
    	 */
    	function loadExamenTipo() {
    		// Request server
    		ExamenTipoResource.query({sorts: {tipo: 'ASC'}})
    		
	    		// On success
	    		.$promise.then(function(data) {
	    			vm.examenTipo = data._embedded.examen_tipo;
    			// On error
	    		}, function(error) {
    			
    		});
    	} // loadExamenTipo
    	
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
        		// Request entity to server, including filter parameters.		//~
        		ExamenResource.get({
        			id: $stateParams.examenId, 
        			filters: {afiliadoId: $stateParams.afiliadoId}
        		})
        			// On success
        			.$promise.then(function(data) {
        				// if examen content is empty, convert into empty object (solve conflict with examen type on update)		//~
        				if (data.examen.length == 0) {
        					data.examen = {};
        				}
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
    			ExamenResource.save(vm.entity)    			
        			// On success
        			.$promise.then(function(data) {
        				// if examen content is empty, convert into empty object (solve conflict with examen type on update)		//~
        				if (data.examen.length == 0) {
        					data.examen = {};
        				}
        				// Load new entity
        				vm.entity = data;
        				// Update route parameter with the new ID	//~
        				$stateParams['examenId'] = vm.entity.id;
        				$state.transitionTo('main.afiliado.edit.examen.edit', {afiliadoId: $stateParams.afiliadoId, examenId: vm.entity.id}, { notify: false });        				
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
    			ExamenResource.update({id: vm.entity.id}, vm.entity)    			
        			// On success
        			.$promise.then(function(data) {
        				// if examen content is empty, convert into empty object (solve conflict with examen type on update)		//~
        				if (data.examen.length == 0) {
        					data.examen = {};
        				}
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
    	    	
	} // CpExamenFormCtr
	
})();