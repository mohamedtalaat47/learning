@extends('layouts.app')

@section('title', 'post')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-8">
                {{-- <div>
                    <h3>{{ $post->title }}</h3>
                    <x-badge type='success' show='{{ $post->created_at->diffInMinutes() < 40 }}'>new</x-badge>
                </div>
                <br> --}}

                @if($post->image)
                <div style="background-image: url('{{ $post->image->url() }}'); min-height: 500px; color: white; text-align: center; background-attachment: fixed; background-size:contain">
                    <h1 style="padding-top: 100px; text-shadow: 1px 2px #000">
                @else
                    <h1>
                @endif
                    {{ $post->title }}
                    <x-badge type='success' show='{{ $post->created_at->diffInMinutes() < 40 }}'>new post</x-badge>
                @if($post->image)    
                    </h1>
                </div>
                @else
                    </h1>
                @endif

                <p>{{ $post->content }}</p>
                {{-- <p>Added {{$post->created_at->diffForHumans()}}</p> --}}
                <x-updated date="{{ $post->created_at }}" name="{{ $post->user->name }}"></x-updated>
                <x-updated date="{{ $post->updated_at }}">Last updated</x-updated>
                <x-tags :tags="$post->tags" />

                

                <h3>Comments</h3>
                @include('comments._form')

                @forelse ($post->comments as $comment)
                    <p>{{ $comment->content }} </p>
                    {{-- <p>added {{$comment->created_at->diffForHumans()}}</p> --}}
                    <x-updated date="{{ $comment->created_at }}" name="{{ $comment->user->name }}"></x-updated>

                    <hr>
                @empty
                    <p>no comments yet!</p>
                @endforelse
            </div>
            <div class="col-4">
                @include('posts._activity')
            </div>
        </div>
    </div>
@stop
