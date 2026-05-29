<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Mailgun, Postmark, AWS and more. This file provides the de facto
    | location for this type of information, allowing packages to have
    | a conventional file to locate the various service credentials.
    |
    */

    'postmark' => [
        'key' => env('POSTMARK_API_KEY'),
    ],

    'resend' => [
        'key' => env('RESEND_API_KEY'),
    ],

    'cal' => [
        'api_base_url' => env('CAL_API_BASE_URL', 'https://api.cal.com/v2'),
        'api_key' => env('CAL_API_KEY'),
        'api_version_slots' => env('CAL_API_VERSION_SLOTS', '2024-09-04'),
        'api_version_bookings' => env('CAL_API_VERSION_BOOKINGS', '2026-02-25'),
        'event_type_id' => env('CAL_EVENT_TYPE_ID'),
        'event_type_slug' => env('CAL_EVENT_TYPE_SLUG', 'free-audit'),
        'username' => env('CAL_USERNAME', 'tommaso-giovannoni-dlhbsf'),
        'timezone' => env('CAL_TIMEZONE', 'Europe/Rome'),
        'slot_lookahead_days' => env('CAL_SLOT_LOOKAHEAD_DAYS', 21),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],

    'slack' => [
        'notifications' => [
            'bot_user_oauth_token' => env('SLACK_BOT_USER_OAUTH_TOKEN'),
            'channel' => env('SLACK_BOT_USER_DEFAULT_CHANNEL'),
        ],
    ],

];
