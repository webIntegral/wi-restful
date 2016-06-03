/**
 * cp.examen.form module
 * mario@webintegral.com.co
 * 
 * Module definition for cp.examen.form module.
 */
(function() {
	'use strict';
	
	angular
		.module('cp.examen.form', [
             'ui.bootstrap',
             'cp.resource.examen',
             'cp.resource.examenTipo',
             'cp.resource.medico'
        ]);
})();