<?php

namespace App\Http\Controllers\Post;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Helpers\MarkdownHelper;
use Illuminate\Http\Request;

class PostController extends Controller {
    public function show(string $id)
    {
        $post = Post::find($id);

        $post->html_content = MarkdownHelper::render($post->content);

        return view('posts.show', ['post' => $post]);
    }

    public function create()  {
        return view('posts.create');
    }

    public function store(Request $request) {
        $request->validate([
            'title' => ['required', 'string', 'min:5', 'max:150'],
            'description' => ['required', 'string', 'min:3', 'max:200'],
            'post_content' => ['required', 'string', 'min:5', 'max:500']
        ]);

        Post::create(['title' => $request->title, 'description' => $request->description, 'content' => $request->post_content, 'user_id' => $request->user()->id]);

        return redirect()->route('posts.create')->with('message', 'Post created successful!');
    }

    public function edit(string $id) {
        $post = Post::find($id);

        return view('posts.edit', ['post' => $post]);
    }

    public function update(Request $request, string $id) {
        $request->validate([
            'title' => ['required', 'string', 'min:5', 'max:150'],
            'description' => ['required', 'string', 'min:3', 'max:200'],
            'post_content' => ['required', 'string', 'min:5', 'max:500']
        ]);

        $post = Post::find($id);

        $post->update(['title' => $request->title, 'description' => $request->description, 'content' => $request->post_content]);

        return redirect()->route('posts.edit', ['id' => $id])->with('message', 'Post updated successful!');
    }

    public function destroy(Request $request, string $id) {
        $post = Post::find($id);

        $post->delete();

        return redirect()->route('profile', ['id' => $request->user()->id])->with('message', 'Post deleted successful!');
    }
}
