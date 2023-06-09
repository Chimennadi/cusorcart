<div class="aiz-category-menu bg-white rounded @if(Route::currentRouteName() == 'home') shadow-sm" @else shadow-lg" id="category-sidebar" @endif>
    <div class="p-3 bg-soft-primary d-none d-lg-block rounded-top all-category position-relative text-left">
        <span class="fw-600 fs-16 mr-3">{{ translate('Categories') }}</span>
        <a href="{{ route('categories.all') }}" class="text-reset">
            <span class="d-none d-lg-inline-block">{{ translate('See All') }} ></span>
        </a>
    </div>
    <ul class="list-unstyled categories no-scrollbar py-2 mb-0 text-left">
        @foreach (\App\Category::where('level', 0)->orderBy('order_level', 'desc')->get()->take(11) as $key => $category)
            <li class="category-nav-element" data-id="{{ $category->id }}">
                <a href="{{ route('products.category', $category->slug) }}" class="text-truncate text-reset py-2 px-3 d-block">
                    <img
                        class="cat-image lazyload mr-2 opacity-60"
                        src="{{ static_asset('assets/img/placeholder.jpg') }}"
                        data-src="{{ uploaded_asset($category->icon) }}"
                        width="16"
                        alt="{{ $category->getTranslation('name') }}"
                        onerror="this.onerror=null;this.src='{{ static_asset('assets/img/placeholder.jpg') }}';"
                    >
                    <span class="cat-name">{{ $category->getTranslation('name') }}</span>
                </a>
                @if(count(\App\Utility\CategoryUtility::get_immediate_children_ids($category->id))>0)
                    <div class="sub-cat-menu c-scrollbar-light rounded shadow-lg p-4">
                        <div class="c-preloader text-center absolute-center">
                            <i class="las la-spinner la-spin la-3x opacity-70"></i>
                        </div>
                    </div>
                @endif
            </li>
        @endforeach
    </ul>
</div>
