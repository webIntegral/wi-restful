/**
 * cp.afiliado.grid module definition
 * mario@webintegral.com.co
 */
(function() {
	'use strict';
	
	angular
		.module('cp.afiliado.grid', [
             'ui.bootstrap',
             'cp.resource.afiliado',
             'ui.grid',
             'ui.grid.selection',
             'ui.grid.infiniteScroll'
     ]);
})();