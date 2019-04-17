<template>
<div>
    <div v-for="(comment, index) in comments" :key="index" v-bind:id="'comment' + comment.id" class="media">
        <figure class="media-left">
            <p class="image is-64x64">
                <img src="https://via.placeholder.com/64x64" alt="Avatar placeholder">
            </p>
        </figure>
        <div class="media-content">
            <div class="content">
                <p>
                    <strong>Anonymous</strong>&nbsp;<small>{{ comment.short_timestamp }}</small>
                    <br>
                    {{ comment.body }}
                </p>
            </div>
            <nav class="level is-mobile">
                <div class="level-left">
                    <button type="button" class="button level-item" v-on:click="toggleComment(index)">
                        <span class="icon is-small"><i class="fa fa-reply"></i></span>
                    </button>
                    <form method="post" v-bind:action="'/comment/' + comment.id">
                        <button type="submit" class="button level-item">
                            <span class="icon is-small"><i class="fa fa-thumbs-o-up"></i></span><span>{{ comment.favourites_count }}</span>
                        </button>
                    </form>
                </div>
            </nav>

            <!-- COMMENT FORM -->
            <form @submit="createComment"
                v-bind:action="'/post/' + post.slug + '/comment?comment_id=' + comment.id"
                v-bind:class="[comment.is_active ? '' : 'is-hidden', 'media']">

                <!-- TODO: Add avatar -->
                <figure class="media-left">
                    <p class="image is-64x64">
                        <img src="https://via.placeholder.com/64x64" alt="Avatar placeholder">
                    </p>
                </figure>

                <div class="media-content">
                    <div class="field">
                        <p class="control">
                            <textarea name="body"
                                v-model="body"
                                v-bind:class="[errors.has('body') ? 'is-danger' : '', 'textarea']"
                                placeholder="Write your reply here!"></textarea>
                        </p>

                        <div v-if="errors.has('body')">
                            <p class="help is-danger">{{ errors.first('body') }}</p>
                        </div>
                    </div>
                    <nav class="level">
                        <div class="level-left">
                            <div class="level-item">
                                <button type="submit" class="button is-primary">Submit</button>
                            </div>
                        </div>
                    </nav>
                </div>
            </form>

            <div v-if="comment.comments">
                <comments :initial-post="initialPost" :initial-comments="comment.comments"></comments>
            </div>
        </div>
    </div>
</div>
</template>

<script>
    import Errors from '../classes/Errors';

    export default {
        props: ['initialPost', 'initialComments'],

        data() {
            return {
                errors: new Errors(),
                body: '',
                post: {},
                comments: []
            };
        },

        mounted() {
            this.post = this.initialPost;
            if (this.initialComments) {
                this.comments = this.initialComments;
            } else {
                this.comments = this.initialPost.comments;
            }
        },

        methods: {
            toggleComment(index) {
                if (this.comments[index].hasOwnProperty('is_active')) {
                    this.$set(this.comments[index], 'is_active', ! this.comments[index].is_active);
                } else {
                    this.$set(this.comments[index], 'is_active', true);
                }
            },
            createComment(e) {
                e.preventDefault();
                const vm = this;
                axios.post(e.target.action, { body: this.body })
                    .then(function (response) {
                        // handle success
                        console.log('Success');
                    })
                    .catch(function (xhr) {
                        if (xhr.response.status === 401 &&
                            xhr.response.data.error === 'Unauthenticated.') {
                            window.location.href = window.location.origin + '/login';
                        }

                        if (xhr.response.data.errors) {
                            vm.errors = new Errors(xhr.response.data.errors);
                        }
                    });
            }
        }
    }
</script>
