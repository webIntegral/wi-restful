(function() {
	'use strict';
	
	/**
	 * wiMainNav Directive
	 * 
	 * This directive handles main app navigation menu (responsive).
	 * 
	 * ¡Importan! This directive depends on 'ui.bootstrap' module. 
	 * 
	 * Usage Example:
	 * 
		<div wi-main-nav></div>
	 * 
	 */
	
	angular
		.module('wi.nav')
		.directive('wiNav', wiNav);
	
	/**
	 * Directive definition
	 */
	function wiNav() {
		return {
			scope:{
				
			},
			replace: true,
			templateUrl:'layout/nav/nav.tpl.html',
			link: function(scope) {
				
			} //link
		}
	} // wiMainNav
	
})();