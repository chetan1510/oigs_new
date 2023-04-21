var gems_filters = {
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

app.controller('gems_controller', function($scope,$http,DBService,Upload){
	
	$scope.formData = {amount:0};
	$scope.dataset = [];
	$scope.loading = true;
	$scope.filter = gems_filters;
	$scope.gemsIds = []; 
	$scope.report = {};

	$scope.getList = function(){
		console.log($scope.filter);
		$scope.processing = true;
		DBService.postCall( $scope.filter ,'/gems/init').then(function(data){
			if(data.success){
				$scope.dataset = data.gems;
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
		DBService.getCall('/gems/get-gems/'+$id).then(function(data){
			if(data.success){
				if($id == 0){
					$scope.formData.report_no = data.report_no;
					$scope.formData.reprt_sequence = data.reprt_sequence;
				} else {
					$scope.formData = data.gems;
				}
				$scope.customers = data.customers;
				$scope.results = data.results;
				$scope.weightType = data.weightType;
				$scope.mesurementType = data.mesurementType;
				$scope.frontImages = data.frontImages;
				$scope.backImages = data.backImages;
				$scope.productTypes = data.productTypes;
	    		$scope.getList();

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
		$scope.filter = gems_filters;
		$(".filters input[type=checkbox]").removeAttr("checked");
		$scope.hide_reset = true;
		$scope.getList();
	}


	$scope.onSubmitGems = function(){
		$scope.processing = true;
		DBService.postCall( $scope.formData,'/gems/store').then(function(data){
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
			var url = base_url+'/gems/product-image';
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
		    	DBService.getCall('/gems/remove-gems-image/'+$scope.formData.image_id).then(function(data){
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
		    	DBService.getCall('/gems/delete/'+data.id).then(function(data){
					if(data.success){
						bootbox.alert(data.message);
		    			$scope.dataset.splice(index,1);
					}
				});
			}
		});
    }

    $scope.addSelectedGems = function(gems){
		if($scope.gemsIds.indexOf(gems.id) > -1){
			var index = $scope.gemsIds.indexOf(gems.id);
			$scope.gemsIds.splice(index,1);
		} else {
			$scope.gemsIds.push(gems.id);
		}
	}

	$scope.checkAll = function(){
		$scope.checkAllData = !$scope.checkAllData;
		for (var i = 0; i < $scope.dataset.length; i++) {
			if($scope.checkAllData){
				if($scope.gemsIds.indexOf($scope.dataset[i].id) < 0){
					$scope.gemsIds.push($scope.dataset[i].id);
				}
			} else {
				var index = $scope.gemsIds.indexOf($scope.dataset[i].id);
				$scope.gemsIds.splice(index,1);
			}
		}
	}

	$scope.submitOperation = function(type){
		if(type == 1){
			window.open(base_url+'/gems/edit-multile-gems/'+$scope.gemsIds,'target'); 
		}

		if(type == 2){
			bootbox.confirm("Are you sure?", (check)=>{
	    	if(check){
				DBService.postCall({ids : $scope.gemsIds},'/gems/delete-multiple-gems').then(function(data){
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

	$scope.editMultipleGemsInit = function(ids){
		$scope.loading = true;
		DBService.postCall({id : ids},'/gems/update-multiple-gems').then(function(data){
			if(data.success){
				$scope.multipleGems = data.gems;
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

	$scope.onSubmitMultipleGems = function(){
		$scope.loading = true;
		$scope.processing = true;
		DBService.postCall($scope.multipleGems,'/gems/submit-multiple-gems').then(function(data){
			if(data.success){
				location.href = base_url+"/gems";
			}
		$scope.loading = true;
		$scope.processing = false;
		});	

	}

	$scope.uploadMultipleProductImage = function (file,index) {
		if (file) {
			var url = base_url+'/gems/product-image';
	        Upload.upload({
	            url: url,
	            data: {
	            	media: file
	            }
	        }).then(function (resp) {
	            if(resp.data.success){
	            	$scope.multipleGems[index].prod_image = resp.data.fileName;
	            	$scope.multipleGems[index].image_id = resp.data.image_id;
	            } 
	        });
		}
    }

    $scope.removeMultipleProductImage = function(gems, index){
    	$scope.multipleGems[index].prod_image = '';
    	bootbox.confirm("Are you sure?", (check)=>{
	    	if(check){
		    	DBService.getCall('/gems/remove-gems-image/'+gems.image_id).then(function(data){
					if(data.success){
    					$scope.multipleGems[index].prod_image = '';
					}
				});
			}
		});
    }

    $scope.printGems = function(){
    	$("#printGemsModel").modal("show");
    }

    $scope.submitPrintReport = function(){
    	window.open(base_url+'/gems/print-report/'+$scope.report.input_report+'/'+$scope.report.status,'target');
    }

    $scope.getResultData = function( ){
    	DBService.getCall('/gems/get-result-data/'+$scope.formData.result_id).then(function(data){
			if(data.success){
				$scope.formData.color = data.records.color;
				$scope.formData.shape_cut = data.records.shape_cut;
				$scope.formData.optic_character = data.records.optic_character;
				$scope.formData.axial_figure = data.records.axial_figure;
				$scope.formData.ri = data.records.ri;
				$scope.formData.birefringence = data.records.birefringence;
				$scope.formData.sg = data.records.sg;
				$scope.formData.hardness = data.records.hardness;
				$scope.formData.microscopic_obs = data.records.microscopic_obs;
				$scope.formData.species = data.records.species;
			}
		});
    }

});