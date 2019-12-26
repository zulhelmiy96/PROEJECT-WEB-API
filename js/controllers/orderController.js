'use strict';

app.controller('orderCtrl', ['$scope', 'memberService', '$location', '$stateParams', function($scope, memberService, $location, $stateParams){
	$scope.error = false;
	$scope.orderList = $stateParams.member;

	//place order
	$scope.order = function(){
		var placeOrder = memberService.order($scope.orderList);
		placeOrder.then(function(response){
			console.log(response);
			if(response.data.error){
				$scope.error = true;
				$scope.message = response.data.message;
			}
			else{
				console.log(response);
				$location.path('chart');
			}
		});
	}

}]);