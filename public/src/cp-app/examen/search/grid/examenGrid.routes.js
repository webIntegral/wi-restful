/**
 * cp.examen.grid routes
 * mario@webintegral.com.co
 * 
 * Route definition for cp.examen.grid module.
 */
(function() {
	'use strict';
	
	angular
		.module('cp.examen.grid')
		.run(moduleRun);
	
	/* @ngInject */
	function moduleRun(routerHelper) {
	    routerHelper.configureStates(getStates());
	}
	
	function getStates() {
		return [
	        {
	        	state: 'main.afiliado.edit.examen.list',
	        	config: {
	        		url: '',
	        		views: {
	        			'@main.afiliado': {
        	        		templateUrl: '/src/cp-app/examen/search/grid/examenGrid.tpl.html',
        	        		controller: 'CpExamenGridCtr',
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
	                    login: true,
	                    allowedRoles: ['Admin']
        			}
	        	}
	        }
	        
        ];
	}
})();