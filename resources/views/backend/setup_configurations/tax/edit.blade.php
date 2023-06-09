@extends('backend.layouts.app')

@section('content')

<div class="aiz-titlebar text-left mt-2 mb-3">
    <h5 class="mb-0 h6">{{translate('Tax Information')}}</h5>
</div>

<div class="row">
    <div class="col-lg-6 mx-auto">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0 h6">{{translate('update Tax Info')}}</h5>
            </div>
            <div class="card-body p-0">
                <form class="p-4" action="{{ route('tax.update', $tax->id) }}" method="POST">
                    <input name="_method" type="hidden" value="PATCH">
                    @csrf
                    <div class="form-group row">
                        <div class="col-lg-3">
                            <label class="control-label">{{ translate('Name') }}</label>
                        </div>
                        <div class="col-lg-9">
                            <input type="text" class="form-control" name="name" placeholder="{{ translate('Name') }}" value="{{ $tax->name }}" required>
                        </div>
                    </div>
                    
                    <div class="form-group mb-0 text-right">
                        <button type="submit" class="btn btn-sm btn-primary">{{translate('Save')}}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
