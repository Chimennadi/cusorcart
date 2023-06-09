<div class="modal-header">
    <h5 class="modal-title strong-600 heading-5">{{translate('Seller Message')}}</h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
<div class="modal-body gry-bg px-3 pt-3">
    <div class="row">
        <div class="col-lg-2">
            <label>{{translate('Message')}} <span class="text-danger">*</span></label>
        </div>
        <div class="col-lg-10">
            <textarea name="meta_description" rows="8" class="form-control" disabled>{{ $seller_withdraw_request->message }}</textarea>
        </div>
    </div>
</div>
<div class="modal-footer">
    <button class="btn btn-default" data-dismiss="modal">{{translate('Cancel')}}</button>
</div>
