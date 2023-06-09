@extends('backend.layouts.blank')
@section('content')
    <div class="container pt-5">
        <div class="row">
            <div class="col-xl-6 mx-auto">
                <div class="card">
                    <div class="card-body">
                        <div class="text-center mb-4">
                            <h1 class="h3">Congratulations!!!</h1>
                            <p>You have successfully completed the installation process. Please Login to continue.</p>
                        </div>
                        <div class="card">
                            <div class="card-header">
                                <h3 class="fs-16 mb-0 card-title">Configure the following setting to run the system properly.</h3>
                            </div>
                            <div class="card-body">
                                <ul class="">
                                    <li class="">SMTP Setting</li>
                                    <li class="">Payment Method Configuration</li>
                                    <li class="">Social Media Login Configuration</li>
                                    <li class="">Facebook Chat Configuration</li>
                                </ul>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header">
                                <h3 class="fs-16 mb-0 card-title">Demo account added for test purpose.</h3>
                            </div>
                            <div class="card-body">
                                <table class="table table-bordered mar-no">
                                    <thead>
                                        <tr>
                                            <th>User Type</th>
                                            <th>Email</th>
                                            <th>Password</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>Customer</td>
                                            <td>customer@example.com</td>
                                            <td>123456</td>
                                        </tr>
                                        <tr>
                                            <td>Seller</td>
                                            <td>seller@example.com</td>
                                            <td>123456</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="text-center">
                            <a href="{{ env('APP_URL') }}" class="btn btn-primary">Go to Frontend Website</a>
                            <a href="{{ env('APP_URL') }}/admin" class="btn btn-success">Login to Admin panel</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
