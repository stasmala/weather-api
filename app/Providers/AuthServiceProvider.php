<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Laravel\Passport\Passport;


class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        'Application\Models\Model' => 'Application\Policies\ModeloPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     */

    public function boot(): void
    {
        $this->registerPolicies();

        // Указываем, что используем Passport для аутентификации API
//        Passport::routes(static function (RouteRegistrar $router): void {
//            $router->forAccessTokens();
//        });

        // Настраиваем области доступа токенов, если это необходимо
//        Passport::tokensCan([
//            'place-orders' => 'Place orders',
//            'check-status' => 'Check order status',
//        ]);
    }
}
