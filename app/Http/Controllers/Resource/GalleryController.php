<?php

namespace Atom26\Http\Controllers\Resource;

use Atom26\Web\Photo;
use Atom26\Web\Gallery;
use Illuminate\Http\Request;
use Atom26\Services\ImageService;
use Illuminate\Support\Facades\Redis;
use Atom26\Http\Controllers\Controller;

class GalleryController extends Controller
{
    /**
     * An instance of \Atom26\Services\ImageService
     * 
     * @var \Atom26\Services\ImageService
     */
    protected $imageService;

    /**
     * Create new instance of GalleryController
     * 
     * @param \Atom26\Services\ImageService $imageService
     */
    public function __construct(ImageService $imageService)
    {
        $this->imageService = $imageService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    public function indexDashboard()
    {
        $galleries = Gallery::all();
        return view('dashboard.gallery', compact('galleries'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.gallerycreator');
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
            'name' => 'required',
            'images.*' => 'required',
        ]);

        $gallery = Gallery::create($request->except('images'));

        collect($request->images)->each(function ($image) use ($gallery) {
            $gallery->photos()->save(new Photo(['path' => $image]));    
        });

        return redirect()->route('gallery.index.dashboard');
    }

    /**
     * Upload image asyncronusly.
     * 
     * @param  \Illuminate\Http\Request $request
     * @return string
     */
    public function upload(Request $request)
    {
        $this->validate($request, [
            'file' => 'required|image'
        ]);

        return $this->imageService->optimize(
            '/uploads/' . $request->file('file')->store('temp'),
            '/uploads/gallery/', 
            50, 
            true
        );
    }

    /**
     * Display the specified resource.
     *
     * @param  \Atom26\Gallery  $gallery
     * @return \Illuminate\Http\Response
     */
    public function show(Gallery $gallery)
    {
        Redis::incr($gallery->redisKey());

        return view('pages.gallery', compact('gallery'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \Atom26\Gallery  $gallery
     * @return \Illuminate\Http\Response
     */
    public function edit(Gallery $gallery)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Atom26\Gallery  $gallery
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Gallery $gallery)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Atom26\Gallery  $gallery
     * @return \Illuminate\Http\Response
     */
    public function destroy(Gallery $gallery)
    {
        //
    }
}
