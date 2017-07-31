<?php

namespace App\Observers;

use App\Post;
use DB;

class PostObserver
{
    /**
     * Listen to the Post created event.
     *
     * @param  Post  $post
     * @return void
     */
    public function created(Post $post)
    {
        // Remove all non-alphanumeric
        $url = preg_replace(
            '/[^a-zA-Z0-9 ]/',
            '',
            strtolower($post->title)
        );

        // Replace spaces with hyphens
        $url = preg_replace('/[ ]/', '-', $url);

        $counter = 1;

        while ($this->checkUrl($url)) {
            $url = $this->newUrl($url, $counter);
            $counter++;
        }

        DB::table('posts')
            ->where('id', $post->id)
            ->update(['url' => $url]);
    }

    /**
     * Listen to the Post updated event.
     *
     * @param  Post  $post
     * @return void
     */
    public function updated(Post $post)
    {
        //
    }

    private function checkUrl($url)
    {
        return DB::table('posts')
            ->where('url', $url)
            ->first();
    }

    private function newUrl($url, $count = null)
    {
        $pattern = '/-' . $count . '/';
        if (! preg_match($pattern, $url)) {
            $url = $url . '-' . $count;
        } else {
            $count++;
            $url = preg_replace($pattern, '-' . $count, $url);
        }
    }
}
