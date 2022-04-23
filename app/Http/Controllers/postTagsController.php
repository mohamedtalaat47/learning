<?php

namespace App\Http\Controllers;

use App\Models\Tags;
use Illuminate\Http\Request;

class postTagsController extends Controller
{
    public function index($tag){

        $tag = Tags::findOrFail($tag);

        return view('posts.index', [
            'posts' => $tag->posts, 
        ]);
    }
}
