

<?php $__env->startSection('sub_header'); ?>
<div class="sub-header">
    <div class="table-div full">
        <div>
            <h4 class="fs-18 bold" style="margin:0;"> <?php echo e($id ? "Update Gems" : "Add Gems"); ?> </h4>
        </div>
        <div class="text-right">
            <a href="<?php echo e(url('/gems')); ?>"><i class="icons icon-arrow-left"></i> Go Back</a>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

<div class="ng-cloak" ng-controller="gems_controller" ng-init="addEditInit('<?php echo e($id); ?>')">

    <div class="portlet">

        <div ng-if="loading" class="text-center mt-5 mb-5"> 
            <div class="spinner-grow" role="status">
              <span class="sr-only">Loading...</span>
          </div>
      </div>

      <div class="portlet-body" ng-if="!loading">

        <div class=" mt-1">

            <form method="POST" name="GemsForm" ng-submit="onSubmitGems(GemsForm.$valid)" novalidate="novalidate" >
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
                            <option ng-repeat="customer in customers" value="{{customer.id}}">{{customer.name}}</option>
                        </select>
                    </div>

                    <div class="col-sm-3 form-group">
                        <label>Prod Type</label>
                        <select class="form-control" ng-model="formData.prod_type_id" convert-to-number>
                            <option value="">--Select--</option>
                            <option ng-repeat="product in productTypes" value="{{product.id}}">{{product.name}}</option>
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
                                <label>Weight</label>
                                <input type="text" class="form-control" ng-model="formData.weight">
                            </div>
                            <div class="col-sm-6">
                                <label>Type</label>
                                <select ng-model="formData.weight_type" class="form-control" convert-to-number>
                                    <option ng-repeat="weight in weightType" value="{{weight.id}}">{{weight.type}}</option>
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
                                <select ng-model="formData.mesurement_type" class="form-control" convert-to-number>
                                    <option ng-repeat="type in mesurementType" value="{{type.id}}">{{type.type}}</option>
                                </select>
                            </div>
                        </div> 
                    </div>
                </div>

                <h4 class="section-title"></h4>

                <div class="row">
                    <div class="col-sm-3 form-group">
                        <label>Colour</label>
                        <input type="text" class="form-control" ng-model="formData.color">
                    </div>

                    <div class="col-sm-3 form-group">
                        <label>Shape & Cut</label>
                        <input type="text" class="form-control" ng-model="formData.shape_cut">
                    </div>

                    <div class="col-sm-3 form-group">
                        <label>Optic Character</label>
                        <input type="text" class="form-control" ng-model="formData.optic_character">
                    </div>

                    <div class="col-sm-3 form-group">
                        <label>Axial Figure</label>
                        <input type="text" class="form-control" ng-model="formData.axial_figure">
                    </div>

                    <div class="col-sm-3 form-group">
                        <label>Refractive Index</label>
                        <input type="text" class="form-control" ng-model="formData.ri">
                    </div>

                    <div class="col-sm-3 form-group">
                        <label>Birefringence</label>
                        <input type="text" class="form-control" ng-model="formData.birefringence">
                    </div>

                    <div class="col-sm-3 form-group">
                        <label>Specific Gravity</label>
                        <input type="text" class="form-control" ng-model="formData.sg">
                    </div>

                    <div class="col-sm-3 form-group">
                        <label>Hardness(Moh's Scale)</label>
                        <input type="text" class="form-control" ng-model="formData.hardness">
                    </div>

                    <div class="col-sm-3 form-group">
                        <label>Microscopic Obs</label>
                        <input type="text" class="form-control" ng-model="formData.microscopic_obs">
                    </div>

                    <div class="col-sm-3 form-group">
                        <label>Species</label>
                        <input type="text" class="form-control" ng-model="formData.species">
                    </div>
                </div>  

                <h4 class="section-title"></h4>

                <div class="row">
                    <div class="col-sm-3 form-group">
                        <label>Crystal System</label>
                        <input type="text" class="form-control" ng-model="formData.crystal_system">
                    </div>

                    <div class="col-sm-3 form-group">
                        <label>Result <span class="required">*</span></label>
                        <select class="form-control" ng-model="formData.result_id" ng-change="getResultData()" convert-to-number required>
                            <option ng-repeat="result in results" value="{{result.id}}">{{result.name}}</option>
                        </select>
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
                            <a href="<?php echo e(url('/')); ?>/{{formData.prod_image}}" class="btn btn-sm btn-info form-control" target="_blank">View</a>

                            <button type="button" style="margin-top:5px" class="btn btn-danger btn-sm form-control" ng-click="removeProductImage()">Remove</button>
                        </div>
                        <div ng-if="!formData.prod_image">
                            <button type="button" class="button btn btn-primary form-control" ngf-select="uploadProductImage($file)" >Upload Image</button>
                        </div>
                    </div>

                    <div class="col-sm-3 form-group">
                        <label>Certi Front <span class="required">*</span></label>
                        <select class="form-control" ng-model="formData.certi_front_id" required convert-to-number>
                            <option ng-repeat="front in frontImages" value="{{front.id}}">{{front.original_name}}</option>
                        </select>
                    </div>

                    <div class="col-sm-3 form-group">
                        <label>Certi Back <span class="required">*</span></label>
                        <select class="form-control" ng-model="formData.certi_back_id" required convert-to-number>
                            <option ng-repeat="back in backImages" value="{{back.id}}">{{back.original_name}}</option>
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
                        {{formData.id ? 'Update':'Submit'}} <span ng-if="processing" class="spinner-border spinner-border-sm"></span>
                    </button>
                </div>

            </form>
        </div>
    </div>
</div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/MAMP/htdocs/oigs_new/resources/views/gems/create.blade.php ENDPATH**/ ?>