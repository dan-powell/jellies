<?php namespace DanPowell\Jellies;

class JelliesServiceProvider extends \Illuminate\Support\ServiceProvider
{

    /**
     * Register bindings in the container.
     *
     * @return void
     */
    public function register()
    {

        // Merge configs
        $this->mergeConfigFrom(__DIR__ . '/../config/encounter.php', 'jellies.encounter');
        $this->mergeConfigFrom(__DIR__ . '/../config/enemy.php', 'jellies.enemy');
        $this->mergeConfigFrom(__DIR__ . '/../config/incursion.php', 'jellies.incursion');
        $this->mergeConfigFrom(__DIR__ . '/../config/minion.php', 'jellies.minion');
        $this->mergeConfigFrom(__DIR__ . '/../config/ui.php', 'jellies.ui');
        $this->mergeConfigFrom(__DIR__ . '/../config/user.php', 'jellies.user');

        // Tell Laravel where to load the views from
        $this->app->register('DanPowell\Jellies\Providers\ViewComposerServiceProvider');

    }

    /**
     * Register bindings in the container.
     *
     * @return void
     */
    public function boot()
    {

        $this->loadRoutesFrom(__DIR__ . '/../routes/web.php');

        $this->loadTranslationsFrom(__DIR__ . '/../resources/lang', 'jellies');

        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'jellies');

        // Publish Frontend Assets
        $this->publishes([
            __DIR__ . '/../public' => public_path('vendor/jellies'),
        ], 'public');

        // Publish Views
        $this->publishes([
            __DIR__ . '/../resources/views' => resource_path('views/vendor/jellies'),
        ], 'views');

        $this->publishes([
            __DIR__ . '/../resources/lang' => resource_path('lang/vendor/jellies'),
        ], 'translations');

        // Publish Config
        $this->publishes([
            __DIR__ . '/../config' => config_path('jellies'),
        ], 'configs');

        // Publish Migrations
        $this->publishes([
            __DIR__ . '/../database/migrations' => $this->app->databasePath().'/migrations',
        ], 'migrations');

        // Publish Factories
        $this->publishes([
            __DIR__ . '/../database/factories' => $this->app->databasePath().'/factories',
        ], 'factories');

        // Publish Seeds
        $this->publishes([
            __DIR__ . '/../database/seeds' => $this->app->databasePath().'/seeds',
        ], 'seeds');

        // Publish Tests
        $this->publishes([
            __DIR__ . '/../tests' => base_path('tests'),
        ], 'tests');

        // Publishes all stuff for dev
        $this->publishes([
            __DIR__ . '/../database' => $this->app->databasePath()
        ], 'database');

    }
}