

<?php $__env->startSection('content'); ?>
<div class="" ng-controller="jewellery_Controller" ng-init="getList()">

	<div class="page-header row">
		<div class="col-6">
			<h3>Jewellery</h3>
		</div>
		<div class="col-6">
			<div class="text-right">
				<button  class="btn btn-info" ng-click="printJewellery()"><i class="icons icon-printer"></i> Print</button>
				<a href="<?php echo e(url('/jewellery/add')); ?>" class="btn btn-primary"><i class="icons icon-plus"></i> Add Jewellery</a>
			</div>
		</div>
	</div>

	<div class="portlet">
		<div class="portlet-body ng-cloak">

			<div table-paginate></div>

			<?php echo $__env->make("jewellery.filters", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

			<div ng-show="dataset.length > 0 && !loading" style="overflow-y: auto;">
				<table class="table table-compact">
					<thead>
						<tr>
							<th>SN</th>
							<th><input type="checkbox" ng-click="checkAll()" ng-checked="checkAllData" ></th>
							<th><th-sort column-id="report_no" column-name="Report No"></th>
							<th><th-sort column-id="customerName" column-name="Customer Name"></th>
							<th><th-sort column-id="prod_type" column-name="prod_type"></th>
							<th><th-sort column-id="testing_charge" column-name="Testing Charge"></th>
							<th><th-sort column-id="amount" column-name="Recieved Amount"></th>
							<th><th-sort column-id="due_amount" column-name="Due Amount"></th>
							<th><th-sort column-id="created_at" column-name="Created At"></th>
							<th>#</th>
						</tr>
					</thead>
					<tbody>
						<tr ng-repeat="data in dataset track by $index">
							<td>{{ (filter.page_no-1)*filter.max_per_page + $index + 1}}</td>
							<td><input type="checkbox" ng-click="addSelectedJewellery(data)" ng-checked="jewelleryIds.indexOf(data.id) > -1"></td>
							<td class="theme-color"> <b>{{data.report_no}}</b></td>
							<td>{{data.customerName}}</td>
							<td>{{data.prod_type}}</td>
							<td>{{data.testing_charge}}</td>
							<td>{{data.amount}}</td>
							<td>{{data.due_amount}}</td>
							<td>{{data.created_at | date}}</td>
							<td>
								<a href="<?php echo e(url('/jewellery/add/')); ?>/{{data.id}}" class="btn btn-sm btn-primary">Edit</a>
								<button ng-click="delete(data, $index)" class="btn btn-sm btn-danger">Delete</button>
							</td>
						</tr>
					</tbody>
				</table>
			</div>
			<div ng-if="jewelleryIds.length > 0">
				<div class="row">
					<div class="col-md-4">
                        <label>Select Type</label>
                        <select class="form-control" ng-model="operation_id">
                            <option value="1">Edit</option>
                            <option value="2">Delete</option>
                        </select>
					</div>
					<div class="col-md-4" style="margin-top:25px">
						<button type="button" class="btn btn-primary" ng-click="submitOperation(operation_id)">Submit</button>
					</div>
				</div>
			</div>
			<div ng-show="dataset.length == 0 && !loading" class="alert alert-warning mt-5">
				No Records found
			</div>
		</div>
	</div>


	<div class="modal fade in" id="printJewelleryModel" role="dialog">
	    <div class="modal-dialog">
	        <div class="modal-content">
	            <div class="modal-header">
	                <h4 class="modal-title">Print Jewellery Report</h4>
	                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="icons icon-close"></i></button>
	            </div>
	            <div class="modal-body small-form" >
	                <div class="row">
	                	<div class="col-md-6 form-group">
	                		<label>Enter Report No.</label>
	                		<input type="text" ng-model="report.input_report" class="form-control">
	                	</div>
	                	<div class="col-md-6 form-group">
	                		<label>Type</label>
	                		<select type="text" ng-model="report.status" class="form-control">
	                			<option value="1">Small</option>
	                			<option value="2">Large</option>
	                			<option value="3">Sticker</option>
	                		</select>
	                	</div>
	                </div>
	            </div>
	            <div class="modal-footer">
	                <button type="button" class="btn btn-primary" ng-click="submitPrintReport()" ng-disabled="processing_print" >Submit <span ng-show="processing_print" class="spinner-border spinner-border-sm"></span></button>
	            </div>
	        </div>
	    </div>
	</div>

</div>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/MAMP/htdocs/oigs_new/resources/views/jewellery/index.blade.php ENDPATH**/ ?>