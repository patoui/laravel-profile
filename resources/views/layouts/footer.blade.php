<footer class="footer hero is-primary">
    <div class="container">
        <div class="columns" style="max-width: 767px; margin: 0 auto;">
            <div class="column">
                <h3 class="is-size-4">Want to get notifications about my latest posts!</h3>
            </div>
            <div class="column">
                <form method="post" action="{{ route('subscription.store') }}">
                    {{ csrf_field() }}
                    <div class="field has-addons" style="margin: 0 auto;">
                        <div class="control">
                            <input class="input" type="text" name="subscription_email" placeholder="Email">
                        </div>
                        <div class="control">
                            <button class="button"
                                type="submit"
                                style="background-color: #007F6E; color: white; border: 1px solid rgba(0,0,0,0);">
                            Subscribe!
                            </button>
                        </div>
                    </div>
                    @if ($errors->has('subscription_email'))
                    <p class="help is-danger">{{ $errors->first('subscription_email') }}</p>
                    @endif
                </form>
            </div>
        </div>
        <hr>
        <div class="content has-text-centered">
            <p>Website by Patrique Ouimet.</p>
            <p>
                <a class="icon" href="https://twitter.com/OuimetPatrique">
                    <i class="fa fa-twitter"></i>
                </a>
                <a class="icon" href="https://github.com/patoui">
                    <i class="fa fa-github"></i>
                </a>
            </p>
        </div>
    </div>
</footer>
