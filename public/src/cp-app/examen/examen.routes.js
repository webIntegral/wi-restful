/**
 * cp.examen routes
 * mario@webintegral.com.co
 * 
 * Route definition for cp.examen module.
 */
(function() {
	'use strict';
	
	angular
		.module('cp.examen')
		.run(moduleRun);
	
	/* @ngInject */
	function moduleRun(routerHelper) {
	    routerHelper.configureStates(getStates());
	}
	
	function getStates() {
		return [
	        {
	        	state: 'main.afiliado.edit.examen',
	        	config: {
	        		abstract: true,
	        		url: '/examen'
	        	}
	        }
        ];
	}
})();