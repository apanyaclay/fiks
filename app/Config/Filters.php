<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;
use CodeIgniter\Filters\CSRF;
use CodeIgniter\Filters\DebugToolbar;
use CodeIgniter\Filters\Honeypot;
use CodeIgniter\Filters\InvalidChars;
use CodeIgniter\Filters\SecureHeaders;
use App\Filters\AuthFilter;
use App\Filters\AdminFilter;
use App\Filters\PremiumFilter;
use App\Filters\UserFilter;
use App\Filters\ApiKeyFilter;

class Filters extends BaseConfig
{
    /**
     * Configures aliases for Filter classes to
     * make reading things nicer and simpler.
     */
    public array $aliases = [
        'csrf'          => CSRF::class,
        'toolbar'       => DebugToolbar::class,
        'honeypot'      => Honeypot::class,
        'invalidchars'  => InvalidChars::class,
        'secureheaders' => SecureHeaders::class,
        'authfilter'    => AuthFilter::class,
        'adminfilter'   => AdminFilter::class,
        'premiumfilter' => PremiumFilter::class,
        'userfilter'    => UserFilter::class,
        'apiKey'        => ApiKeyFilter::class, //filter akses api key premium
        'level'          => \App\Filters\LevelFilter::class, //filter akses api key admin
        'level2'          => \App\Filters\LevelFilter2::class, //filter akses api key admin
    ];

    /**
     * List of filter aliases that are always
     * applied before and after every request.
     */
    public array $globals = [
        'before' => [
            // 'honeypot',
            // 'csrf',
            // 'invalidchars',
            'authfilter' => [
                'except' => [
                    'auth', 'auth/*',
                    '/*', 'api/*'
                ]
            ],
            'adminfilter' => [
                'except' => [
                    'auth', 'auth/*',
                    '/', 'api/*'
                ]
            ],
            'premiumfilter' => [
                'except' => [
                    'auth', 'auth/*',
                    '/', 'api/*'
                ]
            ],
            'userfilter' => [
                'except' => [
                    'auth', 'auth/*',
                    '/', 'api/*'
                ]
            ],
        ],
        'after' => [
            'toolbar',
            // 'honeypot',
            // 'secureheaders',
            'authfilter' => [
                'except' => [
                    'admin/*', 'premium/*', 'user/*'
                ]
            ],
            'adminfilter' => [
                'except' => [
                    'admin', 'admin/*'
                ]
            ],
            'premiumfilter' => [
                'except' => [
                    'premium', 'premium/*'
                ]
            ],
            'userfilter' => [
                'except' => [
                    'user', 'user/*'
                ]
            ],
        ],
    ];

    /**
     * List of filter aliases that works on a
     * particular HTTP method (GET, POST, etc.).
     *
     * Example:
     * 'post' => ['foo', 'bar']
     *
     * If you use this, you should disable auto-routing because auto-routing
     * permits any HTTP method to access a controller. Accessing the controller
     * with a method you don’t expect could bypass the filter.
     */
    public array $methods = [];

    /**
     * List of filter aliases that should run on any
     * before or after URI patterns.
     *
     * Example:
     * 'isLoggedIn' => ['before' => ['account/*', 'profiles/*']]
     */
    public array $filters = [
        'apiKey' => [
            'before' => ['api/*'],
        ],
    ];
}
