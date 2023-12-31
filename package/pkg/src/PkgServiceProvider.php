<?php
namespace Vinh\Pkg;

use App\Http\Controllers\HomeController;
use Illuminate\Support\ServiceProvider;
use Laravel\Fortify\Fortify;

    class PkgServiceProvider extends ServiceProvider {
        public function boot() {
            $this->loadRoutesFrom(__DIR__ . '/routes/web.php');

            $this->loadViewsFrom(__DIR__.'/../resources/views/home', 'pkg');
            $this->loadViewsFrom(__DIR__.'/../resources/views/admin', 'pkg');
            $this->loadViewsFrom(__DIR__.'/../resources/views/auth', 'pkg');
            $this->loadViewsFrom(__DIR__.'/../resources/views', 'pkg');
            
            $this->publishes([
                __DIR__.'/../resources/views' => resource_path('/views/vinh/pkg'),
            ]);

            $this->publishes([
                __DIR__.'/../public' => public_path('vinh/pkg'),
            ], 'public');

            $this->publishes([
                __DIR__.'/Http/Controllers' => app_path('Http/Controllers/vinh/pkg'),
            ]);
        }

        public function register()
        {
            // $this->app->bind(HomeController::class);
            // $this->app->bind(AdminController::class);

        }
    }
?>