<section class="hero is-primary is-bold">

    <!-- Navigation -->
    @if (Auth::user())
    <admin-navigation-vue></admin-navigation-vue>
    @else
    <navigation-vue></navigation-vue>
    @endif

    <div class="hero-body">
        <div class="container has-text-centered">
            <h1 class="title">{{ $title }}</h1>
            @if(isset($subtitle) && ! empty($subtitle))
            <h2 class="subtitle">{{ $subtitle }}</h2>
            @endif
        </div>
    </div>
</section>
