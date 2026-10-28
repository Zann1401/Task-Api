<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
<<<<<<< HEAD
    | as Resend, Postmark, AWS, and more. This file provides the de facto
=======
    | as Mailgun, Postmark, AWS and more. This file provides the de facto
>>>>>>> 676b395fa7202dab0829ec243b286da87e6a46fc
    | location for this type of information, allowing packages to have
    | a conventional file to locate the various service credentials.
    |
    */

    'postmark' => [
<<<<<<< HEAD
        'key' => env('POSTMARK_API_KEY'),
    ],

    'resend' => [
        'key' => env('RESEND_API_KEY'),
=======
        'token' => env('POSTMARK_TOKEN'),
>>>>>>> 676b395fa7202dab0829ec243b286da87e6a46fc
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],

<<<<<<< HEAD
=======
    'resend' => [
        'key' => env('RESEND_KEY'),
    ],

>>>>>>> 676b395fa7202dab0829ec243b286da87e6a46fc
    'slack' => [
        'notifications' => [
            'bot_user_oauth_token' => env('SLACK_BOT_USER_OAUTH_TOKEN'),
            'channel' => env('SLACK_BOT_USER_DEFAULT_CHANNEL'),
        ],
    ],

];
