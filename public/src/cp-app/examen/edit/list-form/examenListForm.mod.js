/**
 * cp.examen.listForm module definition
 * mario@webintegral.com.co
 */
(function() {
	'use strict';
	
	angular
		.module('cp.examen.listForm', [
             'ui.bootstrap',
             'cp.resource.examen',
             'cp.resource.examenTipo',
             'cp.resource.medico'
        ]);
})();