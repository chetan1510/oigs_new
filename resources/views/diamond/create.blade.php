@extends('layout')

@section('sub_header')
<div class="sub-header">
    <div class="table-div full">
        <div>
            <h4 class="fs-18 bold" style="margin:0;"> {{ $id ? "Update Diamond" : "Add Diamond" }} </h4>
        </div>
        <div class="text-right">
            <a href="{{url('/diamond')}}"><i class="icons icon-arrow-left"></i> Go Back</a>
        </div>
    </div>
</div>
@endsection

@section('content')

<div class="ng-cloak" ng-controller="diamond_controller" ng-init="addEditInit('{{$id}}')">

    <div class="portlet">

        <div ng-if="loading" class="text-center mt-5 mb-5">
            <div class="spinner-grow" role="status">
              <span class="sr-only">Loading...</span>
          </div>
      </div>

      <div class="portlet-body" ng-if="!loading">

        <div class=" mt-1">

            <form method="POST" name="DiamondForm" ng-submit="onSubmitDiamond(DiamondForm.$valid)" novalidate="novalidate" >
                <div class="row">
                    <div class="col-sm-3 form-group">
                        <label>Report No</label>
                        <input type="text" class="form-control" readonly ng-model="formData.report_no">
                    </div>

                    <div class="col-sm-3 form-group">
                        <label>Description</label>
                        <input type="text" class="form-control" ng-model="formData.description">
                    </div>

                    <div class="col-sm-3 form-group">
                        <label>Customer <span class="required">*</span></label>
                        <select class="form-control" ng-model="formData.cust_id" convert-to-number required>
                            <option ng-repeat="customer in customers" value="@{{customer.id}}">@{{customer.name}}</option>
                        </select>
                    </div>

                    <div class="col-sm-3 form-group">
                        <label>Prod Type</label>
                        <select class="form-control" ng-model="formData.prod_type_id" convert-to-number>
                            <option value="">--Select--</option>
                            <option ng-repeat="product in productTypes" value="@{{product.id}}">@{{product.name}}</option>
                        </select>
                    </div>

                    <div class="col-sm-3 form-group">
                        <label>Testing Charge <span class="required">*</span></label>
                        <input type="text" class="form-control" ng-model="formData.testing_charge" ng-keyup="dueAmount()" required />
                    </div>

                    <div class="col-sm-3 form-group">
                        <label>Recieved Amount <span class="required">*</span></label>
                        <input type="text" class="form-control" ng-model="formData.amount" ng-keyup="dueAmount()" >
                    </div>

                    <div class="col-sm-3 form-group">
                        <label>Due Amount <span class="required">*</span></label>
                        <input type="text" class="form-control" readonly ng-model="formData.due_amount" required />
                    </div>

                    <div class="col-sm-6 form-group">
                        <div class="row">
                            <div class="col-sm-6">
                                <label>Diamond Weight</label>
                                <input type="text" class="form-control" ng-model="formData.diamond_wt">
                            </div>
                            <div class="col-sm-6">
                                <label>Type</label>
                                <select ng-model="formData.g_cts_ratti" class="form-control" convert-to-number>
                                    <option ng-repeat="weight in weightType" value="@{{weight.id}}">@{{weight.type}}</option>
                                </select>
                            </div>
                        </div> 
                    </div>

                    <div class="col-sm-6 form-group">
                        <div class="row">
                            <div class="col-sm-6">
                                <label>Measurement</label>
                                <input type="text" class="form-control" ng-model="formData.measurement">
                            </div>
                            <div class="col-sm-6">
                                <label>Type</label>
                                <select ng-model="formData.cts" class="form-control" convert-to-number>
                                    <option ng-repeat="type in mesurementType" value="@{{type.id}}">@{{type.type}}</option>
                                </select>
                            </div>
                        </div> 
                    </div>
                </div>

                <h4 class="section-title"></h4>

                <div class="row">
                    <div class="col-sm-3 form-group">
                        <label>Shape Of Diamond</label>
                        <input type="text" class="form-control" ng-model="formData.shape_of_diamond">
                    </div>

                    <div class="col-sm-3 form-group">
                        <label>Florescence</label>
                        <input type="text" class="form-control" ng-model="formData.florescence">
                    </div>

                    <div class="col-sm-3 form-group">
                        <label>Color</label>
                        <input type="text" class="form-control" ng-model="formData.color">
                    </div>

                    <div class="col-sm-3 form-group">
                        <label>Clarity</label>
                        <input type="text" class="form-control" ng-model="formData.clarity">
                    </div>

                    <div class="col-sm-3 form-group">
                        <label>Cut</label>
                        <input type="text" class="form-control" ng-model="formData.cut">
                    </div>

                    <div class="col-sm-3 form-group">
                        <label>Polish</label>
                        <input type="text" class="form-control" ng-model="formData.polish">
                    </div>

                    <div class="col-sm-3 form-group">
                        <label>Symmetry</label>
                        <input type="text" class="form-control" ng-model="formData.symmetry">
                    </div>

                    <div class="col-sm-3 form-group">
                        <label>Clarity Characteristics</label>
                        <input type="text" class="form-control" ng-model="formData.clarity_characteristics">
                    </div>

                    <div class="col-sm-3 form-group">
                        <label>Table%</label>
                        <input type="text" class="form-control" ng-model="formData.table">
                    </div>

                    <div class="col-sm-3 form-group">
                        <label>Dispersion</label>
                        <input type="text" class="form-control" ng-model="formData.dispersion">
                    </div>
                </div>  

                <h4 class="section-title"></h4>

                <div class="row">
                    <div class="col-sm-3 form-group">
                        <label>Prod Code</label>
                        <input type="text" class="form-control" ng-model="formData.prod_code">
                    </div>

                    <div class="col-sm-3 form-group">
                        <label>Enhancement</label>
                        <input type="text" class="form-control" ng-model="formData.enhancements">
                    </div>

                    <div class="col-sm-3 form-group">
                        <label>Coments</label>
                        <input type="text" class="form-control" ng-model="formData.comments">
                    </div>

                    <div class="col-sm-3 form-group">
                        <label>OIGS Quality Grade</label>
                        <input type="text" class="form-control" ng-model="formData.oigs_quality">
                    </div>

                    <div class="col-sm-3 form-group">
                        <label>Remark</label>
                        <input type="text" class="form-control" ng-model="formData.remark">
                    </div>

                    <div class="col-sm-3 form-group">
                        <label>Prod Image <span class="required">*</span></label>
                        <div ng-if="formData.prod_image">
                            <a href="{{ url('/') }}/@{{formData.prod_image}}" class="btn btn-sm btn-info form-control" target="_blank">View</a>

                            <button type="button" style="margin-top:5px" class="btn btn-danger btn-sm form-control" ng-click="removeProductImage()">Remove</button>
                        </div>
                        <div ng-if="!formData.prod_image">
                            <button type="button" class="button btn btn-primary form-control" ngf-select="uploadProductImage($file)" >Upload Image</button>
                        </div>
                    </div>

                    <div class="col-sm-3 form-group">
                        <label>Certi Front <span class="required">*</span></label>
                        <select class="form-control" ng-model="formData.certi_front" required convert-to-number>
                            <option ng-repeat="front in frontImages" value="@{{front.id}}">@{{front.original_name}}</option>
                        </select>
                    </div>

                    <div class="col-sm-3 form-group">
                        <label>Certi Back <span class="required">*</span></label>
                        <select class="form-control" ng-model="formData.certi_back" required convert-to-number>
                            <option ng-repeat="back in backImages" value="@{{back.id}}">@{{back.original_name}}</option>
                        </select>
                    </div>

                    <div class="col-sm-3 form-group">
                        <label>Status <span class="required">*</span></label>
                        <select class="form-control" ng-model="formData.status" required convert-to-number>
                            <option value="1"> Small </option>
                            <option value="2"> Large </option>
                        </select>
                    </div>
                </div> 

                <div class="">
                    <hr>
                    <button type="submit" class="btn btn-primary" ng-disabled="processing">   
                        @{{formData.id ? 'Update':'Submit'}} <span ng-if="processing" class="spinner-border spinner-border-sm"></span>
                    </button>
                </div>

            </form>
        </div>
    </div>
</div>
</div>
@endsection