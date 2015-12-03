(function() {
	'use strict';
	
	/**
	 * WiGridBar Directive
	 * 
	 * This directive is a common datagrid bar with select, create, delete and search capabilities.
	 * 
	 * Usage Example:
	 * 
		<div wi-grid-bar
		 	
			show-select="true"
			show-create="true"
			show-delete="true"
			
			disable-select="false"
			disable-create="false"
			disable-delete="false"
			
			search-string="search this"
			
			on-select="vm.selectAction()"
			on-create="vm.createAction()"
			on-delete="vm.deleteAction()"
			on-search="vm.searchAction(searchString)"
			
			></div>
	 * 
	 * Attributes
	 * 
	 * 	show-select: true/false. Shows or hides Show button.
	 * 	show-create: true/false. Shows or hides Create button.
	 * 	show-delete: true/false. Shows or hides Delete button.
	 * 	disable-select: true/false. Disables or enables Show button.
	 * 	disable-create: true/false. Disables or enables Create button.
	 * 	disable-delete: true/false. Disables or Delete button.
	 * 	search-string: string. Set up a string for search string field.
	 * 	on-select: callback. Executes callback on Select button click.
	 * 	on-create: callback. Executes callback on Create button click.
	 * 	on-delete: callback. Executes callback on Delete button click.
	 * 	on-search: callback. Executes callback on Search button click or on search string input intro key. Passes searchString as parameter.
	 * 
	 * Don't forget to load module and directive .js files.
	 * 
	 */
	
	angular
		.module('wi.bar.grid')
		.directive('wiGridBar', wiGridBar);
	
	/**
	 * Directive definition
	 */
	function wiGridBar() {
		return {
			scope: {
				
				// Show/hide select button
				showSelect: '=',
				
				// Show/hide create button 
				showCreate: '=',
				
				// Show/hide delete button
				showDelete: '=',
				
				// Disable/enable select button
				disableSelect: '=',
				
				// Disable/enable create button
				disableCreate: '=',
				
				// Disable/enable delete button
				disableDelete: '=',
				
				// Property to setup a search string from parent
				searchString: '@',
				
				// Select button callback
				onSelect: '&',
				
				// Create button callback
				onCreate: '&',
				
				// Delete button callback
				onDelete: '&',
				
				// Search button callback (pass searchString as argument)
				onSearch: '&'
			},
			replace: true,
			templateUrl: 'gridBar.tpl.html',
			link: function(scope) {
				
				// On search button click, trigger onSearch event passing searchString as argument
				scope.search = function() {
					scope.onSearch({searchString: scope.searchString});
				}
				
				// On intro key, trigger onSearch event passing searchString as argument
				scope.searchKey = function(keyEvent) {
					// Only search on intro key |
					// Solo buscar con enter
					if (keyEvent.which === 13) {
						scope.onSearch({searchString: scope.searchString});
					}
				}
				
			} //link
		}
	} // wiGridBar
	
})();