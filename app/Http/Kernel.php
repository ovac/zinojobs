<?php

namespace App\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel
{
    /**
     * The application's global HTTP middleware stack.
     *
     * These middleware are run during every request to your application.
     *
     * @var array
     */
    protected $middleware = [
        \Illuminate\Foundation\Http\Middleware\CheckForMaintenanceMode::class,
        \Illuminate\Foundation\Http\Middleware\ValidatePostSize::class,
        \App\Http\Middleware\TrimStrings::class,
        \Illuminate\Foundation\Http\Middleware\ConvertEmptyStringsToNull::class,
        \App\Http\Middleware\TrustProxies::class,
    ];

    /**
     * The application's route middleware groups.
     *
     * @var array
     */
    protected $middlewareGroups = [
        'web' => [
            \App\Http\Middleware\EncryptCookies::class,
            \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,
            \Illuminate\Session\Middleware\StartSession::class,
            \Illuminate\Session\Middleware\AuthenticateSession::class,
            \Illuminate\View\Middleware\ShareErrorsFromSession::class,
            \App\Http\Middleware\VerifyCsrfToken::class,
            \Illuminate\Routing\Middleware\SubstituteBindings::class,
        ],

        'api' => [
            'throttle:60,1',
            'bindings',
        ],
    ];

    /**
     * The application's route middleware.
     *
     * These middleware may be assigned to groups or used individually.
     *
     * @var array
     */
    protected $routeMiddleware = [
        'auth' => \Illuminate\Auth\Middleware\Authenticate::class,
        'quarx' => \App\Http\Middleware\Quarx::class,
        'quarx-api' => \App\Http\Middleware\QuarxApi::class,
        'quarx-analytics' => \Yab\Quarx\Middleware\QuarxAnalytics::class,
        'quarx-language' => \App\Http\Middleware\QuarxLanguage::class,
        'admin' => \App\Http\Middleware\Admin::class,
        'active' => \App\Http\Middleware\Active::class,
        'auth.basic' => \Illuminate\Auth\Middleware\AuthenticateWithBasicAuth::class,
        'bindings' => \Illuminate\Routing\Middleware\SubstituteBindings::class,
        'can' => \Illuminate\Auth\Middleware\Authorize::class,
        'guest' => \App\Http\Middleware\RedirectIfAuthenticated::class,
        'throttle' => \Illuminate\Routing\Middleware\ThrottleRequests::class,
        'admin' => \App\Http\Middleware\Admin::class,
        'permissions' => \App\Http\Middleware\Permissions::class,
        'roles' => \App\Http\Middleware\Roles::class,
        'active' => \App\Http\Middleware\Active::class,
        'can-employ' => \App\Http\Middleware\CanEmploy::class,
        'application-access' => \App\Http\Middleware\ApplicationAccess::class,
        'job-access' => \App\Http\Middleware\JobAccess::class,
        'message-access' => \App\Http\Middleware\MessageAccess::class,
    ];
}
