/**
 * cp.medico module definition
 * mario@webintegral.com.co
 */
(function() {
	'use strict';
	
	angular
		.module('cp.afiliado', [
            'wi.blocks.router',
            'cp.afiliado.grid',
            'cp.afiliado.form'
            //'wi.blocks.error' 
      	]);
})();