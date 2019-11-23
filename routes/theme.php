<?php

// Front End Routes

Route::get('test', function() {
    echo socialShareLinkGroup(['facebook', 'google', 'twitter', 'pinterest', 'linkedin'], null, 'TITLE', '/img/d.png');
});

Route::get('/', 'IndexController@index')->name('index');

Route::get('privacy-policy', 'StaticPageController@privacyPolicy')->name('privacy-policy');
Route::get('about-us', 'StaticPageController@aboutUs')->name('about-us');
Route::get('shipping-and-returns', 'StaticPageController@shippingReturns')->name('shipping-and-returns');
Route::get('delivery-information', 'StaticPageController@deliveryInformation')->name('delivery-information');
Route::get('secure-shopping', 'StaticPageController@secureShopping')->name('secure-shopping');
Route::get('terms-and-conditions', 'StaticPageController@termsConditions')->name('terms-and-conditions');
Route::get('frequently-asked-questions', 'StaticPageController@faq')->name('faq');
Route::get('contact', 'StaticPageController@contact')->name('contact');

Route::prefix('shop')->group(function () {
    Route::get('/', 'ProductsController@shop')->name('shop');
    Route::get('category/{slug?}', 'ProductsController@shop')->name('category.single');
    Route::get('{slug}', 'ProductsController@show')->name('product.single');
});

Route::middleware('auth')->group(function () {

    Route::get('wishlist', 'IndexController@wishlist')->name('wishlist');

    Route::middleware('verified')->group(function () {
        Route::get('account', 'ClientController@account')->name('account');

        Route::get('order/{no}', 'OrderController@show')->name('order.details');

        Route::get('checkout', 'CheckoutController@index')->name('checkout');
    });
});

// Franchise
Route::get('franchise', 'FranchiseController@register')->name('franchise.register');
