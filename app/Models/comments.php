<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class comments extends Model
{
    use HasFactory;
    use SoftDeletes;
    
    public function post(){
        return $this->belongsTo('App\Models\posts','post_id');
    }
}
