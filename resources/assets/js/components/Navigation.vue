<template>
<div class="hero-head">
    <nav class="navbar">
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
                <a v-if="isAuthed()" class="navbar-item " :href="'/profile/' + user.email">Profile</a>
                <a class="navbar-item " href="/tip">Tips</a>
                <a class="navbar-item " href="/blog">Blog</a>
                <a v-if="isAdmin()" class="navbar-item" href="/admin/dashboard">Dashboard</a>
                <a class="navbar-item" :href="isAuthed() ? '/logout' : '/login'">
                    <span class="icon">
                        <i :class="[isAuthed() ? 'fa-sign-out' : 'fa-sign-in', 'fa']" aria-hidden="true"></i>
                    </span>
                </a>
            </div>
        </div>
    </nav>
</div>
</template>

<script>
    export default {
        props: ['user'],

        data() {
            return { isActive: false };
        },

        methods: {
            toggleNav() {
                this.isActive = !this.isActive;
            },
            isAuthed() {
                return this.user && this.user.email;
            },
            isAdmin() {
                return this.user && this.user.is_admin;
            }
        }
    }
</script>
