<?php

namespace Atom26\Observers;

use Atom26\Web\Post;
use Illuminate\Support\Facades\Cache;

class PostObserver
{
    /**
     * Listen to post saved event.
     *
     * @param \Atom26\Web\Post $post
     */
    public function saved(Post $post)
    {
        Cache::forget('home-news');
    }

    /**
     * Listen to post deleted event.
     *
     * @param \Atom26\Web\Post $post
     */
    public function deleted(Post $post)
    {
        Cache::forget('home-news');
    }
}