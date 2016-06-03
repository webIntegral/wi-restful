/**
 * wi.role module route definition
 * mario@webintegral.com.co
 */
(function() {
	'use strict';
	
	angular
		.module('wi.role')
		.run(moduleRun);
	
	/* @ngInject */
	function moduleRun(routerHelper) {
		routerHelper.configureStates(getStates());
	}
	
	function getStates() {
		return [
	        {
	        	state: 'main.role',
	        	config: {
	        		abstract: true,
	        		url: 'role',
	        		template: '<div ui-view></div>'
	        	}
	        }
        ];
	} // getStates
})();