'use strict';

app.controller('chartCtrl', ['$scope', 'memberService', function($scope, memberService){
	//fetch members
	$scope.fetch = function(){
		var members = memberService.readChart();
		members.then(function(response){
			$scope.members = response.data;
		});
	}

}]);