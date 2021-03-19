<?php

namespace App\Http\Controllers;

use App\Models\Posts;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class PostsController extends Controller
{
    /**
     * Instantiate a new PostsController instance.
     */
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['show']]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return response()->view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => ['required', 'max:255'],
            'content' => ['required'],
        ]);

        $post = Posts::create([
            'title' => $data['title'],
            'content' => $data['content'],
            'user_id' => auth()->user()->id
        ]);

        return redirect()->route('posts.show', $post->id)
            ->with('message', 'Your post is published.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Posts  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Posts $post)
    {
        return response()->view('posts.show', [
            'post' => $post
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Posts  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Posts $post)
    {
        return response()->view('posts.edit', [
            'post' => $post
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Posts  $post
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Posts $post)
    {
        $data = $request->validate([
            'title' => ['required', 'max:255'],
            'content' => ['required'],
        ]);

        DB::table('posts')
            ->where('id', $post->id)
            ->update([
                'title' => $data['title'],
                'content' => $data['content']
            ]);

        return redirect()->route('posts.show', $post->id)
            ->with('message', 'Your post is updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Posts  $post
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Posts $post)
    {
        DB::table('posts')->where('id', $post->id)->delete();

        return redirect()->route('dashboard')
            ->with('message', 'Your post is deleted.');
    }
}
