<section class="hero is-primary is-bold">

    <!-- Navigation -->
    <admin-navigation-vue></admin-navigation-vue>

    <div class="hero-body">
        <div class="container">
            <div class="columns">
                <div class="column has-text-centered">
                    <h1 class="title">{{ $postsCount }}</h1>
                    <h2 class="subtitle">Total</h2>
                </div>
                <div class="column has-text-centered">
                    <h1 class="title">{{ $postsPublishedCount }}</h1>
                    <h2 class="subtitle">Published</h2>
                </div>
            </div>
        </div>
    </div>
</section>
