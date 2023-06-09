@extends('frontend.layouts.user_panel')

@section('panel_content')
    <div class="aiz-titlebar mt-2 mb-4">
        <div class="row align-items-center">
            <div class="col-md-6">
                <h1 class="h3">{{ translate('Dashboard') }}</h1>
            </div>
        </div>
    </div>

    <div class="row gutters-10">
        <div class="col-md-3">
            <div class="bg-grad-3 text-white rounded-lg mb-4 overflow-hidden">
              <div class="px-3 pt-3">
                <div class="h3 fw-700">
                  {{ count(\App\Product::where('user_id', Auth::user()->id)->get()) }}
                </div>
                <div class="opacity-50">{{ translate('Products')}}</div>
              </div>
              <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320">
                  <path fill="rgba(255,255,255,0.3)" fill-opacity="1" d="M0,192L26.7,192C53.3,192,107,192,160,202.7C213.3,213,267,235,320,218.7C373.3,203,427,149,480,117.3C533.3,85,587,75,640,90.7C693.3,107,747,149,800,149.3C853.3,149,907,107,960,112C1013.3,117,1067,171,1120,202.7C1173.3,235,1227,245,1280,213.3C1333.3,181,1387,107,1413,69.3L1440,32L1440,320L1413.3,320C1386.7,320,1333,320,1280,320C1226.7,320,1173,320,1120,320C1066.7,320,1013,320,960,320C906.7,320,853,320,800,320C746.7,320,693,320,640,320C586.7,320,533,320,480,320C426.7,320,373,320,320,320C266.7,320,213,320,160,320C106.7,320,53,320,27,320L0,320Z"></path>
              </svg>
            </div>
        </div>

        <div class="col-md-3">
            <div class="bg-grad-1 text-white rounded-lg mb-4 overflow-hidden">
                <div class="px-3 pt-3">
                    <div class="h3 fw-700">
                      {{ count(\App\OrderDetail::where('seller_id', Auth::user()->id)->where('delivery_status', 'delivered')->get()) }}
                    </div>
                    <div class="opacity-50">{{ translate('Total sale')}}</div>
                </div>
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320">
                    <path fill="rgba(255,255,255,0.3)" fill-opacity="1" d="M0,192L30,208C60,224,120,256,180,245.3C240,235,300,181,360,144C420,107,480,85,540,96C600,107,660,149,720,154.7C780,160,840,128,900,117.3C960,107,1020,117,1080,112C1140,107,1200,85,1260,74.7C1320,64,1380,64,1410,64L1440,64L1440,320L1410,320C1380,320,1320,320,1260,320C1200,320,1140,320,1080,320C1020,320,960,320,900,320C840,320,780,320,720,320C660,320,600,320,540,320C480,320,420,320,360,320C300,320,240,320,180,320C120,320,60,320,30,320L0,320Z"></path>
                </svg>
            </div>
        </div>

        <div class="col-md-3">
            <div class="bg-grad-2 text-white rounded-lg mb-4 overflow-hidden">
                <div class="px-3 pt-3">
                    @php
                        $orderDetails = \App\OrderDetail::where('seller_id', Auth::user()->id)->get();
                        $total = 0;
                        foreach ($orderDetails as $key => $orderDetail) {
                            if($orderDetail->order != null && $orderDetail->order->payment_status == 'paid'){
                                $total += $orderDetail->price;
                            }
                        }
                    @endphp
                    <div class="h3 fw-700">{{ single_price($total) }}</div>
                    <div class="opacity-50">{{ translate('Total earnings') }}</div>
                  </div>
                  <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320">
                      <path fill="rgba(255,255,255,0.3)" fill-opacity="1" d="M0,128L34.3,112C68.6,96,137,64,206,96C274.3,128,343,224,411,250.7C480,277,549,235,617,213.3C685.7,192,754,192,823,181.3C891.4,171,960,149,1029,117.3C1097.1,85,1166,43,1234,58.7C1302.9,75,1371,149,1406,186.7L1440,224L1440,320L1405.7,320C1371.4,320,1303,320,1234,320C1165.7,320,1097,320,1029,320C960,320,891,320,823,320C754.3,320,686,320,617,320C548.6,320,480,320,411,320C342.9,320,274,320,206,320C137.1,320,69,320,34,320L0,320Z"></path>
                  </svg>
            </div>
        </div>

        <div class="col-md-3">
            <div class="bg-grad-3 text-white rounded-lg mb-4 overflow-hidden">
              <div class="px-3 pt-3">
                  @php
                  $orders = \App\Order::where('user_id', Auth::user()->id)->get();
                  $total = 0;
                  foreach ($orders as $key => $order) {
                  $total += count($order->orderDetails);
                  }
                  @endphp
                  <div class="h3 fw-700">
                      {{ count(\App\OrderDetail::where('seller_id', Auth::user()->id)->where('delivery_status', 'delivered')->get()) }}
                  </div>
                  <div class="opacity-50">{{ translate('Successful orders')}}</div>
              </div>
              <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320">
                  <path fill="rgba(255,255,255,0.3)" fill-opacity="1" d="M0,192L26.7,192C53.3,192,107,192,160,202.7C213.3,213,267,235,320,218.7C373.3,203,427,149,480,117.3C533.3,85,587,75,640,90.7C693.3,107,747,149,800,149.3C853.3,149,907,107,960,112C1013.3,117,1067,171,1120,202.7C1173.3,235,1227,245,1280,213.3C1333.3,181,1387,107,1413,69.3L1440,32L1440,320L1413.3,320C1386.7,320,1333,320,1280,320C1226.7,320,1173,320,1120,320C1066.7,320,1013,320,960,320C906.7,320,853,320,800,320C746.7,320,693,320,640,320C586.7,320,533,320,480,320C426.7,320,373,320,320,320C266.7,320,213,320,160,320C106.7,320,53,320,27,320L0,320Z"></path>
              </svg>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-7">
          <div class="card">
              <div class="card-header">
                  <h5 class="mb-0 h6">{{ translate('Orders') }}</h5>
              </div>
              <div class="card-body">
                  <table class="table aiz-table mb-0">
                      <tr>
                          <td>{{ translate('Total orders')}}:</td>
                          <td>{{ count(\App\OrderDetail::where('seller_id', Auth::user()->id)->get()) }}</strong></td>
                      </tr>
                      <tr>
                          <td>{{ translate('Pending orders')}}:</td>
                          <td>{{ count(\App\OrderDetail::where('seller_id', Auth::user()->id)->where('delivery_status', 'pending')->get()) }}</strong></td>
                      </tr>
                      <tr>
                          <td>{{ translate('Cancelled orders')}}:</td>
                          <td>{{ count(\App\OrderDetail::where('seller_id', Auth::user()->id)->where('delivery_status', 'cancelled')->get()) }}</strong></td>
                      </tr>
                      <tr>
                          <td>{{ translate('Successful orders')}}:</td>
                          <td>{{ count(\App\OrderDetail::where('seller_id', Auth::user()->id)->where('delivery_status', 'delivered')->get()) }}</strong></td>
                      </tr>
                  </table>
              </div>
          </div>
        </div>
        <div class="col-md-5">
          <div class="bg-white mt-4 p-5 text-center">
              <div class="mb-3">
                  @if(Auth::user()->seller->verification_status == 0)
                      <img loading="lazy"  src="{{ static_asset('assets/img/non_verified.png') }}" alt="" width="130">
                  @else
                      <img loading="lazy"  src="{{ static_asset('assets/img/verified.png') }}" alt="" width="130">
                  @endif
              </div>
              @if(Auth::user()->seller->verification_status == 0)
                  <a href="{{ route('shop.verify') }}" class="btn btn-primary">{{ translate('Verify Now')}}</a>
              @endif
          </div>
        </div>
    </div>

    <div class="row">
      <div class="col-md-8">
          <div class="card">
              <div class="card-header">
                  <h6 class="mb-0">{{ translate('Products') }}</h6>
              </div>
    		          <div class="card-body">
                <table class="table aiz-table mb-0">
                  <thead>
                      <tr>
                          <th>{{ translate('Category')}}</th>
                          <th>{{ translate('Product')}}</th>
                      </tr>
                  </thead>
                  <tbody>
                    @foreach (\App\Category::all() as $key => $category)
                        @if(count($category->products->where('user_id', Auth::user()->id))>0)
                          <tr>
                              <td>{{ $category->getTranslation('name') }}</td>
                              <td>{{ count($category->products->where('user_id', Auth::user()->id)) }}</td>
                          </tr>
                      @endif
                  @endforeach
                </table>
                <br>
                @php
                      $seller_package_working = \App\Seller::where('user_id',Auth::user()->id)->first();
                  @endphp
                  @if($seller_package_working->verification_status == 1) 
                <div class="text-center">
                    <a href="{{ route('seller.products.upload')}}" class="btn btn-primary d-inline-block">{{ translate('Add New Product')}}</a>
                </div>
                @else
                <div class="text-center">
                    <a href="{{ route('shop.verify') }}" class="btn btn-primary d-inline-block">{{ translate('Please Verify Now')}}</a>
                </div>
                
                @endif
              </div>
          </div>
      </div>
      <div class="col-md-4">
          @if (\App\Addon::where('unique_identifier', 'seller_subscription')->first() != null && \App\Addon::where('unique_identifier', 'seller_subscription')->first()->activated)

              <div class="card">
                  <div class="card-header">
                      <h6 class="mb-0">{{ translate('Purchased Package') }}</h6>
                  </div>
                  @php
                      $seller_package = \App\SellerPackage::find(Auth::user()->seller->seller_package_id);
                  @endphp
                  <div class="card-body text-center">
                      @if($seller_package != null)
                        <img src="{{ uploaded_asset($seller_package->logo) }}" class="img-fluid mb-4 h-110px">
                        <p class="mb-1 text-muted">{{ translate('Product Upload Remaining') }}: {{ Auth::user()->seller->remaining_uploads }} {{ translate('Times')}}</p>
                        <p class="text-muted mb-1">{{ translate('Digital Product Upload Remaining') }}: {{ Auth::user()->seller->remaining_digital_uploads }} {{ translate('Times')}}</p>
                        <p class="text-muted mb-4">{{ translate('Package Expires at') }}: {{ Auth::user()->seller->invalid_at }}</p>
                        <h6 class="fw-600 mb-3 text-primary">{{ translate('Current Package') }}: {{ $seller_package->name }}</h6>
                      @else
                          <h6 class="fw-600 mb-3 text-primary">{{translate('Package Not Found')}}</h6>
                      @endif
                      <div class="text-center">
                          <a href="{{ route('seller_packages_list') }}" class="btn btn-soft-primary">{{ translate('Upgrade Package')}}</a>
                      </div>
                  </div>
              </div>
          @endif
          <div class="bg-white mt-4 p-4 text-center">
              <div class="h5 fw-600">{{ translate('Shop')}}</div>
              <p>{{ translate('Manage & organize your shop')}}</p>
              <a href="{{ route('shops.index') }}" class="btn btn-soft-primary">{{ translate('Go to setting')}}</a>
          </div>
          <div class="bg-white mt-4 p-4 text-center">
              <div class="h5 fw-600">{{ translate('Payment')}}</div>
              <p>{{ translate('Configure your payment method')}}</p>
              <a href="{{ route('profile') }}" class="btn btn-soft-primary">{{ translate('Configure Now')}}</a>
          </div>
      </div>
    </div>

@endsection
