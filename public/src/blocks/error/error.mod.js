/*
 * wi.blocks.error
 * Error Handler
 * 
 * This module handles application Errors
 * 
 */
(function() {
	'use strict';
	
	angular
		.module('wi.blocks.error', [
		                            
        ])
        
        .config(function($httpProvider) {
        	$httpProvider.interceptors.push('httpErrorInterceptor');
        });
})();