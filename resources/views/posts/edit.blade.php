@extends('layouts.app')

@section('title','create post')

@section('content')

<div class=" container">
    <div class="col-6 form-group">
    <form action="{{ route('posts.update', ['post' => $post->id]) }}" method="POST">
        @csrf
        @method('PUT')

        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif
        <label for="title">Title</label>
        <input class=" form-control" id="title" type="text" name="title" value="{{ old('title', $post->title) }}">
        @error('title')
            <div>{{ $message }}</div>
        @enderror
        <br>


        <label for="content">Content</label>
        <textarea class=" form-control" id="content"   name="content" id="" cols="30" rows="10">{{ old('content', $post->content) }}</textarea>
        <br>

        <button class="btn btn-dark btn-block" type="submit" name="submit">Update</button>

        @if ($errors->any())
            @foreach ($errors->all() as $error)
                <div>{{ $error }}</div>
            @endforeach

        @endif








    </form>
    </div>
    </div>
@stop