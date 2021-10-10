<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Requests\Post\StoreRequest;
use App\Http\Requests\Post\EditRequest;
use App\Http\Requests\Post\UpdateRequest;
use App\Http\Requests\Post\DestroyRequest;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::all();

        return Inertia::render('Post/Index', [
            'posts' => $posts
        ]);
    }

    public function create()
    {
        return Inertia::render('Post/Create');
    }

    public function store(StoreRequest $request)
    {
        $data = collect($request->validated())->put('user_id', auth()->user()->id)->all();

        $post = Post::create($data);

        return redirect()->route('dashboard.post.show', ['post' => $post])->with('message', 'Post created!');
    }

    public function show(Post $post)
    {
        return Inertia::render('Post/Show', [
            'post' => $post
        ]);
    }

    public function edit(EditRequest $request, Post $post)
    {
        return Inertia::render('Post/Edit', [
            'post' => $post
        ]);
    }

    public function update(UpdateRequest $request, Post $post)
    {
        $post->update($request->validated());

        return redirect()->route('dashboard.post.show', ['post' => $post])->with('message', 'Post updated');
    }

    public function destroy(DestroyRequest $request, Post $post)
    {
        $post->delete();

        return redirect()->route('dashboard.post.index')->with('message', 'Post deleted!');
    }
}
