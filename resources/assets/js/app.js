
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const nav = new Vue({
    el: '#nav',
    data: { isActive: false },
    methods: {
        toggleNav() {
            this.isActive = ! this.isActive;
        }
    }
});

const post = new Vue({
    el: '#comments',
    data: {
        comments: {}
    },
    methods: {
        toggleComment(id) {
            if (this.comments.hasOwnProperty(id)) {
                this.$set(
                    this.comments,
                    id,
                    { isActive: ! this.comments[id].isActive }
                );
                // The code below is not reactive, therefore the frontend
                // does not see the changes
                // this.comments[id].isActive = ! this.comments[id].isActive;
            } else {
                this.$set(this.comments, id, { isActive: true });
                // The code below is not reactive, therefore the frontend
                // does not see the changes
                // this.comments[id] = { isActive: true };
            }
        },
        isCommentActive(id) {
            if (this.comments.hasOwnProperty(id)) {
                return this.comments[id].isActive;
            }
            return false;
        }
    }
});
