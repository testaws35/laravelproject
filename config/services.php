<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Stripe, Mailgun, SparkPost and others. This file provides a sane
    | default location for this type of information, allowing packages
    | to have a conventional place to find your various credentials.
    |
    */

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
        'endpoint' => env('MAILGUN_ENDPOINT', 'api.mailgun.net'),
    ],

    'postmark' => [
        'token' => env('POSTMARK_TOKEN'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],

    'sparkpost' => [
        'secret' => env('SPARKPOST_SECRET'),
    ],

    'instamojo' => [

        'api_key'       => env('IM_API_KEY'),
    
        'auth_token'    => env('IM_AUTH_TOKEN'),
    
        'url'           => env('IM_URL'),
    
    ],

    'paytm-wallet' => [

        'env' => 'local', // values : (local | production)

        'merchant_id' => env('YOUR_MERCHANT_ID'),

        'merchant_key' => env('YOUR_MERCHANT_KEY'),

        'merchant_website' => env('YOUR_WEBSITE'),

        'channel' => env('YOUR_CHANNEL'),

        'industry_type' => env('YOUR_INDUSTRY_TYPE'),

    ],

    'google' => [

        'client_id' => '936581881777-moeim17i2vboah46408h9ca5jmeh0vgn.apps.googleusercontent.com',

        'client_secret' => 'Ao6XVjtlCDTtKrY6GJxg5pkl',

        'redirect' => 'http://127.0.0.1:8000/auth/google/callback',

    ],

    'stripe' => [
        'model' => App\User::class,
        'key' => env('STRIPE_KEY'),
        'secret' => env('STRIPE_SECRET'),
        'webhook' => [
            'secret' => env('STRIPE_WEBHOOK_SECRET'),
            'tolerance' => env('STRIPE_WEBHOOK_TOLERANCE', 300),
        ],
    ],

];
