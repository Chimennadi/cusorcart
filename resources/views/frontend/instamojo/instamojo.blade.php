<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{translate('Instamojo Payment Gateway Integrate')}}</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-alpha/css/bootstrap.css" rel="stylesheet">
    <style>
        .mt40{
            margin-top: 40px;
        }
    </style>
</head>
<body>

<div class="container">

<div class="row">
    <div class="col-lg-12 mt40">
        <div class="card-header" style="background: #0275D8;">
            <h2>{{translate('Confirm your Information For Security Reason')}}</h2>
        </div>
    </div>
</div>

@if ($errors->any())
    <div class="alert alert-danger">
        <strong>{{translate('Opps!')}}'</strong> {{translate('Something went wrong')}}<br>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ url('pay') }}" method="POST" name="laravel_instamojo">
    {{ csrf_field() }}

     <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <strong>{{translate('Name')}}</strong>
                <input type="text" name="name" class="form-control" placeholder="{{ translate('Enter Name') }}" value="{{$order->user->name}}" required>
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group">
                <strong>{{translate('Mobile Number')}}</strong>
                <input type="text" name="mobile_number" class="form-control" placeholder="{{ translate('Enter Mobile Number') }}" value="{{$order->user->phone}}" required>
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group">
                <strong>{{translate('Email Id')}}</strong>
                <input type="text" name="email" class="form-control" placeholder="{{ translate('Enter Email id') }}" value="{{$order->user->email}}" required>
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group">
                <strong>{{translate('Amount')}}</strong>
                <input type="text" name="amount" class="form-control" placeholder="{{ translate('Enter Amount') }}" value="{{round($order->grand_total)}}" readonly="">
            </div>
        </div>
        <div class="col-md-12">
                <button type="submit" class="btn btn-primary">{{ translate('Submit') }}</button>
        </div>
    </div>

</form>
</div>

</body>
</html>
