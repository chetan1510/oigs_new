<div class="filters small-form mt-3" ng-show="filter.show">
	<form ng-submit="searchList()">
		<div class="row">


        <div class="col-md-2">
          <div class="form-group mt-3">
          	<label class="theme-color">Image Type</label>
          	<select ng-model="filter.type" class="form-control">
          		<option ng-repeat="mode in imageMode track by $index" value="@{{$index+1}}">@{{mode}}</option>
          	</select>
          </div>
        </div>

        <div class="col-md-2">
        	<div class="mt-5">
        		<button type="submit" class="btn btn-primary btn-block" ng-disabled="processing">Apply Filters <span ng-show="processing" class="spinner-border spinner-border-sm"></span></button>
        	</div>
        </div>

		</div>
	</form>
</div>