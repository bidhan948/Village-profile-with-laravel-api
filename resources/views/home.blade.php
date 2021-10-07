@extends('layouts.main')
@section('title','Dashboard')
@section('main_content')
    <h1 class="text-center">you are logged in {{auth()->user()->name}}</h1>
@endsection