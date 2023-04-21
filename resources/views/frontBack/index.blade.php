@extends('layout')

@section('content')

	<div class="row">

		<div class="col-md-12">
			<div class="page-header row">
				<div class="col-6">
					<h3>Front Back And Product Image</h3>
				</div>
				<div class="col-6">
					<div class="text-right">
					</div>
				</div>
			</div>

			@if(session()->has('success'))
			    <div class="alert alert-success">
			        {{ session()->get('success') }}
			    </div>
			@endif

			@if(session()->has('failure'))
			    <div class="alert alert-danfer">
			        {{ session()->get('failure') }}
			    </div>
			@endif

			<div class="portlet">
				<div class="portlet-body">

					<div class="row">
						<div class="col-md-6" style="border-right: 1px solid;">
							{{ Form::open(array('url' => '/upload/front-back-image/upload', 'method'=>'POST',"autocomplete"=>"off", "files" => "true")) }}
						        <div class="row">
						        	<div class="col-md-4 form-group">
						        		<label>Image</label>
						        		{{Form::file("image[]", ["class" => "form-control", "multiple" => "multiple", "required" => "required"])}}
						        	</div>

						        	<div class="col-md-4">
						        		<label>Select Type</label>
						        		{{Form::select("type",$imageMode,'',["class" => "form-control"])}}
						        	</div>

							        <div class="col-md-4">
							        	<button type="submit" class="btn btn-primary" style="margin-top:25px;">Upload</button>
							        </div>
						        </div>
		                    {{Form::close()}}
						</div>

						<div class="col-md-6">

							{{ Form::open(array('url' => '/upload/excel', 'method'=>'POST',"autocomplete"=>"off", "files" => "true")) }}
						        <div class="row">
						        	<div class="col-md-4 form-group">
						        		<label>Excel File</label>
						        		{{Form::file("excel_file", ["class" => "form-control", "multiple" => "multiple", "required" => "required"])}}
						        	</div>

						        	<div class="col-md-4">
						        		<label>Select Type</label>
						        		{{Form::select("type",$imageMode,'',["class" => "form-control"])}}
						        	</div>

							        <div class="col-md-4">
							        	<button type="submit" class="btn btn-primary" style="margin-top:25px;">Upload</button>
							        </div>
						        </div>
		                    {{Form::close()}}
							
						</div>
					</div>

				</div>
			</div>

			<div class="ng-cloak" ng-controller="image_controller" ng-init="getList()">
				<div class="portlet">
					<div class="portlet-body ng-cloak">
						<div table-paginate></div>
						@include("frontBack.filters")
						<div ng-show="dataset.length > 0 && !loading" style="overflow-y: auto;">
							<table class="table table-compact">
								<thead>
									<tr>
										<th>SN</th>
										<th>Image</th>
										<th>View</th>
										<th><th-sort column-id="type" column-name="Type" /></th>
										<th><th-sort column-id="original_name" column-name="Original Name" /></th>
										<th><th-sort column-id="created_at" column-name="Created At" /></th>
										<th>#</th>
									</tr>
								</thead>
								<tbody>
									<tr ng-repeat="image in dataset track by $index">
										<td>@{{ (filter.page_no-1)*filter.max_per_page + $index + 1}}</td>
										<td class="theme-color"> <b>@{{image.name}}</b> </td>
										<td> <a href="{{url('/')}}/@{{image.name}}" class="btn btn-info btn-sm" target="_blank">View </td>
										<td>@{{image.type}}</td>
										<td>@{{image.original_name}}</td>
										<td>@{{image.created_at}}</td>
										<td><button class="btn btn-danger btn-sm" ng-click="delete(image.id, $index)">Delete</button></td>
									</tr>
								</tbody>
							</table>
						</div>
						<div ng-show="dataset.length == 0 && !loading" class="alert alert-warning mt-5">
							No Images found
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

@endsection

