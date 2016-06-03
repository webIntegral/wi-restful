(function() {
	'use strict';
	
	angular
		.module('wi.app',[
              //'ui.router', // @todo: This library it's loaded on router.mod.js. Do we need to load it again? Test.
              'wi.blocks.router',	// Handle Routes 
              'wi.blocks.error',	// Handle Http Errors
              'wi.oauth',			// Handle Auth Tokens
              'wi.login',
              'wi.main',
              //'wi.dashboard'
        ])
		/*.config(function($stateProvider, $urlRouterProvider) {
			// For any unmatched url, redirect to /state1
			// $urlRouterProvider.otherwise("/dashboard");
		})
		*/;
})();