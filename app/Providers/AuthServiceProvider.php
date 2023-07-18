<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;

use App\Policies\PostPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        'App\Models\Post' => 'App\Policies\PostPolicy',
        'App\Models\User' => 'App\Policies\UserPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        $this->registerPolicies();

        // Gate::define("post.update", function($user, $post){
        //     return $user->id === $post->user_id;
        // });

        // Gate::define("post.delete", function($user, $post){
        //     return $user->id === $post->user_id;
        // });

        Gate::before(function($user, $ability){
            if($user->is_admin && in_array($ability, ["update", "restore"])) {
                return true;
            }
        });

        // ! v2 policy
        // Gate::define("post.update", [PostPolicy::class, "update"]);
        // Gate::define("post.delete", [PostPolicy::class, "delete"]);

        // ! v3 policy
        // Gate::resource("post", [PostPolicy::class]);
        // Gate::resource("post", 'App\Policies\PostPolicy');

        // ! V4 policy is to uncoment the $policies variable without declaring the Gate

        Gate::define('secret.page', function($user){
            return $user->is_admin;
        });
    }
}
