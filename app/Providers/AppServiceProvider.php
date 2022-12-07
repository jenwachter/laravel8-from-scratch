<?php

namespace App\Providers;

use App\Services\Newsletter;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;
use MailchimpMarketing\ApiClient;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(Newsletter::class, function () {

          $client = new ApiClient();

          $client->setConfig([
            'apiKey' => config('services.mailchimp.key'),
            'server' => config('services.mailchimp.server')
          ]);

          return new Newsletter($client);
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Model::unguard();

        // defines an 'admin' gate to keep non-admins from accessing areas they shouldn't
        Gate::define('admin', function ($user) {
          return $user->username === 'jen';
        });

        Blade::if('admin', function () {
          return request()->user()?->can('admin');
        });
    }
}
