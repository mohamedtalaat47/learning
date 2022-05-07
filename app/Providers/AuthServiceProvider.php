<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
            'App\Models\User' => 'App\Policies\userPolicy',
            'App\Models\comments' => 'App\Policies\commentsPolicy'
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        // Gate::define('update-post',function($user,$posts){
        //     return $user->id == $posts->user_id;
        // });

        // Gate::define('delete-post',function($user,$posts){
        //     return $user->id == $posts->user_id;
        // });

        Gate::define('posts.update','App\Policies\postsPolicy@update');
        Gate::define('posts.delete','App\Policies\postsPolicy@delete');
        


        Gate::before(function($user,$ability){
            if($user->is_admin){
                return true;
            }
        });

    }
}
