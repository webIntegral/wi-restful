/**
 * cp.examen.listForm Controller
 * mario@webintegral.com.co
 * 
 * This controller handles Examen Form, creation and edition.
 */
(function() {
	'use strict';
	
	angular
		.module('cp.examen.listForm')
		.controller('CpExamenListFormCtr', CpExamenListFormCtr);
	
	CpExamenListFormCtr.$inject = ['$scope', 'acl', '$q', '$state', '$stateParams', 'ExamenResource', 'ExamenTipoResource', 'MedicoResource'];	//~
	
	function CpExamenListFormCtr($scope, acl, $q, $state, $stateParams, ExamenResource, ExamenTipoResource, MedicoResource) {	//~
    	/* jshint validthis: true */
    	var vm = this;
    	
    	// load acl
    	vm.acl = acl;
    	
    	// flags
    	vm.busy = true;		// busy
    	vm.hasChanges = false;	// changes without save
    	vm.error = false;		// error
    	vm.loadingMedico;		// loading data in typeahead
    	
    	// Examenes properties
    	vm.examenDetail = {
			codigoCausaExterna: '', 
			medico: ''
    	};
    	
    	// Examenes list
    	vm.examenes = {
			parcialOrina: {
				create: false,
				tipo: 1
			},
			coprologico: {
				create: false,
				tipo: 2
			},
			hematologia: {
				create: false,
				tipo: 3
			},
			quimicaSanguinea: {
				create: false,
				tipo: 4
			},
			inmunologia: {
				create: false,
				tipo: 5
			},
			frotisVaginal: {
				create: false,
				tipo: 6
			}
    	};
    	
    	// Bindable functions
    	vm.goBack = goBack;
    	vm.save = save;
    	vm.getMedico = getMedico;
    	
    	activate();
    	
    	///////////
    	
    	/*
    	 * Activate Controller
    	 */
    	function activate() {
    		// not busy
    		vm.busy = false;
    	}
    	
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
    		
    		/****/
    		
    		
    		/*****/
    		
    		angular.forEach(vm.examenes, function(examen, key) {
    			if(examen.create) {
    				create({
						tmp: {
							codigoCausaExterna: vm.examenDetail.codigoCausaExterna,
							codigoClaseServicio: vm.examenDetail.codigoClaseServicio,
							valorCostoEps: '',
							valorCuotaModeradora: ''
						},
						_embedded: {
							examenTipo:{
								id: examen.tipo,
							},
							afiliado: {
								id: $stateParams.afiliadoId
							},
							medico: vm.examenDetail.medico
						},
						examen: {}
					});
					
    			}
    		})
			$state.go('main.afiliado.edit.examen.list', {afiliadoId: $stateParams.afiliadoId});
    		
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
    	 * Create entity
    	 */
    	function create(entity) {
    		return $q(function(resolve, reject) {
    			// Request creation to server	//~
    			ExamenResource.save(entity)    			
        			// On success
        			.$promise.then(function(data) {
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