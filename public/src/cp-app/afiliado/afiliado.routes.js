/**
 * cp.afiliado module route definition
 * mario@webintegral.com.co
 */
(function() {
	'use strict';
	
	angular
		.module('cp.afiliado')
		.run(moduleRun);
	
	/* @ngInject */
	function moduleRun(routerHelper) {
	    routerHelper.configureStates(getStates());
	}
	
	function getStates() {
		return [
	        {
	        	state: 'main.afiliado',
	        	config: {
	        		abstract: true,
	        		url: 'afiliado',
	        		template: '<div ui-view></div>'
	        	}
	        }
        ];
	}
})();