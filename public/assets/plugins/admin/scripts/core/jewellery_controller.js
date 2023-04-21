var jewelerry_filters = {
	page_no : 1,
    max_per_page : 200,
    max_page: 1,
    order_by: '',
    order_type: 'ASC',
    export: false,
    show: false,
	create_start: "",
	create_end: "",
	order_by: '',
	order_type: 'ASC'
};

app.controller('jewellery_Controller', function($scope,$http,DBService,Upload){
	
	$scope.formData = {amount:0};
	$scope.dataset = [];
	$scope.loading = true;
	$scope.filter = jewelerry_filters;
	$scope.jewelleryIds = [];
	$scope.report = {};

	$scope.getList = function(){
		$scope.processing = true;
		DBService.postCall( $scope.filter ,'/jewellery/init').then(function(data){
			if(data.success){
				$scope.dataset = data.jewelleries;
				$scope.total = data.total;
          		$scope.filter.max_page = Math.ceil($scope.total/$scope.filter.max_per_page);
          		$scope.customers = data.customers;
				$scope.results = data.results;
				$scope.productTypes = data.productTypes;
			}
			$scope.loading = false;
			$scope.processing = false;
			$scope.hide_reset = false;
		});
	}


	$scope.addEditInit = function($id){
		$scope.loading = true;
		DBService.getCall('/jewellery/get-jewellery/'+$id).then(function(data){
			if(data.success){
				if($id == 0){
					$scope.formData.report_no = data.report_no;
					$scope.formData.reprt_sequence = data.reprt_sequence;
				} else {
					$scope.formData = data.jewellery;
				}
				$scope.customers = data.customers;
				$scope.results = data.results;
				$scope.weightType = data.weightType;
				$scope.mesurementType = data.mesurementType;
				$scope.frontImages = data.frontImages;
				$scope.backImages = data.backImages;
				$scope.productTypes = data.productTypes;
			}
		});
		$scope.loading = false;
	}

	$scope.dueAmount = function(){
		$scope.formData.due_amount = $scope.formData.testing_charge - $scope.formData.amount;
	}

	$scope.searchList = function(){
	    $scope.filter.page_no = 1;
	    $scope.getList();
	}



	$scope.resetAll = function(){
		$scope.filter_centers = [];
		$scope.filter = jewelerry_filters;
		$(".filters input[type=checkbox]").removeAttr("checked");
		$scope.hide_reset = true;
		$scope.getList();
	}


	$scope.onSubmitJewellery = function(){
		$scope.processing = true;
		DBService.postCall( $scope.formData,'/jewellery/store').then(function(data){
			if(data.success){
				bootbox.alert(data.message);
			} else {
				bootbox.alert(data.message);
			}
			$scope.processing = false;
		});	
	}

	$scope.uploadProductImage = function (file) {
		if (file) {
			var url = base_url+'/jewellery/product-image';
	        Upload.upload({
	            url: url,
	            data: {
	            	media: file
	            }
	        }).then(function (resp) {
	            if(resp.data.success){
	            	$scope.formData.prod_image = resp.data.fileName;
	            	$scope.formData.image_id = resp.data.image_id;
	            } 
	        });
		}
    }

    $scope.removeProductImage = function(){
    	bootbox.confirm("Are you sure?", (check)=>{
	    	if(check){
		    	DBService.getCall('/jewellery/remove-jewellery-image/'+$scope.formData.image_id).then(function(data){
					if(data.success){
						bootbox.alert(data.message);
		    			$scope.formData.prod_image = '';
					}
				});
			}
		});
    }

    $scope.delete = function(data, index){
    	bootbox.confirm("Are you sure?", (check)=>{
	    	if(check){
		    	DBService.getCall('/jewellery/delete/'+data.id).then(function(data){
					if(data.success){
						bootbox.alert(data.message);
		    			$scope.dataset.splice(index,1);
					}
				});
			}
		});
    }

    $scope.addSelectedJewellery = function(jewellery){
		if($scope.jewelleryIds.indexOf(jewellery.id) > -1){
			var index = $scope.jewelleryIds.indexOf(jewellery.id);
			$scope.jewelleryIds.splice(index,1);
		} else {
			$scope.jewelleryIds.push(jewellery.id);
		}
	}

	$scope.checkAll = function(){
		$scope.checkAllData = !$scope.checkAllData;
		for (var i = 0; i < $scope.dataset.length; i++) {
			if($scope.checkAllData){
				if($scope.jewelleryIds.indexOf($scope.dataset[i].id) < 0){
					$scope.jewelleryIds.push($scope.dataset[i].id);
				}
			} else {
				var index = $scope.jewelleryIds.indexOf($scope.dataset[i].id);
				$scope.jewelleryIds.splice(index,1);
			}
		}
	}

	$scope.submitOperation = function(type){
		if(type == 1){
			window.open(base_url+'/jewellery/edit-multile-jewellery/'+$scope.jewelleryIds,'target'); 
		}

		if(type == 2){
			bootbox.confirm("Are you sure?", (check)=>{
	    	if(check){
				DBService.postCall({ids : $scope.jewelleryIds},'/jewellery/delete-multiple-jewellery').then(function(data){
					$scope.loading = true;
					if(data.success){
						bootbox.alert(data.message);
					}
					$scope.loading = true;
				});
			}
			});
		}
	}

	$scope.editMultipleJewelleryInit = function(ids){
		$scope.loading = true;
		DBService.postCall({id : ids},'/jewellery/update-multiple-jewellery').then(function(data){
			if(data.success){
				$scope.multipleJewellery = data.jewellery;
				$scope.customers = data.customers;
				$scope.results = data.results;
				$scope.weightType = data.weightType;
				$scope.mesurementType = data.mesurementType;
				$scope.frontImages = data.frontImages;
				$scope.backImages = data.backImages;
				$scope.productTypes = data.productTypes;
			}
			$scope.loading = false;
		});	
	}

	$scope.onSubmitMultipleJewellery = function(){
		$scope.loading = true;
		$scope.processing = true;
		DBService.postCall($scope.multipleJewellery,'/jewellery/submit-multiple-jewellery').then(function(data){
			if(data.success){
				location.href = base_url+"/jewellery";
			}
		$scope.loading = true;
		$scope.processing = false;
		});	

	}

	$scope.uploadMultipleProductImage = function (file,index) {
		if (file) {
			var url = base_url+'/jewellery/product-image';
	        Upload.upload({
	            url: url,
	            data: {
	            	media: file
	            }
	        }).then(function (resp) {
	            if(resp.data.success){
	            	$scope.multiplejewellery[index].prod_image = resp.data.fileName;
	            	$scope.multiplejewellery[index].image_id = resp.data.image_id;
	            } 
	        });
		}
    }

    $scope.removeMultipleProductImage = function(jewellery, index){
    	$scope.multipleJewellery[index].prod_image = '';
    	bootbox.confirm("Are you sure?", (check)=>{
	    	if(check){
		    	DBService.getCall('/jewellery/remove-jewellery-image/'+jewellery.image_id).then(function(data){
					if(data.success){
    					$scope.multipleJewellery[index].prod_image = '';
					}
				});
			}
		});
    }

    $scope.printJewellery = function(){
    	$("#printJewelleryModel").modal("show");
    }

    $scope.submitPrintReport = function(){
    	window.open(base_url+'/jewellery/print-report/'+$scope.report.input_report+'/'+$scope.report.status,'target');
    }

});