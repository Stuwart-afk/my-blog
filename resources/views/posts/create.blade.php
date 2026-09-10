@extends('layouts.app')


@section('content')
    <div class="box1">
    <h1>Create a post</h1>
    <form action="{{ route('posts.store') }}" method="POST">
    @csrf
    <Label>Title</Label>
    <br>
    <input type="text" name="title">
    <br>
    <label>Content</label>
    <br>
    <textarea name="body" id="body" rows="10"></textarea>

    <button type="submit">Create Post</button>
    </div>
    </form>
@endsection