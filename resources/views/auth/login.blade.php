@extends('layouts.app-navless')

@section('content')
<div class="container is-fluid">
    <div class="columns">
        <div class="column"></div>
        <div id="login" class="column is-third is-half-tablet">
            <div class="card">
                <header class="card-header">
                    <p class="card-header-title has-text-centered">
                        Blog
                    </p>
                </header>
                <form method="post" action="{{ route('login') }}">
                    {{ csrf_field() }}
                    <div class="card-content">
                        <div class="content">
                            <p class="control has-icon">
                                <input class="input{{ $errors->has('email') ? ' is-danger' : '' }}" name="email" type="email" placeholder="Email" required autofocus>
                                <span class="icon is-small"><i class="fa fa-envelope"></i></span>
                                @if($errors->has('email'))
                                <span class="help is-danger">{{ $errors->first('email') }}</span>
                                @endif
                            </p>
                            <p class="control has-icon">
                                <input class="input{{ $errors->has('password') ? ' is-danger' : '' }}" name="password" type="password" placeholder="Password" required>
                                <span class="icon is-small"><i class="fa fa-lock"></i></span>
                                @if($errors->has('password'))
                                <span class="help is-danger">{{ $errors->first('password') }}</span>
                                @endif
                            </p>
                            <button class="button is-primary is-submit">Login</button>
                        </div>
                    </div>
                    <footer class="card-footer">
                        <a href="/register" class="card-footer-item">Sign Up</a>
                        <a href="/password/reset" class="card-footer-item">Forgot Password?</a>
                    </footer>
                </form>
            </div>
        </div>
        <div class="column"></div>
    </div>
</div>
@endsection
