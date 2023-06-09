@extends('backend.layouts.app')

@section('content')

<div class="row">
    <div class="col-lg-6 mx-auto">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0 h6">Add Bank Detail</h5>
            </div>
            <?php   
                $bank = App\BankDetail::where('user_id',Auth::user()->id)->first();
            ?>
            @if(App\BankDetail::where('user_id', Auth::user()->id)->first() )
            <form class="form-horizontal" action="bank-detail-update" method="POST" enctype="multipart/form-data">
            	@csrf
                <div class="card-body">
                    <div class="form-group row">
                        <label class="col-sm-3 col-from-label" for="name">Bank Name</label>
                        <div class="col-sm-9">
                            <input type="text" placeholder="Bank Name" id="name" name="bankname" value="{{$bank->bankname}}" class="form-control" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-from-label" for="email">Account No / Iban</label>
                        <div class="col-sm-9">
                            <input type="text" placeholder="Account No" id="email" name="acount_no" value="{{$bank->acount_no}}" class="form-control" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-from-label" for="mobile">Account Title</label>
                        <div class="col-sm-9">
                            <input type="text" placeholder="Account Title" id="mobile" name="acount_title" value="{{$bank->acount_title}}" class="form-control" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-from-label" for="password">Branch Code</label>
                        <div class="col-sm-9">
                            <input type="text" placeholder="Branch Code" id="password" name="branch_code" value="{{$bank->branch_code}}" class="form-control" required>
                        </div>
                    </div>
                     <div class="form-group row">
                        <label class="col-sm-3 col-from-label" for="password">Branch Address</label>
                        <div class="col-sm-9">
                            <input type="text" placeholder="Branch Address" id="password" name="branch_address" value="{{$bank->branch_address}}" class="form-control" required>
                        </div>
                    </div>
                   
                    <div class="form-group mb-0 text-right">
                        <button type="submit" class="btn btn-sm btn-primary">{{translate('Save')}}</button>
                    </div>
                </div>
            </form>
            @else
            <form class="form-horizontal" action="bank-detail-post" method="POST" enctype="multipart/form-data">
            	@csrf
                <div class="card-body">
                    <div class="form-group row">
                        <label class="col-sm-3 col-from-label" for="name">Bank Name</label>
                        <div class="col-sm-9">
                            <input type="text" placeholder="Bank Name" id="name" name="bankname" class="form-control" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-from-label" for="email">Account No / Iban</label>
                        <div class="col-sm-9">
                            <input type="text" placeholder="Account No" id="email" name="acount_no" class="form-control" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-from-label" for="mobile">Account Title</label>
                        <div class="col-sm-9">
                            <input type="text" placeholder="Account Title" id="mobile" name="acount_title" class="form-control" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-from-label" for="password">Branch Code</label>
                        <div class="col-sm-9">
                            <input type="text" placeholder="Branch Code" id="password" name="branch_code" class="form-control" required>
                        </div>
                    </div>
                     <div class="form-group row">
                        <label class="col-sm-3 col-from-label" for="password">Branch Address</label>
                        <div class="col-sm-9">
                            <input type="text" placeholder="Branch Address" id="password" name="branch_address" class="form-control" required>
                        </div>
                    </div>
                   
                    <div class="form-group mb-0 text-right">
                        <button type="submit" class="btn btn-sm btn-primary">{{translate('Save')}}</button>
                    </div>
                </div>
            </form>
            @endif
        </div>
    </div>
</div>

@endsection
