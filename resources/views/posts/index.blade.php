@extends('layouts.app')

@section('title', 'all posts')

@section('content')
    <div class="container">
        <div class="row">
        <div class="col-8 d-flex flex-column">
            
            @foreach ($posts as $post)
                <h3>
                    
                    @if($post->trashed())
                    <del>
                @endif
                <a class="{{ $post->trashed() ? 'text-muted' : '' }}"
                    href="{{ route('posts.show', ['post' => $post->id]) }}">{{ $post->title }}</a>
                @if($post->trashed())
                    </del>
                @endif</h3>

                {{-- <p>added {{ $post->created_at->diffForHumans() }} by {{ $post->user->name }}</p> --}}
                <x-updated date="{{$post->created_at}}" name="{{ $post->user->name }}"></x-updated>

                <x-tags :tags="$post->tags" />

                @if ($post->comments_count)
                    <p>{{ $post->comments_count }} {{__("Comments")}}</p>
                @else
                    <p>{{__("No comments yet!")}}</p>
                @endif

                <div class="my-3 d-flex">
                    @can('posts.update', $post)
                        <a href="{{ route('posts.edit', $post->id) }}" class="btn btn-primary">{{__("Edit")}}</a>
                    @endcan
                    @can('posts.delete', $post)
                        <form action="{{ route('posts.destroy', $post->id) }}" method="post">
                            @csrf
                            @method('DELETE')

                            <input class="btn btn-danger" type="submit" value="{{__("Delete!")}}">

                        </form>
                    @endcan
                </div>




                <hr>
            @endforeach
            @empty($posts->count())
                <h3>{{__("No blog posts yet!")}}</h3>
            @endempty


        </div>
        <div class="col-4">
            @include('posts._activity')
        </div>
        {{-- <div class="col-12 d-flex justify-content-center">
            {{ $posts->links() }}
        </div> --}}
    </div>
    </div>
@stop
