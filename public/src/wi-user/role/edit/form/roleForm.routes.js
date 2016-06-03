/**
 * wi.role.form route definition
 * mario@webintegral.com.co
 */
(function() {
	'use strict';
	
	angular
		.module('wi.role.form')
		.run(moduleRun);
	
	/* @ngInject */
	function moduleRun(routerHelper) {
		routerHelper.configureStates(getStates());
	}
	
	function getStates() {
		return [
	        {
	        	state: 'main.role.edit',
	        	config: {
	        		url: '/{roleId}',
	        		views: {
	        			'': {
	        				templateUrl: '/src/wi-user/role/edit/form/roleForm.tpl.html',
	        				controller: 'WiRoleFormCtr',
	        				controllerAs: 'vm',
	        				resolve: {
	        					// App Config (Depending on functionality)
	        					cfg: function() {
	        						return {
	        							showGoBack: true,
	        							showSave: true,
	        						}
	        					},
	        					// Access Control List
	        					acl: function() {
	        						return {
	        							create: true,
	        							edit: true,
	        							del: true,
	        							showField: true,
	        							editField: true,
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