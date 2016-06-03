/**
 * cp.medico routes
 * mario@webintegral.com.co
 * 
 * Route definition for cp.medico module.
 */
(function() {
	'use strict';
	
	angular
		.module('cp.medico')
		.run(moduleRun);
	
	/* @ngInject */
	function moduleRun(routerHelper) {
	    routerHelper.configureStates(getStates());
	}
	
	function getStates() {
		return [
	        {
	        	state: 'main.medico',
	        	config: {
	        		abstract: true,
	        		url: 'medico',
	        		template: '<div ui-view></div>'
	        	}
	        }
        ];
	}
})();