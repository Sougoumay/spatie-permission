<?php

namespace App\Providers;

use App\Models\Article;
use App\Models\Team;
use App\Models\User;
use App\Policies\ArticlePolicy;
use App\Policies\TeamPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        Team::class => TeamPolicy::class,
        Article::class=>ArticlePolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        // A Super Admin has all permissions
        Gate::before(function (User $user, $ability) {
            return $user->hasRole('Super-Admin') ? true : null;
        });
    }
}
