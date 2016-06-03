/**
 * wi.formaters date service
 * mario@webintegral.com.co
 */
(function() {
	'use strict';
	
	angular
		.module('wi.formaters')
		.factory('wiDateFormater', wiDateFormater);
	
	wiDateFormater.$inject = [];
	
	function wiDateFormater() {
		
		var service = {
			toDate: toDate,
			toString: toString
		}
		
		return service;
		
		///////////
		
		/**
		 * Transform server date format into local format
		 * Assuming server and local timezones are the UTC-5
		 * Result should be a javascript Date object
		 */
		function toDate(date) {
			
			// Init date string
			var fDate = '0000-00-00T00:00:00-05:00';
			
			// If date is not null or empty
			if (null != date && '' != date) {
				// transform string into '2016-09-21T12:05:10-05:00'
				fDate = date.replace(' ', 'T')+'-05:00';				
			}

			// Return a date object
			return new Date(fDate);
		}
		
		/**
		 * Transform local date format (javascript Date object) into server format
		 * Assuming server and local timezones are the UTC-5
		 * Result should look like '2016-09-21 12:05:10'
		 */
		function toString(date) {
			
			// We do not validate this, since it's always a Date object ¿Should we?
			
			// Get month
			var month = date.getMonth() + 1;
			month = month.toString();
			month = (month.length == 1 ? '0'+month : month);
			
			// Get day
			var day = date.getDate().toString();
			day = (day.length == 1 ? '0'+day : day);
			
			// Get hour
			var hour = date.getHours().toString();
			hour = (hour.length == 1 ? '0'+hour : hour);
			
			// Get minutes
			var min = date.getMinutes().toString();
			min = (min.length == 1 ? '0'+min : min);
			
			// Get seconds
			var sec = date.getSeconds().toString();
			sec = (sec.length == 1 ? '0'+sec : sec);
			
			// Build date string
			return date.getFullYear()+'-'+month+'-'+day+' '+hour+':'+min+':'+sec;
		}
		
	} // wiDateFormater
})();