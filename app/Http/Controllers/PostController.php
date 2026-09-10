<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Console\AboutCommand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class PostController extends Controller
{
        
    public function seedPosts():void {
        if (!Session::has('posts')) {
            Session::put('posts', [
            1 => [
                    'id' => 1,
                    'title' => 'BSCS student blog',
                    'body' => 'Welcome. this is my first laravel website i have made and it was fun creating this. please enjoy my website',
                ],
            ]);
        }
    }

    public function index(){
        $this->seedPosts();

        return view('posts.index',[
            'posts' => Session::get('posts',[])
        ]);
    }

    public function show($id){
        $this->seedPosts();

        $posts = Session::get('posts', []);

        if (!isset($posts[$id])) {
            abort(404);
        }
        return view('posts.show', ['post' => $posts[$id],]);
    }

    public function create()
    {
        return view ('posts.create');
    }

    public function store(Request $request){
        $request->validate([
            'title' => 'required',
            'body' => 'required',
        ]);
        $this->seedPosts();

        $posts = Session::get('posts', []);
        
        $id = empty($posts)? 1 : max(array_keys($posts)) + 1;

        $posts[$id] = [
            'id' => $id,
            'title' => $request->title,
            'body' => $request->body,
        ];

        Session::put('posts', $posts);

        return redirect()->route('posts.index')->with('status', 'Post Create Successfully!');

    }

    public function edit($id){

    $this->seedPosts();

    $posts = Session::get('posts', []);

    if (!isset($posts[$id])) {
        abort(404);
    }
    return view('posts.edit', ['post' => $posts[$id],]);

    }

    public function update(Request $request, $id){
        $request->validate([
            'title' => 'required',
            'body' => 'required',
        ]);

        $this->seedPosts();

        $posts = Session::get('posts', []);

        if (!isset($posts[$id])) {
            abort(404);
        }

        $posts[$id]['title'] = $request->title;
        $posts[$id]['body'] = $request->body;

        Session::put('posts', $posts);

        return redirect()->route('posts.show', $id)->with('status', 'Post updated successfully!');

    }

    public function destroy($id){
        $this->seedPosts();

        $posts = Session::get('posts', []);

        if (!isset($posts[$id])) {
            abort(404);
        }

        unset($posts[$id]);

        Session::put('posts', $posts);

        return redirect()->route('posts.index')->with('status', 'Post deleted successfully');

    }

    public function apiIndex(){
        $this->seedPosts();

        return response()->json([
            'data' => array_values(Session::get('posts', [])),
        ]);
    }

    public function apiShow($id){
        $this->seedPosts();

        $posts = Session::get('posts', []);

        if (!isset($posts[$id])){
            return response()->json([
                'message' => 'Post not found.',
            ],404);
        }

        return response()->json([
            'data' => $posts[$id],
            ]);
    }

}
