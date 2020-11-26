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
        \Barryvdh\Cors\HandleCors::class,
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
            \Illuminate\View\Middleware\ShareErrorsFromSession::class,
            // \App\Http\Middleware\VerifyCsrfToken::class,
            \Illuminate\Routing\Middleware\SubstituteBindings::class,
        ],

        'api' => [
            //'throttle:60,1',
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
        'auth.basic' => \Illuminate\Auth\Middleware\AuthenticateWithBasicAuth::class,
        'bindings' => \Illuminate\Routing\Middleware\SubstituteBindings::class,
        'can' => \Illuminate\Auth\Middleware\Authorize::class,
        'guest' => \App\Http\Middleware\RedirectIfAuthenticated::class,
        'throttle' => \Illuminate\Routing\Middleware\ThrottleRequests::class,
        'owner' => \App\Http\Middleware\IsOwner::class,
        'vendor' => \App\Http\Middleware\IsVendor::class,
        'affiliate' => \App\Http\Middleware\IsAffiliate::class,
        'crm' => \App\Http\Middleware\IsCRM::class,
        'lang' => \App\Http\Middleware\Lang::class,
        'o_vendor' => \App\Http\Middleware\Owner\Ven::class,
        'o_customer' => \App\Http\Middleware\Owner\Customer::class,
        'o_admin' => \App\Http\Middleware\Owner\Admin::class,
        'o_affiliate' => \App\Http\Middleware\Owner\Affiliate::class,
        'o_link' => \App\Http\Middleware\Owner\Link::class,
        'o_owner' => \App\Http\Middleware\Owner\Owner::class,
        'o_quantity' => \App\Http\Middleware\Owner\Quantity::class,
        'o_shop' => \App\Http\Middleware\Owner\Shop::class,
        'o_auction' => \App\Http\Middleware\Owner\Auction::class,
        'o_supplier' => \App\Http\Middleware\Owner\Supplier::class,
        'o_b2b' => \App\Http\Middleware\Owner\B2B::class,
        'o_store' => \App\Http\Middleware\Owner\Store::class,
        'o_accessory' => \App\Http\Middleware\Owner\Accessory::class,
        'o_coupon' => \App\Http\Middleware\Owner\Coupon::class,
        'o_purchase' => \App\Http\Middleware\Owner\Purchase::class,
        'o_digital' => \App\Http\Middleware\Owner\Digital::class,
        'cors' => \Barryvdh\Cors\HandleCors::class,
        'track' => \App\Http\Middleware\TrackMiddleware::class,
        'assigning' => \App\Http\Middleware\AssigningMiddleware::class,
      //  'canaccess' => \App\Http\Middleware\CanaccessMiddleware::class,
      //  'access' => \App\Http\Middleware\AccessMiddleware::class,
        'role' => \Spatie\Permission\Middlewares\RoleMiddleware::class,
        'permission' => \Spatie\Permission\Middlewares\PermissionMiddleware::class,
        'role_or_permission' => \Spatie\Permission\Middlewares\RoleOrPermissionMiddleware::class,
        

    ];
}

/*
view all permissions 
add permission
edit permission

view all roles 
add role 
edit role 
delete role 
assign users roles
create users roles
view all admins
create admin
*/



















