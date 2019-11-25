<?php

/*Route::get('/mailable', function () {
    $client = \App\Client::find(1);
    $token = \Illuminate\Support\Str::random(10);
    return new App\Mail\PasswordReset($client, $token);
});*/

//Seller Routes
Route::group(['prefix' => 'seller'], function (){
    route::get('seller_dashboard/seller-contact', 'SellerPagesController@contact')->name('seller.contact');
    route::get('add-new-product', 'SellerPagesController@addNewProduct')->name('seller.addNewProduct');
    route::get('seller_dashboard/cancel-products', 'SellerPagesController@CanceledProducts')->name('seller.CanceledProducts');
    route::get('seller_dashboard/seller-invoice', 'SellerPagesController@getInvoice')->name('seller.invoice');

    //Seller Auth Routes
    route::get('login','SellerController@showLoginForm')->name('seller.seller-login');
    route::post('dashboard','SellerController@processLogin')->name('seller.test-login');

    route::get('dashboard', 'SellerPagesController@profile')->name('seller.dashboard');


    // Registration processes route section
    route::get('registration', 'SellerPagesController@registration')->name('seller.registration');
    route::post('registration','SellerController@processRegistration')->name('seller.registered');

    route::get('seller_dashboard/approved-products', 'SellerProductController@allApprovedProducts')->name('seller.allApprovedProducts');
    route::post('add-new-product', 'SellerProductController@processNewProduct')
        ->name('seller.addNewProduct');

    route::get('seller_dashboard/edit-product/{edit_product_id}','SellerProductController@editProduct')
        ->name('seller.editProduct');

    route::post('seller_dashboard/update-product/','SellerProductController@updateProduct')
        ->name('seller.updateProduct');

    route::get('seller_dashboard/preview-product/{preview_product_id}','SellerProductController@previewProduct')
        ->name('seller.previewProduct');

    route::get('seller_dashboard/delete-product/{product_id}','SellerProductController@deleteProduct')->name('seller.deleteProduct');


    route::get('pages/auth/seller-logout','SellerController@signout')->name('seller.signout');

});


//Route::get('/products', 'SellerPagesController@products');


// Client Routes

Route::get('sitemap.xml', 'SitemapController@siteMap')->name('sitemap');

Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@loginOrRegister');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');
//Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
//Route::post('register', 'Auth\RegisterController@register');

Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
Route::patch('password/reset', 'Auth\ResetPasswordController@resetClientPassword')->name('password.update');
Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');

Route::get('email/resend', 'Auth\VerificationController@resend')->name('verification.resend');
Route::get('email/verify', 'Auth\VerificationController@show')->name('verification.notice');
Route::get('email/verify/{id}', 'Auth\VerificationController@verify')->name('verification.verify');

Route::get('mobile/resend', 'Auth\VerificationController@resendMobileVerification')->name('verification.mobile.resend');
Route::post('mobile/verify/{id}', 'Auth\VerificationController@verifyMobile')->name('verification.mobile.verify');
//Route::get('account', 'UserController@index')->name('profile');

Route::get('login/{driver}', 'Auth\SocialController@redirectToProvider')->name('login.social');
Route::get('login/{driver}/callback','Auth\SocialController@handleProviderCallback');


// For AXIOS Request
Route::prefix('bs-client-api')->namespace('Api')->group(function () {
    Route::prefix('cart')->group(function () {
        Route::get('/', 'CartController@index')->name('api.cart');
        Route::post('add', 'CartController@add')->name('api.cart.add');
        Route::post('delete', 'CartController@delete')->name('api.cart.delete');
        //Route::delete('destroy', 'CartController@destroy')->name('api.cart.add');
    });

    Route::middleware('auth')->group(function () {
        Route::get('wishlist', 'WishlistController@index')->name('api.wishlist');
        Route::post('wishlist/add', 'WishlistController@store')->name('api.wishlist.add');
        Route::delete('wishlist/delete/{id}', 'WishlistController@remove')->name('api.wishlist.delete');

        Route::post('place-order', 'CheckoutController@placeOrder')->name('api.order.submit')
            ->middleware('verified');

        Route::patch('update-profile', 'UserController@update')->name('api.profile.update')
            ->middleware('verified');
    });

    Route::post('search', 'ProductsController@search')->name('api.search');

    Route::prefix('product')->group(function() {
        Route::get('quick-view/{id}', 'ProductsController@single')->name('api.product.single');
    });

    Route::get('user', 'UserController@user')->name('api.user');

    Route::post('validate-coupon', 'CouponsController@validateCoupon')->name('api.coupon.validate');

    Route::get('delivery-methods', 'CheckoutController@shippingMethods')->name('api.deliveryMethods');

    Route::get('client-settings-cook/{key?}/{value?}', 'UserController@clientSettings');

    Route::post('franchise-register', 'FranchiseController@register')->name('api.franchise.register');
});


