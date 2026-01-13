<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use App\Models\Author;
use App\Models\Admin;

class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [
        'App\Models\Book' => 'App\Policies\BookPolicy',
    ];
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        $this->registerPolicies();
        Gate::define('example-com-user',function(Admin $admin){
            return substr($admin->login_id,-11) === 'example.com';
        });
    }
}
