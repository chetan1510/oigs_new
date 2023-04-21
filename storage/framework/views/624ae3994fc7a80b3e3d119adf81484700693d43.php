

<?php $__env->startSection('content'); ?>
	<div class="ng-cloak" ng-controller="jewellery_Controller" ng-init="editMultipleJewelleryInit('<?php echo e($jewelleryIds); ?>')">
		<div class="portlet">
			<div class="portlet-body">
				<div ng-if="loading" class="text-center mt-5 mb-5">
					<div class="spinner-grow" role="status">
					  <span class="sr-only">Loading...</span>
					</div>
				</div>

				<div class="containermultiple"  style="overflow-y: auto;" ng-if="!loading">
            		<form method="POST" name="JewelleryForm" ng-submit="onSubmitMultipleJewellery(JewelleryForm.$valid)" novalidate="novalidate" >
						<table class="table table-compact" width="100%">
							<thead class="thead-dark">
								<tr>
									<th class="header">Report No</th>
									<th class="header">Description</th>
									<th class="header">Customer <span class="required">*</span></th>
									<th class="header">Prod Type</th>
									<th class="header">Testing Charge <span class="required">*</span></th>
									<th class="header">Recieved Amount <span class="required">*</span></th>
									<th class="header">Due Amount <span class="required">*</span></th>
									<th class="header">Gross Weight</th>
									<th class="header">Type</th>
									<th class="header">Diamond Weight</th>
									<th class="header">Type</th>
									<th class="header">Shape Of Diamond</th>
									<th class="header">Florescence</th>
									<th class="header">Color</th>
									<th class="header">Clarity</th>
									<th class="header">Cut</th>
									<th class="header">Porosity</th>
									<th class="header">Shape Of Product</th>
									<th class="header">Polish</th>
									<th class="header">Hallmark</th>
									<th class="header">Loose Diamond</th>
									<th class="header">Product Code</th>
									<th class="header">Color Stone Weight</th>
									<th class="header">Type</th>
									<th class="header">Coments</th>
									<th class="header">OIGS Quality Grade</th>
									<th class="header">Remark</th>
									<th class="header">Prod Image <span class="required">*</span></th>
									<th class="header">Certi Front <span class="required">*</span></th>
									<th class="header">Certi Back <span class="required">*</span></th>
									<th class="header">Status <span class="required">*</span></th>
								</tr>
							</thead>
							<tbody>
								<tr ng-repeat="jewellery in multipleJewellery track by $index" class="form-group">
									<td>
										<input type="text" class="form-control size-multiple-edit" readonly ng-model="jewellery.report_no">
									</td>

									<td>
                        				<input type="text" class="form-control size-multiple-edit" ng-model="jewellery.description">
									</td>

									<td>
										<select class="form-control size-multiple-edit" ng-model="jewellery.cust_id" convert-to-number required>
				                            <option ng-repeat="customer in customers" value="{{customer.id}}">{{customer.name}}</option>
				                        </select>
									</td>

									<td>
										<select class="form-control size-multiple-edit" ng-model="jewellery.prod_type_id" convert-to-number >
				                            <option value="">--Select--</option>
				                            <option ng-repeat="product in productTypes" value="{{product.id}}">{{product.name}}</option>
				                        </select>
									</td>

									<td>
                        				<input type="text" class="form-control size-multiple-edit" ng-model="jewellery.testing_charge" required />
									</td>

									<td>
                        				<input type="text" class="form-control size-multiple-edit" ng-model="jewellery.amount" ng-keyup="dueAmount()" required />
									</td>

									<td>
                        				<input type="text" class="form-control size-multiple-edit" readonly ng-model="jewellery.due_amount" required />
									</td>

									<td>
                                		<input type="text" class="form-control size-multiple-edit" ng-model="jewellery.gross_weight">
									</td>

									<td>
										<select ng-model="jewellery.g_cts_ratti" class="form-control size-multiple-edit" convert-to-number>
		                                    <option ng-repeat="weight in weightType" value="{{weight.id}}">{{weight.type}}</option>
		                                </select>
									</td>

									<td>
                                		<input type="text" class="form-control size-multiple-edit" ng-model="jewellery.diamond_wt">
									</td>

									<td>
										<select ng-model="jewellery.cts" class="form-control size-multiple-edit" convert-to-number>
		                                    <option ng-repeat="type in mesurementType" value="{{type.id}}">{{type.type}}</option>
		                                </select>
									</td>

									<td>
                        				<input type="text" class="form-control size-multiple-edit" ng-model="jewellery.shape_of_diamond">
									</td>

									<td>
                        				<input type="text" class="form-control size-multiple-edit" ng-model="jewellery.florescence">
									</td>

									<td>
                        				<input type="text" class="form-control size-multiple-edit" ng-model="jewellery.color">
									</td>

									<td>
                        				<input type="text" class="form-control size-multiple-edit" ng-model="jewellery.clarity">
									</td>

									<td>
                        				<input type="text" class="form-control size-multiple-edit" ng-model="jewellery.cut">
									</td>

									<td>
                       					<input type="text" class="form-control size-multiple-edit" ng-model="jewellery.porosity">
									</td>

									<td>
                        				<input type="text" class="form-control size-multiple-edit" ng-model="jewellery.shape_of_product">
									</td>

									<td>
                        				<input type="text" class="form-control size-multiple-edit" ng-model="jewellery.polish">
									</td>

									<td>
                        				<input type="text" class="form-control size-multiple-edit" ng-model="jewellery.hallmark">
									</td>

									<td>
                        				<input type="text" class="form-control size-multiple-edit" ng-model="jewellery.loose_diamond">
									</td>

									<td>
                        				<input type="text" class="form-control size-multiple-edit" ng-model="jewellery.prod_code">
									</td>

									<td>
                        				<input type="text" class="form-control size-multiple-edit" ng-model="jewellery.color_stone_weight">
									</td>

									<td>
										<select ng-model="jewellery.ctss" class="form-control size-multiple-edit" convert-to-number>
		                                    <option ng-repeat="type in mesurementType" value="{{type.id}}">{{type.type}}</option>
		                                </select>
									</td>

									<td>
                        				<input type="text" class="form-control size-multiple-edit" ng-model="jewellery.comments">
									</td>

									<td>
                        				<input type="text" class="form-control size-multiple-edit" ng-model="jewellery.oigs_quality">
									</td>

									<td>
                        				<input type="text" class="form-control size-multiple-edit" ng-model="jewellery.remark">
									</td>

									<td>
										<div ng-if="jewellery.prod_image">
				                            <a href="<?php echo e(url('/')); ?>/{{jewellery.prod_image}}" class="btn btn-sm btn-info form-control size-multiple-edit" target="_blank">View</a>

				                            <button type="button" style="margin-top:5px" class="btn btn-danger btn-sm form-control size-multiple-edit" ng-click="removeMultipleProductImage(jewellery, $index)">Remove</button>
				                        </div>
				                        <div ng-if="!jewellery.prod_image">
				                            <button type="button" class="button btn btn-primary form-control size-multiple-edit" ngf-select="uploadMultipleProductImage($file, $index)" >Upload Image</button>
				                        </div>
									</td>

									<td>
										<select class="form-control size-multiple-edit" ng-model="jewellery.certi_front" required convert-to-number>
				                            <option ng-repeat="front in frontImages" value="{{front.id}}">{{front.original_name}}</option>
				                        </select>
									</td>

									<td>
										<select class="form-control size-multiple-edit" ng-model="jewellery.certi_back" required convert-to-number>
				                            <option ng-repeat="back in backImages" value="{{back.id}}">{{back.original_name}}</option>
				                        </select>
									</td>

									<td>
										<select class="form-control size-multiple-edit" ng-model="jewellery.status" required convert-to-number>
				                            <option value="1"> Small </option>
				                            <option value="2"> Large </option>
				                        </select>
									</td>

								</tr>
							</tbody>
						</table>
						<div style="margin-bottom: 20px; position: sticky;">
							<button type="submit" class="btn btn-primary float-right" ng-disabled="processing" >   
		                        Submit <span ng-if="processing" class="spinner-border spinner-border-sm"></span>
		                    </button>
		                </div>
					</form>
				</div>
			</div>
		</div>
	</div>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\oigs_new\resources\views/jewellery/multipleEdit.blade.php ENDPATH**/ ?>