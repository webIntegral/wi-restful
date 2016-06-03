(function() {
	'use strict';
	
	angular
		.module('cp.app', [
             'wi.blocks.router',
             'cp.main',
             'cp.medico',
             'cp.afiliado',
             'cp.examen'
        ]);
})();