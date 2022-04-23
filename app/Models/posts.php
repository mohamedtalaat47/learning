<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Cache;

class posts extends Model
{
    use HasFactory;
    use SoftDeletes;

    public function comments(){
        return $this->hasMany('App\Models\comments','post_id');
    }

    public function user(){
        return $this->belongsTo('App\Models\user');
    }

    public function Tags(){
        return $this->belongsToMany('App\Models\Tags','posts_tags','post_id','tag_id')->withTimestamps();
    }

    public function scopeMostCommented(Builder $query){
        return $query->withCount('comments')->orderBy('comments_count','DESC');
    }

    public function scopelatestWithRelations(Builder $query){
        return $query->withCount('comments')->with('user')->with('tags')->latest('id');
    }

    public static function boot(){
        parent::boot();

        static::deleting(function(posts $posts){

            $posts->comments()->delete();
            Cache::tags(['post'])->forget('post-{$id}');

        });

        static::updating(function(posts $posts){

            Cache::tags(['post'])->forget('post-{$id}');

        });

        static::restoring(function(posts $posts){

            $posts->comments()->restore();

        });
    }
}
