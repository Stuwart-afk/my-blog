@extends('layouts.app')

@if(session('status'))
    <script>
        alert("{{ session('status') }}")
    </script>
@endif
@section('content')
    <h1 id="headerBlog">Blog Post</h1>
    @foreach ($posts as $post )
        <div class="box">
        
            <h2><a href="{{ route('posts.show', $post['id']) }}">{{ $post['title'] }}</a></h2>
        
        </div>
    @endforeach
@endsection