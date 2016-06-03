/**
 * cp.afiliado.grid route definition
 * mario@webintegral.com.co
 */
(function() {
	'use strict';
	
	angular
		.module('cp.afiliado.grid')
		.run(moduleRun);
	
	/* @ngInject */
	function moduleRun(routerHelper) {
		routerHelper.configureStates(getStates());
	}
	
	function getStates() {
		return [
	        {
	        	state: 'main.afiliado.list',
	        	config: {
	        		url: '',
	        		views: {
	        			'': {
	        				templateUrl: '/src/cp-app/afiliado/search/grid/afiliadoGrid.tpl.html',
	        				controller: 'CpAfiliadoGridCtr', 
	        				controllerAs: 'vm',
	        				resolve: {
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
	} // getStates
})();