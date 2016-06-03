/**
 * cp.afiliado.search routes
 * mario@webintegral.com.co
 * 
 * Route definition for cp.afiliado.search module.
 */
(function() {
	'use strict';
	
	angular
		.module('cp.afiliado.searchForm')
		.run(moduleRun);
	
	/* @ngInject */
	function moduleRun(routerHelper) {
	    routerHelper.configureStates(getStates());
	}
	
	function getStates() {
		return [
	        {
	        	state: 'main.afiliado.search',
	        	config: {
	        		url: '/{afiliadoId:[0-9]{0,9}}',
	        		views: {
        				'': {
        	        		templateUrl: '/src/cp-app/afiliado/search/form/afiliadoSearch.tpl.html',
        	        		controller: 'CpAfiliadoSearchCtr',
        	        		controllerAs: 'vm',
        	        		resolve:{
        	        			acl: function() {
        	        				
        	        				/*
        	        				 * @todo: Code how to get this acl from server
        	        				 * so one can deal with this easyly
        	        				 */
        	        				return {
        	        					allowEdit: true,		// allow edit fields
        	        					allowExamenes: true,	// show examenes button
        	        					allowCitas: true,
        	        					allowAutorizaciones: true,
        	        					isEditable: true
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