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
		.module('cp.nav')
		.directive('cpNav', cpNav);
	
	/**
	 * Directive definition
	 */
	function cpNav() {
		var directive = {
			restrict: 'EA',
			templateUrl:'/src/cp-app/layout/nav/nav.tpl.html',
			replace: true,
			scope: {
				
			},
			link: linkFunction,
			controller: CpNavCtr,
			controllerAs: 'vm',
			bindToController: true
		}
		return directive;
		
		function linkFunction(scope, element, attrs, ctrl) {
			
		} // linkFunction
		
	} // CpNav
	
	CpNavCtr.$inject = ['$scope', '$q'/*, '$auth', 'AuthService'*/];
	
	// Controller definition
	function CpNavCtr($scope, $q/*, $auth, AuthService*/) {
		/* jshint validthis: true */
		var vm = this;
		
		vm.logout = logout;
		
		// Logout click
		function logout() {
			
			// Request logout
			///AuthService.logout();
			
		} // logout
		
	} // CpNavCtr
	
})();