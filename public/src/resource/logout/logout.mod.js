/**
 * wi.resource.logout
 * 
 * Logout Resource
 * 
 * This Resource requests the server to delete token to "kill session".
 * Server uses Satellizer Token.
 * 
 */
(function() {
	'use strict';
	
	angular
		.module('wi.resource.logout', [
		   'ngResource'
        ]);
})();