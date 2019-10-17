@if (config('facebook.app_id'))
    <meta property="fb:app_id"      content="{{ config('facebook.app_id') }}" />
@endif
<meta property="article:author" content="Patrique Ouimet" />
<meta property="article:published_time" content="{{ $model->published_at->toIso8601String() }}" />
@foreach ($model->tags as $tag)
    <meta property="article:tag"   content="{{ $tag->name }}" />
@endforeach
<meta property="og:url"         content="{{ Request::url() }}" />
