<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;
use Laravel\Sanctum\Http\Middleware\CheckAbilities;
use Laravel\Sanctum\Http\Middleware\CheckForAnyAbility;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        ini_set('memory_limit', '-1');
        ini_set('max_execution_time', '300'); // 300 seconds = 5 minutes
        ini_set('post_max_size', '100M');
        ini_set('upload_max_filesize', '100M');
        ini_set('max_file_uploads', '200');
        // Route::aliasMiddleware('ability', CheckAbilities::class);
        // Route::aliasMiddleware('abilities', CheckForAnyAbility::class);
        // $this->routes(function () {
        //     // Rutas web
        //     Route::middleware('web')
        //         ->group(base_path('routes/web.php'));

        //     // Rutas api
        //     Route::prefix('api')
        //         ->middleware('api')
        //         ->group(base_path('routes/api.php'));
        // });
    }
}
