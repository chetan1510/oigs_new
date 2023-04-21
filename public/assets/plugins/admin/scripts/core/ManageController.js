app.controller("ManageController", function($scope, $http, DBService) {
	$scope.customerData = {customer:[{}]};
	$scope.resultData = {result:[{}]};
	$scope.productTypeData = {product:[{}]};

	$scope.cust = {};
	$scope.res = {};
	$scope.prod = {};

	$scope.init = function(){
		$scope.customerInit();
		$scope.resultInit();
		$scope.productTypeInit();
	}

	$scope.customerInit = function(){
		DBService.postCall({},"/management/customers/customer-list").then(function(data){
			$scope.customers = data.customers;
		});
	}

	$scope.addCustomer = function(){
		$("#customerModel").modal('show');
	}

	$scope.submitCustomer = function(){
		$scope.processing = true;
		DBService.postCall($scope.customerData,"/management/customers/save-customer").then(function(data){
			if (data.success) {
				$scope.customerInit();
				$("#customerModel").modal('hide');
				bootbox.alert(data.message);
			}else{
				bootbox.alert(data.message);
			}
			$scope.processing = false;
		});
	}

	$scope.editCustomer = function(){
		$scope.customerData.customer = $scope.customers;
		$("#customerModel").modal('show');
	}


	$scope.deleteCustomer = function(id, index){
	bootbox.confirm("Are you sure?", (check)=>{
	      if(check){
				DBService.getCall("/management/customers/delete-customer/"+id).then(function(data){
					if(data.success){
						$scope.customers.splice(index,1);
						bootbox.alert(data.message);
					}
				});
			}
		});
	}

	$scope.addMoreCustomer = function(){
      $scope.customerData.customer.push(JSON.parse(JSON.stringify($scope.cust)));
    }

    $scope.resultInit = function(){
		DBService.postCall({},"/management/results/result-list").then(function(data){
			$scope.results = data.results;
		});
	}

    $scope.addResult = function(){
		$("#result").modal('show');
	}

	$scope.submitResult = function(){
		$scope.resultProcessing = true;
		DBService.postCall($scope.resultData,"/management/results/save-result").then(function(data){
			if (data.success) {
				$scope.resultInit();
				$("#result").modal('hide');
				bootbox.alert(data.message);
			}else{
				bootbox.alert(data.message);
			}
			$scope.resultProcessing = false;
		});
	}

	$scope.editResult = function(){
		$scope.resultData.result = $scope.results;
		$("#result").modal('show');
	}


	$scope.deleteResult = function(id, index){
	bootbox.confirm("Are you sure?", (check)=>{
	      if(check){
				DBService.getCall("/management/results/delete-result/"+id).then(function(data){
					if(data.success){
						$scope.results.splice(index,1);
						bootbox.alert(data.message);
					}
				});
			}
		});
	}

	$scope.addMoreResult = function(){
      $scope.resultData.result.push(JSON.parse(JSON.stringify($scope.res)));
    }


// product type start


	$scope.productTypeInit = function(){
		DBService.postCall({},"/management/product-type/product-type-list").then(function(data){
			$scope.productTypes = data.productTypes;
		});
	}


	$scope.addProductType = function(){
		$("#product_type").modal('show');
	}

	$scope.submitProductType = function(){
		$scope.productProcessing = true;
		DBService.postCall($scope.productTypeData,"/management/product-type/save-product-type").then(function(data){
			if (data.success) {
				$scope.productTypeInit();
				$("#product_type").modal('hide');
				bootbox.alert(data.message);
			}else{
				bootbox.alert(data.message);
			}
			$scope.productProcessing = false;
		});
	}

	$scope.editProductType = function(){
		$scope.productTypeData.product = $scope.productTypes;
		$("#product_type").modal('show');
	}


	$scope.deleteProductType = function(id, index){
	bootbox.confirm("Are you sure?", (check)=>{
	      if(check){
				DBService.getCall("/management/product-type/delete-product/"+id).then(function(data){
					if(data.success){
						$scope.productTypes.splice(index,1);
						bootbox.alert(data.message);
					}
				});
			}
		});
	}

	$scope.addMoreProduct = function(){
      $scope.productTypeData.product.push(JSON.parse(JSON.stringify($scope.prod)));
    }




});
