/**
 * cp.examen module
 * mario@webintegral.com.co
 * 
 * Module definition for cp.afiliado
 */
(function() {
	'use strict';
	
	angular
		.module('cp.examen', [
            'wi.blocks.router',
            'cp.examen.grid',
            'cp.examen.form',
            'cp.examen.listForm'
            //'wi.blocks.error' 
      	]);
})();