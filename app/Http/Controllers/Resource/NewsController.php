<?php

namespace Atom26\Http\Controllers\Resource;

use Atom26\Web\Post;
use Illuminate\Http\Request;
use Atom26\Http\Controllers\Controller;

class NewsController extends Controller
{
    /**
     * Create a new instance of controller.
     */
    public function __construct()
    {
        $this->middleware('role:editor', ['except' => ['show', 'upload']]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.newswriter');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'content' => 'required',
            'thumbnail' => 'required|image'
        ]);

        Post::create([
            'title' => $request->title,
            'content' => $request->get('content'),
            'thumbnail' => '/uploads/' . $request->file('thumbnail')->store('news_thumb'),
        ]);

        return redirect()->route('dashboard.editor');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \Atom26\Web\Post $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        return view('dashboard.newseditor', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Atom26\Web\Post $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        $post->title = $request->title;
        $post->content = $request->get('content'); // Prevent phpStorm from crying

        if ($request->has('thumbnail')) {
            $post->thumbnail = '/uploads/' . $request->file('thumbnail')->store('news_thumb');
        }

        $post->save();

        return redirect()->route('dashboard.editor');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Atom26\Web\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $post->delete();

        return redirect()->route('dashboard.editor');
    }

    /**
     * Upload picture from
     *
     * @param Request $request
     * @return string
     */
    public function uploadPicture(Request $request)
    {
        $this->validate($request, [
            'file' => 'required|image'
        ]);

        return json_encode([
            'location' => '/uploads/' . $request->file('file')->store('news_pic')
        ]);
    }
}
