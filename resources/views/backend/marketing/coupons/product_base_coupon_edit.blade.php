<div class="card-header mb-2">
    <h5 class="mb-0 h6">{{translate('Add Your Product Base Coupon')}}</h5>
</div>
<div class="form-group row">
    <label class="col-lg-3 control-label" for="coupon_code">{{translate('Coupon code')}}</label>
    <div class="col-lg-9">
        <input type="text" placeholder="{{translate('Coupon code')}}" id="coupon_code" name="coupon_code" value="{{ $coupon->code }}" class="form-control" required>
    </div>
</div>
<div class="product-choose-list">
    <div class="product-choose">
        <div class="form-group row">
            <label class="col-lg-3 control-label" for="name">{{translate('Product')}}</label>
            <div class="col-lg-9">
                <select name="product_ids[]" class="form-control product_id aiz-selectpicker" data-live-search="true" data-selected-text-format="count" required multiple>
                    @foreach(filter_products(\App\Product::query())->get() as $key => $product)
                        <option value="{{$product->id}}"
                            @foreach (json_decode($coupon->details) as $key => $details)
                                @if ($details->product_id == $product->id)
                                    selected
                                @endif
                            @endforeach
                            >{{$product->getTranslation('name')}}</option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>
</div>
@php
  $start_date = date('m/d/Y', $coupon->start_date);
  $end_date = date('m/d/Y', $coupon->end_date);
@endphp
<div class="form-group row">
    <label class="col-sm-3 control-label" for="start_date">{{translate('Date')}}</label>
    <div class="col-sm-9">
      <input type="text" class="form-control aiz-date-range" value="{{ $start_date .' - '. $end_date }}" name="date_range" placeholder="Select Date">
    </div>
</div>

<div class="form-group row">
   <label class="col-lg-3 col-from-label">{{translate('Discount')}}</label>
   <div class="col-lg-7">
       <input type="number" lang="en" min="0" step="0.01" placeholder="{{translate('Discount')}}" value="{{ $coupon->discount }}" name="discount" class="form-control" required>

   </div>
   <div class="col-lg-2">
       <select class="form-control aiz-selectpicker" name="discount_type">
           <option value="amount" @if ($coupon->discount_type == 'amount') selected  @endif>{{translate('Amount')}}</option>
           <option value="percent" @if ($coupon->discount_type == 'percent') selected  @endif>{{translate('Percent')}}</option>
       </select>
   </div>
</div>

<script type="text/javascript">

    $(document).ready(function(){
        $('.aiz-date-range').daterangepicker();
        AIZ.plugins.bootstrapSelect('refresh');
    });

</script>
