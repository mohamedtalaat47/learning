@extends('layouts.app')

@section('title','create post')

@section('content')

<div class=" container">
    <div class="col-6 form-group">
    <form class=" form-group" action="{{route('posts.store')}}" method="POST" enctype="multipart/form-data">
        @csrf
        <label for="title">Title</label>
        <input class=" form-control" id="title" type="text" name="title" value="{{old('title')}}">
        @error('title')
            <div>{{$message}}</div>
        @enderror
        <br>
        <label for="content">Content</label>
        <textarea class=" form-control" id="content"  name="content" id="" cols="30" rows="10">{{old('content')}}</textarea>
        <br>
        <label for="image">Image</label>
        <input type="file" name="image" id="image" class=" form-control-file">

        <x-errors></x-errors>
        
        <button class="btn btn-dark btn-block" type="submit" name="submit">create</button>

        

    </form>
</div>
</div>  

@stop