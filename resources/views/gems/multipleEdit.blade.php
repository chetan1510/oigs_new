@extends('layout')

@section('content')
	<div class="ng-cloak" ng-controller="gems_controller" ng-init="editMultipleGemsInit('{{$gemsIds}}')">
		<div class="portlet">
			<div class="portlet-body">

				<div ng-if="loading" class="text-center mt-5 mb-5">
					<div class="spinner-grow" role="status">
					  <span class="sr-only">Loading...</span>
					</div>
				</div>

				<div class="containermultiple"  style="overflow-y: auto;" ng-if="!loading">
            		<form method="POST" name="GemsForm" ng-submit="onSubmitMultipleGems(GemsForm.$valid)" novalidate="novalidate" >
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
									<th class="header">Colour</th>
									<th class="header">Shape & Cut</th>
									<th class="header">Optic Character</th>
									<th class="header">Axial Figure</th>
									<th class="header">Refractive Index</th>
									<th class="header">Birefringence</th>
									<th class="header">Specific Gravity</th>
									<th class="header">Hardness(Moh's Scale)</th>
									<th class="header">Microscopic Obs</th>
									<th class="header">Species</th>
									<th class="header">Crystal System</th>
									<th class="header">Result <span class="required">*</span></th>
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
								<tr ng-repeat="gems in multipleGems track by $index" class="form-group">
									<td>
										<input type="text" class="form-control size-multiple-edit" readonly ng-model="gems.report_no">
									</td>

									<td>
                        				<input type="text" class="form-control size-multiple-edit" ng-model="gems.description">
									</td>

									<td>
										<select class="form-control size-multiple-edit" ng-model="gems.cust_id" convert-to-number required>
				                            <option ng-repeat="customer in customers" value="@{{customer.id}}">@{{customer.name}}</option>
				                        </select>
									</td>

									<td>
										<select class="form-control size-multiple-edit" ng-model="gems.prod_type_id" convert-to-number >
				                            <option value="">--Select--</option>
				                            <option ng-repeat="product in productTypes" value="@{{product.id}}">@{{product.name}}</option>
				                        </select>
									</td>

									<td>
                        				<input type="text" class="form-control size-multiple-edit" ng-model="gems.testing_charge" required />
									</td>

									<td>
                        				<input type="text" class="form-control size-multiple-edit" ng-model="gems.amount" ng-keyup="dueAmount()" required />
									</td>

									<td>
                        				<input type="text" class="form-control size-multiple-edit" readonly ng-model="gems.due_amount" required />
									</td>

									<td>
                                		<input type="text" class="form-control size-multiple-edit" ng-model="gems.weight">
									</td>

									<td>
										<select ng-model="gems.weight_type" class="form-control size-multiple-edit" convert-to-number>
		                                    <option ng-repeat="weight in weightType" value="@{{weight.id}}">@{{weight.type}}</option>
		                                </select>
									</td>

									<td>
                                		<input type="text" class="form-control size-multiple-edit" ng-model="gems.measurement">
									</td>

									<td>
										<select ng-model="gems.mesurement_type" class="form-control size-multiple-edit" convert-to-number>
		                                    <option ng-repeat="type in mesurementType" value="@{{type.id}}">@{{type.type}}</option>
		                                </select>
									</td>

									<td>
                        				<input type="text" class="form-control size-multiple-edit" ng-model="gems.color">
									</td>

									<td>
                        				<input type="text" class="form-control size-multiple-edit" ng-model="gems.shape_cut">
									</td>

									<td>
                        				<input type="text" class="form-control size-multiple-edit" ng-model="gems.optic_character">
									</td>

									<td>
                        				<input type="text" class="form-control size-multiple-edit" ng-model="gems.axial_figure">
									</td>

									<td>
                        				<input type="text" class="form-control size-multiple-edit" ng-model="gems.ri">
									</td>

									<td>
                       					<input type="text" class="form-control size-multiple-edit" ng-model="gems.birefringence">
									</td>

									<td>
                        				<input type="text" class="form-control size-multiple-edit" ng-model="gems.sg">
									</td>

									<td>
                        				<input type="text" class="form-control size-multiple-edit" ng-model="gems.hardness">
									</td>

									<td>
                        				<input type="text" class="form-control size-multiple-edit" ng-model="gems.microscopic_obs">
									</td>

									<td>
                        				<input type="text" class="form-control size-multiple-edit" ng-model="gems.species">
									</td>

									<td>
                        				<input type="text" class="form-control size-multiple-edit" ng-model="gems.crystal_system">
									</td>

									<td>
										<select class="form-control size-multiple-edit" ng-model="gems.result_id" convert-to-number required>
				                            <option ng-repeat="result in results" value="@{{result.id}}">@{{result.name}}</option>
				                        </select>
									</td>

									<td>
                        				<input type="text" class="form-control size-multiple-edit" ng-model="gems.comments">
									</td>

									<td>
                        				<input type="text" class="form-control size-multiple-edit" ng-model="gems.oigs_quality">
									</td>

									<td>
                        				<input type="text" class="form-control size-multiple-edit" ng-model="gems.remark">
									</td>

									<td>
										<div ng-if="gems.prod_image">
				                            <a href="{{ url('/') }}/@{{gems.prod_image}}" class="btn btn-sm btn-info form-control size-multiple-edit" target="_blank">View</a>

				                            <button type="button" style="margin-top:5px" class="btn btn-danger btn-sm form-control size-multiple-edit" ng-click="removeMultipleProductImage(gems, $index)">Remove</button>
				                        </div>
				                        <div ng-if="!gems.prod_image">
				                            <button type="button" class="button btn btn-primary form-control size-multiple-edit" ngf-select="uploadMultipleProductImage($file, $index)" >Upload Image</button>
				                        </div>
									</td>

									<td>
										<select class="form-control size-multiple-edit" ng-model="gems.certi_front_id" required convert-to-number>
				                            <option ng-repeat="front in frontImages" value="@{{front.id}}">@{{front.original_name}}</option>
				                        </select>
									</td>

									<td>
										<select class="form-control size-multiple-edit" ng-model="gems.certi_back_id" required convert-to-number>
				                            <option ng-repeat="back in backImages" value="@{{back.id}}">@{{back.original_name}}</option>
				                        </select>
									</td>

									<td>
										<select class="form-control size-multiple-edit" ng-model="gems.status" required convert-to-number>
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

