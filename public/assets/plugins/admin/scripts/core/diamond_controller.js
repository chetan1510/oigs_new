var diamond_filters = {
	page_no : 1,
    max_per_page : 200,
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

app.controller('diamond_controller', function($scope,$http,DBService,Upload){
	
	$scope.formData = {amount:0};
	$scope.dataset = [];
	$scope.loading = true;
	$scope.filter = diamond_filters;
	$scope.diamondIds = [];
	$scope.report = {};

	$scope.getList = function(){
		console.log($scope.filter);
		$scope.processing = true;
		DBService.postCall( $scope.filter ,'/diamond/init').then(function(data){
			if(data.success){
				$scope.dataset = data.diamonds;
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
		DBService.getCall('/diamond/get-diamond/'+$id).then(function(data){
			if(data.success){
				if($id == 0){
					$scope.formData.report_no = data.report_no;
					$scope.formData.reprt_sequence = data.reprt_sequence;
				} else {
					$scope.formData = data.diamond;
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
		$scope.filter = diamond_filters;
		$(".filters input[type=checkbox]").removeAttr("checked");
		$scope.hide_reset = true;
		$scope.getList();
	}


	$scope.onSubmitDiamond = function(){
		$scope.processing = true;
		DBService.postCall( $scope.formData,'/diamond/store').then(function(data){
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
			var url = base_url+'/diamond/product-image';
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
		    	DBService.getCall('/diamond/remove-diamond-image/'+$scope.formData.image_id).then(function(data){
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
		    	DBService.getCall('/diamond/delete/'+data.id).then(function(data){
					if(data.success){
						bootbox.alert(data.message);
		    			$scope.dataset.splice(index,1);
					}
				});
			}
		});
    }

    $scope.addSelecteddiamond = function(diamond){
		if($scope.diamondIds.indexOf(diamond.id) > -1){
			var index = $scope.diamondIds.indexOf(diamond.id);
			$scope.diamondIds.splice(index,1);
		} else {
			$scope.diamondIds.push(diamond.id);
		}
	}

	$scope.checkAll = function(){
		$scope.checkAllData = !$scope.checkAllData;
		for (var i = 0; i < $scope.dataset.length; i++) {
			if($scope.checkAllData){
				if($scope.diamondIds.indexOf($scope.dataset[i].id) < 0){
					$scope.diamondIds.push($scope.dataset[i].id);
				}
			} else {
				var index = $scope.diamondIds.indexOf($scope.dataset[i].id);
				$scope.diamondIds.splice(index,1);
			}
		}
	}

	$scope.submitOperation = function(type){
		if(type == 1){
			window.open(base_url+'/diamond/edit-multile-diamond/'+$scope.diamondIds,'target'); 
		}

		if(type == 2){
			bootbox.confirm("Are you sure?", (check)=>{
	    	if(check){
				DBService.postCall({ids : $scope.diamondIds},'/diamond/delete-multiple-diamond').then(function(data){
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

	$scope.editMultipleDiamondInit = function(ids){
		$scope.loading = true;
		DBService.postCall({id : ids},'/diamond/update-multiple-diamond').then(function(data){
			if(data.success){
				$scope.multipleDiamond = data.diamond;
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

	$scope.onSubmitMultipleDiamond = function(){
		$scope.loading = true;
		$scope.processing = true;
		DBService.postCall($scope.multipleDiamond,'/diamond/submit-multiple-diamond').then(function(data){
			if(data.success){
				location.href = base_url+"/diamond";
			}
		$scope.loading = true;
		$scope.processing = false;
		});	

	}

	$scope.uploadMultipleProductImage = function (file,index) {
		if (file) {
			var url = base_url+'/diamond/product-image';
	        Upload.upload({
	            url: url,
	            data: {
	            	media: file
	            }
	        }).then(function (resp) {
	            if(resp.data.success){
	            	$scope.multipleDiamond[index].prod_image = resp.data.fileName;
	            	$scope.multipleDiamond[index].image_id = resp.data.image_id;
	            } 
	        });
		}
    }

    $scope.removeMultipleProductImage = function(diamond, index){
    	$scope.multipleDiamond[index].prod_image = '';
    	bootbox.confirm("Are you sure?", (check)=>{
	    	if(check){
		    	DBService.getCall('/diamond/remove-diamond-image/'+diamond.image_id).then(function(data){
					if(data.success){
    					$scope.multiplediamond[index].prod_image = '';
					}
				});
			}
		});
    }

    $scope.printdiamond = function(){
    	$("#printDiamondModel").modal("show");
    }

    $scope.submitPrintReport = function(){
    	window.open(base_url+'/diamond/print-report/'+$scope.report.input_report+'/'+$scope.report.status,'target');
    }

});