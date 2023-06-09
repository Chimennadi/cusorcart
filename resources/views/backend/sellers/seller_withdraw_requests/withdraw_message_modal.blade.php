<div class="modal-header">
  <h5 class="modal-title h6">{{translate('Seller Message')}}</h5>
  <button type="button" class="close" data-dismiss="modal">
  </button>
</div>
<div class="modal-body">
    <div class="from-group row">
        <div class="col-lg-2">
            <label>{{translate('Message')}}</label>
        </div>
        <div class="col-lg-10">
            <textarea name="meta_description" rows="8" class="form-control">{{ $seller_withdraw_request->message }}</textarea>
        </div>
    </div>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-light" data-dismiss="modal">{{translate('Cancel')}}</button>
</div>
