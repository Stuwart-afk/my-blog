@extends('layouts.app')

@section('content')

        <div class="box">
        <h1>{{ $post['title'] }}</h1>
        <p>{{ $post['body'] }}</p>
        
        <a href="{{ route('posts.edit', $post['id']) }}">
            <button type="button">Edit</button>
        </a>

        <form action="{{ route('posts.destroy', $post['id']) }}" method="POST" style="display:inline">
            @csrf
            @method('DELETE')
            <button type="submit">Delete</button>
        </form>
        </div>
@endsection