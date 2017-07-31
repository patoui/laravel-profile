<template>
<nav class="navbar container">
    <div class="navbar-brand">
        <a id="navbar-brand-logo" class="navbar-item" href="/">PO</a>

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

        <div class="navbar-end">
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
</template>

<script>
    export default {

        data() {
            return { isActive: false };
        },

        methods: {
            toggleNav() {
                this.isActive = !this.isActive;
            }
        }
    }
</script>
