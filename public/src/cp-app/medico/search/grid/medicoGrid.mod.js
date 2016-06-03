/**
 * cp.medico.grid module
 * mario@webintegral.com.co
 * 
 * Module definition for cp.medico.grid module.
 */
(function() {
	'use strict';
	
	angular
		.module('cp.medico.grid', [
             'ui.bootstrap',
             'cp.resource.medico',
             'ui.grid',
             'ui.grid.selection',
             'ui.grid.infiniteScroll'
    ]);
})();