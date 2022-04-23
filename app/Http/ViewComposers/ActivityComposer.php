<?php

namespace App\Http\ViewComposers;

use Illuminate\View\View;
use Illuminate\Support\Facades\Cache;
use App\Models\posts;
use App\Models\User;

class ActivityComposer
{
    public function compose(View $view) 
    {
        $mostcommented = Cache::remember('mostCommented',now()->addMinutes(60), function(){
            return posts::MostCommented()->take(5)->get();
        });

        $userMostPosts = Cache::remember('mostPosts',now()->addMinutes(60), function(){
            return user::MostPosts()->take(5)->get();
        });
        
        $userMostPostsLastMonth = Cache::remember('mostPostsLastMonth',now()->addMinutes(60), function(){
            return user::MostPostsLastMonth()->take(5)->get();
        });

        $view->with('mostCommented', $mostcommented);
        $view->with('mostPosts', $userMostPosts);
        $view->with('mostPostsLastMonth', $userMostPostsLastMonth);
    }
}