
# Jellies

A browser-based MMO with jellies & sundry.

# WIP

This software is pre-alpha, don't bother to use it just yet...

# Install

#### Install using composer

`composer require dan-powell/jellies`

#### Add service providers to `config/app.php`

```
// Jellies Service Provider
DanPowell\Jellies\JelliesServiceProvider::class,

// Third Party
Collective\Html\HtmlServiceProvider::class,
Krucas\Notification\NotificationServiceProvider::class,
```

#### Add aliases to `config/app.php`

```
// Jellies

// Third Party
'Form' => Collective\Html\FormFacade::class,
'Html' => Collective\Html\HtmlFacade::class,
'Notification' => Krucas\Notification\Facades\Notification::class,
```

#### Add middleware to `app/Http/Kernel.php`

```
protected $middlewareGroups = [
    'web' => [
        ...
        \Illuminate\Session\Middleware\StartSession::class,
        \Krucas\Notification\Middleware\NotificationMiddleware::class,
```

Kernel middleware array (must be placed after 'Illuminate\Session\Middleware\StartSession' middleware)

#### Publish assets

    php artisan vendor:publish --tag='database'

#### Run migrations

    php artisan migrate

#### Change default auth model in `config/auth.php`

```
'providers' => [
    'users' => [
        'driver' => 'eloquent',
        'model' => DanPowell\Jellies\Models\User::class,
    ],
```

#### Add command classes to `app/Console/Kernel.php`

```
use DanPowell\Jellies\Console\Commands\Incursion\IncursionProcessEncounters;
use DanPowell\Jellies\Console\Commands\User\UserAddAction;

class Kernel extends ConsoleKernel
{
    protected $commands = [
        IncursionProcessEncounters::class,
        UserAddAction::class,
    ];
```

#### Add scheduled tasks to `app/Console/Kernel.php`

```
protected function schedule(Schedule $schedule)
{
    $schedule->command('incursion:encounters --queue')->everyFiveMinutes();
    $schedule->command('user:actions --queue')->hourly();
}
```

# Update

#### publish assets

    php artisan vendor:publish --tag='database' --force

#### migrations

    php artisan migrate

# Seeding

#### publish database

    php artisan vendor:publish --tag='database' --force

#### Add seeder to `database/seeds/DatabaseSeeder.php`

    $this->call('JelliesSeeder');

#### Seed

    composer dump-autoload
    php artisan db:seed


# Testing

#### Publish tests

    php artisan vendor:publish --tag='tests' --force

#### Add testing database to `config/database.php`

```
    'testing' => [
        ...
        'database'  => 'testing',
        ...
    ],
```

#### Add modules to `test/functional.suite.yml`

```
    modules:
      enabled:
        - Laravel5:
            environment_file: .env.testing
```

#### Create `.env.testing`

```
    APP_ENV=testing
    APP_DEBUG=true
    APP_KEY=

    BASE_URL=

    DB_HOST=localhost
    DB_DATABASE=testing
    DB_USERNAME=homestead
    DB_PASSWORD=secret

    CACHE_DRIVER=file
    SESSION_DRIVER=file
```

#### Migrate

    php artisan migrate --database=testing

#### Run tests

    php ./vendor/bin/codecept run
