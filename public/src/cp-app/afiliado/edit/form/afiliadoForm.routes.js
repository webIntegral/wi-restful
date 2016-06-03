/**
 * cp.afiliado.form route definition
 * mario@webintegral.com.co
 */
(function() {
	'use strict';
	
	angular
		.module('cp.afiliado.form')
		.run(moduleRun);
	
	/* @ngInject */
	function moduleRun(routerHelper) {
	    routerHelper.configureStates(getStates());
	}
	
	function getStates() {
		return [
	        {
	        	state: 'main.afiliado.edit',
	        	config: {
	        		url: '/{afiliadoId}',
	        		views: {
	        			'': {
			        		templateUrl: '/src/cp-app/afiliado/edit/form/afiliadoForm.tpl.html',
			        		controller: 'CpAfiliadoFormCtr',
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
			        		        	showGoBack: true,
			        		        	allowExamenes: true
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