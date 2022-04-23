<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Cache;

class comments extends Model
{
    use HasFactory;
    use SoftDeletes;
    
    protected $fillable = ['user_id', 'content'];

    public function post(){
        return $this->belongsTo('App\Models\posts','post_id');
    }

    public function user(){
        return $this->belongsTo('App\Models\user');
    }

    public static function boot()
    {
        parent::boot();

        static::creating(function (comments $comment) {
            Cache::tags(['post'])->forget("post-{$comment->post_id}");
            Cache::tags(['post'])->forget('mostCommented');
        });
    }
}
