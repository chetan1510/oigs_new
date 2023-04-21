var init_filters = {
	page_no : 1,
    max_per_page : 100,
    max_page: 1,
    order_by: '',
    order_type: 'ASC',
    export: false,
    show: false,
	action_date_start: "",
	action_date_end: "",
	create_start: "",
	create_end: "",
	order_by: '',
	order_type: 'ASC'
};

app.controller('image_controller', function($scope,$http,DBService,Upload){
	
	$scope.dataset = [];
	$scope.loading = true;
	$scope.filter = init_filters;

	$scope.getList = function(){
		$scope.processing = true;
		DBService.postCall( $scope.filter ,'/upload/front-back-image/init').then(function(data){
			if(data.success){
				$scope.dataset = data.images;
				$scope.total = data.total;
				$scope.imageMode = data.imageMode;
          		$scope.filter.max_page = Math.ceil($scope.total/$scope.filter.max_per_page)
			}
			$scope.loading = false;
			$scope.processing = false;
			$scope.hide_reset = false;
		});
	}



	$scope.searchList = function(){
	    $scope.filter.page_no = 1;
	    $scope.getList();
	}


	$scope.delete = function(id, index){
		bootbox.confirm("Are you sure?", (check)=>{
	      if(check){
				DBService.getCall("/upload/front-back-image/delete/"+id).then(function(data){
					if(data.success){
						$scope.getList();
						bootbox.alert(data.message);
					}
				});
			}
		});
	}



	$scope.checkAll = function(){
		$scope.formData.checkAll = !$scope.formData.checkAll;
		for (var i = 0; i < $scope.dataset.length; i++) {
			if($scope.formData.checkAll){
				if($scope.selectedLeads.indexOf($scope.dataset[i].id) < 0){
					$scope.selectedLeads.push($scope.dataset[i].id);
				}
			} else {
				var index = $scope.selectedLeads.indexOf($scope.dataset[i].id);
				$scope.selectedLeads.splice(index,1);
			}
		}
	}

});