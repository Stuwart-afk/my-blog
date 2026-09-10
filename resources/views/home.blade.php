@extends('layouts.app')

@section('content')
    <div class="box">
    <h1>Welcome to Mini Blog</h1>
    <a href={{ route('posts.index') }}>View Blog</a>
    </div>
@endsection
