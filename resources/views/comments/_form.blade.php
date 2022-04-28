<div class="mb-2 mt-2">
    @auth
        <form method="POST" action="{{ route('posts.comments.store', ['post' => $post->id]) }}">
            @csrf
    
            <div class="form-group">
                <textarea type="text" name="content" class="form-control"></textarea>
            </div>
            
            <x-errors></x-errors>
            
            <button type="submit" class="btn btn-primary btn-block mt-2">{{__("Add")}}</button>
        </form>
    @else
        <a href="{{ route('login') }}">{{__("Sign-in")}}</a> {{__("to post comments!")}}
    @endauth
    </div>
    <hr/> 