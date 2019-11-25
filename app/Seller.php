<?php

namespace App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Notifications\AdminResetPasswordNotification;


class Seller extends Authenticatable
{
//    use Notifiable;
//
//    protected $guard = 'seller';

    protected $fillable = [
        'seller_email',
        'seller_password',
        'seller_first_name',
        'seller_last_name',
        'type_of_seller',
        'shop_name',
        'shop_address',
        'shop_road_number',
        'shop_district',
        'shop_url',
        'shop_identity',
        'seller_number',
        'seller_alt_number',
        'seller_terms_conditions',
        'is_active',
        'is_blocked',
    ];

//    protected $hidden = [
//        'seller_password', 'remember_token'
//    ];
}
