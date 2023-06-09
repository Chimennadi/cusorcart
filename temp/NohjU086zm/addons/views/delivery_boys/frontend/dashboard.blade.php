@extends('frontend.layouts.user_panel')
@section('panel_content')

@php 
$delivery_boy_info = \App\Models\DeliveryBoy::where('user_id', Auth::user()->id)->first();
@endphp
<div class="aiz-titlebar mt-2 mb-4">
    <div class="row align-items-center">
        <div class="col-md-6">
            <h1 class="h3">{{ translate('Dashboard') }}</h1>
        </div>
    </div>
</div>
<div class="row gutters-10">
    <div class="col-md-3">
        <div class="bg-grad-1 text-white rounded-lg mb-4 overflow-hidden">
            <div class="px-3 pt-3 text-center">
                <i class="las la-shipping-fast la-4x"></i>
                <div class="opacity-50">{{ translate('Completed Delivery') }}</div>
                @php 
                $total_complete_delivery = \App\Models\Order::where('assign_delivery_boy', Auth::user()->id)
                                            ->where('delivery_status', 'delivered')
                                            ->get();
                @endphp
                @if(count($total_complete_delivery))
                <div class="h3 fw-700">
                    {{ count($total_complete_delivery) }}
                </div>
                @else
                <div class="h3 fw-700">0</div>
                @endif
                
            </div>
            
        </div>
    </div>
    <div class="col-md-3">
        <div class="bg-grad-2 text-white rounded-lg mb-4 overflow-hidden">
            <div class="px-3 pt-3 text-center">
                <i class="las la-clock la-4x"></i>
                <div class="opacity-50">{{ translate('Pending Delivery') }}</div>
                @php 
                $total_pending_delivery = \App\Models\Order::where('assign_delivery_boy', Auth::user()->id)
                                            ->where('delivery_status', '!=', 'delivered')
                                            ->where('delivery_status', '!=', 'cancelled')
                                            ->get();
                @endphp
                 @if(count($total_pending_delivery))
                <div class="h3 fw-700">
                    {{ count($total_pending_delivery) }}
                </div>
                @else
                <div class="h3 fw-700">0</div>
                @endif
                
            </div>
            
        </div>
    </div>
    <div class="col-md-3">
        <div class="bg-grad-3 text-white rounded-lg mb-4 overflow-hidden">
            <div class="px-3 pt-3 text-center">
                <i class="las la-layer-group la-4x"></i>
                <div class="opacity-50">{{ translate('Total Collected') }}</div>
                
                <div class="h3 fw-700">
                    {{ $delivery_boy_info->total_collection }}
                </div>
                
            </div>
            
        </div>
    </div>
    <div class="col-md-3">
        <div class="bg-grad-4 text-white rounded-lg mb-4 overflow-hidden">
            <div class="px-3 pt-3 text-center">
                <i class="las la-dollar-sign la-4x"></i>
                <div class="opacity-50">{{ translate('Earnings') }}</div>
                @if(get_setting('delivery_boy_payment_type') == 'commission')
                <div class="h3 fw-700">
                    {{ $delivery_boy_info->total_earning }}/
                    <span>
                        <small>{{ translate('order') }}</small>
                    </span>
                </div>
                @endif
                @if(get_setting('delivery_boy_payment_type') == 'salary')
                <div class="h3 fw-700">
                    {{ get_setting('delivery_boy_salary') }} / {{ translate('mo') }}
                </div>
                @endif
                
            </div>
            
        </div>
    </div>
    
</div>


@endsection
