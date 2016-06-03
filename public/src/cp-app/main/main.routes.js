(function() {
	'use strict';
	
	angular
		.module('cp.main')
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
	        		templateUrl: '/src/cp-app/main/main.tpl.html',
	        		controller: 'CpMainCtr',
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