<?php

namespace App\Providers;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;
use Livewire\Livewire;

class AppServiceProvider extends ServiceProvider
{
    private $roles = [
        'SADM' => 0,
        'ADM' => 1,
        'HEAD' => 2,
        'COORDINATOR' => 3,
        'COMPANY' => 4,
        'STUDENT' => 20
    ];

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
        $appRoot = env('APP_ROOT');
        if (!empty($appRoot)) {
            Livewire::setUpdateRoute(fn ($handle) => Route::post(sprintf("/%s/livewire/update", $appRoot), $handle));
        }

        Blade::directive('role', fn ($expression) => sprintf("<?PHP if(auth()->check() && auth()->user()->role==%s): ?>", $this->roles[strtoupper($expression)]));
        Blade::directive('endrole', fn () => "<?PHP endif; ?>");

        URL::forceRootUrl(Config::get('app.url'));
        if (str_contains(Config::get('app.url'), 'https://')) {
            URL::forceScheme('https');
        }
    }
}
