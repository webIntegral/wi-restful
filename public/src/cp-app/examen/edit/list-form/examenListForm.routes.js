/**
 * cp.examen.listForm route definition
 * mario@webintegral.com.co
 */
(function() {
	'use strict';
	
	angular
		.module('cp.examen.listForm')
		.run(moduleRun);
	
	/* @ngInject */
	function moduleRun(routerHelper) {
	    routerHelper.configureStates(getStates());
	}
	
	function getStates() {
		return [
	        {
	        	state: 'main.afiliado.edit.examen.listcreate',
	        	config: {
	        		url: '/list-create',
	        		views: {
	        			'@main.afiliado': {
        	        		templateUrl: '/src/cp-app/examen/edit/list-form/examenListForm.tpl.html',
        	        		controller: 'CpExamenListFormCtr',
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