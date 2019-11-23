<?php

/*
 *  Admin Routes
 */

Route::middleware(['auth:admin', 'admin'])->group(function() {
    Route::get('test', function () {
        dd(\App\Models\Client::count());
    });
    /* *************              Shop Management Routes              ************* */
    // Admin Dashboard Route
    Route::get('/', 'HomeController@index')->name('admin.home');

    Route::prefix('shop')->group(function() {
        // Order Routes
        Route::get('orders', 'OrderController@all')->name('admin.orders');
        Route::get('pending-orders', 'OrderController@pending')->name('admin.orders.pending');
        Route::get('delivered-orders', 'OrderController@delivered')->name('admin.orders.delivered');
        Route::get('canceled-orders', 'OrderController@canceled')->name('admin.orders.canceled');
        Route::get('confirmed-orders', 'OrderController@confirmed')->name('admin.orders.confirmed');

        Route::get('orders-for-franchise', 'OrderController@forFranchise')->name('admin.orders.for-franchise');
        Route::get('orders-by-franchise', 'OrderController@byFranchise')->name('admin.orders.by-franchise');

        Route::get('create-order', 'OrderController@create')->name('admin.orders.create');
        Route::get('view-order/{order_no}', 'OrderController@single')->name('admin.orders.single')->where('order_no', '[0-9]+');

        // Order Actions
        Route::get('edit-order/{order_no}', 'OrderController@edit')->name('admin.orders.edit')->where('order_no', '[0-9]+');
        Route::patch('edit-order/{order_no}', 'OrderController@update')->where('order_no', '[0-9]+');
        Route::patch('approve-order', 'OrderController@approve')->name('admin.orders.approve');
        Route::patch('process-order', 'OrderController@process')->name('admin.orders.process');
        Route::patch('deliver-order', 'OrderController@deliver')->name('admin.orders.deliver');
        Route::patch('cancel-order', 'OrderController@cancel')->name('admin.orders.cancel');
        Route::delete('delete-order', 'OrderController@delete')->name('admin.orders.delete');

        // Product Routes
        Route::prefix('products')->group(function() {
            Route::get('/', 'ProductsController@index')->name('admin.products.all');
            Route::get('show/{sku}', 'ProductsController@show')->where('sku', '[A-Za-z0-9]+')->name('admin.products.single');
            Route::get('returned', 'ProductsController@returned')->name('admin.products.returned');
            Route::get('damaged', 'ProductsController@damaged')->name('admin.products.damaged');
            Route::get('create', 'ProductsController@create')->name('admin.products.create');
            Route::get('edit/{id?}', 'ProductsController@edit')->name('admin.products.edit')
                ->where(['id' => '[0-9]+']);
            Route::get('franchise', 'ProductsController@franchise')->name('admin.products.franchise');
        });

        // Product Brands Routes
        Route::prefix('product-brands')->group(function() {
            Route::get('/', 'BrandsController@index')->name('admins.brands');
            Route::get('show/{id}', 'BrandsController@show')->name('admins.brands.single')->where('id', '[0-9]+');
            Route::get('create', 'BrandsController@create')->name('admin.brands.create');
            Route::get('edit/{id}', 'BrandsController@edit')->name('admin.brands.edit');
        });

        // Categories Routes
        Route::prefix('categories')->group(function() {
            Route::get('/', 'CategoriesController@index')->name('admin.categories');
            Route::get('create', 'CategoriesController@create')->name('admin.categories.create');
            Route::get('edit/{id}', 'CategoriesController@edit')->name('admin.categories.edit')->where('id', '[0-9]+');
        });

        Route::prefix('shipper')->group(function () {
            Route::get('/', 'ShipperController@index')->name('admin.shipper.all');
            //Route::get('show/{id}', 'ShipperController@show')->name('admin.admins.single');
            Route::get('create', 'ShipperController@add')->name('admin.shipper.create');
            //Route::post('create', 'ShipperController@store');
            Route::get('edit/{id}', 'ShipperController@edit')->where('id', '[0-9]+')->name('admin.shipper.edit');
            //Route::patch('edit/{id}', 'ShipperController@update')->where('id', '[0-9]+');
            Route::delete('delete', 'ShipperController@delete')->name('admin.shipper.delete');
        });
        // Shipping Method Routes
        Route::prefix('shipping-methods')->group(function () {
            Route::get('/', 'ShippingController@index')->name('admin.shipping');
            Route::get('add', 'ShippingController@add')->name('admin.shipping.add');
            Route::post('add', 'ShippingController@store');
            Route::get('edit/{id}', 'ShippingController@edit')->name('admin.shipping.edit');
            Route::patch('edit/{id}', 'ShippingController@update');
            Route::delete('delete', 'ShippingController@delete')->name('admin.shipping.delete');
        });

        // Customers Routes
        Route::prefix('customers')->group(function () {
            Route::get('/', 'CustomersController@index')->name('admin.customers');
            Route::get('details/{id}', 'CustomersController@show')->name('admin.customers.show');
            Route::get('add', 'CustomersController@add')->name('admin.customers.add');
            Route::post('add', 'CustomersController@store');
            Route::get('edit/{id}', 'CustomersController@edit')->name('admin.customers.edit');
            Route::patch('update/{id}', 'CustomersController@update');
        });

        // Franchise Routes
        Route::prefix('franchise-control')->group(function () {
            Route::get('all', 'FranchiseController@all')->name('admin.franchise-control.all');
            Route::get('show/{id}', 'FranchiseController@show')->name('admin.franchise-control.single');
            Route::get('create', 'FranchiseController@create')->name('admin.franchise-control.add');
            Route::post('create', 'FranchiseController@store');
            Route::get('edit/{id}', 'FranchiseController@edit')->name('admin.franchise-control.edit');
            Route::patch('edit/{id}', 'FranchiseController@update');

            Route::patch('activate/{id}', 'FranchiseController@activate')->name('admin.franchise-control.activate');
            Route::patch('deactivate/{id}', 'FranchiseController@deactivate')->name('admin.franchise-control.deactivate');
        });

        Route::get('checkout', 'HomeController@checkout')->name('admin.franchise.checkout');

        /* Marketing Routes*/
        Route::prefix('marketing')->group(function () {
            //Coupon Routes
            Route::prefix('coupons')->group(function () {
                Route::get('/', 'CouponsController@index')->name('admin.coupon.index');
                Route::get('create', 'CouponsController@create')->name('admin.coupon.create');
                Route::post('create', 'CouponsController@store');
                Route::get('edit/{id}', 'CouponsController@edit')->name('admin.coupon.edit');
                Route::patch('edit/{id}', 'CouponsController@update');
                Route::delete('delete', 'CouponsController@delete')->name('admin.coupon.delete');
            });
        });

        // Shop Preferences Routes
        Route::prefix('preferences')->group(function() {
            Route::get('delivery-locations', 'ShopPreferencesController@locations')->name('admin.shop_preferences.delivery_locations');
            Route::get('delivery-schedules', 'ShopPreferencesController@deliverySchedules')->name('admin.shop_preferences.delivery_schedules');
        });

        // Ads Route
        Route::prefix('ads')->group(function() {
            Route::get('home-sliders', 'BannersController@sliders')->name('admin.ads.sliders');

            Route::get('index-banners', 'BannersController@indexBanners')->name('admin.ads.index_banners');
            Route::get('category-banners', 'BannersController@categoryBanners')->name('admin.ads.category_banners');

            Route::get('sidebar-banner', 'BannersController@sidebarBanner')->name('admin.ads.sidebar_banner');
            Route::post('sidebar-banner', 'BannersController@updateSidebarBanner');
        });
    });
    /* *************              End of Shop Management Routes              ************* */

    /* *************              Web Contents Routes              ************* */

    // Pages
    Route::prefix('pages')->group(function () {
        Route::get('/', 'PageController@index')->name('admin.pages');
        //Route::get('create', 'PageController@create')->name('admin.pages.create');
        Route::get('edit/{id}', 'PageController@edit')->name('admin.pages.edit');
        Route::patch('edit/{id}', 'PageController@update');
    });

    // Media Routes
    Route::get('media-manager', 'MediaController@index')->name('admin.media');

    /* *************              End of Web Contents Routes              ************* */

    /* *************              Admin Controls Routes              ************* */
    Route::prefix('admin-control')->group(function() {
        // Admins Routes
        Route::prefix('admins')->group(function() {
            Route::get('/', 'AdminsController@index')->name('admin.admins.all');
            Route::get('show/{id}', 'AdminsController@show')->name('admin.admins.single');
            Route::get('create', 'AdminsController@add')->name('admin.admins.create');
            Route::post('create', 'AdminsController@store');
            Route::get('edit/{id}', 'AdminsController@edit')->where('id', '[0-9]+')->name('admin.admins.edit');
            Route::patch('edit/{id}', 'AdminsController@update')->where('id', '[0-9]+');
            Route::delete('delete', 'AdminsController@delete')->name('admin.admins.delete');
        });

        // Site Options Route
        Route::prefix('site-information')->group(function () {
            Route::get('/', 'SiteOptionsController@index')->name('shop_info.index');
            Route::post('/save', 'SiteOptionsController@save')->name('shop_info.save');

            Route::get('/config', 'SiteOptionsController@config')->name('shop_info.config');
            Route::post('config/save', 'SiteOptionsController@saveConfig')->name('shop_info.config.save');

            Route::get('/seo-config', 'SiteOptionsController@seo')->name('shop_info.seo');
            Route::patch('/seo-config', 'SiteOptionsController@saveSeo');

            Route::get('/social', 'SiteOptionsController@social')->name('shop_info.social');
            Route::patch('/social', 'SiteOptionsController@saveSocial');

            Route::post('/save-front-theme', 'SiteOptionsController@saveFrontThemeColor')->name('shop_info.front_theme');


        });

        // Api Agent Routes
       /* Route::prefix('api-agents')->group(function() {
            Route::get('/', 'ApiAgentController@index')->name('admin.api_agent');
            Route::get('add', 'ApiAgentController@create')->name('admin.api_agent.add');
            Route::post('add', 'ApiAgentController@store');
            Route::get('edit/{id}', 'ApiAgentController@edit')->where('id', '[0-9]+')->name('admin.api_agent.edit');
            Route::patch('edit/{id}', 'ApiAgentController@update')->where('id', '[0-9]+');
            Route::delete('delete', 'ApiAgentController@delete')->name('admin.api_agent.delete');
        });*/
    });
    /* *************              End of Admin Controls Routes              ************* */


    /* *************              *** Contents Routes              ************* */

    // *** Routes

    /* *************              End of *** Contents Routes              ************* */
});


// Admin Auth Routes
Route::namespace('Auth')->group(function() {
    //Route::post('register', 'RegisterController@register');
    Route::get('login', 'LoginController@showLoginForm')->name('admin.login');
    Route::post('login', 'LoginController@login');
    Route::post('logout', 'LoginController@logout')->name('admin.logout');

    Route::get('password-reset-email', 'ForgotPasswordController@showLinkRequestForm')->name('admin.password.email');
    Route::post('password-reset-email', 'ForgotPasswordController@sendResetLinkEmail');
    Route::get('password-reset/{token}', 'ResetPasswordController@showResetForm')->name('admin.password.reset');
    Route::post('password-reset', 'ResetPasswordController@reset')->name('admin.password.request');
});

//profile of admin
Route::prefix('profile')->group(function () {
    Route::get('/', 'ProfileController@showProfileUpdateForm')->name('admin.profile');
    Route::patch('update', 'ProfileController@ProfileUpdate')->name('admin.profile.update');
    Route::get('reset-password', 'ProfileController@showPasswordChangeForm')->name('admin.profile.security');
    Route::patch('reset-password', 'ProfileController@changePassword');
});

// Admin Setup Route
Route::get('setup', 'SetupController@setup')->name('admin.setup');
Route::post('setup', 'SetupController@saveSetup')->name('admin.setup.save');
