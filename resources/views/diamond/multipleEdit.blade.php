@extends('layout')

@section('content')
	<div class="ng-cloak" ng-controller="diamond_controller" ng-init="editMultipleDiamondInit('{{$diamondIds}}')">
		<div class="portlet">
			<div class="portlet-body">

				<div ng-if="loading" class="text-center mt-5 mb-5">
					<div class="spinner-grow" role="status">
					  <span class="sr-only">Loading...</span>
					</div>
				</div>

				<div class="containermultiple"  style="overflow-y: auto;" ng-if="!loading">
            		<form method="POST" name="diamondForm" ng-submit="onSubmitMultipleDiamond(diamondForm.$valid)" novalidate="novalidate" >
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
									<th class="header">Diamond Weight</th>
									<th class="header">Type</th>
									<th class="header">Measurement</th>
									<th class="header">Type</th>
									<th class="header">Shape Of Diamond</th>
									<th class="header">Florescence</th>
									<th class="header">Color</th>
									<th class="header">Clarity</th>
									<th class="header">Cut</th>
									<th class="header">Polish</th>
									<th class="header">Symmetry</th>
									<th class="header">Clarity Characteristics</th>
									<th class="header">Table %</th>
									<th class="header">Dispersion</th>
									<th class="header">Prod Code</th>
									<th class="header">Enhancement</th>
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
								<tr ng-repeat="diamond in multipleDiamond track by $index" class="form-group">
									<td>
										<input type="text" class="form-control size-multiple-edit" readonly ng-model="diamond.report_no">
									</td>

									<td>
                        				<input type="text" class="form-control size-multiple-edit" ng-model="diamond.description">
									</td>

									<td>
										<select class="form-control size-multiple-edit" ng-model="diamond.cust_id" convert-to-number required>
				                            <option ng-repeat="customer in customers" value="@{{customer.id}}">@{{customer.name}}</option>
				                        </select>
									</td>

									<td>
										<select class="form-control size-multiple-edit" ng-model="diamond.prod_type_id" convert-to-number >
				                            <option value="">--Select--</option>
				                            <option ng-repeat="product in productTypes" value="@{{product.id}}">@{{product.name}}</option>
				                        </select>
									</td>

									<td>
                        				<input type="text" class="form-control size-multiple-edit" ng-model="diamond.testing_charge" required />
									</td>

									<td>
                        				<input type="text" class="form-control size-multiple-edit" ng-model="diamond.amount" ng-keyup="dueAmount()" required />
									</td>

									<td>
                        				<input type="text" class="form-control size-multiple-edit" readonly ng-model="diamond.due_amount" required />
									</td>

									<td>
                                		<input type="text" class="form-control size-multiple-edit" ng-model="diamond.diamond_wt">
									</td>

									<td>
										<select ng-model="diamond.g_cts_ratti" class="form-control size-multiple-edit" convert-to-number>
		                                    <option ng-repeat="weight in weightType" value="@{{weight.id}}">@{{weight.type}}</option>
		                                </select>
									</td>

									<td>
                                		<input type="text" class="form-control size-multiple-edit" ng-model="diamond.measurement">
									</td>

									<td>
										<select ng-model="diamond.cts" class="form-control size-multiple-edit" convert-to-number>
                                    	<option ng-repeat="type in mesurementType" value="@{{type.id}}">@{{type.type}}</option>
									</td>

									<td>
                        				<input type="text" class="form-control size-multiple-edit" ng-model="diamond.shape_of_diamond">
									</td>

									<td>
                        				<input type="text" class="form-control size-multiple-edit" ng-model="diamond.florescence">
									</td>

									<td>
                        				<input type="text" class="form-control size-multiple-edit" ng-model="diamond.color">
									</td>

									<td>
                        				<input type="text" class="form-control size-multiple-edit" ng-model="diamond.clarity">
									</td>

									<td>
                        				<input type="text" class="form-control size-multiple-edit" ng-model="diamond.cut">
									</td>

									<td>
                       					<input type="text" class="form-control size-multiple-edit" ng-model="diamond.polish">
									</td>

									<td>
                        				<input type="text" class="form-control size-multiple-edit" ng-model="diamond.symmetry">
									</td>

									<td>
                        				<input type="text" class="form-control size-multiple-edit" ng-model="diamond.clarity_characteristics">
									</td>

									<td>
                        				<input type="text" class="form-control size-multiple-edit" ng-model="diamond.table">
									</td>

									<td>
                        				<input type="text" class="form-control size-multiple-edit" ng-model="diamond.dispersion">
									</td>

									<td>
                        				<input type="text" class="form-control size-multiple-edit" ng-model="diamond.prod_code">
									</td>

									<td>
										<input type="text" class="form-control size-multiple-edit" ng-model="diamond.enhancements">
									</td>

									<td>
                        				<input type="text" class="form-control size-multiple-edit" ng-model="diamond.comments">
									</td>

									<td>
                        				<input type="text" class="form-control size-multiple-edit" ng-model="diamond.oigs_quality">
									</td>

									<td>
                        				<input type="text" class="form-control size-multiple-edit" ng-model="diamond.remark">
									</td>

									<td>
										<div ng-if="diamond.prod_image">
				                            <a href="{{ url('/') }}/@{{diamond.prod_image}}" class="btn btn-sm btn-info form-control size-multiple-edit" target="_blank">View</a>

				                            <button type="button" style="margin-top:5px" class="btn btn-danger btn-sm form-control size-multiple-edit" ng-click="removeMultipleProductImage(diamond, $index)">Remove</button>
				                        </div>
				                        <div ng-if="!diamond.prod_image">
				                            <button type="button" class="button btn btn-primary form-control size-multiple-edit" ngf-select="uploadMultipleProductImage($file, $index)" >Upload Image</button>
				                        </div>
									</td>

									<td>
										<select class="form-control size-multiple-edit" ng-model="diamond.certi_front" required convert-to-number>
                            				<option ng-repeat="front in frontImages" value="@{{front.id}}">@{{front.original_name}}</option>		
				                        </select>
									</td>

									<td>
										<select class="form-control size-multiple-edit" ng-model="diamond.certi_back" required convert-to-number>
				                            <option ng-repeat="back in backImages" value="@{{back.id}}">@{{back.original_name}}</option>
				                        </select>
									</td>

									<td>
										<select class="form-control size-multiple-edit" ng-model="diamond.status" required convert-to-number>
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
@endsection

