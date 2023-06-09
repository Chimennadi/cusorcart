<header id="navbar-main" class="nav-opt-sprite nav-flex nav-locale-us nav-lang-en nav-ssl nav-unrec nav-progressive-attribute">
    <div id="navbar" cel_widget_id="Navigation-desktop-navbar" role="navigation" class="nav-sprite-v1 celwidget nav-bluebeacon nav-a11y-t1 bold-focus-hover layout2 nav-flex layout3 layout3-alt nav-packard-glow hamburger nav-progressive-attribute using-mouse" data-csa-c-id="r8j2q0-iaovn1-403e57-t3zxyo" data-cel-widget="Navigation-desktop-navbar">
        <div id="nav-belt">
            <div class="nav-left">
                <div class="nav-left">
                    <!--<script type="text/javascript">-->
                    <!--    window.navmet.tmp = +new Date();-->
                    <!--</script>-->
                    <a href="javascript: void(0)" id="nav-hamburger-menu" role="button" aria-label="Open Menu" data-csa-c-type="widget" data-csa-c-slot-id="HamburgerMenuDesktop" data-csa-c-interaction-events="click" data-csa-c-id="e5rub6-27ckoz-b7o4l6-bla22d">
                    <i class=""></i>
                    </a>
                    <script type="text/javascript">
                        var hmenu = document.getElementById("nav-hamburger-menu");
                        hmenu.setAttribute("href", "javascript: void(0)");
                        window.navHamburgerMetricLogger = function() {
                            if (window.ue && window.ue.count) {
                                var metricName = "Nav:Hmenu:IconClickActionPending";
                                window.ue.count(metricName, (ue.count(metricName) || 0) + 1);
                            }
                            window.$Nav && $Nav.declare("navHMenuIconClicked", !0);
                            window.$Nav && $Nav.declare("navHMenuIconClickedNotReadyTimeStamp", Date.now());
                        };
                        hmenu.addEventListener("click", window.navHamburgerMetricLogger);
                        window.$Nav && $Nav.declare('hamburgerMenuIconAvailableOnLoad', false);
                    </script>
                    <script type="text/javascript">
                        // window.navmet.push({
                        //     key: 'HamburgerMenuIcon',
                        //     end: +new Date(),
                        //     begin: window.navmet.tmp
                        // });
                    </script>
                </div>
                <!--<script type="text/javascript">-->
                <!--    window.navmet.tmp = +new Date();-->
                <!--</script>-->
                <div id="nav-logo">
                    <a href="{{ route('home') }}" id="nav-logo-sprites" class="nav-logo-link nav-progressive-attribute" aria-label="">
                    @php
                    $header_logo = get_setting('header_logo');
                    @endphp
                    @if($header_logo != null)
                    <span class="nav-sprite "><img src="{{ uploaded_asset($header_logo) }}" style="width: 150px;" alt="{{ env('APP_NAME') }}"></span>
                    @else
                    <span class="nav-sprite "><img src="{{ static_asset('assets/img/logo.png') }}" style="width: 150px;" alt="{{ env('APP_NAME') }}"></span>
                    @endif
                    <span id="logo-ext" class="nav-sprite nav-logo-ext nav-progressive-content">ss</span>
                    <span class="nav-logo-locale">.us</span>
                    </a>
                </div>
                <script type="text/javascript">
                    // window.navmet.push({
                    //     key: 'Logo',
                    //     end: +new Date(),
                    //     begin: window.navmet.tmp
                    // });
                </script>
                <div id="nav-global-location-slot">
                    <span id="nav-global-location-data-modal-action" class="a-declarative nav-progressive-attribute" data-a-modal="{&quot;width&quot;:375, &quot;closeButton&quot;:&quot;false&quot;,&quot;popoverLabel&quot;:&quot;Choose your location&quot;, &quot;ajaxHeaders&quot;:{&quot;anti-csrftoken-a2z&quot;:&quot;gGmoRL4UmTtuZuzUpeMi5FO/a+OmjSfio8+qZzIAAAAMAAAAAGESSGxyYXcAAAAA&quot;}, &quot;name&quot;:&quot;glow-modal&quot;, &quot;url&quot;:&quot;/gp/glow/get-address-selections.html?deviceType=desktop&amp;pageType=Gateway&amp;storeContext=NoStoreName&amp;actionSource=desktop-modal&quot;, &quot;footer&quot;:&quot;<span class=\&quot;a-declarative\&quot; data-action=\&quot;a-popover-close\&quot; data-a-popover-close=\&quot;{}\&quot;><span class=\&quot;a-button a-button-primary\&quot;><span class=\&quot;a-button-inner\&quot;><button name=\&quot;glowDoneButton\&quot; class=\&quot;a-button-text\&quot; type=\&quot;button\&quot;>Done</button></span></span></span>&quot;,&quot;header&quot;:&quot;Choose your location&quot;}" data-action="a-modal">
                        <a id="nav-global-location-popover-link" class="nav-a nav-a-2 a-popover-trigger a-declarative nav-progressive-attribute" tabindex="0">
                            <div class="nav-sprite nav-progressive-attribute" id="nav-packard-glow-loc-icon"></div>
                            <div id="glow-ingress-block">
                                <span class="nav-line-1 nav-progressive-content" id="glow-ingress-line1">
                                Shopper In
                                </span>
                                <span class="nav-line-2 nav-progressive-content" id="glow-ingress-line2">
                                    Nigeria
                                    <?php
                                        // use Stevebauman\Location\Facades\Location;
                                        // $ip = Request::ip();
                                        // if ($position = Location::get($ip)) {
                                        //  Successfully retrieved position.
                                        // echo $position->countryName;
                                        // } else {
                                        //  Failed retrieving position.
                                        // }
                                    ?>
                                </span>
                            </div>
                        </a>
                    </span>
                    <input data-addnewaddress="add-new" id="unifiedLocation1ClickAddress" name="dropdown-selection" type="hidden" value="add-new" class="nav-progressive-attribute">
                    <input data-addnewaddress="add-new" id="ubbShipTo" name="dropdown-selection-ubb" type="hidden" value="add-new" class="nav-progressive-attribute">
                    <input id="glowValidationToken" name="glow-validation-token" type="hidden" value="gGmoRL4UmTtuZuzUpeMi5FO/a+OmjSfio8+qZzIAAAAMAAAAAGESSGxyYXcAAAAA" class="nav-progressive-attribute">
                </div>
                <ul class="list-inline d-flex justify-content-between justify-content-lg-start mb-0">
                    {{-- @if(get_setting('show_language_switcher') == 'on')
                    <li class="list-inline-item dropdown mr-3" id="lang-change">
                        @php
                        if(Session::has('locale')){
                        $locale = Session::get('locale', Config::get('app.locale'));
                        }
                        else{
                        $locale = 'en';
                        }
                        @endphp
                        <a href="javascript:void(0)" class="dropdown-toggle text-reset py-2" data-toggle="dropdown" data-display="static">
                        <img src="{{ static_asset('assets/img/placeholder.jpg') }}" data-src="{{ static_asset('assets/img/flags/'.$locale.'.png') }}" class="mr-2 lazyload" alt="{{ \App\Language::where('code', $locale)->first()->name }}" height="11">
                        <span class="opacity-60">{{ \App\Language::where('code', $locale)->first()->name }}</span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-left">
                            @foreach (\App\Language::all() as $key => $language)
                            <li>
                                <a href="javascript:void(0)" data-flag="{{ $language->code }}" class="dropdown-item @if($locale == $language) active @endif">
                                <img src="{{ static_asset('assets/img/placeholder.jpg') }}" data-src="{{ static_asset('assets/img/flags/'.$language->code.'.png') }}" class="mr-1 lazyload" alt="{{ $language->name }}" height="11">
                                <span class="language">{{ $language->name }}</span>
                                </a>
                            </li>
                            @endforeach
                        </ul>
                    </li>
                    @endif --}}
                    @if(get_setting('show_currency_switcher') == 'on')
                    <li style="margin-top: 15px;" class="list-inline-item dropdown" id="currency-change">
                        @php
                        if(Session::has('currency_code')){
                            $currency_code = Session::get('currency_code');
                        }
                        else {
                            $currency_code = \App\Currency::findOrFail(get_setting('system_default_currency'))->code;
                            //dd($currency_code);
                        }
                        @endphp
                        <span style="color: white;font-size: 12px;" class="nav-line-1 nav-progressive-content" id="glow-ingress-line1">Change Currency</span>
                        <a style="color: white !important;padding-top: 3px !important;font-weight: 700;padding-right: 9px !important;" href="javascript:void(0)" class="dropdown-toggle text-reset py-2 opacity-60" data-toggle="dropdown" data-display="static">
                            {{ (\App\Currency::where('code', $currency_code)->first()->name) }} {{ (\App\Currency::where('code', $currency_code)->first()->symbol) }}
                        </a>
                        <ul class="dropdown-menu dropdown-menu-right dropdown-menu-lg-left">
                            @foreach (\App\Currency::where('status', 1)->get() as $key => $currency)
                            <li>
                                <a  class="dropdown-item @if($currency_code == $currency->code) active @endif" href="javascript:void(0)" data-currency="{{ $currency->code }}">{{ $currency->name }} ({{ $currency->symbol }})</a>
                            </li>
                            @endforeach
                        </ul>
                    </li>
                    @endif
                </ul>
                <div id="nav-global-location-toaster-script-container" class="nav-progressive-content"></div>
            </div>
            <div class="nav-fill">
                <!--<script type="text/javascript">-->
                <!--    window.navmet.tmp = +new Date();-->
                <!--</script>-->
                <select style="height: 44px;margin-top: 8px;background: #f3f3f3;border-radius: 5px;" aria-describedby="searchDropdownDescription" class="nav-search-dropdown searchSelect nav-progressive-attrubute nav-progressive-search-dropdown" data-nav-digest="Xa0GQ+pPQ/tdsV+GmRWeXB8PUD0=" data-nav-selected="0" id="searchDropdownBox" name="url" style="display: block; top: 2.5px;" tabindex="0" title="Search in">
                    <option selected="selected" value="search-alias=aps">All Departments</option>
                    @foreach (\App\Category::where('level', 0)->orderBy('order_level', 'desc')->get()->take(11) as $key => $category)
                    <option value="{{$category->slug}}">{{ $category->getTranslation('name') }}</option>
                    @endforeach
                </select>
                <div style="background: #102847!important;" class="flex-grow-1 front-header-search d-flex align-items-center bg-white">
                    <div class="position-relative flex-grow-1">
                        <form  action="{{ route('search') }}" method="GET" class="stop-propagation">
                            <div class="d-flex position-relative align-items-center">
                                <div class="d-lg-none" data-toggle="class-toggle" data-target=".front-header-search">
                                    <button class="btn px-2" type="button"><i class="la la-2x la-long-arrow-left"></i></button>
                                </div>
                                <div class="input-group">
                                    <input type="text" class="border-0 border-lg form-control" id="search" name="q" placeholder="{{translate('I am shopping for...')}}" autocomplete="off" required>
                                    <div class="input-group-append d-none d-lg-block">
                                        <button style="background: #f3c11b;color: black;font-weight: bolder;border: 1px solid #f3c11b;" class="btn btn-primary" type="submit">
                                        <i class="la la-search la-flip-horizontal fs-18"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>
                        <div class="typed-search-box stop-propagation document-click-d-none d-none bg-white rounded shadow-lg position-absolute left-0 top-100 w-100" style="min-height: 200px">
                            <div class="search-preloader absolute-top-center">
                                <div class="dot-loader">
                                    <div></div>
                                    <div></div>
                                    <div></div>
                                </div>
                            </div>
                            <div class="search-nothing d-none p-3 text-center fs-16">
                            </div>
                            <div id="search-content" class="text-left">
                            </div>
                        </div>
                    </div>
                </div>
                <!--<script type="text/javascript">-->
                <!--    window.navmet.push({-->
                <!--        key: 'Search',-->
                <!--        end: +new Date(),-->
                <!--        begin: window.navmet.tmp-->
                <!--    });-->
                <!--</script>-->
            </div>
            <div class="nav-right">
                <!--<script type="text/javascript">-->
                <!--    window.navmet.tmp = +new Date();-->
                <!--</script>-->
                <div id="nav-tools" class="layoutToolbarPadding">
                    <div class="d-none d-lg-block ml-3 mr-0 mt-3">
                        @auth
                        @if(isAdmin())
                        <li class="list-inline-item mr-3">
                            <a href="{{ route('admin.dashboard') }}" style="color:white !important" class="text-reset py-2 d-inline-block opacity-60 ">{{ translate('My Account')}}</a>
                        </li>
                        @elseif(Auth::user()->user_type == 'logistic')
                        <li class="list-inline-item mr-3">
                            <a href="{{ route('logistic.dashboard') }}" style="color:white !important" class="text-reset py-2 d-inline-block opacity-60 ">{{ translate('My Account')}}</a>
                        </li>
                        @else
                        <li class="list-inline-item mr-3">
                            <a href="{{ route('dashboard') }}" style="color:white !important" class="text-reset py-2 d-inline-block opacity-60 ">{{ translate('My Account')}}</a>
                        </li>
                        @endif
                        <li class="list-inline-item">
                            <a href="{{ route('logout') }}" style="color:white !important" class="text-reset py-2 d-inline-block opacity-60 ">{{ translate('Logout')}}</a>
                        </li>
                        @else
                        <li class="list-inline-item mr-3">
                            <a href="{{ route('user.login') }}" style="color:white !important" class="text-reset py-2 d-inline-block opacity-60 ">{{ translate('Login')}}</a>
                        </li>
                        <li class="list-inline-item">
                            <a href="{{ route('user.registration') }}" style="color:white !important" class="text-reset py-2 d-inline-block opacity-60 ">{{ translate('Registration')}}</a>
                        </li>
                        @endauth
                    </div>
                    <div class="d-none d-lg-block  align-self-stretch ml-3 mr-0" data-hover="dropdown">
                        <div class="nav-cart-box dropdown h-100"  id="cart_items" style="margin-right: 20px;">
                            @include('frontend.partials.cart')
                        </div>
                    </div>
                </div>
                <script type="text/javascript">
                    // window.navmet.push({
                    //     key: 'Tools',
                    //     end: +new Date(),
                    //     begin: window.navmet.tmp
                    // });
                </script>
            </div>
        </div>
        <div id="nav-flyout-iss-anchor">
            <div id="nav-flyout-searchAjax" class="nav-issFlyout nav-flyout">
                <div class="nav-template nav-flyout-content"></div>
                <div class="nav-flyout-buffer-left"></div>
                <div class="nav-flyout-buffer-right"></div>
                <div class="nav-flyout-buffer-top"></div>
                <div class="nav-flyout-buffer-bottom"></div>
            </div>
        </div>
        <div id="nav-flyout-anchor">
            <div id="nav-flyout-prime" class="nav-coreFlyout nav-flyout">
                <div class="nav-arrow">
                    <div class="nav-arrow-inner"></div>
                </div>
                <div class="nav-template nav-flyout-content nav-spinner"></div>
                <div class="nav-flyout-buffer-left"></div>
                <div class="nav-flyout-buffer-right"></div>
                <div class="nav-flyout-buffer-top"></div>
                <div class="nav-flyout-buffer-bottom"></div>
            </div>
            <div id="nav-flyout-accountList" class="nav-coreFlyout nav-flyout">
                <div class="nav-arrow">
                    <div class="nav-arrow-inner"></div>
                </div>
                <div class="nav-template nav-flyout-content">
                    <div id="nav-al-container">
                        <div id="nav-al-signin">
                            <div id="nav-flyout-ya-signin" class="nav-flyout-content nav-flyout-accessibility">
                                <a href="#" rel="nofollow" class="nav-action-button" data-nav-role="signin" data-nav-ref="nav_signin"><span class="nav-action-inner">Sign in</span></a>
                                <div id="nav-flyout-ya-newCust" class="nav_pop_new_cust nav-flyout-content nav-flyout-accessibility">New customer? <a href="#" rel="nofollow" class="nav-a">Start here.</a></div>
                            </div>
                        </div>
                        <div id="nav-al-wishlist" class="nav-al-column nav-tpl-itemList nav-flyout-content nav-flyout-accessibility">
                            <div class="nav-title" id="nav-al-title">Your Lists</div>
                            <a href="#" class="nav-link nav-item"><span class="nav-text">Create a List</span></a> <a href="#" class="nav-link nav-item"><span class="nav-text">AmazonSmile Charity Lists</span></a>
                        </div>
                        <div id="nav-al-your-account" class="nav-al-column nav-template nav-flyout-content nav-tpl-itemList nav-flyout-accessibility">
                            <div class="nav-title">Your Account</div>
                            <a href="#" class="nav-link nav-item"><span class="nav-text">Account</span></a> <a id="nav_prefetch_yourorders" href="#" class="nav-link nav-item"><span class="nav-text">Orders</span></a> <a href="#" class="nav-link nav-item"><span class="nav-text">Recommendations</span></a> <a href="#" class="nav-link nav-item"><span class="nav-text">Browsing History</span></a> <a href="#" class="nav-link nav-item"><span class="nav-text">Watchlist</span></a> <a href="#" class="nav-link nav-item"><span class="nav-text">Video Purchases &amp; Rentals</span></a> <a href="#" class="nav-link nav-item"><span class="nav-text">Kindle Unlimited</span></a> <a href="#" class="nav-link nav-item"><span class="nav-text">Content &amp; Devices</span></a> <a href="#" class="nav-link nav-item"><span class="nav-text">Subscribe &amp; Save Items</span></a> <a href="#" class="nav-link nav-item"><span class="nav-text">Memberships &amp; Subscriptions</span></a> <a href="#" class="nav-link nav-item"><span class="nav-text">Music Library</span></a>
                        </div>
                    </div>
                </div>
                <div class="nav-flyout-buffer-left"></div>
                <div class="nav-flyout-buffer-right"></div>
                <div class="nav-flyout-buffer-top"></div>
                <div class="nav-flyout-buffer-bottom"></div>
            </div>
            <div id="nav-flyout-groceries" class="nav-coreFlyout nav-flyout">
                <div class="nav-arrow">
                    <div class="nav-arrow-inner"></div>
                </div>
                <div class="nav-template nav-flyout-content nav-spinner"></div>
                <div class="nav-flyout-buffer-left"></div>
                <div class="nav-flyout-buffer-right"></div>
                <div class="nav-flyout-buffer-top"></div>
                <div class="nav-flyout-buffer-bottom"></div>
            </div>
            <div id="nav-flyout-transientFlyout" class="nav-coreFlyout nav-flyout">
                <div class="nav-arrow">
                    <div class="nav-arrow-inner"></div>
                </div>
                <div class="nav-template nav-flyout-content nav-spinner"></div>
                <div class="nav-flyout-buffer-left"></div>
                <div class="nav-flyout-buffer-right"></div>
                <div class="nav-flyout-buffer-top"></div>
                <div class="nav-flyout-buffer-bottom"></div>
            </div>
            <div id="nav-flyout-fresh" class="nav-coreFlyout nav-flyout">
                <div class="nav-arrow">
                    <div class="nav-arrow-inner"></div>
                </div>
                <div class="nav-template nav-flyout-content nav-spinner"></div>
                <div class="nav-flyout-buffer-left"></div>
                <div class="nav-flyout-buffer-right"></div>
                <div class="nav-flyout-buffer-top"></div>
                <div class="nav-flyout-buffer-bottom"></div>
            </div>
            <div id="nav-flyout-abAcquisition" class="nav-coreFlyout nav-flyout">
                <div class="nav-arrow">
                    <div class="nav-arrow-inner"></div>
                </div>
                <div class="nav-template nav-flyout-content nav-spinner"></div>
                <div class="nav-flyout-buffer-left"></div>
                <div class="nav-flyout-buffer-right"></div>
                <div class="nav-flyout-buffer-top"></div>
                <div class="nav-flyout-buffer-bottom"></div>
            </div>
            <div id="nav-flyout-abActivation" class="nav-coreFlyout nav-flyout">
                <div class="nav-arrow">
                    <div class="nav-arrow-inner"></div>
                </div>
                <div class="nav-template nav-flyout-content nav-spinner"></div>
                <div class="nav-flyout-buffer-left"></div>
                <div class="nav-flyout-buffer-right"></div>
                <div class="nav-flyout-buffer-top"></div>
                <div class="nav-flyout-buffer-bottom"></div>
            </div>
            <div id="nav-flyout-abAccountLink" class="nav-coreFlyout nav-flyout">
                <div class="nav-arrow">
                    <div class="nav-arrow-inner"></div>
                </div>
                <div class="nav-template nav-flyout-content nav-spinner"></div>
                <div class="nav-flyout-buffer-left"></div>
                <div class="nav-flyout-buffer-right"></div>
                <div class="nav-flyout-buffer-top"></div>
                <div class="nav-flyout-buffer-bottom"></div>
            </div>
            <div class="nav-signin-tt nav-flyout" style="display: none; position: absolute; top: -5px; left: 1259.02px; opacity: 1;">
                <div class="nav-arrow">
                    <div class="nav-arrow-inner"></div>
                </div>
                <div id="nav-signin-tooltip">
                    <a href="#" class="nav-action-button" data-nav-role="signin" data-nav-ref="nav_custrec_signin"><span class="nav-action-inner">Sign in</span></a>
                    <div class="nav-signin-tooltip-footer">New customer? <a href="#" class="nav-a">Start here.</a></div>
                </div>
                <div class="nav-flyout-buffer-left"></div>
                <div class="nav-flyout-buffer-right"></div>
                <div class="nav-flyout-buffer-top"></div>
                <div class="nav-flyout-buffer-bottom"></div>
            </div>
            <div id="nav-flyout-icp" class="nav-coreFlyout nav-flyout">
                <div class="nav-arrow">
                    <div class="nav-arrow-inner"></div>
                </div>
                <div class="nav-template nav-flyout-content nav-spinner"></div>
                <div class="nav-flyout-buffer-left"></div>
                <div class="nav-flyout-buffer-right"></div>
                <div class="nav-flyout-buffer-top"></div>
                <div class="nav-flyout-buffer-bottom"></div>
            </div>
            <div id="nav-flyout-icp-footer-flyout" class="nav-coreFlyout nav-flyout">
                <div class="nav-arrow">
                    <div class="nav-arrow-inner"></div>
                </div>
                <div class="nav-template nav-flyout-content nav-spinner"></div>
                <div class="nav-flyout-buffer-left"></div>
                <div class="nav-flyout-buffer-right"></div>
                <div class="nav-flyout-buffer-top"></div>
                <div class="nav-flyout-buffer-bottom"></div>
            </div>
        </div>
        <div id="nav-main" class="nav-sprite">
            <div class="nav-fill">
                <div id="nav-shop">
                </div>
                <div id="nav-xshop-container">
                    <div id="nav-xshop" class="nav-progressive-content">
                        <!--<script type="text/javascript">-->
                        <!--    window.navmet.tmp = +new Date();-->
                        <!--</script>-->
                        @foreach (json_decode( get_setting('header_menu_labels'), true) as $key => $value)
                        <a href="{{ json_decode( get_setting('header_menu_links'), true)[$key] }}" class="nav-a">{{ translate($value) }}</a>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        <div id="nav-subnav-toaster"></div>
        <div id="nav-progressive-subnav">
        </div>
    </div>
</header>
<header id="nav-main" data-nav-language="en_US" class="nav-mobile nav-progressive-attribute nav-locale-us nav-lang-en nav-ssl nav-unrec nav-blueheaven" >
    <div id="navbar" cel_widget_id="Navigation-mobile-navbar" role="navigation" class="nav-t-gateway nav-sprite-v3 celwidget" data-csa-c-id="3a1n09-v5k4sk-zdsr95-pd8194" data-cel-widget="Navigation-mobile-navbar">
        <div id="nav-logobar">
            <div class="nav-left">
                <script type="text/javascript">
                    var hmenu = document.getElementById("nav-hamburger-menu");
                    hmenu.setAttribute("href", "javascript: void(0)");
                    window.navHamburgerMetricLogger = function() {
                        if (window.ue && window.ue.count) {
                            var metricName = "Navm:Hmenu:IconClickActionPending";
                            window.ue.count(metricName, (ue.count(metricName) || 0) + 1);
                        }
                        window.$Nav && $Nav.declare("navHMenuIconClickedNotReadyTimeStamp", Date.now());
                    };
                    hmenu.addEventListener("click", window.navHamburgerMetricLogger);
                </script>
                <script type="text/javascript">
                    window.$Nav && $Nav.declare('hamburgerMenuIconAvailableOnLoad', false);
                </script>
                <script type="text/javascript">
                    if (document.addEventListener) {
                        document.addEventListener("DOMContentLoaded", function() {
                            var P = window.AmazonUIPageJS ? AmazonUIPageJS : P;
                            if (P && P.now && P.register) {
                                P.now("navCF").execute("regCF", function(navCF) {
                                    if (typeof navCF === "undefined") {
                                        try {
                                            P.register("navCF", function() {
                                                return {
                                                    backupEventTriggered: true
                                                };
                                            });
                                        } catch (e) {}
                                    }
                                });
                            }
                        });
                    }
                </script>
                <!--<script type="text/javascript">-->
                <!--    window.navmet.tmp = +new Date();-->
                <!--</script>-->
                <div id="nav-logo">
                    <a href="{{ route('home') }}" id="nav-logo-sprites" class="nav-logo-link nav-progressive-attribute" aria-label="">
                    @php
                    $header_logo = get_setting('header_logo');
                    @endphp
                    @if($header_logo != null)
                    <img src="{{ uploaded_asset($header_logo) }}" style="width: 120px;margin-top: -16px;" alt="{{ env('APP_NAME') }}">
                    @else
                    <img src="{{ static_asset('assets/img/logo.png') }}" style="width: 120px;margin-top: -16px;" alt="{{ env('APP_NAME') }}">
                    @endif
                    <span id="logo-ext" class="nav-sprite1 nav-logo-ext nav-progressive-content"></span>
                    <span class="nav-logo-locale">.us</span>
                    </a>
                </div>
                <script type="text/javascript">
                    // window.navmet.push({
                    //     key: 'Logo',
                    //     end: +new Date(),
                    //     begin: window.navmet.tmp
                    // });
                </script>
            </div>
            <div class="nav-right">
                @auth
                @if(isAdmin())
                <a href="{{ route('admin.dashboard') }}" class="nav-a avatar-new  avatar-wide" id="nav-button-avatar" aria-label="your account">
                <i class="nav-icon nav-icon-a11y nav-sprite1">{{ translate('My Panel')}}</i>
                </a>
                @else
                <a  href="javascript:void(0)" class="nav-a avatar-new  avatar-wide text-reset flex-grow-1 text-center py-2 mobile-side-nav-thumb" id="nav-button-avatar" data-toggle="class-toggle" data-target=".aiz-mobile-side-nav" aria-label="your account">
                <i class="nav-icon nav-icon-a11y nav-sprite1">{{ translate('My Panel')}}</i>
                </a>
                @endif
                <a href="{{ route('logout') }}" class="nav-a avatar-new  avatar-wide"  aria-label="your account">
                <i class="nav-icon fas fa-sign-out-alt" style="color:#fff;font-size: 22px;margin-top: 13px;margin-left: 5px;"></i> 
                </a>
                @else
                <a href="{{ route('user.login') }}" id="nav-logobar-greeting" class="nav-a nav-show-sign-in">
                {{ translate('Login')}} ›
                </a>
                <!--<br>-->
                <!--<a href="{{ route('user.registration') }}" id="nav-logobar-greeting" class="nav-a nav-show-sign-in">-->
                <!--    {{ translate('Registration')}} ›-->
                <!--</a>-->
                @endauth
                @php
                if(auth()->user() != null) {
                $user_id = Auth::user()->id;
                $cart = \App\Cart::where('user_id', $user_id)->get();
                } else {
                $temp_user_id = Session()->get('temp_user_id');
                if($temp_user_id) {
                $cart = \App\Cart::where('temp_user_id', $temp_user_id)->get();
                }
                }
                @endphp
                <a href="{{ route('cart') }}" aria-label="Cart" class="nav-a" id="nav-button-cart">
                    <div id="cart-size" class="nav-cart-0 nav-progressive-attribute">
                        <span class="nav-icon nav-sprite1">
                        @if(isset($cart) && count($cart) > 0)
                        <span id="nav-cart-count" class="nav-cart-count nav-progressive-content">{{ count($cart)}}</span>
                        @else
                        <span id="nav-cart-count" class="nav-cart-count nav-progressive-content">0</span>
                        @endif
                        </span>
                    </div>
                </a>
            </div>
        </div>
        <!--<script type="text/javascript">-->
        <!--    window.navmet.tmp = +new Date();-->
        <!--</script>-->
        <div class="nav-progressive-attribute" id="search-ac-init-data" data-aliases="aps,amazon-custom-products,amazon-devices,amazonbasics,amazonfresh,amazon-pharmacy,wholefoods,allthebestpets,bartelldrugs,bristolfarms,freshthyme,kegnbottle,missionwinespirits,petfoodexpress,sousaswineliquors,surdyksliquorcheeseshop,unionsquarewine,vintagegrape,westsidemarket,stripbooks,popular,apparel,electronics,sporting,sports-and-fitness,outdoor-recreation,fan-shop,garden,videogames,toys-and-games,jewelry,digital-text,digital-music,prime-digital-music,watches,grocery,hpc,instant-video,handmade,handmade-jewelry,handmade-home-and-kitchen,prime-instant-video,shop-instant-video,baby-products,office-products,software,smart-home,magazines,tools,automotive,misc,industrial,mi,pet-supplies,digital-music-track,digital-music-album,mobile,mobile-apps,movies-tv,music-artist,music-album,music-song,stripbooks-spanish,electronics-accessories,photo,audio-video,computers,furniture,kitchen,audible,audiobooks,beauty,shoes,arts-crafts,appliances,gift-cards,pets,outdoor,lawngarden,collectibles,replacement-parts,financial,fine-art,fashion,fashion-womens,fashion-womens-clothing,fashion-womens-jewelry,fashion-womens-shoes,fashion-womens-watches,fashion-womens-handbags,fashion-mens,fashion-mens-clothing,fashion-mens-jewelry,fashion-mens-shoes,fashion-mens-watches,fashion-girls,fashion-girls-clothing,fashion-girls-jewelry,fashion-girls-shoes,fashion-girls-watches,fashion-boys,fashion-boys-clothing,fashion-boys-jewelry,fashion-boys-shoes,fashion-boys-watches,fashion-baby,fashion-baby-boys,fashion-baby-girls,fashion-luggage,3d-printing,tradein-aps,todays-deals,live-explorations,local-services,vehicles,video-shorts,warehouse-deals,luxury-beauty,banjo-apps,black-friday,cyber-monday,alexa-skills,subscribe-with-amazon,courses,edu-alt-content,amazon-global-store,prime-wardrobe,under-ten-dollars,tempo,specialty-aps-sns,luxury" data-ime="" data-mkt="1" data-src="completion.amazon.com/search/complete">
        </div>
        <div id="nav-search-keywords-data" class="nav-progressive-attribute" data-implicit-alias="aps">
        </div>
        <div class="nav-searchbar-wrapper">
            <form class="nav-searchbar search-big" action="{{ route('search') }}" method="get" role="search" id="nav-search-form" accept-charset="utf-8">
                <div class="nav-fill">
                    <div class="nav-search-field">
                        <input type="text" class="nav-input nav-progressive-attribute" id="search1" name="q" placeholder="{{translate('I am shopping for...')}}" autocomplete="off" autocorrect="off" autocapitalize="off" dir="auto" value="" required>
                        <a class="nav-icon nav-sprite1 nav-search-clear" tabindex="0" href="javascript:;" aria-label="Clear search keywords"></a>
                    </div>
                </div>
                <div class="nav-right">
                    <div class="nav-search-submit">
                        <input type="submit" class="nav-input" value="Go" aria-label="Go">
                        <i class="nav-icon nav-sprite1"></i>
                    </div>
                </div>
                <div style="background:white" id="search1-content" class="text-left">
                </div>
            </form>
        </div>
        <script type="text/javascript">
            // window.navmet.push({
            //     key: 'SearchBar',
            //     end: +new Date(),
            //     begin: window.navmet.tmp
            // });
        </script>
        <script type="text/javascript">
            var nav_t_after_searchbar = +new Date();
        </script>
        <!--<script type="text/javascript">-->
        <!--    window.navmet.tmp = +new Date();-->
        <!--</script>-->
        <div id="nav-gwbar" class="nav-gwbar-single-row nav-genz nav-gwbar-white nav-gwbar-scroll">
            @foreach (json_decode( get_setting('header_menu_labels'), true) as $key => $value)
            <a href="{{ json_decode( get_setting('header_menu_links'), true)[$key] }}" class="nav-a">{{ translate($value) }}</a>
            @endforeach
        </div>
        <script type="text/javascript">
            // window.navmet.push({
            //     key: 'Gateway',
            //     end: +new Date(),
            //     begin: window.navmet.tmp
            // });
        </script>
        <!--NAVYAAN-SUBNAV-AND-SMILE-FROM-GURUPA-->
        <!-- NAVYAAN-GLOW-SUBNAV -->
        <div class="glow-subnav-template glow-mobile-subnav" id="nav-subnav-container">
            <div class="a-declarative" data-action="glow-sheet-trigger" id="nav-global-location-slot">
                <div id="glow-ingress-block">
                    <span style="width: 77%;" class="nav-single-line nav-persist-content" id="glow-ingress-single-line">
                    Shopper In  <?php
                        $ip = Request::ip();
                        if ($position = Location::get($ip)) {
                        // Successfully retrieved position.
                        echo $position->countryName;
                        } else {
                        // Failed retrieving position.
                        }
                        ?>
                    </span>
                    <ul class="list-inline d-flex justify-content-between justify-content-lg-start mb-0">
                        @if(get_setting('show_language_switcher') == 'on')
                        <li class="list-inline-item dropdown mr-3" id="lang-change">
                            @php
                            if(Session::has('locale')){
                            $locale = Session::get('locale', Config::get('app.locale'));
                            }
                            else{
                            $locale = 'en';
                            }
                            @endphp
                            <a href="javascript:void(0)" class="dropdown-toggle text-reset py-2" data-toggle="dropdown" data-display="static">
                            <img src="{{ static_asset('assets/img/placeholder.jpg') }}" data-src="{{ static_asset('assets/img/flags/'.$locale.'.png') }}" class="mr-2 lazyload" alt="{{ \App\Language::where('code', $locale)->first()->name }}" height="11">
                            <span class="opacity-60">{{ \App\Language::where('code', $locale)->first()->name }}</span>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-left">
                                @foreach (\App\Language::all() as $key => $language)
                                <li>
                                    <a href="javascript:void(0)" data-flag="{{ $language->code }}" class="dropdown-item @if($locale == $language) active @endif">
                                    <img src="{{ static_asset('assets/img/placeholder.jpg') }}" data-src="{{ static_asset('assets/img/flags/'.$language->code.'.png') }}" class="mr-1 lazyload" alt="{{ $language->name }}" height="11">
                                    <span class="language">{{ $language->name }}</span>
                                    </a>
                                </li>
                                @endforeach
                            </ul>
                        </li>
                        @endif
                        @if(get_setting('show_currency_switcher') == 'on')
                        <li style="margin-top: 0px;" class="list-inline-item dropdown" id="currency-change">
                            @php
                            if(Session::has('currency_code')){
                            $currency_code = Session::get('currency_code');
                            }
                            else{
                            $currency_code = \App\Currency::findOrFail(get_setting('system_default_currency'))->code;
                            }
                            @endphp
                            <a style="color: white !important;padding-top: 3px !important;font-weight: 700;padding-right: 9px !important;" href="javascript:void(0)" class="dropdown-toggle text-reset py-2 opacity-60" data-toggle="dropdown" data-display="static">
                            {{ \App\Currency::where('code', $currency_code)->first()->name }} {{ (\App\Currency::where('code', $currency_code)->first()->symbol) }}
                            </a>
                            <ul class="dropdown-menu dropdown-menu-right dropdown-menu-lg-left">
                                @foreach (\App\Currency::where('status', 1)->get() as $key => $currency)
                                <li>
                                    <a  class="dropdown-item @if($currency_code == $currency->code) active @endif" href="javascript:void(0)" data-currency="{{ $currency->code }}">{{ $currency->name }} ({{ $currency->symbol }})</a>
                                </li>
                                @endforeach
                            </ul>
                        </li>
                        @endif
                    </ul>
                </div>
                <input data-addnewaddress="new" id="unifiedLocation1ClickAddress" name="addressID" type="hidden" class="nav-progressive-attribute" value="">
                <input id="glowValidationToken" name="glow-validation-token" type="hidden" value="gI5dF1nIExEOYrNsrkzFp1kQjeBqhSVu8Q/obx0AAAAMAAAAAGEWQj1yYXcAAAAA" class="nav-progressive-attribute">
            </div>
        </div>
        <script type="text/javascript">
            if (window.P && typeof window.P.declare === "function" && typeof window.P.now === "function") {
                window.P.now('packardGlowIngressMobileJsEnabled').execute(function(glowEnabled) {
                    if (!glowEnabled) {
                        window.P.declare('packardGlowIngressMobileJsEnabled', true);
                    }
                });
                window.P.now('glowMobileSelectedLocationType').execute(function(locationType) {
                    if (!locationType) {
                        window.P.declare('glowMobileSelectedLocationType', '');
                    }
                });
                window.P.now('glowMobileSelectedLocationValue').execute(function(locationValue) {
                    if (!locationValue) {
                        window.P.declare('glowMobileSelectedLocationValue', '');
                    }
                });
                window.P.now('glowMobileBottomSheetCallRefactor').execute(function(glowCallRefactor) {
                    if (!glowCallRefactor) {
                        window.P.declare('glowMobileBottomSheetCallRefactor', true);
                    }
                });
                window.P.now('glowMobileStoreName').execute(function(storeName) {
                    if (!storeName) {
                        window.P.declare('glowMobileStoreName', 'NoStoreName');
                    }
                });
                window.P.now('glowMobileDoneBottonEnabled').execute(function(doneBottonEnabled) {
                    if (!doneBottonEnabled) {
                        window.P.declare('glowMobileDoneBottonEnabled', true);
                    }
                });
                window.P.now('glowMobileDoneBottonLabel').execute(function(doneBottonLabel) {
                    if (!doneBottonLabel) {
                        window.P.declare('glowMobileDoneBottonLabel', 'DONE');
                    }
                });
            }
        </script>
    </div>
    <div id="nav-progressive-subnav">
    </div>
</header>