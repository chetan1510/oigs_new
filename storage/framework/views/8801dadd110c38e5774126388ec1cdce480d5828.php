

<?php $__env->startSection('content'); ?>

<div class="" ng-controller="ManageController" ng-init="init()">

	<div class="row">
		<div class="col-md-6">
			<div class="page-header row">
				<div class="col-6">
					<h3>Customers</h3>
				</div>
				<div class="col-6">
					<div class="text-right">
						<button class="btn btn-primary" ng-click="addCustomer()"><i class="icons icon-plus"></i> Add</button>
					</div>
				</div>
			</div>

			<div class="portlet">
				<div class="portlet-body ng-cloak">
					<div class="table-responsive" ng-if="customers.length > 0">
						<table class="table">
							<thead>
								<tr>
				 					<th>SN.</th>
									<th>Name</th>
									<th class="text-right">
										<button class="btn btn-sm btn-light" ng-click="editCustomer()">Edit</button>
									</th>
			 					</tr>
							</thead>
							<tbody>
								<tr ng-repeat="rec in customers track by $index">
									<td>{{$index + 1}}</td>
									<td>{{rec.name}}</td>
									<td class="text-right">
										<button class="btn btn-sm btn-danger" ng-click="deleteCustomer(rec.id, $index)">Delete</button>
									</td>
								</tr>
							</tbody>
				 		</table>
					</div>

					<div class="alert alert-warning mt-2" ng-if="customers.length == 0">
		      			No Customers are available. 
		    	</div>

				</div>
			</div>

		</div>

		<div class="col-md-6">
			<div class="page-header row">
				<div class="col-6">
					<h3>Results</h3>
				</div>
				<div class="col-6">
					<div class="text-right">
						<button class="btn btn-primary" ng-click="addResult()"><i class="icons icon-plus"></i> Add</button>
					</div>
				</div>
			</div>

			<div class="portlet">
				<div class="portlet-body ng-cloak">
					<div class="table-responsive" ng-if="results.length > 0">
						<table class="table" id="datatable">
							<thead>
								<tr>
				 					<th>SN.</th>
									<th>Name</th>
									<th class="text-right"><button class="btn btn-sm btn-light" ng-click="editResult()">Edit</button></th>
			 					</tr>
							</thead>
							<tbody>
								<tr ng-repeat="rec in results track by $index">
									<td>{{$index + 1}}</td>
									<td>{{rec.name}}</td>
									<td class="text-right">
										<button class="btn btn-sm btn-danger" ng-click="deleteResult(rec.id, $index)">Delete</button>
									</td>
								</tr>
							</tbody>
				 		</table>
					</div>

					<div class="alert alert-warning mt-2" ng-if="results.length == 0">
		      			No Results are available. 
		    	</div>

				</div>
			</div>
		</div>

		<div class="col-md-6">
			<div class="page-header row">
				<div class="col-6">
					<h3>Product Type</h3>
				</div>
				<div class="col-6">
					<div class="text-right">
						<button class="btn btn-primary" ng-click="addProductType()"><i class="icons icon-plus"></i> Add</button>
					</div>
				</div>
			</div>

			<div class="portlet">
				<div class="portlet-body ng-cloak">
					<div class="table-responsive" ng-if="productTypes.length > 0">
						<table class="table" id="datatable">
							<thead>
								<tr>
				 					<th>SN.</th>
									<th>Name</th>
									<th class="text-right"><button class="btn btn-sm btn-light" ng-click="editProductType()">Edit</button></th>
			 					</tr>
							</thead>
							<tbody>
								<tr ng-repeat="rec in productTypes track by $index">
									<td>{{$index + 1}}</td>
									<td>{{rec.name}}</td>
									<td class="text-right">
										<button class="btn btn-sm btn-danger" ng-click="deleteProductType(rec.id, $index)">Delete</button>
									</td>
								</tr>
							</tbody>
				 		</table>
					</div>

					<div class="alert alert-warning mt-2" ng-if="productTypes.length == 0">
		      			No Product Types are available. 
		    	</div>

				</div>
			</div>
		</div>
	</div>
	<?php echo $__env->make('manage.model', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
</div>

<?php $__env->stopSection(); ?>


<?php echo $__env->make('layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/MAMP/htdocs/oigs_new/resources/views/manage/index.blade.php ENDPATH**/ ?>