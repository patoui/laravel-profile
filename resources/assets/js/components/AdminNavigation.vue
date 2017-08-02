<template>
<div class="hero-head">
    <header class="nav">
        <div class="container">
            <div class="navbar-brand">
                <a id="navbar-brand-logo" class="navbar-item" href="/">PO</a>

                <div class="navbar-burger burger" @click="toggleNav()">
                    <span></span>
                    <span></span>
                    <span></span>
                </div>
            </div>

            <div class="navbar-menu" :class="{ 'is-active' : isActive }">
                <div class="navbar-start">
                    <a class="navbar-item" href="/blog">Blog</a>
                    <a class="navbar-item" href="/admin/dashboard">Dashboard</a>
                </div>

                <div class="navbar-end">
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
        </div>
    </header>
</div>
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
