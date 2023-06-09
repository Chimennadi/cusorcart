@extends('frontend.layouts.app')

@section('content')

<section class="pt-5 mb-4">
    <div class="container">
        <div class="row">
            <div class="col-xl-8 mx-auto">
                <div class="row aiz-steps arrow-divider">
                    <div class="col done">
                        <div class="text-center text-success">
                            <i class="la-3x mb-2 las la-shopping-cart"></i>
                            <h3 class="fs-14 fw-600 d-none d-lg-block text-capitalize">{{ translate('1. My Cart')}}</h3>
                        </div>
                    </div>
                    <div class="col done">
                        <div class="text-center text-success">
                            <i class="la-3x mb-2 las la-map"></i>
                            <h3 class="fs-14 fw-600 d-none d-lg-block text-capitalize">{{ translate('2. Shipping info')}}</h3>
                        </div>
                    </div>
                    <div class="col active">
                        <div class="text-center text-primary">
                            <i class="la-3x mb-2 las la-truck"></i>
                            <h3 class="fs-14 fw-600 d-none d-lg-block text-capitalize">{{ translate('3. Delivery info')}}</h3>
                        </div>
                    </div>
                    <div class="col">
                        <div class="text-center">
                            <i class="la-3x mb-2 opacity-50 las la-credit-card"></i>
                            <h3 class="fs-14 fw-600 d-none d-lg-block opacity-50 text-capitalize">{{ translate('4. Payment')}}</h3>
                        </div>
                    </div>
                    <div class="col">
                        <div class="text-center">
                            <i class="la-3x mb-2 opacity-50 las la-check-circle"></i>
                            <h3 class="fs-14 fw-600 d-none d-lg-block opacity-50 text-capitalize">{{ translate('5. Confirmation')}}</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="py-4 gry-bg">
    <div class="container">
        <div class="row cols-xs-space cols-sm-space cols-md-space">
            <div class="col-xxl-8 col-xl-10 mx-auto text-left">
                <form class="form-default" action="{{ route('checkout.store_delivery_info') }}" role="form" method="POST">
                    @csrf
                @php
                    $admin_products = array();
                    $seller_products = array();
                    foreach ($carts  as $key => $cartItem){
                        if(\App\Product::find($cartItem['product_id'])->added_by == 'admin'){
                            array_push($admin_products, $cartItem['product_id']);
                        }
                        else{
                            $product_ids = array();
                            if(array_key_exists(\App\Product::find($cartItem['product_id'])->user_id, $seller_products)){
                                $product_ids = $seller_products[\App\Product::find($cartItem['product_id'])->user_id];
                            }
                            array_push($product_ids, $cartItem['product_id']);
                            $seller_products[\App\Product::find($cartItem['product_id'])->user_id] = $product_ids;
                        }
                    }
                @endphp

                @if (!empty($admin_products))
                    <div class="card mb-3 shadow-sm border-0 rounded">
                        <div class="card-header p-3">
                            <h5 class="fs-16 fw-600 mb-0">{{ get_setting('site_name') }} {{ translate('Products') }}</h5>
                        </div>
                        <div class="card-body">
                             @php
                            $kgs = 0;
                                @endphp
                            
                             @foreach ($admin_products as $key => $cartItem1)
                            @php
                                    $product1 = \App\Product::find($cartItem1);
                                    $kgs +=  $product1->kg;
                                @endphp
                            @endforeach    
                            <ul class="list-group list-group-flush">
                                @foreach ($admin_products as $key => $cartItem)
                                @php
                                    $product = \App\Product::find($cartItem);
                                @endphp
                                <li class="list-group-item">
                                    <div class="d-flex">
                                        <span class="mr-2">
                                            <img
                                                src="{{ uploaded_asset($product->thumbnail_img) }}"
                                                class="img-fit size-60px rounded"
                                                alt="{{  $product->getTranslation('name')  }}"
                                            >
                                        </span>
                                        <span class="fs-14 opacity-60">{{ $product->getTranslation('name') }}</span>
                                    </div>
                                </li>
                                @endforeach
                            </ul>
                            @if (\App\BusinessSetting::where('type', 'pickup_point')->first()->value == 1 && $product->digital != 1) 
                            <div class="row border-top pt-3">
                                <div class="col-md-6">
                                    <h6 class="fs-15 fw-600">{{ translate('Choose Delivery Type') }}</h6>
                                </div>
                                <div class="col-md-6">
                                    <div class="row gutters-5">
                                        <div class="col-6">
                                            <label class="aiz-megabox d-block bg-white mb-0">
                                                <input
                                                    type="radio" required
                                                    name="shipping_type_{{ \App\User::where('user_type', 'admin')->first()->id }}"
                                                    value="home_delivery"
                                                    onchange="show_pickup_point(this)"
                                                    data-target=".pickup_point_id_admin"
                                                    checked
                                                >
                                                <span class="d-flex p-3 aiz-megabox-elem">
                                                    <span class="aiz-rounded-check flex-shrink-0 mt-1"></span>
                                                    <span class="flex-grow-1 pl-3 fw-600">{{  translate('Home Delivery') }}</span>
                                                </span>
                                            </label>
                                        </div>
                                        <div class="col-6">
                                            <label class="aiz-megabox d-block bg-white mb-0">
                                                <input
                                                    type="radio" required
                                                    name="shipping_type_{{ \App\User::where('user_type', 'admin')->first()->id }}"
                                                    value="pickup_point"
                                                    onchange="show_pickup_point(this)"
                                                    data-target=".pickup_point_id_admin"
                                                >
                                                <span class="d-flex p-3 aiz-megabox-elem">
                                                    <span class="aiz-rounded-check flex-shrink-0 mt-1"></span>
                                                    <span class="flex-grow-1 pl-3 fw-600">{{  translate('Local Pickup') }}</span>
                                                </span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="mt-4 pickup_point_id_admin d-none">
                                        <select
                                            class="form-control aiz-selectpicker"
                                            name="pickup_point_id_{{ \App\User::where('user_type', 'admin')->first()->id }}"
                                            data-live-search="true"
                                        >
                                                <option>{{ translate('Select your nearest pickup point')}}</option>
                                            @foreach (\App\PickupPoint::where('staff_id',App\User::where('user_type', 'admin')->first()->id)->get() as $key => $pick_up_point)
                                                <option
                                                    value="{{ $pick_up_point->id }}"
                                                    data-content="<span class='d-block'>
                                                                    <span class='d-block fs-16 fw-600 mb-2'>{{ $pick_up_point->getTranslation('name') }}</span>
                                                                    <span class='d-block opacity-50 fs-12'><i class='las la-map-marker'></i> {{ $pick_up_point->getTranslation('address') }}</span>
                                                                    <span class='d-block opacity-50 fs-12'><i class='las la-phone'></i>{{ $pick_up_point->phone }}</span>
                                                                </span>"
                                                >
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            @endif
                                 @if($product->digital == 1)
                                            <input type="hidden" name="ship_id[]" value="0">
                                            <input type="hidden" name="shipping_tax[]" value="0">
                                @else
                                 <div class="row">
                           <?php
                                   
                                    $ip = Request::ip();
                            if ($position = Location::get($ip)) {
                                // Successfully retrieved position.
                                // echo $position->countryName;
                            } else {
                                // Failed retrieving position.
                            }
                                    ?>
                                @foreach (App\ShippingDetail::where('ship_city',$datas->city)->where('ship_state',$datas->state)->where('ship_country',$datas->country)->where('city','Baltimore')->where('state','Maryland')->where('country','United States')->where('status','Approved')->where('transit_day','<=',1)->orderBy(DB::raw('RAND()'))->limit(1)->get() as $ship)
                                            
                        <div class="col-md-6">
                           <div id="cart_service">
                                  <div class="card-header p-3">
                            <h5 class="fs-16 fw-600 mb-0">Same day shipping</h5>
                        </div>
                             <div class="shadow-sm bg-white p-4 rounded mb-4">
                            <div class="row gutters-5">
                                   <div class="col-md-12 mb-3">
                                        @php
                                            $shipdata = logistic_price($ship);
                                            
                                            $shipkg = $shipdata  * $kgs;
                                            
                                            
                                            @endphp
                                        <label class="aiz-megabox d-block bg-white mb-0">
                                            <input type="radio" required name="ship_detail_id{{App\User::where('user_type', 'admin')->first()->id}}" id="service_charge" value="{{ $shipkg }}" onclick="service()"  >
                                            <input type="hidden" name="ship_id[]" value="{{ $ship->id }}">
                                            <input type="hidden" name="shipping_tax[]" value="{{ $ship->shipping_tax }}">
                                            
                                            
                                            <span class="d-flex p-3 aiz-megabox-elem">
                                                <span class="aiz-rounded-check flex-shrink-0 mt-1"></span>
                                                <span class="flex-grow-1 pl-3 text-left">
                                                         
                                                    
                                                    <div>
                                                        <span class="opacity-60">{{ translate('Shipped By:') }}:</span>
                                                            <span class="fw-600 ml-2">{{ $ship->user->name }}</span>
                                                    </div>
                                                    
                                                    
                                                        <div>
                                                        <span class="opacity-60">{{ translate('Sold By:') }}:</span>
                                                            <span class="fw-600 ml-2">{{ route('home') }} Services ENT</span>
                                                    </div>
                                                    
                                                    
                                                    <div>
                                                        <span class="opacity-60">{{ translate('Arrival Day') }}:</span>
                                                        <span class="fw-600 ml-2">{{Carbon\Carbon::now()->addDays($ship->transit_day)->format('l, M d, Y') }}</span>
                                                    </div>

                                               
                                                    
                                               
                                                    
                                                    

                                                </span>
                                            </span>
                                        </label>
                                      
                                    </div>
                              
                            </div>
                        </div>
                            
                                
                            </div>
                            
                             
                        </div>     
                                   @endforeach
                     
                      
                      
                      
                      
                      
                      
                      
                                  <?php
                                   
                                    $ip = Request::ip();
                            if ($position = Location::get($ip)) {
                                // Successfully retrieved position.
                                // echo $position->countryName;
                            } else {
                                // Failed retrieving position.
                            }
                                    ?>
                                @foreach (App\ShippingDetail::where('ship_city',$datas->city)->where('ship_state',$datas->state)->where('ship_country',$datas->country)->where('city','Baltimore')->where('state','Maryland')->where('country','United States')->where('status','Approved')->where('transit_day','>',1)->where('transit_day','<=',7)->orderBy(DB::raw('RAND()'))->limit(1)->get() as $ship1)
                        <div class="col-md-6">
                            <div id="cart_service">
                                  <div class="card-header p-3">
                            <h5 class="fs-16 fw-600 mb-0">Express shipping</h5>
                        </div>
                             <div class="shadow-sm bg-white p-4 rounded mb-4">
                            <div class="row gutters-5">
                                
                                
                                 @php
                                            $shipdata1 = logistic_price($ship1);
                                            
                                            $shipkg1 = $shipdata1  * $kgs;
                                            
                                            
                                            @endphp
                                
                                    <div class="col-md-12 mb-3">
                                        <label class="aiz-megabox d-block bg-white mb-0">
                                            <input type="radio" required name="ship_detail_id{{App\User::where('user_type', 'admin')->first()->id}}" id="service_charge" value="{{ $shipkg1 }}" onclick="service()"  >
                                            <input type="hidden" name="ship_id[]" value="{{ $ship1->id }}">
                                               <input type="hidden" name="shipping_tax[]" value="{{ $ship1->shipping_tax }}">
                                         
                                            
                                            <span class="d-flex p-3 aiz-megabox-elem">
                                                <span class="aiz-rounded-check flex-shrink-0 mt-1"></span>
                                                <span class="flex-grow-1 pl-3 text-left">
                                                         
                                                    <div>
                                                        <span class="opacity-60">{{ translate('Shipped By:') }}:</span>
                                                            <span class="fw-600 ml-2">{{ $ship1->user->name }}</span>
                                                    </div>
                                                    
                                                       <div>
                                                        <span class="opacity-60">{{ translate('Sold By:') }}:</span>
                                                            <span class="fw-600 ml-2">{{ route('home') }} Services ENT</span>
                                                    </div>
                                                    
                                                    
                                                    <div>
                                                        <span class="opacity-60">{{ translate('Arrival Day') }}:</span>
                                                        <span class="fw-600 ml-2">{{Carbon\Carbon::now()->addDays($ship1->transit_day)->format('l, M d, Y') }}</span>
                                                    </div>

                                               
                                               
                                                    
                                                    

                                                </span>
                                            </span>
                                        </label>
                                      
                                    </div>
                              
                            </div>
                        </div>
                            
                                
                            </div>
      
                             
                        </div>
                                        @endforeach
                
                        
                                <?php
                                   
                                    $ip = Request::ip();
                            if ($position = Location::get($ip)) {
                                // Successfully retrieved position.
                                // echo $position->countryName;
                            } else {
                                // Failed retrieving position.
                            }
                                    ?>
                                @foreach (App\ShippingDetail::where('ship_city',$datas->city)->where('ship_state',$datas->state)->where('ship_country',$datas->country)->where('city','Baltimore')->where('state','Maryland')->where('country','United States')->where('status','Approved')->where('transit_day','>',7)->where('transit_day','<=',14)->orderBy(DB::raw('RAND()'))->limit(1)->get() as $ship2)
                          <div class="col-md-6">
                     <div id="cart_service">
                                  <div class="card-header p-3">
                            <h5 class="fs-16 fw-600 mb-0">Business day shipping</h5>
                        </div>
                             <div class="shadow-sm bg-white p-4 rounded mb-4">
                            <div class="row gutters-5">
                                
                                 @php
                                            $shipdata2 = logistic_price($ship2);
                                            
                                            $shipkg2 = $shipdata2  * $kgs;
                                            
                                            
                                            @endphp
                                
                                    <div class="col-md-12 mb-3">
                                        <label class="aiz-megabox d-block bg-white mb-0">
                                            <input type="radio" required name="ship_detail_id{{App\User::where('user_type', 'admin')->first()->id}}" id="service_charge" value="{{ $shipkg2 }}" onclick="service()"  >
                                            <input type="hidden" name="ship_id[]" value="{{ $ship2->id }}">
                                            <input type="hidden" name="shipping_tax[]" value="{{ $ship2->shipping_tax }}">
                                            
                                            <span class="d-flex p-3 aiz-megabox-elem">
                                                <span class="aiz-rounded-check flex-shrink-0 mt-1"></span>
                                                <span class="flex-grow-1 pl-3 text-left">
                                                      
                                                    
                                                    <div>
                                                        <span class="opacity-60">{{ translate('Shipped By:') }}:</span>
                                                            <span class="fw-600 ml-2">{{ $ship2->user->name }}</span>
                                                    </div>
                                                    
                                                        <div>
                                                        <span class="opacity-60">{{ translate('Sold By:') }}:</span>
                                                            <span class="fw-600 ml-2">{{ route('home') }} Services ENT</span>
                                                    </div>
                                                    
                                                    <div>
                                                        <span class="opacity-60">{{ translate('Arrival Day') }}:</span>
                                                        <span class="fw-600 ml-2">{{Carbon\Carbon::now()->addDays($ship2->transit_day)->format('l, M d, Y') }}</span>
                                                    </div>

                                               
                                               
                                                    
                                                    

                                                </span>
                                            </span>
                                        </label>
                                      
                                    </div>
                              
                            </div>
                        </div>
                            
                                
                            </div>           
                             
                        </div>     
                               @endforeach
                         
                        
                                <?php
                                   
                                    $ip = Request::ip();
                            if ($position = Location::get($ip)) {
                                // Successfully retrieved position.
                                // echo $position->countryName;
                            } else {
                                // Failed retrieving position.
                            }
                                    ?>
                                @foreach (App\ShippingDetail::where('ship_city',$datas->city)->where('ship_state',$datas->state)->where('ship_country',$datas->country)->where('city','Baltimore')->where('state','Maryland')->where('country','United States')->where('status','Approved')->where('transit_day','>',14)->where('transit_day','<=',30)->orderBy(DB::raw('RAND()'))->limit(1)->get() as $ship3)
                        
                        <div class="col-md-6">
                           <div id="cart_service">
                                  <div class="card-header p-3">
                            <h5 class="fs-16 fw-600 mb-0">Cargo express shipping</h5>
                        </div>
                             <div class="shadow-sm bg-white p-4 rounded mb-4">
                            <div class="row gutters-5">
                                 @php
                                            $shipdata3 = logistic_price($ship3);
                                            
                                            $shipkg3 = $shipdata3  * $kgs;
                                            
                                            
                                            @endphp
                                    <div class="col-md-12 mb-3">
                                        <label class="aiz-megabox d-block bg-white mb-0">
                                            <input type="radio" required name="ship_detail_id{{App\User::where('user_type', 'admin')->first()->id}}" id="service_charge" value="{{ $shipkg3 }}" onclick="service()"  >
                                            <input type="hidden" name="ship_id[]" value="{{ $ship3->id }}">
                                               <input type="hidden" name="shipping_tax[]" value="{{ $ship3->shipping_tax }}">
                                         
                                            
                                            
                                            <span class="d-flex p-3 aiz-megabox-elem">
                                                <span class="aiz-rounded-check flex-shrink-0 mt-1"></span>
                                                <span class="flex-grow-1 pl-3 text-left">
                                                         
                                                    
                                                    <div>
                                                        <span class="opacity-60">{{ translate('Shipped By:') }}:</span>
                                                            <span class="fw-600 ml-2">{{ $ship3->user->name }}</span>
                                                    </div>
                                                    
                                                    
                                                      <div>
                                                        <span class="opacity-60">{{ translate('Sold By:') }}:</span>
                                                            <span class="fw-600 ml-2">{{ route('home') }} Services ENT</span>
                                                    </div>
                                                    
                                                    <div>
                                                        <span class="opacity-60">{{ translate('Arrival Day') }}:</span>
                                                        <span class="fw-600 ml-2">{{Carbon\Carbon::now()->addDays($ship3->transit_day)->format('l, M d, Y') }}</span>
                                                    </div>

                                               
                                               

                                               
                                                    
                                                    

                                                </span>
                                            </span>
                                        </label>
                                      
                                    </div>
                              
                            </div>
                        </div>
                            
                                
                            </div>     
                             
                        </div>
                                   @endforeach
                     
                        
                         </div>
                                @endif
                                
                        </div>
                       
                            <input type="hidden" name="owner_id[]" value="{{ App\User::where('user_type', 'admin')->first()->id }}" />
                    </div>
                
                @endif
              
                    @if (!empty($seller_products))
                   
                        @foreach ($seller_products as $key => $seller_product)
                          @php
                    $shop = \App\Shop::where('user_id',$key)->first();
                    @endphp
                            <div class="card mb-3 shadow-sm border-0 rounded">
                                <div class="card-header p-3">
                                    <h5 class="fs-16 fw-600 mb-0">{{ \App\Shop::where('user_id', $key)->first()->name }} {{ translate('Products') }}</h5>
                                </div>
                                <div class="card-body">
                                    <ul class="list-group list-group-flush">
                            @php
                            $kgs = 0;
                            @endphp
                             @foreach ($seller_product as $cartItem1)
                              @php
                             $product1 = \App\Product::find($cartItem1);
                             $kgs +=  $product1->kg;
                             @endphp
                            @endforeach
                                
                                        @foreach ($seller_product as $cartItem)
                                        @php
                                            $product = \App\Product::find($cartItem);
                                        @endphp
                                        <li class="list-group-item">
                                            <div class="d-flex">
                                                <span class="mr-2">
                                                    <img
                                                        src="{{ uploaded_asset($product->thumbnail_img) }}"
                                                        class="img-fit size-60px rounded"
                                                        alt="{{  $product->getTranslation('name')  }}"
                                                    >
                                                </span>
                                                <span class="fs-14 opacity-60">{{ $product->getTranslation('name') }}</span>
                                            </div>
                                        </li>
                                        @endforeach
                                    </ul>
                                    @if (\App\BusinessSetting::where('type', 'pickup_point')->first()->value == 1 && $product->digital != 1)
                                        <div class="row border-top pt-3">
                                            <div class="col-md-6">
                                                <h6 class="fs-15 fw-600">{{ translate('Choose Delivery Type') }}</h6>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="row gutters-5">
                                                    <div class="col-6">
                                                        <label class="aiz-megabox d-block bg-white mb-0">
                                                            <input
                                                                type="radio" required
                                                                name="shipping_type_{{ $key }}"
                                                                value="home_delivery"
                                                                onchange="show_pickup_point(this)"
                                                                data-target=".pickup_point_id_{{ $key }}"
                                                                checked
                                                            >
                                                            <span class="d-flex p-3 aiz-megabox-elem">
                                                                <span class="aiz-rounded-check flex-shrink-0 mt-1"></span>
                                                                <span class="flex-grow-1 pl-3 fw-600">{{  translate('Home Delivery') }}</span>
                                                            </span>
                                                        </label>
                                                    </div>
                                                    @if (is_array(json_decode(\App\Shop::where('user_id', $key)->first()->pick_up_point_id)))
                                                    <div class="col-6">
                                                        <label class="aiz-megabox d-block bg-white mb-0">
                                                            <input
                                                                type="radio" required
                                                                name="shipping_type_{{ $key }}"
                                                                value="pickup_point"
                                                                onchange="show_pickup_point(this)"
                                                                data-target=".pickup_point_id_{{ $key }}"
                                                            >
                                                            <span class="d-flex p-3 aiz-megabox-elem">
                                                                <span class="aiz-rounded-check flex-shrink-0 mt-1"></span>
                                                                <span class="flex-grow-1 pl-3 fw-600">{{  translate('Local Pickup') }}</span>
                                                            </span>
                                                        </label>
                                                    </div>
                                                    @endif
                                                </div>
                                                @if (\App\BusinessSetting::where('type', 'pickup_point')->first()->value == 1)
                                                    @if (is_array(json_decode(\App\Shop::where('user_id', $key)->first()->pick_up_point_id)))
                                                    <div class="mt-4 pickup_point_id_{{ $key }} d-none">
                                                        <select
                                                            class="form-control aiz-selectpicker"
                                                            name="pickup_point_id_{{ $key }}"
                                                            data-live-search="true"
                                                        >
                                                                <option>{{ translate('Select your nearest pickup point')}}</option>
                                                            @foreach (\App\PickupPoint::where('staff_id', $key)->get() as $pick_up_point)
                                                                <option
                                                                    value="{{ \App\PickupPoint::find($pick_up_point->id) }}"
                                                                    data-content="<span class='d-block'>
                                                                                    <span class='d-block fs-16 fw-600 mb-2'>{{ \App\PickupPoint::find($pick_up_point->id)->name }}</span>
                                                                                    <span class='d-block opacity-50 fs-12'><i class='las la-map-marker'></i> {{ \App\PickupPoint::find($pick_up_point->id)->address }}</span>
                                                                                    <span class='d-block opacity-50 fs-12'><i class='las la-phone'></i> {{ \App\PickupPoint::find($pick_up_point->id)->phone }}</span>
                                                                                </span>"
                                                                >
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    @endif
                                                @endif
                                            </div>
                                        </div>
                                    @endif
                                    
                                            @if($product->digital == 1)
                                            <input type="hidden" name="ship_id[]" value="0">
                                            <input type="hidden" name="shipping_tax[]" value="0">
                                @else   
                                    <div class="row">
                                        
                                        
                                <?php
                                   
                                    $ip = Request::ip();
                            if ($position = Location::get($ip)) {
                                // Successfully retrieved position.
                                // echo $position->countryName;
                            } else {
                                // Failed retrieving position.
                            }
                                    ?>
                                @foreach (App\ShippingDetail::where('ship_city',$datas->city)->where('ship_state',$datas->state)->where('ship_country',$datas->country)->where('city',$shop->city)->where('state',$shop->state)->where('country',$shop->country)->where('status','Approved')->where('transit_day','<=',1)->orderBy(DB::raw('RAND()'))->limit(1)->get() as $ship)
                        <div class="col-md-6">
                           <div id="cart_service">
                                  <div class="card-header p-3">
                            <h5 class="fs-16 fw-600 mb-0">Same day shipping</h5>
                        </div>
                             <div class="shadow-sm bg-white p-4 rounded mb-4">
                                  @php
                                            $shipdata = logistic_price($ship);
                                            
                                            $shipkg = $shipdata  * $kgs;
                                            
                                            
                                            @endphp
                            <div class="row gutters-5">
                                    <div class="col-md-12 mb-3">
                                        <label class="aiz-megabox d-block bg-white mb-0">
                                            <input type="radio" required name="ship_detail_id{{$key}}" id="service_charge" value="{{$shipkg }}" onclick="service()"  >
                                            <input type="hidden" name="ship_id[]" value="{{ $ship->id }}">
                                               <input type="hidden" name="shipping_tax[]" value="{{ $ship->shipping_tax }}">
                                         
                                            
                                            <span class="d-flex p-3 aiz-megabox-elem">
                                                <span class="aiz-rounded-check flex-shrink-0 mt-1"></span>
                                                <span class="flex-grow-1 pl-3 text-left">
                                                    
                                                    <div>
                                                        <span class="opacity-60">{{ translate('Shipped By:') }}:</span>
                                                            <span class="fw-600 ml-2">{{ $ship->user->name }}</span>
                                                    </div>
                                                    
                                                            <div>
                                                        <span class="opacity-60">{{ translate('Sold By:') }}:</span>
                                                            <span class="fw-600 ml-2">{{\App\Shop::where('user_id', $key)->first()->name}}</span>
                                                    </div>
                                                    
                                                    
                                                    
                                                    <div>
                                                        <span class="opacity-60">{{ translate('Arrival Day') }}:</span>
                                                        <span class="fw-600 ml-2">{{Carbon\Carbon::now()->addDays($ship->transit_day)->format('l, M d, Y') }}</span>
                                                    </div>

                                               
                                               

                                               
                                                    
                                                    

                                                </span>
                                            </span>
                                        </label>
                                      
                                    </div>
                              
                            </div>
                        </div>
                            
                                
                            </div>
                            
                             
                        </div>    
                          @endforeach
                              
                        
                         <?php
                                   
                                    $ip = Request::ip();
                            if ($position = Location::get($ip)) {
                                // Successfully retrieved position.
                                // echo $position->countryName;
                            } else {
                                // Failed retrieving position.
                            }
                                    ?>
                                @foreach (App\ShippingDetail::where('ship_city',$datas->city)->where('ship_state',$datas->state)->where('ship_country',$datas->country)->where('city',$shop->city)->where('state',$shop->state)->where('country',$shop->country)->where('status','Approved')->where('transit_day','>',1)->where('transit_day','<=',7)->orderBy(DB::raw('RAND()'))->limit(1)->get() as $ship1)
                  
                        <div class="col-md-6">
                            <div id="cart_service">
                                  <div class="card-header p-3">
                            <h5 class="fs-16 fw-600 mb-0">Express shipping</h5>
                        </div>
                             <div class="shadow-sm bg-white p-4 rounded mb-4">
                            <div class="row gutters-5">
                                      @php
                                            $shipdata1 = logistic_price($ship1);
                                            
                                            $shipkg1 = $shipdata1  * $kgs;
                                            
                                            
                                            @endphp                          
                                
                                    <div class="col-md-12 mb-3">
                                        <label class="aiz-megabox d-block bg-white mb-0">
                                            <input type="radio" required name="ship_detail_id{{$key}}" id="service_charge" value="{{ $shipkg1 }}" onclick="service()"  >
                                            <input type="hidden" name="ship_id[]" value="{{ $ship1->id }}">
                                               <input type="hidden" name="shipping_tax[]" value="{{ $ship1->shipping_tax }}">
                                         
                                            
                                            <span class="d-flex p-3 aiz-megabox-elem">
                                                <span class="aiz-rounded-check flex-shrink-0 mt-1"></span>
                                                <span class="flex-grow-1 pl-3 text-left">
                                                        
                                                    
                                                    <div>
                                                        <span class="opacity-60">{{ translate('Shipped By:') }}:</span>
                                                            <span class="fw-600 ml-2">{{ $ship1->user->name }}</span>
                                                    </div>
                                                    
                                                     <div>
                                                        <span class="opacity-60">{{ translate('Sold By:') }}:</span>
                                                            <span class="fw-600 ml-2">{{\App\Shop::where('user_id', $key)->first()->name}}</span>
                                                    </div>
                                                    
                                                    <div>
                                                        <span class="opacity-60">{{ translate('Arrival Day') }}:</span>
                                                        <span class="fw-600 ml-2">{{Carbon\Carbon::now()->addDays($ship1->transit_day)->format('l, M d, Y') }}</span>
                                                    </div>

                                               
                                               

                                                    
                                                    

                                                </span>
                                            </span>
                                        </label>
                                      
                                    </div>
                              
                            </div>
                        </div>
                            
                                
                            </div>
      
                             
                        </div>
                                   @endforeach
                     
                     
                      <?php
                                   
                                    $ip = Request::ip();
                            if ($position = Location::get($ip)) {
                                // Successfully retrieved position.
                                // echo $position->countryName;
                            } else {
                                // Failed retrieving position.
                            }
                                    ?>
                                @foreach (App\ShippingDetail::where('ship_city',$datas->city)->where('ship_state',$datas->state)->where('ship_country',$datas->country)->where('city',$shop->city)->where('state',$shop->state)->where('country',$shop->country)->where('status','Approved')->where('transit_day','>',7)->where('transit_day','<=',14)->orderBy(DB::raw('RAND()'))->limit(1)->get() as $ship2)
                       
                           <div class="col-md-6">
                     <div id="cart_service">
                                  <div class="card-header p-3">
                            <h5 class="fs-16 fw-600 mb-0">Business day shipping</h5>
                        </div>
                             <div class="shadow-sm bg-white p-4 rounded mb-4">
                            <div class="row gutters-5">
                                @php
                                            $shipdata2 = logistic_price($ship2);
                                            
                                            $shipkg2 = $shipdata2  * $kgs;
                                            
                                            
                                            @endphp   
                                    <div class="col-md-12 mb-3">
                                        <label class="aiz-megabox d-block bg-white mb-0">
                                            <input type="radio" required name="ship_detail_id{{$key}}" id="service_charge" value="{{ $shipkg2  }}" onclick="service()"  >
                                            <input type="hidden" name="ship_id[]" value="{{ $ship2->id }}">
                                               <input type="hidden" name="shipping_tax[]" value="{{ $ship2->shipping_tax }}">
                                         
                                            
                                            <span class="d-flex p-3 aiz-megabox-elem">
                                                <span class="aiz-rounded-check flex-shrink-0 mt-1"></span>
                                                <span class="flex-grow-1 pl-3 text-left">
                                                    
                                                     
                                                    <div>
                                                        <span class="opacity-60">{{ translate('Shipped By:') }}:</span>
                                                            <span class="fw-600 ml-2">{{ $ship2->user->name }}</span>
                                                    </div>
                                                    
                                                          <div>
                                                        <span class="opacity-60">{{ translate('Sold By:') }}:</span>
                                                            <span class="fw-600 ml-2">{{\App\Shop::where('user_id', $key)->first()->name}}</span>
                                                    </div>
                                                   
                                                    
                                                    <div>
                                                        <span class="opacity-60">{{ translate('Arrival Day') }}:</span>
                                                        <span class="fw-600 ml-2">{{Carbon\Carbon::now()->addDays($ship2->transit_day)->format('l, M d, Y') }}</span>
                                                    </div>

                                               
                                               

                                               
                                                    
                                                    

                                                </span>
                                            </span>
                                        </label>
                                      
                                    </div>
                              
                            </div>
                        </div>
                            
                                
                            </div>           
                             
                        </div>
                                @endforeach
                        
                        
                            <?php
                                   
                                    $ip = Request::ip();
                            if ($position = Location::get($ip)) {
                                // Successfully retrieved position.
                                // echo $position->countryName;
                            } else {
                                // Failed retrieving position.
                            }
                                    ?>
                                @foreach (App\ShippingDetail::where('ship_city',$datas->city)->where('ship_state',$datas->state)->where('ship_country',$datas->country)->where('city',$shop->city)->where('state',$shop->state)->where('country',$shop->country)->where('status','Approved')->where('transit_day','>',14)->where('transit_day','<=',30)->orderBy(DB::raw('RAND()'))->limit(1)->get() as $ship3)
                            
                        <div class="col-md-6">
                           <div id="cart_service">
                                  <div class="card-header p-3">
                            <h5 class="fs-16 fw-600 mb-0">Cargo express shipping</h5>
                        </div>
                             <div class="shadow-sm bg-white p-4 rounded mb-4">
                                 
                                   @php
                                            $shipdata3 = logistic_price($ship3);
                                            
                                            $shipkg3 = $shipdata3  * $kgs;
                                            
                                            
                                            @endphp   
                                 
                                 
                            <div class="row gutters-5">
                                    <div class="col-md-12 mb-3">
                                        <label class="aiz-megabox d-block bg-white mb-0">
                                            <input type="radio" required name="ship_detail_id{{$key}}" id="service_charge" value="{{ $shipkg3 }}" onclick="service()"  >
                                            <input type="hidden" name="ship_id[]" value="{{ $ship3->id }}">
                                               <input type="hidden" name="shipping_tax[]" value="{{ $ship3->shipping_tax }}">
                                         
                                            
                                            <span class="d-flex p-3 aiz-megabox-elem">
                                                <span class="aiz-rounded-check flex-shrink-0 mt-1"></span>
                                                <span class="flex-grow-1 pl-3 text-left">
                                                         
                                                    
                                                    <div>
                                                        <span class="opacity-60">{{ translate('Shipped By:') }}:</span>
                                                            <span class="fw-600 ml-2">{{ $ship3->user->name }}</span>
                                                    </div>
                                                    
                                                     <div>
                                                        <span class="opacity-60">{{ translate('Sold By:') }}:</span>
                                                            <span class="fw-600 ml-2">{{\App\Shop::where('user_id', $key)->first()->name}}</span>
                                                    </div>
                                                    
                                                    <div>
                                                        <span class="opacity-60">{{ translate('Arrival Day') }}:</span>
                                                        <span class="fw-600 ml-2">{{Carbon\Carbon::now()->addDays($ship3->transit_day)->format('l, M d, Y') }}</span>
                                                    </div>

                                               
                                               

                                                    
                                                    

                                                </span>
                                            </span>
                                        </label>
                                      
                                    </div>
                              
                            </div>
                        </div>
                            
                                
                            </div>     
                             
                        </div>
                                @endforeach
                        
                        
                         </div>
                         @endif
                                </div>
                                
                            </div>
                              <input type="hidden" name="owner_id[]" value="{{ $key }}" />
                        @endforeach
                   
                 
                    @endif
                    
                <div class="pt-4">
                    <a href="{{ route('home') }}" >
                        <i class="la la-angle-left"></i>
                        {{ translate('Return to shop')}}
                    </a>
                </div>
               
                                    <button style="float: right;margin-top: -26px;" type="submit"  class="btn fw-600 btn-primary">{{ translate('Continue to Payment')}}</a>
                               
                </form>
            </div>
        </div>
    </div>
</section>

@endsection

@section('script')
    <script type="text/javascript">
        function display_option(key){

        }
        function show_pickup_point(el) {
        	var value = $(el).val();
        	var target = $(el).data('target');

            // console.log(value);

        	if(value == 'home_delivery'){
                if(!$(target).hasClass('d-none')){
                    $(target).addClass('d-none');
                }
        	}else{
        		$(target).removeClass('d-none');
        	}
        }

    </script>
@endsection