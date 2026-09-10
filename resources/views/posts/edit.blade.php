@extends('layouts.app')

@section('content')
    <form action="{{ route('posts.update', $post['id']) }}" method="POST">
        @csrf
        @method('PUT')
        <label for="title">Title</label>
        <br>
        <input type="text" value="{{ $post['title'] }}" name="title">
        <br>
        <label for="body">Content</label>
        <br>
        <textarea name="body" id="body" cols="30" rows="10">{{ $post['body'] }}</textarea>
        <br>
        <button type="submit">Update Blog</button>
    </form>
@endsection