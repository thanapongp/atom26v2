<?php

namespace Atom26\Http\Controllers\Resource;

use Atom26\Web\Photo;
use Atom26\Web\Gallery;
use Illuminate\Http\Request;
use Atom26\Services\ImageService;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Redis;
use Atom26\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

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
        $galleries = Cache::remember('allgalleries', 60, function () {
            return Gallery::latest()->get();
        });

        return view('pages.allgalleries', compact('galleries'));
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

        Cache::forget('allgalleries');
        Cache::forget('home-gallery');

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
     * Fetch all pictures in gallery.
     * 
     * @param  \Atom26\Web\Gallery $gallery
     * @return JSON
     */
    public function allpics(Gallery $gallery)
    {
        return $gallery->photos->pluck('path')->map(function ($url) {
            return collect([
                'url' => $url, 
                'size' => Storage::size(str_replace('/uploads', '', $url))
            ]);
        });
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \Atom26\Gallery  $gallery
     * @return \Illuminate\Http\Response
     */
    public function edit(Gallery $gallery)
    {
        return view('dashboard.galleryeditor', compact('gallery'));
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
        $gallery->name = $request->name;

        if ($request->has('images')) {
            collect($request->images)->each(function ($image) use ($gallery) {
                $gallery->photos()->save(new Photo(['path' => $image]));    
            });
        }

        if ($request->has('delimages')) {
            collect($request->delimages)->each(function ($image) use ($gallery) {
                $gallery->photos()->where('path', $image)->delete();    
            });
        }

        $gallery->save();

        Cache::forget('allgalleries');
        Cache::forget('home-gallery');

        return redirect()->route('gallery.index.dashboard');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Atom26\Gallery  $gallery
     * @return \Illuminate\Http\Response
     */
    public function destroy(Gallery $gallery)
    {
        Redis::del($gallery->redisKey());

        $gallery->photos()->delete();
        $gallery->delete();

        Cache::forget('allgalleries');
        Cache::forget('home-gallery');

        return redirect()->route('gallery.index.dashboard');
    }
}
