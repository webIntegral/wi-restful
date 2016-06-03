(function() {
	'use strict';
	
	angular
		.module('wi.login')
		.run(moduleRun);
	
	moduleRun.$inject = ['routerHelper'];
	/* @ngInject */
	function moduleRun(routerHelper) {
	    routerHelper.configureStates(getStates());
	}
	
	function getStates() {
		return [
	        {
		        state: 'login',
		        config: {
		        	url: '/login',
		        	templateUrl: 'login/login.tpl.html',
		        	controller: 'WiLoginCtr',
		        	controllerAs: 'vm',
        			access: {
        				login: false,
	                    allowedRoles: []
        			}
		        }
	        }
        ];
	}
	
})();