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
        // Generate slug if one is not provided
        if (! $post->slug) {
            // Remove all non-alphanumeric
            $slug = preg_replace(
                '/[^a-zA-Z0-9 ]/',
                '',
                strtolower($post->title)
            );

            // Replace spaces with hyphens
            $slug = preg_replace('/[ ]/', '-', $slug);

            $counter = 1;

            while ($this->checkSlug($slug)) {
                $slug = $this->newSlug($slug, $counter);
                $counter++;
            }

            DB::table('posts')
                ->where('id', $post->id)
                ->update(['slug' => $slug]);
        }
    }

    private function checkSlug($slug)
    {
        return DB::table('posts')
            ->where('slug', $slug)
            ->first();
    }

    private function newSlug($slug, $count = null)
    {
        $pattern = '/-' . $count . '/';
        if (! preg_match($pattern, $slug)) {
            $slug = $slug . '-' . $count;
        } else {
            $count++;
            $slug = preg_replace($pattern, '-' . $count, $slug);
        }
    }
}
