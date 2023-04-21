<div class="modal fade in" id="customerModel" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Customer</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="icons icon-close"></i></button>
            </div>
            <div class="modal-body small-form" >
                <div class="row" ng-repeat="customer in customerData.customer track by $index">
                    <div class="col-md-12 form-group">
                        <input type="text" ng-model="customer.name" class="form-control" placeholder="Customer">
                    </div>
                </div>
                <button type="button" class="btn btn-sm btn-light" ng-click="addMoreCustomer()"><i class="icons icon-plus"></i> Add</button>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" ng-click="submitCustomer()" ng-disabled="processing" >Submit <span ng-show="processing" class="spinner-border spinner-border-sm"></span></button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade in" id="result" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Result</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="icons icon-close"></i></button>
            </div>
            <div class="modal-body small-form" >
                <div class="row" ng-repeat="result in resultData.result track by $index">
                    <div class="col-md-12 form-group">
                        <input type="text" ng-model="result.name" class="form-control" placeholder="Result">
                    </div>
                </div>
                <button type="button" class="btn btn-sm btn-light" ng-click="addMoreResult()"><i class="icons icon-plus"></i> Add</button>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" ng-click="submitResult()" ng-disabled="resultProcessing" >Submit <span ng-show="resultProcessing" class="spinner-border spinner-border-sm"></span></button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade in" id="product_type" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Product Type</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="icons icon-close"></i></button>
            </div>
            <div class="modal-body small-form" >
                <div class="row" ng-repeat="product in productTypeData.product track by $index">
                    <div class="col-md-12 form-group">
                        <input type="text" ng-model="product.name" class="form-control" placeholder="Type">
                    </div>
                </div>
                <button type="button" class="btn btn-sm btn-light" ng-click="addMoreProduct()"><i class="icons icon-plus"></i> Add</button>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" ng-click="submitProductType()" ng-disabled="productProcessing" >Submit <span ng-show="productProcessing" class="spinner-border spinner-border-sm"></span></button>
            </div>
        </div>
    </div>
</div><?php /**PATH C:\xampp\htdocs\oigs_new\resources\views/manage/model.blade.php ENDPATH**/ ?>