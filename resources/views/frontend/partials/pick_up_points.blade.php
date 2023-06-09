<div class="card-header bg-white py-3">
    <h5 class="heading-6 mb-0">{{translate('Select Nearest Pick-up Point')}}</h5>
</div>
@php
    $admin_products = array();
    $seller_products = array();
    foreach (Session::get('cart') as $key => $cartItem){
        if(\App\Product::find($cartItem['id'])->added_by == 'admin'){
            array_push($admin_products, $cartItem['id']);
        }
        else{
            $product_ids = array();
            if(array_key_exists(\App\Product::find($cartItem['id'])->user_id, $seller_products)){
                $product_ids = $seller_products[\App\Product::find($cartItem['id'])->user_id];
            }
            array_push($product_ids, $cartItem['id']);
            $seller_products[\App\Product::find($cartItem['id'])->user_id] = $product_ids;
        }
    }
    // dd($seller_products);
@endphp
@if (!empty($admin_products))
    @foreach ($pick_up_points as $key => $pick_up_point)
    <label class="mega-radio w-100">
        <input type="radio" name="pickup_point_id" value="{{ $pick_up_point->id }}" checked required>
        <span class="d-block">
            <br><strong>{{ translate('Address') }}: {{ $pick_up_point->getTranslation('name') }}</strong>
            <br><strong>{{ translate('Address') }}: {{ $pick_up_point->getTranslation('address') }}</strong>
            <br><strong>{{ translate('Phone') }}: {{ $pick_up_point->phone }}</strong>
        </span>
    </label>
    @endforeach
@endif
@if (!empty($seller_products))
    @foreach ($seller_products as $key => $seller_product)
        @foreach ($seller_product as $key => $value)
            {{ $value }}<br>
        @endforeach
    @endforeach
@endif
