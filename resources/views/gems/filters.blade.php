<div class="filters small-form mt-3" ng-show="filter.show">
	<form ng-submit="searchList()">
		<div class="row">

				<div class="col-md-2">
          <div class="form-group mt-3">
          	<label class="theme-color">Date</label>
            <input type="text" ng-model="filter.date" class="form-control datepicker" autocomplete="off" >
          </div>
        </div>

        <div class="col-md-2">
          <div class="form-group mt-3">
          	<label class="theme-color">Report No.</label>
            <input type="text" ng-model="filter.report_no" class="form-control" autocomplete="off" >
          </div>
        </div>

        <div class="col-md-2">
          <div class="form-group mt-3">
          	<label class="theme-color">Due Amount</label>
            <input type="text" ng-model="filter.due_amount" class="form-control" autocomplete="off" >
          </div>
        </div>

        <div class="col-md-2 mt-3 form-group">
          <label>Customer </label>
          <select class="theme-color form-control" ng-model="filter.cust_id" convert-to-number>
              <option ng-repeat="customer in customers" value="@{{customer.id}}">@{{customer.name}}</option>
          </select>
      	</div>

      	<div class="col-md-2 mt-3 form-group">
          <label>Result </label>
          <select class="theme-color form-control" ng-model="filter.result_id" convert-to-number>
              <option ng-repeat="result in results" value="@{{result.id}}">@{{result.name}}</option>
          </select>
      	</div>

        <div class="col-md-2 mt-3 form-group">
          <label>Prod Type</label>
          <select class="form-control" ng-model="filter.prod_type_id" >
              <option value="">--Select--</option>
              <option ng-repeat="product in productTypes" value="@{{product.id}}">@{{product.name}}</option>
          </select>
        </div>

        <div class="col-md-2">
        	<div class="mt-5">
        		<button type="submit" class="btn btn-primary btn-block" ng-disabled="processing">Apply Filters <span ng-show="processing" class="spinner-border spinner-border-sm"></span></button>

	        	<!-- <button style="margin-top: 23px;" class="btn btn-warning" ng-click="filter.export_excel=1" ladda="loading">Export Excel</button> -->
        	</div>

        </div>

		</div>
	</form>
</div>