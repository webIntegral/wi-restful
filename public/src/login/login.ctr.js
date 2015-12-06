(function() {
	'use strict';
	
	angular
		.module('wi.login')
		.controller('WiLoginCtr', WiLoginCtr);
	
	// Inject dependencies
	WiLoginCtr.$inject = ['$scope', '$q', '$auth'];
	
	// Controller definition
	function WiLoginCtr($scope, $q, $auth) {
    	/* jshint validthis: true */
    	var vm = this;
    	
    	// User credentials
    	vm.user = {
 		    grant_type: 'password',
 		    username: '',
 		    password: '',
 		    client_id: 'restful-wi'
    	};
    	
    	// Error Msg
    	vm.errorMsg = '';
    	
    	// flag to show 
    	vm.error = false;
    	
    	// flag to show that request is being sent
    	vm.signing = false;
    	
    	vm.login = login;
    	
    	
    	// Login action
    	function login() {
    			
    		// Clean error msg
    		vm.errorMsg = '';
			// set signing in flag
			vm.signing = true;
			// unset error flag
			vm.error = false;
			
			// Request login to server
    		$auth.authenticate( 'restful-wi', vm.user )
            	.then( function( response ) {
            		
            		// unset signing in flag
        			vm.signing = false;
        			
        			console.log('Success. Script should redirect to somewhere else now.');
            		
          		// Redirect to app root, in
              	// window.location.href = '/';
            })
            .catch(function(error) {
            	
            	switch (error.status) {            	
	            	// Invalid grant
					case 401:
						vm.errorMsg = error.data.detail;
						break;
					
					// Everything else
					default:
						vm.errorMsg = "Sorry, It seems the server is not avaliable at the moment.";
						break;
				}
            	
            	// set error flag
            	vm.error = true;
            	// unset signing in flag
    			vm.signing = false;
            });
	    		
    	}
    	
    	
    	
	} // WiLoginCtr
	
})();