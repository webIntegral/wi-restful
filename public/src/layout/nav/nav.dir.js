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
		var directive = {
			restrict: 'EA',
			templateUrl:'/src/layout/nav/nav.tpl.html',
			replace: true,
			scope: {
				
			},
			link: linkFunction,
			controller: WiNavCtr,
			controllerAs: 'vm',
			bindToController: true
		}
		return directive;
		
		function linkFunction(scope, element, attrs, ctrl) {
			
		} // linkFunction
		
	} // wiNav
	
	WiNavCtr.$inject = ['$scope', '$q', '$auth', 'AuthService'];
	
	// Controller definition
	function WiNavCtr($scope, $q, $auth, AuthService) {
		/* jshint validthis: true */
		var vm = this;
		
		vm.logout = logout;
		
		// Logout click
		function logout() {
			
			// Request logout
			AuthService.logout();
			
		} // logout
		
	} // WiNavCtr
	
})();