<section class="bg-white border-top mt-auto">
    <div class="container">
        <div class="row no-gutters">
            <div class="col-lg-3 col-md-6 col-sm-3 col-xs-3">
                <a class="text-reset border-left text-center p-4 d-block" href="https://global.{{ route('home') }}/terms-and-conditions/">
                    <i class="la la-file-text la-3x text-primary mb-2"></i>
                    <h4 class="h6">{{ translate('Terms & conditions') }}</h4>
                </a>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-3 col-xs-3">
                <a class="text-reset border-left text-center p-4 d-block" href="{{ route('home') }}/send-refund-request">
                    <i class="la la-mail-reply la-3x text-primary mb-2"></i>
                    <h4 class="h6">{{ translate('Return Policy') }}</h4>
                </a>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-3 col-xs-3">
                <a class="text-reset border-left text-center p-4 d-block" href="https://global.{{ route('home') }}/privacy-policy/">
                    <i class="la la-support la-3x text-primary mb-2"></i>
                    <h4 class="h6">{{ translate('Support Policy') }}</h4>
                </a>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-3 col-xs-3">
                <a class="text-reset border-left border-right text-center p-4 d-block" href="https://global.{{ route('home') }}/privacy-policy/">
                    <i class="las la-exclamation-circle la-3x text-primary mb-2"></i>
                    <h4 class="h6">{{ translate('Privacy Policy') }}</h4>
                </a>
            </div>
        </div>
    </div>
</section>


<!-- FOOTER -->

<style>
    * {
        margin: 0;
        /*padding: 0;*/
    }

    a {
        color: #fff;
        text-decoration: none;
    }

    .pg-footer {
        font-family: 'Roboto', sans-serif;
    }


    .footer {
        background-color: #041e42;
        color: #fff;
    }

    .footer-wave-svg {
        background-color: transparent;
        display: block;
        height: 30px;
        position: relative;
        top: -1px;
        width: 100%;
    }
    
    h1, h1 span {
        font-family: Rubik;
        line-height: 36px;
        color: #fff;
        font-size: 36px;
    }

    .footer-wave-path {
        fill: #fff;
    }

    .footer-content {
        margin-left: auto;
        margin-right: auto;
        max-width: 91%;
        padding: 40px 15px 450px;
        position: relative;
    }

    .footer-content-column {
        box-sizing: border-box;
        float: left;
        padding-left: 15px;
        padding-right: 15px;
        width: 100%;
        color: #fff;
    }

    .footer-content-column ul li a {
        color: #fff;
        text-decoration: none;
    }

    .footer-logo-link {
        display: inline-block;
    }

    .footer-menu {
        margin-top: 30px;
    }

    .footer-menu-name {
        color: #fffff2;
        font-size: 15px;
        font-weight: 900;
        letter-spacing: .1em;
        line-height: 18px;
        margin-bottom: 0;
        margin-top: 0;
        text-transform: uppercase;
    }

    .footer-menu-list {
        list-style: none;
        margin-bottom: 0;
        margin-top: 10px;
        padding-left: 0;
    }

    .footer-menu-list li {
        margin-top: 5px;
    }

    .footer-call-to-action-description {
        color: #fffff2;
        margin-top: 10px;
        margin-bottom: 20px;
    }

    .footer-call-to-action-button:hover {
        background-color: #fffff2 !important;
        color: #ffc220 !important;
    }

    .button:last-of-type {
        margin-right: 0;
    }

    .footer-call-to-action-button {
        background-color: #f29202;
        border-radius: 21px;
        color: #fffff2 !important;
        display: inline-block;
        font-size: 11px;
        font-weight: 900;
        letter-spacing: .1em;
        line-height: 18px;
        padding: 12px 30px;
        margin: 0 10px 10px 0;
        text-decoration: none;
        text-transform: uppercase;
        transition: background-color .2s;
        cursor: pointer;
        position: relative;
    }

    .footer-call-to-action {
        margin-top: 30px;
    }

    .footer-call-to-action-title {
        color: #fffff2;
        font-size: 14px;
        font-weight: 900;
        letter-spacing: .1em;
        line-height: 18px;
        margin-bottom: 0;
        margin-top: 0;
        text-transform: uppercase;
    }

    .footer-call-to-action-link-wrapper {
        margin-bottom: 0;
        margin-top: 10px;
        color: #fff;
        text-decoration: none;
    }

    .footer-call-to-action-link-wrapper a {
        color: #fff;
        text-decoration: none;
    }




    .footer-social-links {
        bottom: 0;
        height: 54px;
        position: absolute;
        right: 0;
        width: 236px;
    }

    .footer-social-amoeba-svg {
        height: 54px;
        left: 0;
        display: block;
        position: absolute;
        top: 0;
        width: 236px;
    }

    .footer-social-amoeba-path {
        fill: #f29202;
    }

    .footer-social-link.linkedin {
        height: 26px;
        left: 3px;
        top: 11px;
        width: 26px;
    }

    .footer-social-link {
        display: block;
        padding: 10px;
        position: absolute;
    }

    .hidden-link-text {
        position: absolute;
        clip: rect(1px 1px 1px 1px);
        clip: rect(1px, 1px, 1px, 1px);
        -webkit-clip-path: inset(0px 0px 99.9% 99.9%);
        clip-path: inset(0px 0px 99.9% 99.9%);
        overflow: hidden;
        height: 1px;
        width: 1px;
        padding: 0;
        border: 0;
        top: 50%;
    }

    .footer-social-icon-svg {
        display: block;

    }

    .footer-social-icon-path {
        fill: #fffff2;
        transition: fill .2s;
    }

    .footer-social-link.twitter {
        height: 28px;
        left: 62px;
        top: 3px;
        width: 28px;
    }

    .footer-social-link.youtube {
        height: 24px;
        left: 123px;
        top: 12px;
        width: 24px;
    }

    .footer-social-link.github {
        height: 34px;
        left: 172px;
        top: 7px;
        width: 34px;
    }

    .footer-copyright {
        background-color: #F29202 !important;
        color: #fff;
        padding: 15px 30px;
        text-align: center;
    }

    .footer-copyright-wrapper {
        margin-left: auto;
        margin-right: auto;
        max-width: 1200px;
    }

    .footer-copyright-text {
        color: #fff;
        font-size: 13px;
        font-weight: 400;
        line-height: 18px;
        margin-bottom: 0;
        margin-top: 0;
    }

    .footer-copyright-link {
        color: #fff !important;
        text-decoration: none;
        font-size: 15px;
    }
    
    @media(max-width:991px){
        .footer-copyright {
            background-color: #F29202 !important;
            color: #fff;
            padding: 15px 30px;
            text-align: center;
            margin-top: 38%;
            margin-bottom: 17%;
        }
    }




    /* Media Query For different screens */
    @media (min-width:320px) and (max-width:479px) {

        /* smartphones, portrait iPhone, portrait 480x320 phones (Android) */
        .footer-content {
            margin-left: auto;
            margin-right: auto;
            max-width: 91%;
            padding: 40px 15px 1050px;
            position: relative;
        }
    }

    @media (min-width:480px) and (max-width:599px) {

        /* smartphones, Android phones, landscape iPhone */
        .footer-content {
            margin-left: auto;
            margin-right: auto;
            max-width: 91%;
            padding: 40px 15px 1050px;
            position: relative;
        }
    }

    @media (min-width:600px) and (max-width: 800px) {

        /* portrait tablets, portrait iPad, e-readers (Nook/Kindle), landscape 800x480 phones (Android) */
        .footer-content {
            margin-left: auto;
            margin-right: auto;
            max-width: 91%;
            padding: 40px 15px 1050px;
            position: relative;
        }
    }

    @media (min-width:801px) {
        /* tablet, landscape iPad, lo-res laptops ands desktops */

    }

    @media (min-width:1025px) {
        /* big landscape tablets, laptops, and desktops */

    }

    @media (min-width:1281px) {
        /* hi-res laptops and desktops */

    }




    @media (min-width: 760px) {
        .footer-content {
            margin-left: auto;
            margin-right: auto;
            max-width: 91%;
            padding: 40px 15px 450px;
            position: relative;
        }

        .footer-wave-svg {
            height: 50px;
        }

        .footer-content-column {
            width: 24.99%;
        }
    }

    @media (min-width: 568px) {
        /* .footer-content-column {
          width: 49.99%;
        } */
      
        
    }
</style>

  <div class="navLeftFooter nav-sprite-v1" id="navFooter">

        <a href="#top" id="navBackToTop" aria-label="Back to top">
            <div class="navFooterBackToTop">
                <span class="navFooterBackToTopText">
                    TOP OF PAGE
                </span>
            </div>
        </a>
    
    
        <div class="navFooterVerticalColumn navAccessibility" role="presentation">
            <div class="navFooterVerticalRow navAccessibility" style="display: table-row;">
                <div class="navFooterLinkCol navAccessibility">
                    <div class="navFooterColHead">LET US HELP YOU</div>
                    <ul>
                        <li class="nav_first">
                            <a href="/support_tickets" class="nav_a">Customer Help Center</a>
                        </li>
                        <li>
                            <a href="https://global.{{ route('home') }}/shop-on-cusorcart/" class="nav_a">How to Shop on Cusorcart</a>
                        </li>
                        <li>
                            <a href="#" class="nav_a">Shopping/Delivery Timelines </a>
                        </li>
                        <li>
                            <a href="{{ route('home') }}/send-refund-request" class="nav_a">Return a Product</a>
                        </li>
                        <li class="nav_last ">
                            <a href="https://forms.gle/8o9o83jNqa6qVS2p6" class="nav_a"> Report a Product</a>
                        </li>
                    </ul>
 
                    <div class="footer-social">
                    <h6 style="color:#fff">JOIN US ON </h6>
                    <ul >
                        <li><a href="https://facebook.com/cusorcart/"><i class="fab fa-facebook"></i></a></li>
                        <li><a href="https://twitter.com/cusorcart/"><i class="fab fa-twitter"></i></a></li>
                        <li><a href="https://www.youtube.com/channel/UC2A7F6j6-VNB5AasSlER2Mg"><i class="fab fa-youtube"></i></a></li>
                        <li><a href="https://instagram.com/cusorcart/"><i class="fab fa-instagram"></i></a></li>
                    </ul>
                </div>
                </div>
                <div class="navFooterColSpacerInner navAccessibility"></div>
                <div class="navFooterLinkCol navAccessibility">
                    <div class="navFooterColHead">ABOUT CUSORCART</div>
                    <ul>
                        <li class="nav_first">
                            <a href="https://global.{{ route('home') }}/about-us/" class="nav_a">About Us </a>
                        </li>
                        <li>
                            <a href="/blog" class="nav_a">Blog</a>
                        </li>
                        <li>
                            <a href="https://global.{{ route('home') }}/terms-and-conditions/" class="nav_a">Terms & Conditions</a>
                        </li>
                        <li>
                            <a href="https://global.{{ route('home') }}/privacy-policy/" class="nav_a">Privacy Policy</a>
                        </li>
                        <li>
                            <a href="https://global.{{ route('home') }}/how-to-stay-safe/" class="nav_a">How to Stay Safe</a>
                        </li>
                        
                    </ul>
                </div>
                <div class="navFooterColSpacerInner navAccessibility"></div>
                <div class="navFooterLinkCol navAccessibility">
                    <div class="navFooterColHead">INSIDE CUSORCART</div>
                    <ul>
                       
                        <li>
                            <a href="/dashboard" class="nav_a">Your Account</a>
                        </li>
                        <li>
                            <a href="/purchase_history" class="nav_a">Your Orders</a>
                        </li>
                        <li class="nav_last ">
                            <a href="https://global.{{ route('home') }}/returnpolicy/" class="nav_a">Returns & Replacements</a>
                        </li>
                      <li class="nav_last ">
                            <a href="https://global.{{ route('home') }}/shipping-rates-and-policies/" class="nav_a">Shipping Rates & Policies</a>
                        </li>
                        <li class="nav_last ">
                            <a href="https://global.{{ route('home') }}/faq/" class="nav_a">FAQ</a>
                        </li>
                    </ul>
                </div>
                <div class="navFooterColSpacerInner navAccessibility"></div>
                <div class="navFooterLinkCol navAccessibility">
                    <div class="navFooterColHead">MAKE MONEY WITH CUSORCART</div>
                    <ul>
                        <li class="nav_first">
                            <a href="https://global.{{ route('home') }}/seller-hub/" class="nav_a">Sell Product on Cusorcart</a>
                        </li>
                        
                        <li>
                            <a href="https://global.{{ route('home') }}/seller-hub/" class="nav_a">Sell Apps on Cusorcart</a>
                        </li>
                        <li>
                            <a href="https://global.{{ route('home') }}/affiliates/" class="nav_a">Become An Affiliate</a>
                        </li>
                       
                        <li>
                            <a href="https://global.{{ route('home') }}/advertising/" class="nav_a">Advertise Your Products</a>
                        </li>
                        
                    </ul>

                    <div class="navFooterLine navFooterLinkLine navFooterPadItemLine">
                        
                        <span>
                            <div class="navFooterLine navFooterLogoLine">
                                <a href="#">
                                    <div class="nav-logo-base ">
                                        <img src="{{asset('public/uploads/all/footer_logo.png')}}" alt="" style="width: 100px;margin-top: -32px;">                                        
                                    </div>
                                </a>
                            </div>
                            
                        </span><span class="icp-container-desktop">
                            <h6 class="text-left">Download Cusorcart Free App</h6>
                            <div class="navFooterLine">
                                <style type="text/css">
                                    #icp-touch-link-language {
                                        display: none;
                                    }
                                </style>
                
                                <style type="text/css">
                                    #icp-touch-link-cop {
                                        display: none;
                                    }
                                </style>
                
                <a href="#" class="icp-button a-declarative" >
                    <i class="fab fa-google-play"></i><span class="icp-color-base">PLAY STORE</span><span class="aok-hidden" style="display:none">Choose a country/region for shopping.</span>
                </a>
                
                                <style type="text/css">
                                    #icp-touch-link-country {
                                        display: none;
                                    }
                                </style>
                                <a href="#" class="icp-button a-declarative" >
                                    <i class="fab fa-apple"></i><span class="icp-color-base">APP STORE</span><span class="aok-hidden" style="display:none">Choose a country/region for shopping.</span>
                                </a>
                            </div>
                        </span>
                    </div>

                </div>
            </div>
        </div>
      
    

    
        <div class="navFooterLine navFooterLinkLine navFooterPadItemLine navFooterCopyright">
            <span>© 2021, {{ route('home') }}</span>
        </div>
    
    
    </div>








<footer class="nav-mobile nav-ftr-batmobile" id="mob-footer">

    <div id="nav-ftr" class="nav-t-footer-gateway nav-sprite-v3">

        <a id="nav-ftr-gototop" class="nav-a" href="#top" aria-label="Top of page">
            <i class="nav-icon"></i>
            <b class="nav-b">
                Top of page
            </b>
        </a>



        <ul id="nav-ftr-links" class="nav-ftr-links-two-column">

            <li class="nav-li nav-li-right">
                <a class="nav-a " href="https://global.{{ route('home') }}/terms-and-conditions/">
                    <span class="nav-ftr-text">
                        
                        Terms & Conditions
                    </span>
                    <i class="nav-icon nav-sprite"></i>
                </a>
            </li>
            <li class="nav-li nav-li-right">
                <a class="nav-a " href="https://global.{{ route('home') }}/about-us/">
                    <span class="nav-ftr-text">
                        About Us
                    </span>
                    <i class="nav-icon nav-sprite"></i>
                </a>
            </li>
            <li class="nav-li nav-li-right">
                <a class="nav-a " href="https://global.{{ route('home') }}/seller-hub/">
                    <span class="nav-ftr-text">
                        Become a Seller
                    </span>
                    <i class="nav-icon nav-sprite"></i>
                </a>
            </li>
            <li class="nav-li nav-li-right">
                <a class="nav-a " href="#">
                    <span class="nav-ftr-text">
                        Download the Free CusorCart App
                    </span>
                    <i class="nav-icon nav-sprite"></i>
                </a>
            </li>
            <li class="nav-li nav-li-right aok-offscreen nav-hidden">
                <a class="nav-a " href="#" aria-label="Click to call our Disability Customer Support line, or reach us directly at 1-888-283-1678 ">
                    <span class="nav-ftr-text">
                        Disability Customer Support
                    </span>
                    <i class="nav-icon nav-sprite"></i>
                </a>
            </li>
          
            <li class="nav-li ">
                <a class="nav-a " href="{{ route('home') }}/users/login">
                    <span class="nav-ftr-text">
                        Your Account
                    </span>
                    <i class="nav-icon nav-sprite"></i>
                </a>
            </li>
            <li class="nav-li ">
                <a class="nav-a " href="{{ route('home') }}/users/login">
                    <span class="nav-ftr-text">
                        Your Orders
                    </span>
                    <i class="nav-icon nav-sprite"></i>
                </a>
            </li>
            <li class="nav-li ">
                <a class="nav-a " href="{{ route('home') }}/returnpolicy/">
                    <span class="nav-ftr-text">
                        Returns
                    </span>
                    <i class="nav-icon nav-sprite"></i>
                </a>
            </li>
            <li class="nav-li ">
                <a class="nav-a " href="https://global.{{ route('home') }}/docs/">
                    <span class="nav-ftr-text">
                        Customer Service
                    </span>
                    <i class="nav-icon nav-sprite"></i>
                </a>
            </li>
           


        </ul>


       
 @if(Auth::check())
  <div id="nav-ftr-auth">
        <a href="#" class="nav-a">{{ Auth::user()->name }}</a>
        </div>
              
            @else
        <div id="nav-ftr-auth">
            Already a customer?<a href="#" class="nav-a">Sign In</a>
        </div>
        @endif




        <div id="nav-ftr-copyright">
            ©2021, Cusortcart.com
        </div>
         
    </div>
</footer>









<!--<div class="aiz-mobile-bottom-nav d-xl-none fixed-bottom bg-white shadow-lg border-top">-->
<!--    <div class="d-flex justify-content-around align-items-center">-->
<!--        <a href="{{ route('home') }}" class="text-reset flex-grow-1 text-center py-3 border-right {{ areActiveRoutes(['home'],'bg-soft-primary')}}">-->
<!--            <i class="las la-home la-2x"></i>-->
<!--        </a>-->
<!--        <a href="{{ route('categories.all') }}" class="text-reset flex-grow-1 text-center py-3 border-right {{ areActiveRoutes(['categories.all'],'bg-soft-primary')}}">-->
<!--            <span class="d-inline-block position-relative px-2">-->
<!--                <i class="las la-list-ul la-2x"></i>-->
<!--            </span>-->
<!--        </a>-->
<!--        <a href="{{ route('cart') }}" class="text-reset flex-grow-1 text-center py-3 border-right {{ areActiveRoutes(['cart'],'bg-soft-primary')}}">-->
<!--            <span class="d-inline-block position-relative px-2">-->
<!--                <i class="las la-shopping-cart la-2x"></i>-->
<!--                @if(Session::has('cart'))-->
<!--                    <span class="badge badge-circle badge-primary position-absolute absolute-top-right" id="cart_items_sidenav">{{ count(Session::get('cart'))}}</span>-->
<!--                @else-->
<!--                    <span class="badge badge-circle badge-primary position-absolute absolute-top-right" id="cart_items_sidenav">0</span>-->
<!--                @endif-->
<!--            </span>-->
<!--        </a>-->
<!--        @if (Auth::check())-->
<!--            @if(isAdmin())-->
<!--                <a href="{{ route('admin.dashboard') }}" class="text-reset flex-grow-1 text-center py-2">-->
<!--                    <span class="avatar avatar-sm d-block mx-auto">-->
<!--                        @if(Auth::user()->photo != null)-->
<!--                            <img src="{{ custom_asset(Auth::user()->avatar_original)}}">-->
<!--                        @else-->
<!--                            <img src="{{ static_asset('assets/img/avatar-place.png') }}">-->
<!--                        @endif-->
<!--                    </span>-->
<!--                </a>-->
<!--            @else-->
<!--                <a href="javascript:void(0)" class="text-reset flex-grow-1 text-center py-2 mobile-side-nav-thumb" data-toggle="class-toggle" data-target=".aiz-mobile-side-nav">-->
<!--                    <span class="avatar avatar-sm d-block mx-auto">-->
<!--                        @if(Auth::user()->photo != null)-->
<!--                            <img src="{{ custom_asset(Auth::user()->avatar_original)}}">-->
<!--                        @else-->
<!--                            <img src="{{ static_asset('assets/img/avatar-place.png') }}">-->
<!--                        @endif-->
<!--                    </span>-->
<!--                </a>-->
<!--            @endif-->
<!--        @else-->
<!--            <a href="{{ route('user.login') }}" class="text-reset flex-grow-1 text-center py-2">-->
<!--                <span class="avatar avatar-sm d-block mx-auto">-->
<!--                    <img src="{{ static_asset('assets/img/avatar-place.png') }}">-->
<!--                </span>-->
<!--            </a>-->
<!--        @endif-->
<!--    </div>-->
<!--</div>-->
@if (Auth::check() && !isAdmin())
    <div class="aiz-mobile-side-nav collapse-sidebar-wrap sidebar-xl d-xl-none z-1035">
        <div style="z-index: -1;" class="overlay dark c-pointer overlay-fixed" data-toggle="class-toggle" data-target=".aiz-mobile-side-nav" data-same=".mobile-side-nav-thumb"></div>
        <div class="collapse-sidebar bg-white">
            @include('frontend.inc.user_side_nav')
        </div>
    </div>
@endif
