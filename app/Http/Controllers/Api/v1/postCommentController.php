<?php

namespace App\Http\Controllers\Api\v1;

use App\Events\CommentPosted;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\comments as CommentResource;
use App\Models\comments;
use App\Models\posts;

class postCommentController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:api')->only(['store','update','destroy']);
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(posts $post)
    {
        return CommentResource::collection($post->comments()->with('user')->get());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(posts $post, Request $request)
    {
        
        $request->validate([
            'content' => 'required|min:1'
        ]);

        $comment = $post->comments()->create([
            'content' => $request->input('content'),
            'user_id' => $request->user()->id
        ]);
        event(new CommentPosted($comment));

        return new CommentResource($comment);
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(posts $post,comments $comment)
    {
        return new CommentResource($comment);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(posts $post,comments $comment,Request $request)
    {
        $request->validate([
            'content' => 'required|min:1'
        ]);
        $this->authorize($comment);
        $comment->content = $request->input('content');
        $comment->save();

        return new CommentResource($comment);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(posts $post,comments $comment)
    {
        $this->authorize($comment);
        
        $comment->delete();

        return response()->noContent();
    }
}
