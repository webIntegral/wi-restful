(function() {
	'use strict';
	
	angular
		.module('wi.main')
		.run(moduleRun);
	
	/* @ngInject */
	function moduleRun(routerHelper) {
	    routerHelper.configureStates(getStates(), '/');
	}
	
	function getStates() {
		return [
	        {
	        	state: 'main',
	        	config: {
	        		url: '/',
	        		templateUrl: 'main/main.tpl.html',
	        		controller: 'WiMainCtr',
	        		controllerAs: 'vm',
        			access: {
	                    login: true,
	                    allowedRoles: ['Admin']
        			}
	        	}
	        }
        ];
	}
	
})();