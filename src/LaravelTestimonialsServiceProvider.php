<?php

namespace DavideCasiraghi\LaravelTestimonials;

use Carbon\Carbon;
use Illuminate\Support\ServiceProvider;

class LaravelTestimonialsServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        /*
         * Optional methods to load your package assets
         */
        $this->loadTranslationsFrom(__DIR__.'/../resources/lang', 'laravel-testimonials');
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'laravel-testimonials');
        $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
        $this->loadRoutesFrom(__DIR__.'/../routes/web.php');

        if (! class_exists('CreateTestimonialsTable')) {
            $this->publishes([
                __DIR__.'/../database/migrations/create_testimonials_table.php.stub' => database_path('migrations/'.Carbon::now()->format('Y_m_d_Hmsu').'_create_testimonials_table.php'),
            ], 'migrations');
        }
        if (! class_exists('CreateTestimonialTranslationsTable')) {
            $this->publishes([
                __DIR__.'/../database/migrations/create_testimonial_translations_table.php.stub' => database_path('migrations/'.Carbon::now()->format('Y_m_d_Hmsu').'_create_testimonial_translations_table.php'),
            ], 'migrations');
        }
        if (! class_exists('CreateTestimonialGroupsTable')) {
            $this->publishes([
                __DIR__.'/../database/migrations/create_testimonial_groups_table.php.stub' => database_path('migrations/'.Carbon::now()->format('Y_m_d_Hmsu').'_create_testimonial_groups_table.php'),
            ], 'migrations');
        }
        if (! class_exists('CreateTestimonialGroupTranslationsTable')) {
            $this->publishes([
                __DIR__.'/../database/migrations/create_testimonial_group_translations_table.php.stub' => database_path('migrations/'.Carbon::now()->format('Y_m_d_Hmsu').'_create_testimonial_group_translations_table.php'),
            ], 'migrations');
        }

        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__.'/../config/config.php' => config_path('laravel-testimonials.php'),
            ], 'config');

            // Publishing the views.
            $this->publishes([
                __DIR__.'/../resources/views' => resource_path('views/vendor/laravel-testimonials'),
            ], 'views');

            $this->publishes([
                __DIR__.'/../resources/assets/sass' => resource_path('sass/vendor/laravel-testimonials/'),
            ], 'sass');

            $this->publishes([
                __DIR__.'/../resources/assets/js' => resource_path('js/vendor/laravel-testimonials/'),
            ], 'js');

            $this->publishes([
                __DIR__.'/../resources/assets/images' => public_path('vendor/laravel-testimonials/assets/images/'),
            ], 'images');

            // Publishing assets.
            /*$this->publishes([
                __DIR__.'/../resources/assets' => public_path('vendor/laravel-testimonials'),
            ], 'assets');*/

            // Publishing the translation files.
            $this->publishes([
                __DIR__.'/../resources/lang' => resource_path('lang/vendor/laravel-testimonials'),
            ], 'lang');

            // Registering package commands.
            // $this->commands([]);
        }
    }

    /**
     * Register the application services.
     */
    public function register()
    {
        // Automatically apply the package configuration
        $this->mergeConfigFrom(__DIR__.'/../config/config.php', 'laravel-testimonials');

        // Register the main class to use with the facade
        $this->app->singleton('laravel-testimonials', function () {
            return new LaravelTestimonials;
        });
    }
}
