<?php

/*
 *  Admin API Routes
 */

Route::middleware(['checkSA', 'admin', 'auth:admin'])->group(function() {

    /* Order Routes */
    Route::get('orders/{type}', 'OrderAxiosController@getOrders')->name('admin.api.orders');
    Route::post('orders/create', 'OrderAxiosController@store');

    /* Products Routes */
    Route::prefix('products')->group(function() {
        Route::get('all', 'ProductsController@getAll')->name('admin.api.products.all');
        Route::post('add', 'ProductsController@store')->name('admin.api.products.add');
        Route::patch('update-general/{id}', 'ProductsController@updateGeneral')->where('id', '[0-9]+');
        Route::patch('update-options/{id}', 'ProductsController@updateOptions')->where('id', '[0-9]+');
        Route::patch('update-vendor/{id}', 'ProductsController@updateVendor')->where('id', '[0-9]+');
        Route::patch('update-meta/{id}', 'ProductsController@updateMeta')->where('id', '[0-9]+');
        Route::patch('update-app-data/{id}', 'ProductsController@updateAppData')->where('id', '[0-9]+');
        Route::patch('update-images/{id}', 'ProductsController@updateImages')->where('id', '[0-9]+');
        Route::delete('delete/{id}', 'ProductsController@delete')->where('id', '[0-9]+');

        Route::get('franchise', 'ProductsController@franchiseProducts')->name('admin.api.products.franchise');
        Route::get('{id}', 'ProductsController@getSingle')->name('admin.api.products.single')->where('id', '[0-9]+');
    });

    // Product Brands Routes
    Route::prefix('product-brands')->group(function() {
        Route::get('/', 'BrandsController@getAll')->name('admin.api.brands.all');
        Route::get('{id}', 'BrandsController@single')->name('admin.api.brands.single')->where('id', '[0-9]+');
        Route::post('create', 'BrandsController@store')->name('admin.api.brands.create');
        Route::get('brand-selector-data', 'BrandsController@brandSelectionData')->name('admin.api.brands.selection');
        Route::delete('delete/{id}', 'BrandsController@delete')->where('id', '[0-9]+');
        Route::patch('update/{id}', 'BrandsController@update')->where('id', '[0-9]+');
    });

    /* Categories Routes */
    Route::prefix('categories')->group(function() {
        Route::get('all', 'CategoriesController@all')->name('admin.api.categories.all');
        Route::get('select-parent-for/{for}', 'CategoriesController@parentCategoriesFor')->where('for', '[A-Za-z]+');
        Route::post('add-new-cat', 'CategoriesController@store');
        Route::get('single/{id}', 'CategoriesController@single')->where('id', '[0-9]+');
        Route::patch('edit-cat/{id}', 'CategoriesController@update')->where('id', '[0-9]+');
    });

    // Shipper Route
    Route::prefix('shipper')->group(function () {
        Route::post('create', 'ShipperController@store')->name('admin.api.shipper.create');
        Route::patch('edit/{id}', 'ShipperController@update')->where('id', '[0-9]+')->name('admin.api.shipper.edit');
        Route::delete('delete', 'ShipperController@delete')->name('admin.api.shipper.delete');
    });

    // Customers Routes
    Route::prefix('customers')->group(function () {
        Route::get('/all', 'CustomersController@all')->name('admin.api.clients.all');
        Route::patch('change/{id}', 'CustomersController@changeStatus')->name('admin.api.clients.delete')
            ->where('id', '[0-9]+');
    });

    // Franchise Routes
    Route::prefix('franchise-control')->group(function () {
        Route::get('/all', 'FranchiseController@all')->name('admin.api.franchise-control.all');
        Route::delete('delete/{id}', 'FranchiseController@delete')->name('admin.api.franchise-control.delete')
            ->where('id', '[0-9]+');
    });

    /* Ads Routes */
    Route::prefix('ads')->group(function() {
        Route::get('home-sliders', 'BannersController@sliders')->name('admin.api.ads.sliders');
        Route::post('home-sliders', 'BannersController@saveHomeSlider');

        Route::get('index-banners', 'BannersController@indexBanners')->name('admin.api.ads.index_banners');
        Route::post('index-banners', 'BannersController@updateIndexBanners');

        Route::get('category-banners/{id}', 'BannersController@categoryBanners');
        Route::post('category-banners', 'BannersController@updateCategoryBanner')->name('admin.api.ads.category_banners');
    });

    // Shop Preferences Routes
    Route::prefix('shop-preferences')->namespace('ShopPreferences')->group(function() {
        // Location Routes
        Route::prefix('locations')->group(function() {
            Route::get('/', 'LocationsController@index')->name('admin.api.shop_preferences.locations');
            Route::get('schedules-for-location', 'LocationsController@schedulesForLocation');
            Route::post('add', 'LocationsController@storeLocation');
            Route::get('edit/{id}', 'LocationsController@editLocation')->where('id', '[0-9]+');
            Route::patch('edit/{id}', 'LocationsController@updateLocation')->where('id', '[0-9]+');
            Route::get('view/{id}', 'LocationsController@viewLocation')->where('id', '[0-9]+');
            Route::delete('delete/{id}', 'LocationsController@delete')->where('id', '[0-9]+');
        });
        // Schedule Routes
        Route::prefix('schedules')->group(function() {
            Route::get('/', 'SchedulesController@index')->name('admin.api.shop_preferences.schedules');
            Route::get('show/{id}', 'SchedulesController@show')->where('id', '[0-9]+');
            Route::post('add', 'SchedulesController@store');
            Route::patch('edit/{id}', 'SchedulesController@update')->where('id', '[0-9]+');
            Route::delete('delete/{id}', 'SchedulesController@delete')->where('id', '[0-9]+');
        });
    });

    Route::namespace('Franchise')->group(function () {
        Route::prefix('cart')->group(function () {
            Route::get('/', 'CartController@index')->name('admin.api.cart');
            Route::post('add', 'CartController@add')->name('admin.api.cart.add');
            Route::post('delete', 'CartController@delete')->name('admin.api.cart.delete');
        });

        Route::post('place-order', 'CheckoutController@placeOrder')->name('admin.api.franchise.place-order');
    });

    /* Admin/s Profile Routes */
    Route::get('admins/me', 'AdminController@me');

    /* Admin Notification Routes */
    Route::prefix('admin-notification')->group(function() {
        Route::get('pending-orders', 'AdminNotificationsController@pendingOrders');
        Route::get('orders-in-progress', 'AdminNotificationsController@orderInProgress');
    });

});
