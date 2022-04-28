<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    public const LOCALES = [
        'en' => 'English',
        'es' => 'Español',
        'de' => 'Deutsch',
        'ar' => 'العربيه'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function posts(){
        return $this->hasMany('App\Models\posts');
    }

    public function comments(){
        return $this->hasMany('App\Models\comments');
    }

    public function image(){
        return $this->morphOne('App\Models\image','imageable');
    }

    public function scopeMostPosts(Builder $query){
        return $query->withCount('posts')->orderBy('posts_count','desc');
    }

    public function scopeMostPostsLastMonth(Builder $query){
        return $query->withCount(['posts' => function (Builder $query) {
            $query->whereBetween(static::CREATED_AT, [now()->subMonths(1), now()]);
        }]) ->has('posts','>=','2')
            ->orderBy('posts_count','desc');
    }

    
}
