@foreach($comments as $comment)
<div id="comment{{ $comment->id }}" class="media">
    <figure class="media-left">
        <p class="image is-64x64">
            <img src="https://via.placeholder.com/64x64" alt="Avatar placeholder">
        </p>
    </figure>
    <div class="media-content">
        <div class="content">
            <p>
                <strong>Anonymous</strong>&nbsp;<small>{{ $comment->short_timestamp }}</small>
                <br>
                {{ $comment->body }}
            </p>
        </div>
        <nav class="level is-mobile">
            <div class="level-left">
                <button type="button" class="button level-item" v-on:click="toggleComment({{ json_encode($comment->id) }})">
                    <span class="icon is-small"><i class="fa fa-reply"></i></span>
                </button>
                <form method="post" action="{{ route('comment.favourite.store', ['comment' => $comment->id]) }}">
                    {{ csrf_field() }}
                    <button type="submit" class="button level-item">
                        <span class="icon is-small"><i class="fa fa-thumbs-o-up"></i></span><span>{{ $comment->favourites_count }}</span>
                    </button>
                </form>
            </div>
        </nav>

        <!-- COMMENT FORM -->
        <form method="post"
            action="{{ route(
                'post.comment.store',
                [
                    'post_slug' => $post->slug,
                    'comment_id' => $comment->id
                ]
            ) }}"
            class="media"
            :class="{ 'is-hidden' : ! isCommentActive({{ json_encode($comment->id) }}) }">
            {{ csrf_field() }}

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
                            class="textarea{{ $errors->has('body') ? ' is-danger' : '' }}"
                            placeholder="Write your reply here!"></textarea>
                    </p>

                    @if ($errors->has('body'))
                    <p class="help is-danger">{{ $errors->first('body') }}</p>
                    @endif
                </div>
                <nav class="level">
                    <div class="level-left">
                        <div class="level-item">
                            <button type="submit" class="button is-primary">Submit</button>
                        </div>
                    </div>
                    <!-- TODO: Add 'Press enter to submit' functionality -->
                    <!-- <div class="level-right">
                        <div class="level-item">
                            <label class="checkbox">
                                <input type="checkbox"> Press enter to submit
                            </label>
                        </div>
                    </div> -->
                </nav>
            </div>
        </form>

        @include('post.comments', ['comments' => $comment->comments])
    </div>
</div>
@endforeach
