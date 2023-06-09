<?php

/*
    |--------------------------------------------------------------------------
    | Admin Routes
    |--------------------------------------------------------------------------
    |
    | Here is where you can register admin routes for your application. These
    | routes are loaded by the RouteServiceProvider within a group which
    | contains the "web" middleware group. Now create something great!
    |
    */

    //Support_Ticket
    Route::get('support_ticket/', 'SupportTicketController@admin_index')->name('support_ticket.admin_index');
    Route::get('/logistic/open_ticket/', 'SupportTicketController@admin_dashboard')->name('logistic.open.ticket');
    Route::get('support_ticket/{id}/show', 'SupportTicketController@admin_show')->name('support_ticket.admin_show');
    Route::get('support_ticket/{id}/delete', 'SupportTicketController@admin_delete')->name('support_ticket.admin_delete');
    Route::post('support_ticket/reply', 'SupportTicketController@admin_store')->name('support_ticket.admin_store');

    //conversation of seller customer
    Route::get('dashboard-conversations', 'ConversationController@admin_dashboard')->name('conversations.admin_dashboard');
    Route::get('conversations/{id}/show', 'ConversationController@admin_show')->name('conversations.admin_show');


    //Tracking route
    Route::get('/tracking', 'DashboardController@tracking')->name('dashboard.tracking');
    Route::post('/tracking', 'DashboardController@tracking_post')->name('dashboard.tracking_post');

    Route::get('/dashboard-language', 'DashboardController@language')->name('dashboard.language');

    Route::get('/dashboard-allorder', 'OrderController@all_orders')->name('dashboard.allorder');
    Route::get('/dashboard-pickup', 'DashboardController@pickup_manager')->name('dashboard.pickup');
    Route::get('/dashboard-over-sale', 'DashboardController@sales')->name('dashboard.over.sale');
    Route::post('/delivery-status/{id}', 'DashboardController@delivery_status')->name('delivery.status');

    //shipping route
    Route::get('shipping-detail-index','ShippingDetailController@index')->name('shipping.detail');
    Route::get('shipping-detail-add','ShippingDetailController@create')->name('shipping.create');
    Route::get('shipping-detail/{id}','ShippingDetailController@edit')->name('shipping.edit');
    Route::resource('shipping-detail','ShippingDetailController');
    Route::get('/dashboard_shipping_configuration', 'DashboardController@shipping_configuration')->name('dashboard_shipping.index');

    Route::get('/feedback', 'DashboardController@feedback')->name('dashboard.feedback');
    Route::get('/complaint', 'DashboardController@complaint')->name('dashboard.complaint');
    Route::get('score', 'DashboardController@score')->name('score');
    Route::get('/partner-register', 'DashboardController@p_register')->name('dashboard.partner');

    
    //Wallet details
    Route::get('/dashboard-wallet', 'DashboardController@wallet_transaction')->name('dashboard.wallet');
    Route::get('/bank-detail', 'DashboardController@bankdetail')->name('logic.bank');
    Route::post('/bank-detail-post', 'DashboardController@bankdetailpost')->name('logic.bankpost');
    Route::post('/bank-detail-update', 'DashboardController@bankdetailupdate')->name('logic.bankupdate');


    Route::get('/admin', 'HomeController@admin_dashboard')->name('admin.dashboard')->middleware(['auth', 'admin']);
    Route::group(['prefix' => 'admin', 'middleware' => ['auth', 'admin']], function() {
        //Update Routes

        Route::post('/partner-approve', 'DashboardController@p_approve');
        Route::post('/update', 'UpdateController@step0')->name('update');
        Route::get('/update/step1', 'UpdateController@step1')->name('update.step1');
        Route::get('/update/step2', 'UpdateController@step2')->name('update.step2');

        //Logistic
        Route::get('/logistic', 'DashboardController@dashboard')->name('logistic.dashboard');

        Route::get('conversations', 'ConversationController@admin_index')->name('conversations.admin_index');

        Route::get('state', 'DashboardController@importExportView');
        Route::get('city', 'DashboardController@importExportView1');
        Route::get('country', 'DashboardController@importExportView2');


        Route::post('import', 'DashboardController@import')->name('import');
        Route::post('import1', 'DashboardController@import1')->name('import1');
        Route::post('import2', 'DashboardController@import2')->name('import2');


        Route::resource('categories', 'CategoryController');
        Route::get('support_ticket/create', 'SupportTicketController@create')->name('support_ticket.create');
        Route::post('support_ticket/adminstore', 'SupportTicketController@adminstore')->name('support_ticket.adminstore');
        Route::get('/categories/edit/{id}', 'CategoryController@edit')->name('categories.edit');
        Route::get('/categories/destroy/{id}', 'CategoryController@destroy')->name('categories.destroy');
        Route::post('/categories/featured', 'CategoryController@updateFeatured')->name('categories.featured');

        Route::resource('brands', 'BrandController');
        Route::get('/brands/edit/{id}', 'BrandController@edit')->name('brands.edit');
        Route::get('/brands/destroy/{id}', 'BrandController@destroy')->name('brands.destroy');

        Route::get('/products/admin', 'ProductController@admin_products')->name('products.admin');
        Route::get('/products/seller', 'ProductController@seller_products')->name('products.seller');
        Route::get('/products/all', 'ProductController@all_products')->name('products.all');
        Route::get('/products/create', 'ProductController@create')->name('products.create');
        Route::get('/products/admin/{id}/edit', 'ProductController@admin_product_edit')->name('products.admin.edit');
        Route::get('/products/seller/{id}/edit', 'ProductController@seller_product_edit')->name('products.seller.edit');
        Route::post('/products/todays_deal', 'ProductController@updateTodaysDeal')->name('products.todays_deal');
        Route::post('/products/featured', 'ProductController@updateFeatured')->name('products.featured');
        Route::post('/products/get_products_by_subcategory', 'ProductController@get_products_by_subcategory')->name('products.get_products_by_subcategory');
        Route::post('/bulk-product-delete', 'ProductController@bulk_product_delete')->name('bulk-product-delete');
        


        Route::resource('sellers', 'SellerController');
        Route::get('sellers_ban/{id}', 'SellerController@ban')->name('sellers.ban');
        Route::get('/sellers/destroy/{id}', 'SellerController@destroy')->name('sellers.destroy');
        Route::post('/bulk-seller-delete', 'SellerController@bulk_seller_delete')->name('bulk-seller-delete');
        Route::get('/sellers/view/{id}/verification', 'SellerController@show_verification_request')->name('sellers.show_verification_request');
        Route::get('/sellers/approve/{id}', 'SellerController@approve_seller')->name('sellers.approve');
        Route::get('/sellers/reject/{id}', 'SellerController@reject_seller')->name('sellers.reject');
        Route::post('/sellers/clear', 'SellerController@clear_seller')->name('sellers.clear');
        Route::get('/sellers/login/{id}', 'SellerController@login')->name('sellers.login');
        Route::post('/sellers/payment_modal', 'SellerController@payment_modal')->name('sellers.payment_modal');
        Route::get('/seller/payments', 'PaymentController@payment_histories')->name('sellers.payment_histories');
        Route::get('/seller/payments/show/{id}', 'PaymentController@show')->name('sellers.payment_history');

        Route::resource('customers', 'CustomerController');
        Route::get('customers_ban/{customer}', 'CustomerController@ban')->name('customers.ban');
        Route::get('/customers/login/{id}', 'CustomerController@login')->name('customers.login');
        Route::get('/customers/destroy/{id}', 'CustomerController@destroy')->name('customers.destroy');
        Route::post('/bulk-customer-delete', 'CustomerController@bulk_customer_delete')->name('bulk-customer-delete');

        Route::get('/newsletter', 'NewsletterController@index')->name('newsletters.index');
        Route::get('/newsletter/custom', 'NewsletterController@index_custom')->name('newsletters.index_custom');
        Route::post('/newsletter/send', 'NewsletterController@send')->name('newsletters.send');
        Route::post('/newsletter/send/custom', 'NewsletterController@send_custom')->name('newsletters.send_custom');
        Route::post('/newsletter/test/smtp', 'NewsletterController@testEmail')->name('test.smtp');

        Route::resource('profile', 'ProfileController');
        Route::get('logisticprofile/{id}','ProfileController@logistic')->name('logistic.profile');
        Route::post('/business-settings/update', 'BusinessSettingsController@update')->name('business_settings.update');
        Route::post('/business-settings/update/activation', 'BusinessSettingsController@updateActivationSettings')->name('business_settings.update.activation');
        Route::get('/general-setting', 'BusinessSettingsController@general_setting')->name('general_setting.index');
        Route::get('/admin-setting', 'BusinessSettingsController@general_setting')->name('admin_setting.index');
        Route::get('/activation', 'BusinessSettingsController@activation')->name('activation.index');
        Route::get('/payment-method', 'BusinessSettingsController@payment_method')->name('payment_method.index');
        Route::get('/file_system', 'BusinessSettingsController@file_system')->name('file_system.index');
        Route::get('/social-login', 'BusinessSettingsController@social_login')->name('social_login.index');
        Route::get('/smtp-settings', 'BusinessSettingsController@smtp_settings')->name('smtp_settings.index');
        Route::get('/google-analytics', 'BusinessSettingsController@google_analytics')->name('google_analytics.index');
        Route::get('/google-recaptcha', 'BusinessSettingsController@google_recaptcha')->name('google_recaptcha.index');

        //Facebook Settings
        Route::get('/facebook-chat', 'BusinessSettingsController@facebook_chat')->name('facebook_chat.index');
        Route::post('/facebook_chat', 'BusinessSettingsController@facebook_chat_update')->name('facebook_chat.update');
        Route::get('/facebook-comment', 'BusinessSettingsController@facebook_comment')->name('facebook-comment');
        Route::post('/facebook-comment', 'BusinessSettingsController@facebook_comment_update')->name('facebook-comment.update');
        Route::post('/facebook_pixel', 'BusinessSettingsController@facebook_pixel_update')->name('facebook_pixel.update');

        Route::post('/env_key_update', 'BusinessSettingsController@env_key_update')->name('env_key_update.update');
        Route::post('/payment_method_update', 'BusinessSettingsController@payment_method_update')->name('payment_method.update');
        Route::post('/google_analytics', 'BusinessSettingsController@google_analytics_update')->name('google_analytics.update');
        Route::post('/google_recaptcha', 'BusinessSettingsController@google_recaptcha_update')->name('google_recaptcha.update');
        //Currency
        Route::get('/currency', 'CurrencyController@currency')->name('currency.index');
        Route::post('/currency/update', 'CurrencyController@updateCurrency')->name('currency.update');
        Route::post('/your-currency/update', 'CurrencyController@updateYourCurrency')->name('your_currency.update');
        Route::get('/currency/create', 'CurrencyController@create')->name('currency.create');
        Route::post('/currency/store', 'CurrencyController@store')->name('currency.store');
        Route::post('/currency/currency_edit', 'CurrencyController@edit')->name('currency.edit');
        Route::post('/currency/update_status', 'CurrencyController@update_status')->name('currency.update_status');

        //Tax
        Route::resource('tax', 'TaxController');
        Route::get('/tax/edit/{id}', 'TaxController@edit')->name('tax.edit');
        Route::get('/tax/destroy/{id}', 'TaxController@destroy')->name('tax.destroy');
        Route::post('tax-status', 'TaxController@change_tax_status')->name('taxes.tax-status');


        Route::get('/verification/form', 'BusinessSettingsController@seller_verification_form')->name('seller_verification_form.index');
        Route::post('/verification/form', 'BusinessSettingsController@seller_verification_form_update')->name('seller_verification_form.update');
        Route::get('/vendor_commission', 'BusinessSettingsController@vendor_commission')->name('business_settings.vendor_commission');
        Route::post('/vendor_commission_update', 'BusinessSettingsController@vendor_commission_update')->name('business_settings.vendor_commission.update');

        Route::resource('/languages', 'LanguageController');
        Route::post('/languages/{id}/update', 'LanguageController@update')->name('languages.update');
        Route::get('/languages/destroy/{id}', 'LanguageController@destroy')->name('languages.destroy');
        Route::post('/languages/update_rtl_status', 'LanguageController@update_rtl_status')->name('languages.update_rtl_status');
        Route::post('/languages/key_value_store', 'LanguageController@key_value_store')->name('languages.key_value_store');

        // website setting
        Route::group(['prefix' => 'website'], function() {
            Route::view('/header', 'backend.website_settings.header')->name('website.header');
            Route::view('/footer', 'backend.website_settings.footer')->name('website.footer');
            Route::view('/pages', 'backend.website_settings.pages.index')->name('website.pages');
            Route::view('/appearance', 'backend.website_settings.appearance')->name('website.appearance');
            Route::resource('custom-pages', 'PageController');
            Route::get('/custom-pages/edit/{id}', 'PageController@edit')->name('custom-pages.edit');
            Route::get('/custom-pages/destroy/{id}', 'PageController@destroy')->name('custom-pages.destroy');
        });

        Route::resource('roles', 'RoleController');
        Route::get('/roles/edit/{id}', 'RoleController@edit')->name('roles.edit');
        Route::get('/roles/destroy/{id}', 'RoleController@destroy')->name('roles.destroy');

        Route::resource('staffs', 'StaffController');
        Route::get('/staffs/destroy/{id}', 'StaffController@destroy')->name('staffs.destroy');

        Route::resource('flash_deals', 'FlashDealController');
        Route::get('/flash_deals/edit/{id}', 'FlashDealController@edit')->name('flash_deals.edit');
        Route::get('/flash_deals/destroy/{id}', 'FlashDealController@destroy')->name('flash_deals.destroy');
        Route::post('/flash_deals/update_status', 'FlashDealController@update_status')->name('flash_deals.update_status');
        Route::post('/flash_deals/update_featured', 'FlashDealController@update_featured')->name('flash_deals.update_featured');
        Route::post('/flash_deals/product_discount', 'FlashDealController@product_discount')->name('flash_deals.product_discount');
        Route::post('/flash_deals/product_discount_edit', 'FlashDealController@product_discount_edit')->name('flash_deals.product_discount_edit');

        //Subscribers
        Route::get('/subscribers', 'SubscriberController@index')->name('subscribers.index');
        Route::get('/subscribers/destroy/{id}', 'SubscriberController@destroy')->name('subscriber.destroy');

        Route::get('/orders', 'OrderController@admin_orders')->name('orders.index.admin');
        Route::get('/orders/{id}/show', 'OrderController@show')->name('orders.show');
        Route::get('/sales/{id}/show', 'OrderController@sales_show')->name('sales.show');
        Route::get('/sales', 'OrderController@sales')->name('sales.index');
        // All Orders
        Route::get('/all_orders', 'OrderController@all_orders')->name('all_orders.index');
        Route::get('/all_orders/{id}/show', 'OrderController@all_orders_show')->name('all_orders.show');

        // Inhouse Orders
        Route::get('/inhouse-orders', 'OrderController@admin_orders')->name('inhouse_orders.index');
        Route::get('/inhouse-orders/{id}/show', 'OrderController@show')->name('inhouse_orders.show');

        // Seller Orders
        Route::get('/seller_orders', 'OrderController@seller_orders')->name('seller_orders.index');
        Route::get('/seller_orders/{id}/show', 'OrderController@seller_orders_show')->name('seller_orders.show');

        Route::post('/bulk-order-status', 'OrderController@bulk_order_status')->name('bulk-order-status');


        // Pickup point orders
        Route::get('orders_by_pickup_point', 'OrderController@pickup_point_order_index')->name('pick_up_point.order_index');
        Route::get('/orders_by_pickup_point/{id}/show', 'OrderController@pickup_point_order_sales_show')->name('pick_up_point.order_show');

        Route::get('/orders/destroy/{id}', 'OrderController@destroy')->name('orders.destroy');
        Route::post('/bulk-order-delete', 'OrderController@bulk_order_delete')->name('bulk-order-delete');

        Route::post('/pay_to_seller', 'CommissionController@pay_to_seller')->name('commissions.pay_to_seller');

        //Reports
        Route::get('/stock_report', 'ReportController@stock_report')->name('stock_report.index');
        Route::get('/in_house_sale_report', 'ReportController@in_house_sale_report')->name('in_house_sale_report.index');
        Route::get('/seller_sale_report', 'ReportController@seller_sale_report')->name('seller_sale_report.index');
        Route::get('/wish_report', 'ReportController@wish_report')->name('wish_report.index');
        Route::get('/user_search_report', 'ReportController@user_search_report')->name('user_search_report.index');
        Route::get('/wallet-history', 'ReportController@wallet_transaction_history')->name('wallet-history.index');

        //Blog Section
        Route::resource('blog-category', 'BlogCategoryController');
        Route::get('/blog-category/destroy/{id}', 'BlogCategoryController@destroy')->name('blog-category.destroy');
        Route::resource('blog', 'BlogController');
        Route::get('/blog/destroy/{id}', 'BlogController@destroy')->name('blog.destroy');
        Route::post('/blog/change-status', 'BlogController@change_status')->name('blog.change-status');

        //Coupons
        Route::resource('coupon', 'CouponController');
        Route::post('/coupon/get_form', 'CouponController@get_coupon_form')->name('coupon.get_coupon_form');
        Route::post('/coupon/get_form_edit', 'CouponController@get_coupon_form_edit')->name('coupon.get_coupon_form_edit');
        Route::get('/coupon/destroy/{id}', 'CouponController@destroy')->name('coupon.destroy');

        //Reviews
        Route::get('/reviews', 'ReviewController@index')->name('reviews.index');
        Route::post('/reviews/published', 'ReviewController@updatePublished')->name('reviews.published');

        //Support_Ticket
        Route::get('support_ticket/', 'SupportTicketController@admin_index')->name('support_ticket.admin_index');
        Route::get('open_ticket/', 'SupportTicketController@admin_dashboard')->name('open.ticket');
        Route::get('support_ticket/{id}/show', 'SupportTicketController@admin_show')->name('support_ticket.admin_show');
        Route::post('support_ticket/reply', 'SupportTicketController@admin_store')->name('support_ticket.admin_store');

        //Pickup_Points
        Route::resource('pick_up_points', 'PickupPointController');
        Route::get('/pick_up_points/edit/{id}', 'PickupPointController@edit')->name('pick_up_points.edit');
        Route::get('/pick_up_points/destroy/{id}', 'PickupPointController@destroy')->name('pick_up_points.destroy');

        Route::post('/sellers/profile_modal', 'SellerController@profile_modal')->name('sellers.profile_modal');
        Route::post('/sellers/approved', 'SellerController@updateApproved')->name('sellers.approved');

        Route::resource('attributes', 'AttributeController');
        Route::get('/attributes/edit/{id}', 'AttributeController@edit')->name('attributes.edit');
        Route::get('/attributes/destroy/{id}', 'AttributeController@destroy')->name('attributes.destroy');

        //Attribute Value
        Route::post('/store-attribute-value', 'AttributeController@store_attribute_value')->name('store-attribute-value');
        Route::get('/edit-attribute-value/{id}', 'AttributeController@edit_attribute_value')->name('edit-attribute-value');
        Route::post('/update-attribute-value/{id}', 'AttributeController@update_attribute_value')->name('update-attribute-value');
        Route::get('/destroy-attribute-value/{id}', 'AttributeController@destroy_attribute_value')->name('destroy-attribute-value');

        //Colors
        Route::get('/colors', 'AttributeController@colors')->name('colors');
        Route::post('/colors/store', 'AttributeController@store_color')->name('colors.store');
        Route::get('/colors/edit/{id}', 'AttributeController@edit_color')->name('colors.edit');
        Route::post('/colors/update/{id}', 'AttributeController@update_color')->name('colors.update');
        Route::get('/colors/destroy/{id}', 'AttributeController@destroy_color')->name('colors.destroy');

        Route::resource('addons', 'AddonController');
        Route::post('/addons/activation', 'AddonController@activation')->name('addons.activation');

        Route::get('/customer-bulk-upload/index', 'CustomerBulkUploadController@index')->name('customer_bulk_upload.index');
        Route::post('/bulk-user-upload', 'CustomerBulkUploadController@user_bulk_upload')->name('bulk_user_upload');
        Route::post('/bulk-customer-upload', 'CustomerBulkUploadController@customer_bulk_file')->name('bulk_customer_upload');
        Route::get('/user', 'CustomerBulkUploadController@pdf_download_user')->name('pdf.download_user');
        //Customer Package

        Route::resource('customer_packages', 'CustomerPackageController');
        Route::get('/customer_packages/edit/{id}', 'CustomerPackageController@edit')->name('customer_packages.edit');
        Route::get('/customer_packages/destroy/{id}', 'CustomerPackageController@destroy')->name('customer_packages.destroy');

        //Classified Products
        Route::get('/classified_products', 'CustomerProductController@customer_product_index')->name('classified_products');
        Route::post('/classified_products/published', 'CustomerProductController@updatePublished')->name('classified_products.published');

        //Shipping Configuration
        Route::get('/shipping_configuration', 'BusinessSettingsController@shipping_configuration')->name('shipping_configuration.index');
        Route::post('/shipping_configuration/update', 'BusinessSettingsController@shipping_configuration_update')->name('shipping_configuration.update');

        Route::resource('pages', 'PageController');
        Route::get('/pages/destroy/{id}', 'PageController@destroy')->name('pages.destroy');

        Route::resource('countries', 'CountryController');
        Route::get('countries_loc', 'CountryController@index')->name('dashboard.location');
        Route::post('/countries/status', 'CountryController@updateStatus')->name('countries.status');
        Route::get('/countries/destroy/{id}', 'CountryController@destroy')->name('countries.delete');

        Route::resource('cities', 'CityController');
        Route::get('/cities/edit/{id}', 'CityController@edit')->name('cities.edit');
        Route::get('/cities/destroy/{id}', 'CityController@destroy')->name('cities.destroy');
        
        
        Route::resource('states', 'StateController');
        Route::get('/states/edit/{id}', 'StateController@edit')->name('states.edit');
        Route::get('/states/destroy/{id}', 'StateController@destroy')->name('states.destroy');
        

        Route::view('/system/update', 'backend.system.update')->name('system_update');
        Route::view('/system/server-status', 'backend.system.server_status')->name('system_server');

        // uploaded files
        Route::any('/uploaded-files/file-info', 'AizUploadController@file_info')->name('uploaded-files.info');
        Route::resource('/uploaded-files', 'AizUploadController');
        Route::get('/uploaded-files/destroy/{id}', 'AizUploadController@destroy')->name('uploaded-files.destroy');
        Route::post('/destroy-selected-files', 'AizUploadController@delete_multiple')->name('uploaded-files.delete_multiple');
    });
