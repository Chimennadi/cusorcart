<div class="modal-body">

  <div class="text-center">
      <span class="avatar avatar-xxl mb-3">
          <img src="{{ uploaded_asset($seller->user->avatar_original) }}" onerror="this.onerror=null;this.src='{{ static_asset('assets/img/avatar-place.png') }}';">
      </span>
      <h1 class="h5 mb-1">{{ $seller->user->name }}</h1>
      <p class="text-sm text-muted">{{ $seller->user->shop->name }}</p>

      <div class="pad-ver btn-groups">
          <a href="{{ $seller->user->shop->facebook }}" class="btn btn-icon demo-pli-facebook icon-lg add-tooltip" data-original-title="Facebook" data-container="body"></a>
          <a href="{{ $seller->user->shop->twitter }}" class="btn btn-icon demo-pli-twitter icon-lg add-tooltip" data-original-title="Twitter" data-container="body"></a>
          <a href="{{ $seller->user->shop->google }}" class="btn btn-icon demo-pli-google-plus icon-lg add-tooltip" data-original-title="Google+" data-container="body"></a>
      </div>
  </div>
  <hr>

  <!-- Profile Details -->
  <h6 class="mb-4">{{translate('About')}} {{ $seller->user->name }}</h6>
  <p><i class="demo-pli-map-marker-2 icon-lg icon-fw mr-1"></i>{{ $seller->user->shop->address }}</p>
  <p><a href="{{ route('shop.visit', $seller->user->shop->slug) }}" class="btn-link"><i class="demo-pli-internet icon-lg icon-fw mr-1"></i>{{ $seller->user->shop->name }}</a></p>
  <p><i class="demo-pli-old-telephone icon-lg icon-fw mr-1"></i>{{ $seller->user->phone }}</p>

  <h6 class="mb-4">{{translate('Payout Info')}}</h6>
  <p>{{translate('Bank Name')}} : {{ $seller->bank_name }}</p>
  <p>{{translate('Bank Acc Name')}} : {{ $seller->bank_acc_name }}</p>
  <p>{{translate('Bank Acc Number')}} : {{ $seller->bank_acc_no }}</p>
  <p>{{translate('Bank Routing Number')}} : {{ $seller->bank_routing_no }}</p>

  <br>

  <div class="table-responsive">
      <table class="table table-striped mar-no">
          <tbody>
          <tr>
              <td>{{ translate('Total Products') }}</td>
              <td>{{ App\Product::where('user_id', $seller->user->id)->get()->count() }}</td>
          </tr>
          <tr>
              <td>{{ translate('Total Orders') }}</td>
              <td>{{ App\OrderDetail::where('seller_id', $seller->user->id)->get()->count() }}</td>
          </tr>
          <tr>
              <td>{{ translate('Total Sold Amount') }}</td>
              @php
                  $orderDetails = \App\OrderDetail::where('seller_id', $seller->user->id)->get();
                  $total = 0;
                  foreach ($orderDetails as $key => $orderDetail) {
                      if($orderDetail->order != null && $orderDetail->order->payment_status == 'paid'){
                          $total += $orderDetail->price;
                      }
                  }
              @endphp
              <td>{{ single_price($total) }}</td>
          </tr>
          <tr>
              <td>{{ translate('Wallet Balance') }}</td>
              <td>{{ single_price($seller->user->balance) }}</td>
          </tr>
          </tbody>
      </table>
  </div>
</div>
