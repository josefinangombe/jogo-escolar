<?php

namespace App\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * Caminho padrão após login (opcional)
     */
    public const HOME = '/home';

    /**
     * Bootstrap das rotas da aplicação.
     */
    public function boot(): void
    {
        $this->routes(function () {

            // 🔹 ROTAS DA API
            Route::middleware('api')
                ->prefix('api')
                ->group(base_path('routes/api.php'));

            // 🔹 ROTAS WEB
            Route::middleware('web')
                ->group(base_path('routes/web.php'));
        });
    }
}