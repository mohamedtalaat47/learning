@extends('layouts.app')

@section('title', 'post')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-8">
                <h3>{{ $post->title }}</h3>
                <br>
                <p>{{ $post->content }}</p>
                {{-- <p>Added {{$post->created_at->diffForHumans()}}</p> --}}
                <x-updated date="{{ $post->created_at }}" name="{{ $post->user->name }}"></x-updated>
                <x-updated date="{{ $post->updated_at }}">Last updated</x-updated>
                <x-tags :tags="$post->tags" />

                <x-badge type='success' show='{{ $post->created_at->diffInMinutes() < 40 }}'>new</x-badge>

                @forelse ($post->comments as $comment)
                    <p>{{ $comment->content }} </p>
                    {{-- <p>added {{$comment->created_at->diffForHumans()}}</p> --}}
                    <x-updated date="{{ $comment->created_at }}"></x-updated>

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
