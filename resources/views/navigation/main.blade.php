<!-- Navigation -->
@if (Auth::user())
<div id="nav" class="hero-head">
    <nav class="navbar container">
        <div class="navbar-brand">
            <a id="navbar-brand-logo" class="navbar-item" href="/">PO</a>

            <div class="navbar-burger burger" @click="toggleNav()">
                <span></span>
                <span></span>
                <span></span>
            </div>
        </div>

        <div class="navbar-menu" :class="{ 'is-active' : isActive }">
            <div class="navbar-end">
                <a class="navbar-item" href="/blog">Blog</a>
                <a class="navbar-item" href="/admin/dashboard">Dashboard</a>
                <a class="navbar-item" href="/admin/post/create">
                    <span class="icon">
                        <i class="fa fa-plus"></i>
                    </span>
                </a>
                <a class="navbar-item" href="/logout">
                    <span class="icon">
                        <i class="fa fa-sign-out"></i>
                    </span>
                </a>
            </div>
        </div>
    </nav>
</div>
@else
<div id="nav" class="hero-head">
    <nav class="navbar container">
        <div class="navbar-brand">
            <a id="navbar-brand-logo" class="navbar-item" href="/">PO</a>

            <div class="navbar-burger burger" :class="{ 'is-active': isActive }" @click="toggleNav()">
                <span></span>
                <span></span>
                <span></span>
            </div>
        </div>

        <div class="navbar-menu" :class="{ 'is-active': isActive }">
            <div class="navbar-end">
                <a class="navbar-item " href="/blog">
                Blog
                </a>
                <a class="navbar-item" href="https://twitter.com/OuimetPatrique" target="_blank">
                    <span class="icon">
                        <i class="fa fa-twitter"></i>
                    </span>
                </a>
                <a class="navbar-item" href="https://github.com/patoui" target="_blank">
                    <span class="icon">
                        <i class="fa fa-github"></i>
                    </span>
                </a>
            </div>
        </div>
    </nav>
@endif
</div>
