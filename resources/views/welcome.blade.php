@extends('layouts.app')

@section('title','welcome')

@section('content')

    <h1 class=" text-center mt-5">{{__('message.welcome',["user" => "Mohamed"])}}</h1>
    <h4 class=" text-center mt-5">{{__('testing :name',["name" => "ahmed"])}}</h4>

@stop