<nav id="navigation" class="navbar">
    <div class="navbar-brand">
        <a id="navbar-brand-logo" class="navbar-item" href="/">PO</a>

        <a class="navbar-item is-hidden-desktop" href="https://github.com/jgthms/bulma" target="_blank">
            <span class="icon" style="color: #333;">
                <i class="fa fa-github"></i>
            </span>
        </a>

        <a class="navbar-item is-hidden-desktop" href="https://twitter.com/jgthms" target="_blank">
            <span class="icon" style="color: #55acee;">
                <i class="fa fa-twitter"></i>
            </span>
        </a>

        <div class="navbar-burger burger" @click="toggleNav()">
            <span></span>
            <span></span>
            <span></span>
        </div>
    </div>

    <div class="navbar-menu" :class="{ 'is-active': isActive }">
        <div class="navbar-start">
            <a class="navbar-item" href="/">Home</a>
            <a class="navbar-item" href="/blog">Blog</a>
        </div>

        <div class="navbar-end is-hidden-touch">
            <a class="navbar-item" href="https://github.com/patoui" target="_blank">
                <span class="icon" style="color: #333;">
                    <i class="fa fa-github"></i>
                </span
                >&nbsp;<span>Github</span>
            </a>
            <a class="navbar-item" href="https://twitter.com/OuimetPatrique" target="_blank">
                <span class="icon" style="color: #55acee;">
                    <i class="fa fa-twitter"></i>
                </span
                >&nbsp;<span>Twitter</span>
            </a>
        </div>
    </div>
</nav>
