(function() {
	'use strict';
	
	angular
		.module('wi.oauth', [
		    'satellizer'
        ])
        
        // Configure auth provider
        // read more https://github.com/sahat/satellizer
        .config(function($authProvider) {
        	
            // $authProvider.loginUrl = '/oauth';
            $authProvider.tokenName = 'access_token';

            $authProvider.oauth2({
            	name: 'restful-wi',
            	url: '/oauth',
            	clientId: 'restful-wi',
            	responseParams: {
            		clientId: 'client_id'
            	},
            	redirectUri: '/'
        		//redirectUri: window.location.origin,
            });
        	
        });
})();