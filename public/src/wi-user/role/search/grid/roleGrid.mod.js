/**
 * wi.role.grid module route definition
 * mario@webintegral.com.co
 */
(function() {
	'use strict';
	
	angular
		.module('wi.role.grid', [
             'ui.bootstrap',
             'wi.resource.role',
             'ui.grid',
             'ui.grid.selection',
             'ui.grid.infiniteScroll'
     ]);
})();