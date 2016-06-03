/**
 * wi.login
 * 
 * WiLoginCtr
 * 
 * Login Form Controller
 * 
 */
(function() {
	'use strict';
	
	angular
		.module('wi.login')
		.controller('WiLoginCtr', WiLoginCtr);
	
	// Inject dependencies
	WiLoginCtr.$inject = ['$scope', '$q', 'AuthService'];
	
	// Controller definition
	function WiLoginCtr($scope, $q, AuthService) {
    	/* jshint validthis: true */
    	var vm = this;
    	
    	// flags
    	vm.busy = false;
    	vm.error = false;
    	
    	// Init empty credentials
    	vm.credentials = {
 		    username: '',
 		    password: ''
    	};
    	
    	// Bindables
    	vm.login = login;
    	
    	activate();
    	
    	///////////
    	
    	/*
    	 * Activate Controller
    	 */
    	function activate() {
    		
    	}

    	// Login click
    	function login() {
    		// Get busy
    		getBusy();
    		
    		authenticate().then(function(data) {
    			vm.busy = false;
    		}, function(error) {
    			// Show error
				vm.error = error;
    			vm.busy = false;
    		});
    	}
    	
    	///////////
    	
    	// Authenticate
    	function authenticate() {
    		return $q(function(resolve, reject) {
    			// Request Login
    			AuthService.login(vm.credentials)
    				// On success
    				.then(function(data) {
    					
    				// On error
    				}, function(error) {
        				// return appropiated error message
        				var errorMsg;
        				switch (error.status) {
        					
        					case '50x':
        						// TODO: Handle login error 
        					
    						default:
    							errorMsg = 'Error al intentar autenticarse.';
    							break;
    					}
        				// reject
        				reject(errorMsg);
    			}); // login
    		});
    	}
    	
    	/*
    	 * get Busy
    	 */
    	function getBusy() {
    		// Clean errors
    		vm.error = false;
    		// Get busy
    		vm.busy = true;
    	} // getBusy
    	
    	
	} // WiLoginCtr
	
})();