@extends('backend.layouts.app')

@section('content')
<div class="aiz-titlebar text-left mt-2 mb-3">
    <h5 class="mb-0 h6">{{translate('Add New Ticket')}}</h5>
</div>
 <form class="form form-horizontal mar-top" action="{{ route('support_ticket.adminstore') }}" method="post" enctype="multipart/form-data">
                      @csrf
                      <div class="row">
                          <div class="col-md-2">
                              <label>{{ translate('Subject')}}</label>
                          </div>
                          <div class="col-md-10">
                              <input type="text" class="form-control mb-3" placeholder="{{ translate('Subject')}}" name="subject" required>
                          </div>
                      </div>
                    
                    <div class="row">
                          <div class="col-md-2">
                              <label>{{ translate('Select Customer')}}</label>
                          </div>
                          <div class="col-md-10">
                             <select class="form-control mb-3" name="id">
                            <option>Select Customer</option>
                            @foreach(\App\User::where('user_type','customer')->get() as $item)
                            <option value="{{$item->id}}">{{$item->name}}</option>
                            @endforeach
                             </select>
                          </div>
                      </div>
                    
                      <div class="row">
                          <div class="col-md-2">
                              <label>{{ translate('Provide a detailed description')}}</label>
                          </div>
                          <div class="col-md-10">
                              <textarea type="text" class="form-control mb-3" rows="3" name="details" placeholder="{{ translate('Type your reply')}}" data-buttons="bold,underline,italic,|,ul,ol,|,paragraph,|,undo,redo" required></textarea>
                          </div>
                      </div>
                      <div class="form-group row">
                          <label class="col-md-2 col-form-label">{{ translate('Photo') }}</label>
                          <div class="col-md-10">
                              <div class="input-group" data-toggle="aizuploader" data-type="image" data-multiple="true">
                                  <div class="input-group-prepend">
                                      <div class="input-group-text bg-soft-secondary font-weight-medium">{{ translate('Browse')}}</div>
                                  </div>
                                  <div class="form-control file-amount">{{ translate('Choose File') }}</div>
                                  <input type="hidden" name="attachments" class="selected-files">
                              </div>
                              <div class="file-preview box sm">
                              </div>
                          </div>
                      </div>
                      <div class="text-right mt-4">
                          <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ translate('cancel')}}</button>
                          <button type="submit" class="btn btn-primary">{{ translate('Send Ticket')}}</button>
                      </div>
                  </form>
                  
@endsection
                  