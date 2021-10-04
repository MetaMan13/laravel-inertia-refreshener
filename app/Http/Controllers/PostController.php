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
        return Inertia::render('Post/Index');
    }

    public function create()
    {
        return Inertia::render('Post/Create');
    }

    public function store(StoreRequest $request)
    {
        $data = collect($request->validated())->put('user_id', auth()->user()->id)->all();

        Post::create($data);

        return redirect()->route('dashboard.post.index')->with('post_created', 'Post created!');
    }

    public function show()
    {
        return Inertia::render('Post/Show');
    }

    public function edit(EditRequest $request, Post $post)
    {
        return Inertia::render('Post/Edit');
    }

    public function update(UpdateRequest $request, Post $post)
    {

    }

    public function destroy(DestroyRequest $request, Post $post)
    {

    }
}
