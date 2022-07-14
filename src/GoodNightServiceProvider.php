<?php

namespace GoodM4ven\GoodNight;

use Illuminate\Contracts\Http\Kernel;
use Illuminate\Support\Facades\Blade;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class GoodNightServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        /*
         *
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         *
         */
        $package
            ->name('good-night')
            ->hasConfigFile()
            ->hasViews();
    }

    public function bootingPackage()
    {
        $this->registerBladeDirectives();
    }

    public function packageBooted()
    {
        $this->registerMiddleware();
    }

    protected function registerBladeDirectives()
    {
        Blade::directive('goodNight', function () {
            if (config('good-night.switcher-enabled')) {
                return "<?= view('good-night::partials.good-night-switcher')->render(); ?>";
            }

            return "<?= view('good-night::partials.custom-night-switcher')->render(); ?>";
        });
    }

    protected function registerMiddleware()
    {
        $this->app->make(Kernel::class)->appendMiddlewareToGroup('web', DetectSettingChange::class);
    }
}
