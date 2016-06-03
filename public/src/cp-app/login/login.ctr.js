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
	WiLoginCtr.$inject = ['$scope', '$q', 'AuthService',];
	
	// Controller definition
	function WiLoginCtr($scope, $q, AuthService) {
    	/* jshint validthis: true */
    	var vm = this;
    	
    	vm.credentials = {
 		    username: '',
 		    password: ''
    	};
    	
    	vm.errorMsg = '';		// Error Msg
    	vm.error = false;		// flag to show 
    	vm.signing = false;		// flag to show that request is being sent
    	vm.login = login;		// login action (login button)
    	
    	// Login action
    	function login() {
    			
    		// Clean error msg
    		vm.errorMsg = '';
			// set signing in flag
			vm.signing = true;
			// unset error flag
			vm.error = false;
			
			// Request Login
    		AuthService.login(vm.credentials)
    			// On success
				.then(function(data) {
					
					// unset signing in flag
        			vm.signing = false;
					
				// On error
				}).catch(function(error) {
					// Show error
					vm.errorMsg = error.data.detail;
	            	// Set error flag
	            	vm.error = true;
	            	// Unset signing in flag
	    			vm.signing = false;
			});
    	}
    	
	} // WiLoginCtr
	
})();