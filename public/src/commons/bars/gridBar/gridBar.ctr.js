/**
 * 
 * Grid Bar Controller
 * 
 * Handle the events triggered by bar's buttons and inputs, and emits appopiated events.
 * This events bubble up to parent controller, who trigger appopiated datagrid actions
 * 
 * Maneja los eventos generados por los botones y los inputs y emite los eventos apropiados.
 * Los eventos "suben" hasta el controlador padre, quién hace las solicitudes apropiadas para el datagrid.
 * 
 */
(function () {
	
	angular
		.module('wi.bar.gridBar')
		.service('GridBarSrv', GridBarSrv)
		.controller('GridBarCtr', GridBarCtr)
		.directive('wiGridBar', wiGridBar);
	
	function wiGridBar () {
		return {
			scope: {
				showSelect: '@',
				showCreate: '=',
				showDelete: '=',
				disableSelect: '=',
				disableCreate: '=',
				disableDelete: '=',
				searchString: '=',
				select:'&',
				create:'&',
				del:'&'
			},
			transclude: true,
			templateUrl: 'gridBar.tpl.html',
			controller: GridBarCtr,
	        controllerAs: 'vm',
	        bindToController: true
				
		}
		
	}
	
	function GridBarSrv () {
		this.disableSelect = false;
		this.disableDelete = false;
		this.disableCreate = false;
		this.searchString = '';
		
		this.getDisableDelete = function () {
			//debugger;
			return this.disableDelete;
		}
	}
	
	GridBarCtr.$inject = ['$scope', 'GridBarSrv'];
	
	function GridBarCtr ($scope, GridBarSrv) {
		/* jshint validthis: true */
		var vm = this;
		
		//debugger;
		
		// Bindables
		vm.selectClk = selectClk;
		vm.createClk = createClk;
		vm.deleteClk = deleteClk;
		vm.searchClk = searchClk;
		vm.searchKey = searchKey;
		
		activate ();
		
		/* Directive Testing */
		
		// console.log($scope.showSelect);
		
		/*/Directive Testing */
		
		// Activate controller | Enable controller
		function activate () {
			
		}
		
		// *** Event listeners ***
		
		// Disables/Enables delete button on 'gridBar.disableDelete' Event
		$scope.$on('gridBar.disableDelete', function (event, data) {
			// Update service variable
			// GridBarSrv.disableDelete = data;
			// Update controller variable
			vm.disableDelete = data;
		});
		
		// *** Events | Eventos ***
		
		// Create click event
		function selectClk () {
			console.log('Select Click');
			$scope.$emit('gridBar.select');
			$scope.apply(function() {
				$scope.select();
			});
		};
		
		// Create click event
		function createClk () {
			console.log('Create Click');
			$scope.$emit('gridBar.create');
		};
		
		// Delete click event 
		function deleteClk () {
			console.log('Delete Click');
			$scope.$emit('gridBar.delete');
		};
		
		// Search button click event | Evento clic en el botón Búsqueda
		function searchClk () {
			console.log('Search Click: '+ vm.searchString);
			$scope.$emit('gridBar.search', vm.searchString);
		};
		
		// Search input Intro key event | Evento tecla en el campo de búsqueda
		function searchKey (keyEvent) {
			// Only search on intro key |
			// Solo buscar con enter
			if (keyEvent.which === 13) {
				console.log('Search Input Intro: '+ vm.searchString);
				$scope.$emit('gridBar.search', vm.searchString);
			}
		}
	}
	
})();