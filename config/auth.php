<?php

return [
    'defaults' => [
        'guard' => env('AUTH_GUARD', 'user'),
        'passwords' => env('AUTH_PASSWORD_BROKER', 'users'),
    ],

    'guards' => [
        'user' => [
            'driver' => 'session',
            'provider' => 'users',
        ],
        'employer' => [
            'driver' => 'session',
            'provider' => 'employers'
        ],
        'admin' => [
            'driver' => 'session',
            'provider' => 'admins'
        ],
    ],

    'providers' => [
        'users' => [
            'driver' => 'eloquent',
            'model' => env('AUTH_MODEL', App\Models\User::class),
        ],
        'employers' => [
            'driver' => 'eloquent',
            'model' => App\Models\Employer::class
        ],
        'admins' => [
            'driver' => 'eloquent',
            'model' => App\Models\Admin::class
        ]
    ],

    'passwords' => [
        'users' => [
            'provider' => 'users',
            'table' => env('AUTH_PASSWORD_RESET_TOKEN_TABLE', 'password_reset_tokens'),
            'expire' => 60,
            'throttle' => 60,
        ],
    ],

    'password_timeout' => env('AUTH_PASSWORD_TIMEOUT', 10800),

];
