@extends('backend.layouts.blank')
@section('content')
    <div class="container pt-5">
        <div class="row">
            <div class="col-xl-6 mx-auto">
                <div class="card">
                    <div class="card-body">
                        <div class="mar-ver pad-btm text-center">
                            <h1 class="h3">Active eCommerce CMS Settings</h1>
                            <p>Fill this form with basic information & admin login credentials</p>
                        </div>
                        <p class="text-muted font-13">
                            <form method="POST" action="{{ route('system_settings') }}">
                                @csrf
                                <div class="form-group">
                                    <label for="admin_name">Admin Name</label>
                                    <input type="text" class="form-control" id="admin_name" name="admin_name" required>
                                </div>

                                <div class="form-group">
                                    <label for="admin_email">Admin Email</label>
                                    <input type="email" class="form-control" id="admin_email" name="admin_email" required>
                                </div>

                                <div class="form-group">
                                    <label for="admin_password">Admin Password (At least 6 characters)</label>
                                    <input type="password" class="form-control" id="admin_password" name="admin_password" required>
                                </div>

                                <div class="form-group">
                                    <label for="admin_name">System Currency</label>
                                    <select class="form-control aiz-selectpicker" data-live-search="true" name="system_default_currency" required>
                                        @foreach (\App\Currency::all() as $key => $currency)
                                            <option value="{{ $currency->id }}">{{ $currency->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="text-center">
                                    <button type="submit" class="btn btn-primary">Continue</button>
                                </div>
                            </form>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
