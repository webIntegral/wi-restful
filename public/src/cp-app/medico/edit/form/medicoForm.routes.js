/**
 * cp.medico.form route definition
 * mario@webintegral.com.co
 */
(function() {
	'use strict';
	
	angular
		.module('cp.medico.form')
		.run(moduleRun);
	
	/* @ngInject */
	function moduleRun(routerHelper) {
	    routerHelper.configureStates(getStates());
	}
	
	function getStates() {
		return [
	        {
	        	state: 'main.medico.edit',
	        	config: {
	        		url: '/{medicoId}',
	        		views: {
	        			'': {
			        		templateUrl: '/src/cp-app/medico/edit/form/medicoForm.tpl.html',
			        		controller: 'CpMedicoFormCtr',
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
	        			login: false,
	        			allowedRoles: ['Admin']
	        		}
	        	}
	        }
        ];
	}
})();