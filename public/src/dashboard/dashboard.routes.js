(function() {
	'use strict';
	
	angular
		.module('wi.dashboard')
		.run(moduleRun);
	
	/* @ngInject */
	function moduleRun(routerHelper) {
	    routerHelper.configureStates(getStates());
	}
	
	function getStates() {
		return [
	        {
	        	state: 'main.dashboard',
	        	config: {
	        		url: '/dashboard',
	        		templateUrl: '/src/dashboard/dashboard.tpl.html',
	        		controller: 'WiDashboardCtr',
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