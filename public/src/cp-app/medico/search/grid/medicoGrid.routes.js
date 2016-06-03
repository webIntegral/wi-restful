/**
 * cp.medico.grid routes
 * mario@webintegral.com.co
 * 
 * Route definition for cp.medico.grid module.
 */
(function() {
	'use strict';
	
	angular
		.module('cp.medico.grid')
		.run(moduleRun);
	
	/* @ngInject */
	function moduleRun(routerHelper) {
	    routerHelper.configureStates(getStates());
	}
	
	function getStates() {
		return [
	        {
	        	state: 'main.medico.list',
	        	config: {
	        		url: '',
	        		views: {
	        			'': {
	    	        		templateUrl: '/src/cp-app/medico/search/grid/medicoGrid.tpl.html',
	    	        		controller: 'CpMedicoGridCtr',
	    	        		controllerAs: 'vm',
	    	        		resolve:{
	    	        			acl: function() {
	    	        				
	    	        				/*
	    	        				 * @todo: Code how to get this acl from server
	    	        				 * so one can deal with this easyly
	    	        				 */
	    	        				return {
	    	        			    	allowCreate: true,
	    	        			    	allowDelete: true,
	    	        			    	showGoBack: true,
	    	        			    	showSelect: false,
	    	        			    	showCreate: true,
	    	        			    	showDelete: true,
	    	        			    	showSearch: true
	    	        				}
	    	        			}
	    	        		}
	        			}
	        		},
	        		access: {
	        			login: false,
	        			allowedRoles: ['Admin']
	        		}
	        	}
	        }
        ];
	}
	
})();