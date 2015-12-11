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
		.module('wi.nav.main')
		.directive('wiMainNav', wiMainNav);
	
	/**
	 * Directive definition
	 */
	function wiMainNav() {
		return {
			scope:{
				
			},
			replace: true,
			templateUrl:'/src/nav/main/mainNav.tpl.html',
			link: function(scope) {
				
			} //link
		}
	} // wiMainNav
	
})();