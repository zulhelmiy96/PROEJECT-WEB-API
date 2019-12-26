'use strict';

app.factory('memberService', function($http){
	return{
		read: function(){
			var read = $http.get('api/read.php');
			return read;
		},
		create: function(member){
			var add = $http.post('api/add.php', member);
			return add;
		},
		update: function(member){
			var edit = $http.post('api/edit.php', member);
			return edit;
		},
		delete: function(member){
			var del = $http.post('api/delete.php', member);
			return del;
		},
		readChart: function(){
			var read = $http.get('api/chart.php');
			return read;
		},
		order: function(member){
			var addOrder = $http.post('api/order.php', member);
			return addOrder;
		}
	}
});