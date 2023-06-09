@extends('frontend.layouts.user_panel')

@section('panel_content')
    <div class="card">
        <div class="card-header">
            <h5 class="mb-0 h6">{{ translate('Download Your Product') }}</h5>
        </div>
        <div class="card-body">
          <table class="table aiz-table mb-0">
              <thead>
                  <tr>
                      <th>{{ translate('Product')}}</th>
                      <th width="20%">{{ translate('Option')}}</th>
                  </tr>
              </thead>
              <tbody>
                  @foreach ($orders as $key => $order_id)
                      @php
                          $order = \App\OrderDetail::find($order_id->id);
                      @endphp
                      <tr>
                          <td><a href="{{ route('product', $order->product->slug) }}">{{ $order->product->getTranslation('name') }}</a></td>
                          <td>
                            <a class="btn btn-soft-info btn-icon btn-circle btn-sm" href="{{route('digitalproducts.download', encrypt($order->product->id))}}" title="{{ translate('Download') }}">
                                <i class="las la-download"></i>
                            </a>
                          </td>
                      </tr>
                  @endforeach
              </tbody>
          </table>
            {{ $orders->links() }}
        </div>
    </div>
@endsection
