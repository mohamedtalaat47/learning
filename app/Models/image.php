<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class image extends Model
{
    use HasFactory;

    protected $fillable = ['path','post_id'];

    public function posts(){
        return $this->belongsTo('App\Models\posts');
    }

    public function url(){
        return Storage::url($this->path);
    }
}
