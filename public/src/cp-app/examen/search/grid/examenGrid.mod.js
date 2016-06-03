/**
 * cp.examen.grid module
 * mario@webintegral.com.co
 * 
 * Module definition for cp.examen.grid module.
 */
(function() {
	'use strict';
	
	angular
		.module('cp.examen.grid', [
           'ui.bootstrap',
           'cp.resource.examen',
           'ui.grid',
           'ui.grid.selection',
           'ui.grid.infiniteScroll'
        ]);
})();