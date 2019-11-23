<?php

namespace App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Notifications\AdminResetPasswordNotification;


class Seller extends Authenticatable
{
//    protected $guard = 'seller';

    protected $fillable = ['seller_email','seller_password','seller_name','seller_shop_name','seller_shop_address',
        'seller_shop_postcode','seller_shop_city','seller_shop_district','seller_shop_division','seller_shop_identity',
        'seller_phone_number','seller_account_type'];

//    protected $hidden = [
//        'seller_password', 'remember_token'
//    ];
}
