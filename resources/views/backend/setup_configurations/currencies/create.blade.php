<form action="{{ route('currency.store') }}" method="POST">
    @csrf
    <div class="modal-header">
    	<h5 class="modal-title h6">{{translate('Add New Currency')}}</h5>
    	<button type="button" class="close" data-dismiss="modal">
    	</button>
    </div>
    <div class="modal-body">
        <div class="form-group row">
            <label class="col-sm-2 col-from-label" for="name">{{translate('Name')}}</label>
            <div class="col-sm-10">
                <input type="text" placeholder="{{translate('Name')}}" id="name" name="name" class="form-control" required>
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-2 col-from-label" for="symbol">{{translate('Symbol')}}</label>
            <div class="col-sm-10">
                <input type="text" placeholder="{{translate('Symbol')}}" id="symbol" name="symbol" class="form-control" required>
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-2 col-from-label" for="code">{{translate('Code')}}</label>
            <div class="col-sm-10">
                <input type="text" placeholder="{{translate('Code')}}" id="code" name="code" class="form-control" required>
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-2 col-from-label" for="exchange_rate">{{translate('Exchange Rate')}}</label>
            <div class="col-sm-10">
                <input type="number" lang="en" step="0.01" min="0" placeholder="{{translate('Exchange Rate')}}" id="exchange_rate" name="exchange_rate" class="form-control" required>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button type="submit" class="btn btn-sm btn-primary">{{translate('Save')}}</button>
        <button type="button" class="btn btn-sm btn-light" data-dismiss="modal">{{translate('Cancel')}}</button>
    </div>
</form>
