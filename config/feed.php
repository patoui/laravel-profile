<?php

return [
    'feeds' => [
        'blog' => [
            'items' => 'App\Post@getFeedItems',
            'url' => '/rss',
            'title' => 'patriqueouimet.ca - blog posts',
            'format' => 'atom',
        ],
        'tips' => [
            'items' => 'App\Tip@getFeedItems',
            'url' => '/rss/tips',
            'title' => 'patriqueouimet.ca - tips and tricks',
            'format' => 'atom',
        ],
        'videos' => [
            'items' => 'App\Video@getFeedItems',
            'url' => '/rss/videos',
            'title' => 'patriqueouimet.ca - videos',
            'format' => 'atom',
        ],
    ],
];
