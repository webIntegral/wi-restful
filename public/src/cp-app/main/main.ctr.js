(function() {
	'use strict';
	
	angular
		.module('cp.main')
		.controller('CpMainCtr', CpMainCtr);
	
	CpMainCtr.$inject = ['$scope'];
	
	function CpMainCtr($scope) {
    	/* jshint validthis: true */
    	var vm = this;
    	
	} // CpMainCtr
	
})();