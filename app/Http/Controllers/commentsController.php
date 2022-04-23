<?php

namespace App\Http\Controllers;

use App\Models\posts;
use Illuminate\Http\Request;

class commentsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->only(['store']);
    }

    public function store(posts $post,Request $request)
    {

        $request->validate([
            'content' => 'required|min:1'
        ]);

        $post->comments()->create([
            'content' => $request->input('content'),
            'user_id' => $request->user()->id
        ]);

        $request->session()->flash('status', 'Comment was created!');

        return redirect()->back();

        
    }
}
