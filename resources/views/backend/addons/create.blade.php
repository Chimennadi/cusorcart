@extends('backend.layouts.app')

@section('content')

<div class="row">
    <div class="col-lg-7 mx-auto">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0 h6">{{ translate('Install/Update Addon')}}</h5>
            </div>
            <form class="form-horizontal" action="{{ route('addons.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                    <div class="form-group row">
                        <label class="col-sm-3 col-from-label" for="addon_zip">{{ translate('Zip File')}}</label>
                        <div class="col-sm-9">
                            <div class="custom-file">
                                <label class="custom-file-label">
                                    <input type="file" id="addon_zip" name="addon_zip"  class="custom-file-input" required>
                                    <span class="custom-file-name">{{ translate('Choose file') }}</span>
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group mb-0 text-right">
                        <button type="submit" class="btn btn-primary">{{translate('Install/Update')}}</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
