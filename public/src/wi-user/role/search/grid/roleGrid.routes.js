/**
 * wi.role.grid route definition
 * mario@webintegral.com.co
 */
(function() {
	'use strict';
	
	angular
		.module('wi.role.grid')
		.run(moduleRun);
	
	/* @ngInject */
	function moduleRun(routerHelper) {
		routerHelper.configureStates(getStates());
	}
	
	function getStates() {
		return [
	        {
	        	state: 'main.role.list',
	        	config: {
	        		url: '',
	        		views: {
	        			'': {
	        				templateUrl: '/src/wi-user/role/search/grid/roleGrid.tpl.html',
	        				controller: 'WiRoleGridCtr',
	        				controllerAs: 'vm',
	        				resolve: {
	        					// App Config (Depending on functionality)
	        					cfg: function() {
	        						return {
	        							showGoBack: true,
	        							showSelect: false,
	        							showCreate: true,
	        							showRefresh: true,
	        							showDelete: true,
	        							showSearch: true
	        						}
	        						
	        					},
	        					// Access Control List
	        					acl: function() {
	        						return {
	        							search: true,
	        							searchAll: true,
	        							searchOwn: true,
	        							edit: true,
	        							create: true,
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