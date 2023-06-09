<!DOCTYPE html>
@if(\App\Language::where('code', Session::get('locale', Config::get('app.locale')))->first()->rtl == 1)
<html dir="rtl" lang="{{ str_replace('_', '-', app()->getLocale()) }}">
@else
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
@endif
<head>

    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="app-url" content="{{ getBaseURL() }}">
    <meta name="file-base-url" content="{{ getFileBaseURL() }}">

    <title>@yield('meta_title', get_setting('website_name').' | '.get_setting('site_motto'))</title>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="index, follow">
    <meta name="description" content="@yield('meta_description', get_setting('meta_description') )" />
    <meta name="keywords" content="@yield('meta_keywords', get_setting('meta_keywords') )">

    @yield('meta')

    @if(!isset($detailedProduct) && !isset($customer_product) && !isset($shop) && !isset($page) && !isset($blog))
    <!-- Schema.org markup for Google+ -->
    <meta itemprop="name" content="{{ get_setting('meta_title') }}">
    <meta itemprop="description" content="{{ get_setting('meta_description') }}">
    <meta itemprop="image" content="{{ uploaded_asset(get_setting('meta_image')) }}">

    <!-- Twitter Card data -->
    <meta name="twitter:card" content="product">
    <meta name="twitter:site" content="@publisher_handle">
    <meta name="twitter:title" content="{{ get_setting('meta_title') }}">
    <meta name="twitter:description" content="{{ get_setting('meta_description') }}">
    <meta name="twitter:creator" content="@author_handle">
    <meta name="twitter:image" content="{{ uploaded_asset(get_setting('meta_image')) }}">

    <!-- Open Graph data -->
    <meta property="og:title" content="{{ get_setting('meta_title') }}" />
    <meta property="og:type" content="website" />
    <meta property="og:url" content="{{ route('home') }}" />
    <meta property="og:image" content="{{ uploaded_asset(get_setting('meta_image')) }}" />
    <meta property="og:description" content="{{ get_setting('meta_description') }}" />
    <meta property="og:site_name" content="{{ env('APP_NAME') }}" />
    <meta property="fb:app_id" content="{{ env('FACEBOOK_PIXEL_ID') }}">
    @endif


    <!-- Favicon -->
    <link rel="icon" href="{{ url('/public/frontend/img/site_icon.png') }}">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i&display=swap" rel="stylesheet">

    <!-- CSS Files -->
    <link rel="stylesheet" href="{{ static_asset('assets/css/vendors.css') }}">
    @if(\App\Language::where('code', Session::get('locale', Config::get('app.locale')))->first()->rtl == 1)
    <link rel="stylesheet" href="{{ static_asset('assets/css/bootstrap-rtl.min.css') }}">
    @endif
    <link rel="stylesheet" href="{{ static_asset('assets/css/aiz-core.css') }}">
    <link rel="stylesheet" href="{{ static_asset('assets/css/custom-style.css') }}">
    
     <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
  <script>
    $(document).ready(function() {
         $('.aiz-text-editor').summernote({
        height: 300
      });
    });
  </script>

    <script>
        var AIZ = AIZ || {};
        AIZ.local = {
            nothing_found: '{{ translate('Nothing found') }}',
            choose_file: '{{ translate('Choose file') }}',
            file_selected: '{{ translate('File selected') }}',
            files_selected: '{{ translate('Files selected') }}',
            add_more_files: '{{ translate('Add more files') }}',
            adding_more_files: '{{ translate('Adding more files') }}',
            drop_files_here_paste_or: '{{ translate('Drop files here, paste or') }}',
            browse: '{{ translate('Browse') }}',
            upload_complete: '{{ translate('Upload complete') }}',
            upload_paused: '{{ translate('Upload paused') }}',
            resume_upload: '{{ translate('Resume upload') }}',
            pause_upload: '{{ translate('Pause upload') }}',
            retry_upload: '{{ translate('Retry upload') }}',
            cancel_upload: '{{ translate('Cancel upload') }}',
            uploading: '{{ translate('Uploading') }}',
            processing: '{{ translate('Processing') }}',
            complete: '{{ translate('Complete') }}',
            file: '{{ translate('File') }}',
            files: '{{ translate('Files') }}',
        }
    </script>

    <style>
        *{
            font-family: 'Open Sans' !important;
            font-weight: 400;
        }
        body{
            font-family: 'Open Sans' !important;
            font-weight: 400;
        }
        :root{
            /*--primary: {{ get_setting('base_color', '#e62d04') }};*/
             --primary: #102847;
            /*--hov-primary: {{ get_setting('base_hov_color', '#c52907') }};*/
             --primary: #102847;
            --soft-primary: {{ hex2rgba(get_setting('base_color','#e62d04'),.15) }};
        }
        
        #addToCart-modal-body .slick-list{
            height:auto !important;
        }
    </style>

@if (\App\BusinessSetting::where('type', 'google_analytics')->first()->value == 1)
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id={{ env('TRACKING_ID') }}"></script>

    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());
        gtag('config', '{{ env('TRACKING_ID') }}');
    </script>
@endif

@if (\App\BusinessSetting::where('type', 'facebook_pixel')->first()->value == 1)
    <!-- Facebook Pixel Code -->
    <script>
        !function(f,b,e,v,n,t,s)
        {if(f.fbq)return;n=f.fbq=function(){n.callMethod?
        n.callMethod.apply(n,arguments):n.queue.push(arguments)};
        if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
        n.queue=[];t=b.createElement(e);t.async=!0;
        t.src=v;s=b.getElementsByTagName(e)[0];
        s.parentNode.insertBefore(t,s)}(window, document,'script',
        'https://connect.facebook.net/en_US/fbevents.js');
        fbq('init', '{{ env('FACEBOOK_PIXEL_ID') }}');
        fbq('track', 'PageView');
    </script>
    <noscript>
        <img height="1" width="1" style="display:none" src="https://www.facebook.com/tr?id={{ env('FACEBOOK_PIXEL_ID') }}&ev=PageView&noscript=1"/>
    </noscript>
    <!-- End Facebook Pixel Code -->
@endif

@php
    echo get_setting('header_script');
@endphp
    <link rel="stylesheet" href="{{asset('public/assets/css/style_header.css')}}">
     <link rel="stylesheet" href="{{asset('public/assets/css/mobile_header.css')}}">
      <!--<link rel="stylesheet" href="{{asset('public/assets/css/mobile_header2.css')}}">-->
  

    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300&display=swap" rel="stylesheet">

<style>
    div,strong,span,button,a,small{
        font-family: 'Open Sans', sans-serif !important;
    }
    
</style>
 <script src="https://code.jquery.com/jquery-3.4.1.js"></script>
      
 
<style>
    @import url('https://fonts.googleapis.com/css?family=Poppins:400,500,600,700&display=swap');
*{
  /*margin: 0;*/
  /*padding: 0;*/
  user-select: none;
  box-sizing: border-box;
  font-family: 'Poppins', sans-serif;
}
.btn1{
  position: absolute;
  top: 10px;
  left: 0;
  height: 45px;
  width: 45px;
  text-align: center;

  cursor: pointer;
  transition: left 0.4s ease;
}
.btn1.click{
  left: 350px;
  position:fixed;
}
.btn1 i{
  color: white;
  font-size: 28px;
  line-height: 45px;
}
.btn1.click i:before{
  content: '\f00d';
}
.sidebar{
  position: fixed;
  width: 350px;
  height: 100%;
  left: -350px;
  background: #ffffff;
  transition: left 0.4s ease;
  z-index: 1000;
}

@media (max-width:991px){
 .nav-mobile{
     margin-bottom:135px !important;
 }   
 
  .nav-ftr-batmobile{
     margin-bottom:0 !important;
 }   
}


@media (max-width:480px){
    .sidebar{
  width: 300px;
  
  left: -300px;

}

.btn1.click{
  left: 300px;

}

}


.sidebar.show{
  left: 0px;
}
.sidebar .text{
  color: white;
  font-size: 25px;
  font-weight: 600;
  line-height: 65px;
  text-align: center;
  background: #1e1e1e;
  letter-spacing: 1px;
}

h1, h1 span {
    font-family: Rubik;
    line-height: 36px;
    color: #000 !important;
    font-size: 36px;
}

nav ul{
  background: #ffffff;
  height: 100%;
  width: 100%;
  list-style: none;
  margin:0;
overflow-y: scroll;
}
nav ul li{
  line-height: 60px;
  border-top: 1px solid rgba(255,255,255,0.1);
      list-style: none;
}
nav ul li:last-child{
  border-bottom: 1px solid rgba(255,255,255,0.05);
}
nav ul li a{
  position: relative;
  color: #1e1e1e !important;
  text-decoration: none;
  font-size: 14px;
  padding-left: 40px;
  font-weight: 500;
  display: block;
  width: 100%;
  border-left: 3px solid transparent;
}
nav ul li.active a{
  color: #1e1e1e;
    background: #eaeded;
    border-left-color: #1e1e1e;
}
nav ul li a:hover{
  background: #eaeded;
}
nav ul ul{
  position: static;
  display: none;
}
nav ul .feat-show.show{
  display: block;
}
nav ul .serv-show.show1{
  display: block;
}
nav ul ul li{
  line-height: 42px;
  border-top: none;
}
nav ul ul li a{
  font-size: 17px;
  color: #1e1e1e !important;
  padding-left: 80px;
}
nav ul li.active ul li a{
  color: #1e1e1e;
  background: #ffffff;
  border-left-color: transparent;
}
nav ul ul li a:hover{
  color: #fff!important;
  background: #1e1e1e!important;
}
nav ul li a span{
  position: absolute;
  top: 50%;
  right: 20px;
  transform: translateY(-50%);
  font-size: 22px;
  transition: transform 0.4s;
}
nav ul li a span.rotate{
  transform: translateY(-50%) rotate(-180deg);
}
.content{
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%,-50%);
  color: #202020;
  z-index: -1;
  text-align: center;
}
.content .header{
  font-size: 45px;
  font-weight: 600;
}
.content p{
  font-size: 30px;
  font-weight: 500;
}

.goog-logo-link{
    display:none !important;
}

.goog-te-banner-frame {
    display:none !important;
}

body{
        top: 0 !important;
}

.skiptranslate{
        background-color: #102847;
    color: #102847 !important;
    
}

.freez{
    position: fixed;
    width: 100%;
    height: 100%;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
}

@media (max-width:991px){
    .skiptranslate{
        background-color: #0d141e;
        color: #0d141e !important;
    }
    .btn1 i {
        color: white;
        font-size: 22px;
        line-height: 25px;
    }
}



.la, .las {
    font-family: 'Line Awesome Free' !important;
}

.fa, .far, .fas {
    font-family: "Font Awesome 5 Free" !important;
}

.fab {
    font-family: "Font Awesome 5 Brands" !important;
}

</style>
<script src="https://kit.fontawesome.com/5fe4a5af8f.js" crossorigin="anonymous"></script>
</head>
<body>
    
      @include('frontend.inc.sidebar')

    <div id="overlay" onclick="closeNav()"></div>

    <div id="closeBtn" onclick="closeNav()">&times;</div>
   
   <div class="btn1" onclick="openNav()" style="z-index:1000;">
         <i class="fas fa-bars"></i>
      </div>     
   
 
   
   
   
    <!-- aiz-main-wrapper -->
        
        
    <div class="aiz-main-wrapper d-flex flex-column">
<!--<div class="position-relative top-banner removable-session z-1035" data-key="top-banner" data-value="removed">-->
<!--    <a href="#" class="d-block text-reset">-->
<!--        <img src="https://demo.activeitzone.com/ecommerce/public/uploads/all/VhEx0nvy8mDVDBjnCOdhZmuTSqsq6jJkvagvdhSK.png" class="w-100 mw-100 h-50px h-lg-auto img-fit">-->
<!--    </a>-->
<!--    <button class="btn text-white absolute-top-right set-session" data-key="top-banner" data-value="removed" data-toggle="remove-parent" data-parent=".top-banner">-->
<!--        <i class="la la-close la-2x"></i>-->
<!--    </button>-->
<!--</div>-->
        <!-- Header -->
        
@include('frontend.inc.nav')

 <style>
     .shows{
         display:block !important;
     }
     
     .category-menu{
         padding-right: 20px;
    padding-left: 36px;
    padding-top: 5px;
    font-weight: bold;
    text-transform: uppercase;
     }
     
     .hmenu-separator{
         border-bottom: 1px solid #d5dbdb;
    padding: 0;
    margin: 5px 0;
     }
 </style>
 


        @yield('content')

        @include('frontend.inc.footer')

    </div>
    
    </div>
     
    

    @if (get_setting('show_cookies_agreement') == 'on')
        <div class="aiz-cookie-alert shadow-xl">
            <div class="p-3 bg-dark rounded">
                <div class="text-white mb-3">
                    @php
                        echo get_setting('cookies_agreement_text');
                    @endphp
                </div>
                <button class="btn btn-primary aiz-cookie-accepet">
                    {{ translate('Ok. I Understood') }}
                </button>
            </div>
        </div>
    @endif

    @include('frontend.partials.modal')

    <div class="modal fade" id="addToCart">
        <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-zoom product-modal" id="modal-size" role="document">
            <div class="modal-content position-relative">
                <div class="c-preloader text-center p-3">
                    <i class="las la-spinner la-spin la-3x"></i>
                </div>
                <button type="button" class="close absolute-top-right btn-icon close z-1" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" class="la-2x">&times;</span>
                </button>
                <div id="addToCart-modal-body">

                </div>
            </div>
        </div>
    </div>

    @yield('modal')

    <!-- SCRIPTS -->
    <script src="{{ static_asset('assets/js/vendors.js') }}"></script>
    <script src="{{ static_asset('assets/js/aiz-core.js') }}"></script>

<script>
    $(document).ready(function(){
        $("#myModal").modal('show');
    });
</script>



    @if (get_setting('facebook_chat') == 1)
        <script type="text/javascript">
            window.fbAsyncInit = function() {
                FB.init({
                  xfbml            : true,
                  version          : 'v3.3'
                });
              };

              (function(d, s, id) {
              var js, fjs = d.getElementsByTagName(s)[0];
              if (d.getElementById(id)) return;
              js = d.createElement(s); js.id = id;
              js.src = 'https://connect.facebook.net/en_US/sdk/xfbml.customerchat.js';
              fjs.parentNode.insertBefore(js, fjs);
            }(document, 'script', 'facebook-jssdk'));
        </script>
        <div id="fb-root"></div>
        <!-- Your customer chat code -->
        <div class="fb-customerchat"
          attribution=setup_tool
          page_id="{{ env('FACEBOOK_PAGE_ID') }}">
        </div>
    @endif

    <script>
        @foreach (session('flash_notification', collect())->toArray() as $message)
            AIZ.plugins.notify('{{ $message['level'] }}', '{{ $message['message'] }}');
        @endforeach
    </script>

    <script>

        $(document).ready(function() {
            $('.category-nav-element').each(function(i, el) {
                $(el).on('mouseover', function(){
                    if(!$(el).find('.sub-cat-menu').hasClass('loaded')){
                        $.post('{{ route('category.elements') }}', {_token: AIZ.data.csrf, id:$(el).data('id')}, function(data){
                            $(el).find('.sub-cat-menu').addClass('loaded').html(data);
                        });
                    }
                });
            });
            if ($('#lang-change').length > 0) {
                $('#lang-change .dropdown-menu a').each(function() {
                    $(this).on('click', function(e){
                        e.preventDefault();
                        var $this = $(this);
                        var locale = $this.data('flag');
                        $.post('{{ route('language.change') }}',{_token: AIZ.data.csrf, locale:locale}, function(data){
                            location.reload();
                        });

                    });
                });
            }

            if ($('#currency-change').length > 0) {
                $('#currency-change .dropdown-menu a').each(function() {
                    $(this).on('click', function(e){
                        e.preventDefault();
                        var $this = $(this);
                        var currency_code = $this.data('currency');
                        $.post('{{ route('currency.change') }}',{_token: AIZ.data.csrf, currency_code:currency_code}, function(data){
                            location.reload();
                        });

                    });
                });
            }
        });

        $('#search').on('keyup', function(){
            search();
        });

        $('#search').on('focus', function(){
            search();
        });

        function search(){
            var searchKey = $('#search').val();
            if(searchKey.length > 0){
                $('body').addClass("typed-search-box-shown");

                $('.typed-search-box').removeClass('d-none');
                $('.search-preloader').removeClass('d-none');
                $.post('{{ route('search.ajax') }}', { _token: AIZ.data.csrf, search:searchKey}, function(data){
                    if(data == '0'){
                        // $('.typed-search-box').addClass('d-none');
                        $('#search-content').html(null);
                        $('.typed-search-box .search-nothing').removeClass('d-none').html('Sorry, nothing found for <strong>"'+searchKey+'"</strong>');
                        $('.search-preloader').addClass('d-none');

                    }
                    else{
                        $('.typed-search-box .search-nothing').addClass('d-none').html(null);
                        $('#search-content').html(data);
                        $('.search-preloader').addClass('d-none');
                    }
                });
            }
            else {
                $('.typed-search-box').addClass('d-none');
                $('body').removeClass("typed-search-box-shown");
            }
        }
        
        
        $('#search1').on('keyup', function(){
            search1();
        });

        $('#search1').on('focus', function(){
            search1();
        });

        function search1(){
            var searchKey = $('#search1').val();
            if(searchKey.length > 0){
                $('body').addClass("typed-search-box-shown");

                $('.typed-search-box').removeClass('d-none');
                $('.search-preloader').removeClass('d-none');
                $.post('{{ route('search.ajax') }}', { _token: AIZ.data.csrf, search:searchKey}, function(data){
                    if(data == '0'){
                        // $('.typed-search-box').addClass('d-none');
                        $('#search1-content').html(null);
                        $('.typed-search-box .search-nothing').removeClass('d-none').html('Sorry, nothing found for <strong>"'+searchKey+'"</strong>');
                        $('.search-preloader').addClass('d-none');

                    }
                    else{
                        $('.typed-search-box .search-nothing').addClass('d-none').html(null);
                        $('#search1-content').html(data);
                        $('.search-preloader').addClass('d-none');
                    }
                });
            }
            else {
                $('.typed-search-box').addClass('d-none');
                $('body').removeClass("typed-search-box-shown");
            }
        }
        
        
        
        
        
        
        

        function updateNavCart(){
            $.post('{{ route('cart.nav_cart') }}', {_token: AIZ.data.csrf }, function(data){
                $('#cart_items').html(data);
            });
        }

        function removeFromCart(key){
            $.post('{{ route('cart.removeFromCart') }}', {_token: AIZ.data.csrf, key:key}, function(data){
                updateNavCart();
                $('#cart-summary').html(data);
                AIZ.plugins.notify('success', 'Item has been removed from cart');
                $('#cart_items_sidenav').html(parseInt($('#cart_items_sidenav').html())-1);
            });
        }

        function addToCompare(id){
            $.post('{{ route('compare.addToCompare') }}', {_token: AIZ.data.csrf, id:id}, function(data){
                $('#compare').html(data);
                AIZ.plugins.notify('success', "{{ translate('Item has been added to compare list') }}");
                $('#compare_items_sidenav').html(parseInt($('#compare_items_sidenav').html())+1);
            });
        }

        function addToWishList(id){
            @if (Auth::check() && (Auth::user()->user_type == 'customer' || Auth::user()->user_type == 'seller'))
                $.post('{{ route('wishlists.store') }}', {_token: AIZ.data.csrf, id:id}, function(data){
                    if(data != 0){
                        $('#wishlist').html(data);
                        AIZ.plugins.notify('success', "{{ translate('Item has been added to wishlist') }}");
                    }
                    else{
                        AIZ.plugins.notify('warning', "{{ translate('Please login first') }}");
                    }
                });
            @else
                AIZ.plugins.notify('warning', "{{ translate('Please login first') }}");
            @endif
        }

        function showAddToCartModal(id){
            if(!$('#modal-size').hasClass('modal-lg')){
                $('#modal-size').addClass('modal-lg');
            }
            $('#addToCart-modal-body').html(null);
            $('#addToCart').modal();
            $('.c-preloader').show();
            $.post('{{ route('cart.showCartModal') }}', {_token: AIZ.data.csrf, id:id}, function(data){
                $('.c-preloader').hide();
                $('#addToCart-modal-body').html(data);
                AIZ.plugins.slickCarousel();
                AIZ.plugins.zoom();
                AIZ.extra.plusMinus();
                getVariantPrice();
            });
        }

        $('#option-choice-form input').on('change', function(){
            getVariantPrice();
        });

        function getVariantPrice(){
            if($('#option-choice-form input[name=quantity]').val() > 0 && checkAddToCartValidity()){
                $.ajax({
                   type:"POST",
                   url: '{{ route('products.variant_price') }}',
                   data: $('#option-choice-form').serializeArray(),
                   success: function(data){

                        $('.product-gallery-thumb .carousel-box').each(function (i) {
                            if($(this).data('variation') && data.variation == $(this).data('variation')){
                                $('.product-gallery-thumb').slick('slickGoTo', i);
                            }
                        })

                       $('#option-choice-form #chosen_price_div').removeClass('d-none');
                       $('#option-choice-form #chosen_price_div #chosen_price').html(data.price);
                       $('#available-quantity').html(data.quantity);
                       $('.input-number').prop('max', data.quantity);
                       if(parseInt(data.quantity) < 1 && data.digital  == 0){
                           $('.buy-now').hide();
                           $('.add-to-cart').hide();
                       }
                       else{
                           $('.buy-now').show();
                           $('.add-to-cart').show();
                       }
                   }
               });
            }
        }

        function checkAddToCartValidity(){
            var names = {};
            $('#option-choice-form input:radio').each(function() { // find unique names
                  names[$(this).attr('name')] = true;
            });
            var count = 0;
            $.each(names, function() { // then count them
                  count++;
            });

            if($('#option-choice-form input:radio:checked').length == count){
                return true;
            }

            return false;
        }

        function addToCart(){
            if(checkAddToCartValidity()) {
                $('#addToCart').modal();
                $('.c-preloader').show();
                $.ajax({
                   type:"POST",
                   url: '{{ route('cart.addToCart') }}',
                   data: $('#option-choice-form').serializeArray(),
                   success: function(data){
                       $('#addToCart-modal-body').html(null);
                       $('.c-preloader').hide();
                       $('#modal-size').removeClass('modal-lg');
                       $('#addToCart-modal-body').html(data.view);
                       updateNavCart();
                       $('#cart_items_sidenav').html(parseInt($('#cart_items_sidenav').html())+1);
                   }
               });
            }
            else{
                AIZ.plugins.notify('warning', 'Please choose all the options');
            }
        }

        function buyNow(){
            if(checkAddToCartValidity()) {
                $('#addToCart-modal-body').html(null);
                $('#addToCart').modal();
                $('.c-preloader').show();
                $.ajax({
                   type:"POST",
                   url: '{{ route('cart.addToCart') }}',
                   data: $('#option-choice-form').serializeArray(),
                   success: function(data){
                       if(data.status == 1){
                            updateNavCart();
                            $('#cart_items_sidenav').html(parseInt($('#cart_items_sidenav').html())+1);
                            window.location.replace("{{ route('cart') }}");
                       }
                       else{
                            $('#addToCart-modal-body').html(null);
                            $('.c-preloader').hide();
                            $('#modal-size').removeClass('modal-lg');
                            $('#addToCart-modal-body').html(data.view);
                       }
                   }
               });
            }
            else{
                AIZ.plugins.notify('warning', 'Please choose all the options');
            }
        }

        function show_purchase_history_details(order_id)
        {
            $('#order-details-modal-body').html(null);

            if(!$('#modal-size').hasClass('modal-lg')){
                $('#modal-size').addClass('modal-lg');
            }

            $.post('{{ route('purchase_history.details') }}', { _token : AIZ.data.csrf, order_id : order_id}, function(data){
                $('#order-details-modal-body').html(data);
                $('#order_details').modal();
                $('.c-preloader').hide();
            });
        }

        function show_order_details(order_id)
        {
            $('#order-details-modal-body').html(null);

            if(!$('#modal-size').hasClass('modal-lg')){
                $('#modal-size').addClass('modal-lg');
            }

            $.post('{{ route('orders.details') }}', { _token : AIZ.data.csrf, order_id : order_id}, function(data){
                $('#order-details-modal-body').html(data);
                $('#order_details').modal();
                $('.c-preloader').hide();
            });
        }

        function cartQuantityInitialize(){
            $('.btn-number').click(function(e) {
                e.preventDefault();

                fieldName = $(this).attr('data-field');
                type = $(this).attr('data-type');
                var input = $("input[name='" + fieldName + "']");
                var currentVal = parseInt(input.val());

                if (!isNaN(currentVal)) {
                    if (type == 'minus') {

                        if (currentVal > input.attr('min')) {
                            input.val(currentVal - 1).change();
                        }
                        if (parseInt(input.val()) == input.attr('min')) {
                            $(this).attr('disabled', true);
                        }

                    } else if (type == 'plus') {

                        if (currentVal < input.attr('max')) {
                            input.val(currentVal + 1).change();
                        }
                        if (parseInt(input.val()) == input.attr('max')) {
                            $(this).attr('disabled', true);
                        }

                    }
                } else {
                    input.val(0);
                }
            });

            $('.input-number').focusin(function() {
                $(this).data('oldValue', $(this).val());
            });

            $('.input-number').change(function() {

                minValue = parseInt($(this).attr('min'));
                maxValue = parseInt($(this).attr('max'));
                valueCurrent = parseInt($(this).val());

                name = $(this).attr('name');
                if (valueCurrent >= minValue) {
                    $(".btn-number[data-type='minus'][data-field='" + name + "']").removeAttr('disabled')
                } else {
                    alert('Sorry, the minimum value was reached');
                    $(this).val($(this).data('oldValue'));
                }
                if (valueCurrent <= maxValue) {
                    $(".btn-number[data-type='plus'][data-field='" + name + "']").removeAttr('disabled')
                } else {
                    alert('Sorry, the maximum value was reached');
                    $(this).val($(this).data('oldValue'));
                }


            });
            $(".input-number").keydown(function(e) {
                // Allow: backspace, delete, tab, escape, enter and .
                if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 190]) !== -1 ||
                    // Allow: Ctrl+A
                    (e.keyCode == 65 && e.ctrlKey === true) ||
                    // Allow: home, end, left, right
                    (e.keyCode >= 35 && e.keyCode <= 39)) {
                    // let it happen, don't do anything
                    return;
                }
                // Ensure that it is a number and stop the keypress
                if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
                    e.preventDefault();
                }
            });
        }

         function imageInputInitialize(){
             $('.custom-input-file').each(function() {
                 var $input = $(this),
                     $label = $input.next('label'),
                     labelVal = $label.html();

                 $input.on('change', function(e) {
                     var fileName = '';

                     if (this.files && this.files.length > 1)
                         fileName = (this.getAttribute('data-multiple-caption') || '').replace('{count}', this.files.length);
                     else if (e.target.value)
                         fileName = e.target.value.split('\\').pop();

                     if (fileName)
                         $label.find('span').html(fileName);
                     else
                         $label.html(labelVal);
                 });

                 // Firefox bug fix
                 $input
                     .on('focus', function() {
                         $input.addClass('has-focus');
                     })
                     .on('blur', function() {
                         $input.removeClass('has-focus');
                     });
             });
         }

    </script>

    @yield('script')

    @php
        echo get_setting('footer_script');
    @endphp
    <center>
    <div id="google_translate_element"></div>
</center>
 <script type="text/javascript">
        function googleTranslateElementInit() {
            new google.translate.TranslateElement({ pageLanguage: 'en', includedLanguages: "es,en,fr" }, 'google_translate_element');
        }
 </script>
 <script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
</body>
</html>
