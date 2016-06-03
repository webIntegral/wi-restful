/**
 * cp.examen.form routes
 * mario@webintegral.com.co
 * 
 * Route definition for cp.examen.form module.
 */
(function() {
	'use strict';
	
	angular
		.module('cp.examen.form')
		.run(moduleRun);
	
	/* @ngInject */
	function moduleRun(routerHelper) {
	    routerHelper.configureStates(getStates());
	}
	
	function getStates() {
		return [
	        {
	        	state: 'main.afiliado.edit.examen.edit',
	        	config: {
	        		url: '/edit/{examenId}',
	        		views: {
	        			'@main.afiliado': {
        	        		templateUrl: '/src/cp-app/examen/edit/form/examenForm.tpl.html',
        	        		controller: 'CpExamenFormCtr',
				    		controllerAs: 'vm',
				    		resolve:{
				    			acl: function() {
				    				
			        				/*
			        				 * @todo: Code how to get this acl from server
			        				 * so one can deal with this easyly
			        				 */
			        				return {
			        					allowCreate: true,
			        					allowEdit: true,
			        		        	showGoBack: true
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