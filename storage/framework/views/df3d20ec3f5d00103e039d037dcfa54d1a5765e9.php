

<?php $__env->startSection('content'); ?>
	<div class="ng-cloak" ng-controller="rudraksha_Controller" ng-init="editMultipleRudrakshaInit('<?php echo e($rudrakshaIds); ?>')">
		<div class="portlet">
			<div class="portlet-body">
				<div ng-if="loading" class="text-center mt-5 mb-5">
					<div class="spinner-grow" role="status">
					  <span class="sr-only">Loading...</span>
					</div>
				</div>

				<div class="containermultiple"  style="overflow-y: auto;" ng-if="!loading">
            		<form method="POST" name="RudrakshaForm" ng-submit="onSubmitMultipleRudraksha(RudrakshaForm.$valid)" novalidate="novalidate" >
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
									<th class="header">Weight</th>
									<th class="header">Type</th>
									<th class="header">Measurement</th>
									<th class="header">Type</th>
									<th class="header">Color</th>
									<th class="header">Shape & Cut</th>
									<th class="header">Real Face</th>
									<th class="header">Artifical Face</th>
									<th class="header">Resin/Conjuction</th>
									<th class="header">Microscopic Obs</th>
									<th class="header">X-Ray Analysis</th>
									<th class="header">Mag.Resonance Imag</th>
									<th class="header">Cut Test</th>
									<th class="header">Origin</th>
									<th class="header">Kingdom/Division</th>
									<th class="header">Result <span class="required">*</span></th>
									<th class="header">Spicies</th>
									<th class="header">OIGS Quality Grade <span class="required">*</span></th>
									<th class="header">Comments</th>
									<th class="header">Prod Image <span class="required">*</span></th>
									<th class="header">Certi Front <span class="required">*</span></th>
									<th class="header">Certi Back <span class="required">*</span></th>
									<th class="header">Status <span class="required">*</span></th>
								</tr>
							</thead>
							<tbody>
								<tr ng-repeat="rudraksha in multipleRudraksha track by $index" class="form-group">
									<td>
										<input type="text" class="form-control size-multiple-edit" readonly ng-model="rudraksha.report_no">
									</td>

									<td>
                        				<input type="text" class="form-control size-multiple-edit" ng-model="rudraksha.description">
									</td>

									<td>
										<select class="form-control size-multiple-edit" ng-model="rudraksha.cust_id" convert-to-number required>
				                            <option ng-repeat="customer in customers" value="{{customer.id}}">{{customer.name}}</option>
				                        </select>
									</td>

									<td>
										<select class="form-control size-multiple-edit" ng-model="rudraksha.prod_type_id" convert-to-number >
				                            <option value="">--Select--</option>
				                            <option ng-repeat="product in productTypes" value="{{product.id}}">{{product.name}}</option>
				                        </select>
									</td>

									<td>
                        				<input type="text" class="form-control size-multiple-edit" ng-model="rudraksha.testing_charge" required />
									</td>

									<td>
                        				<input type="text" class="form-control size-multiple-edit" ng-model="rudraksha.amount" ng-keyup="dueAmount()" required />
									</td>

									<td>
                        				<input type="text" class="form-control size-multiple-edit" readonly ng-model="rudraksha.due_amount" required />
									</td>

									<td>
                                		<input type="text" class="form-control size-multiple-edit" ng-model="rudraksha.weight">
									</td>

									<td>
										<select ng-model="rudraksha.g_cts_ratti" class="form-control size-multiple-edit" convert-to-number>
                                    		<option ng-repeat="mesurement in mesurementType" value="{{mesurement.id}}">{{mesurement.type}}</option>

		                                </select>
									</td>

									<td>
                                		<input type="text" class="form-control size-multiple-edit" ng-model="rudraksha.measurement">
									</td>

									<td>
										<select ng-model="rudraksha.cts" class="form-control size-multiple-edit" convert-to-number>
                                    		<option ng-repeat="weight in weightType" value="{{weight.id}}">{{weight.type}}</option>
		                                </select>
									</td>

									<td>
                        				<input type="text" class="form-control size-multiple-edit" ng-model="rudraksha.color">
									</td>

									<td>
                        				<input type="text" class="form-control size-multiple-edit" ng-model="rudraksha.shape_cut">
									</td>

									<td>
                        				<input type="text" class="form-control size-multiple-edit" ng-model="rudraksha.real_face">
									</td>

									<td>
                        				<input type="text" class="form-control size-multiple-edit" ng-model="rudraksha.artificial_face">
									</td>

									<td>
                        				<input type="text" class="form-control size-multiple-edit" ng-model="rudraksha.resin">
									</td>

									<td>
                       					<input type="text" class="form-control size-multiple-edit" ng-model="rudraksha.microscopic_obs">
									</td>

									<td>
                        				<input type="text" class="form-control size-multiple-edit" ng-model="rudraksha.x_ray">
									</td>

									<td>
                        				<input type="text" class="form-control size-multiple-edit" ng-model="rudraksha.mag_resonance_imag">
									</td>

									<td>
                        				<input type="text" class="form-control size-multiple-edit" ng-model="rudraksha.cut_test">
									</td>

									<td>
                        				<input type="text" class="form-control size-multiple-edit" ng-model="rudraksha.origins">
									</td>

									<td>
                        				<input type="text" class="form-control size-multiple-edit" ng-model="rudraksha.kingdom_division">
									</td>

									<td>
										<select class="form-control size-multiple-edit" ng-model="rudraksha.result_id" convert-to-number required>
				                            <option ng-repeat="result in results" value="{{result.id}}">{{result.name}}</option>
				                        </select></td>

									<td>
                        				<input type="text" class="form-control size-multiple-edit" ng-model="rudraksha.spicies">
									</td>

									<td>
                        				<input type="text" class="form-control size-multiple-edit" ng-model="rudraksha.oigs_quality">
									</td>

									<td>
                        				<input type="text" class="form-control size-multiple-edit" ng-model="rudraksha.comments">
									</td>

									<td>
										<div ng-if="rudraksha.prod_image">
				                            <a href="<?php echo e(url('/')); ?>/{{rudraksha.prod_image}}" class="btn btn-sm btn-info form-control size-multiple-edit" target="_blank">View</a>

				                            <button type="button" style="margin-top:5px" class="btn btn-danger btn-sm form-control size-multiple-edit" ng-click="removeMultipleProductImage(rudraksha, $index)">Remove</button>
				                        </div>
				                        <div ng-if="!rudraksha.prod_image">
				                            <button type="button" class="button btn btn-primary form-control size-multiple-edit" ngf-select="uploadMultipleProductImage($file, $index)" >Upload Image</button>
				                        </div>
									</td>

									<td>
										<select class="form-control size-multiple-edit" ng-model="rudraksha.certi_front" required convert-to-number>
				                            <option ng-repeat="front in frontImages" value="{{front.id}}">{{front.original_name}}</option>
				                        </select>
									</td>

									<td>
										<select class="form-control size-multiple-edit" ng-model="rudraksha.certi_back" required convert-to-number>
				                            <option ng-repeat="back in backImages" value="{{back.id}}">{{back.original_name}}</option>
				                        </select>
									</td>

									<td>
										<select class="form-control size-multiple-edit" ng-model="rudraksha.status" required convert-to-number>
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


<?php echo $__env->make('layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\oigs_new\resources\views/rudraksha/multipleEdit.blade.php ENDPATH**/ ?>