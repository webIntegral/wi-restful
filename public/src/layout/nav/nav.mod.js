/**
 * Main Nav module
 */
(function() {
	'use strict';
	
	angular
		.module('wi.nav', [
		    'ui.bootstrap',
		    'wi.blocks.router',
		    'wi.oauth',
		    //'wi.resource.logout'
        ]);
})();