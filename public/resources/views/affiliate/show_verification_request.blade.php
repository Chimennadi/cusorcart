@extends('backend.layouts.app')

@section('content')

<div class="card">
    <div class="card-header">
        <h5 class="mb-0 h6">{{ translate('Affiliate User Verification')}}</h5>
    </div>
    <div class="card-body row">
        <div class="col-md-4">
            <h6 class="mb-4">{{ translate('User Info') }}</h6>
            <p class="text-muted">
                <strong>{{ translate('Name') }} :</strong>
                <span class="ml-2">{{ $affiliate_user->user->name }}</span>
            </p>
            <p class="text-muted">
                <strong>{{translate('Email')}}</strong>
                <span class="ml-2">{{ $affiliate_user->user->email }}</span>
            </p>
            <p class="text-muted">
                <strong>{{translate('Address')}}</strong>
                <span class="ml-2">{{ $affiliate_user->user->address }}</span>
            </p>
            <p class="text-muted">
                <strong>{{translate('Phone')}}</strong>
                <span class="ml-2">{{ $affiliate_user->user->phone }}</span>
            </p>
        </div>
        <div class="col-md-6">
          <h6 class="mb-4">{{ translate('Verification Info') }}</h6>
            <table class="table table-striped table-bordered" cellspacing="0" width="100%">
                <tbody>
                    @foreach (json_decode($affiliate_user->informations) as $key => $info)
                        <tr>
                            <th class="text-muted">{{ $info->label }}</th>
                            @if ($info->type == 'text' || $info->type == 'select' || $info->type == 'radio')
                                <td>{{ $info->value }}</td>
                            @elseif ($info->type == 'multi_select')
                                <td>
                                    {{ implode(json_decode($info->value), ', ') }}
                                </td>
                            @elseif ($info->type == 'file')
                                <td>
                                    <a href="{{ static_asset($info->value) }}" target="_blank" class="btn-info">{{ translate('Click here')}}</a>
                                </td>
                            @endif
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="text-center">
                <a href="{{ route('affiliate_user.reject', $affiliate_user->id) }}" class="btn btn-sm btn-default d-innline-block">{{ translate('Reject')}}</a></li>
                <a href="{{ route('affiliate_user.approve', $affiliate_user->id) }}" class="btn btn-sm btn-dark d-innline-block">{{ translate('Accept')}}</a>
            </div>
        </div>
    </div>
</div>

@endsection
