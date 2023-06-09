<div class="aiz-card-box border border-light rounded hov-shadow-md mt-1 mb-2 has-transition bg-white">
    <div class="position-relative">
        <a href="{{ route('product', $product->slug) }}" class="d-block">
            <img
                class="img-fit lazyload mx-auto h-140px h-md-210px"
                src="{{ static_asset('assets/img/placeholder.jpg') }}"
                data-src="{{ uploaded_asset($product->thumbnail_img) }}"
                alt="{{  $product->getTranslation('name')  }}"
                onerror="this.onerror=null;this.src='{{ static_asset('assets/img/placeholder.jpg') }}';"
            >
        </a>
        <div class="absolute-top-right aiz-p-hov-icon">
            <a href="javascript:void(0)" onclick="addToWishList({{ $product->id }})" data-toggle="tooltip" data-title="{{ translate('Add to wishlist') }}" data-placement="left">
                <i class="la la-heart-o"></i>
            </a>
            <!--<a href="javascript:void(0)" onclick="addToCompare({{ $product->id }})" data-toggle="tooltip" data-title="{{ translate('Add to compare') }}" data-placement="left">-->
            <!--    <i class="las la-sync"></i>-->
            </a>
            <a href="javascript:void(0)" onclick="showAddToCartModal({{ $product->id }})" data-toggle="tooltip" data-title="{{ translate('Add to cart') }}" data-placement="left">
                <i class="las la-shopping-cart"></i>
            </a>
        </div>
    </div>
    <div class="p-md-3 p-2 text-left">
            <h3 class="fw-600 fs-13 text-truncate-2 lh-1-4 mb-0 ">
            <a href="{{ route('product', $product->slug) }}" style="display: block; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;" class="d-block text-reset">{{  $product->getTranslation('name')  }}</a>
        </h3>
    
        <div class="fs-15">
            <!--<p>-->
                <span class="fw-700 text-primary">{{ home_discounted_price($product) }}</span>
            <!--</p>-->
            <br/>
            <!--<p>-->
                @if(home_discounted_base_price($product) !== "₦0.00")
                    <del class="fw-600 opacity-50 mr-1">{{ home_discounted_base_price($product) }}</del>
                @endif
            <!--</p>-->
        </div>
        <div class="rating rating-sm mt-1">
            {{ renderStarRating($product->rating) }}
        </div>
        @if (\App\Addon::where('unique_identifier', 'club_point')->first() != null && \App\Addon::where('unique_identifier', 'club_point')->first()->activated)
            <div class="rounded px-2 mt-2 bg-soft-primary border-soft-primary border">
                {{ translate('Club Point') }}:
                <span class="fw-700 float-right">{{ $product->earn_point }}</span>
            </div>
        @endif
    </div>
</div>
