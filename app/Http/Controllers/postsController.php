<?php

namespace App\Http\Controllers;

use App\Models\comments;
use App\Models\posts;
use App\Models\user;
use Facade\FlareClient\View;
use Illuminate\Auth\Middleware\Authorize;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth;
use App\Scopes\DeletedAdminScope;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Redis;

//use Illuminate\Support\Facades\DB;

class postsController extends Controller
{

    use SoftDeletes;

    public function __construct()
    {
        $this->middleware('auth')->except(['index','show']);
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        

        return view('posts.index', [
            'posts' => posts::withCount('comments')->with('user')->with('tags')->latest('id')->get(),
        ]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $request->validate([
            'title' => 'required|min:5|max:100',
            'content' => 'required|min:5|max:100'
        ]);

        $post = new posts();
        $post->title = $request->input('title');
        $post->content = $request->input('content');
        $post->user_id = Auth::id();
        $post->save();

        $request->session()->flash('status','posts created succesfully!');

        return redirect()->route('posts.show',['post'=> $post->id]);

        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        $post = cache::remember('post-{$id}',60,function() use($id){
            return posts::with('comments')->findOrFail($id);
        });

        return view('posts.show', ['post' => $post ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = posts::findOrFail($id);

        // if(Gate::denies('update-post',$post)){
        //     abort(403,"you are not allowed to edit this post");
        // }

        $this->Authorize('posts.update',$post);

        return view('posts.edit',['post' => $post ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|min:5|max:100',
            'content' => 'required|min:5|max:100'
        ]);

        $post = posts::findOrFail($id);
        $post->title = $request->input('title');
        $post->content = $request->input('content');
        $post->save();

        $request->session()->flash('status','posts updated succesfully!');
        
        return redirect()->route('posts.show',['post'=> $post->id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = posts::findOrFail($id);

        $this->Authorize('posts.delete',$post);
        $post->delete();

        session()->flash('status','post deleted succesfully!');

        return redirect()->route('posts.index');
    }

    public static function boot(){
        static::addGlobalScope(new DeletedAdminScope);
        
        parent::boot();
    }
}
