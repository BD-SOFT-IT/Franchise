<?php

return [
    'headers' => [
        'Content-Type' => 'application/json'
    ],

    'timeout' => '5.0',

    'cookies' => false,

    'allow_redirects' => false,

    'method' => 'POST',

    'json' => true,

    // Default param name given by your sms gateway
    'default_params'    => [
        'api_key'   => 'api_key',
        'sender'    => 'senderid',
        'sms_type'  => 'type',
        'message'   => 'msg',
        'to'        => 'contacts'
    ],

    'array_to_string_connector' => '+',

    'api_key' => 'C20044035d6fd71561cf83.17634949',

    'sender' => '8809612446000',

    'sms_type' => 'text',

    'base_uri' => 'http://esms.mimsms.com/',

    'uri' => '/smsapi',

    'user_name' => '',

    'password' => '',

    'from' => 'BD SOFT IT',

    'country_code' => '880'

];
