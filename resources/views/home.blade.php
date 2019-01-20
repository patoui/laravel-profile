@extends('layouts.app')

@section('title', 'Patrique Ouimet')

@section('hero-body')
    <div class="hero-body">
        <div class="container has-text-centered">
            <picture>
                <source srcset="/img/black-white-profile.webp" type="image/webp">
                <img src="/img/black-white-profile.png" type="image/png" alt="Grayscale profile picture" style="border-radius: 50%;" />
            </picture>
            <h1 class="title" style="margin-top: 24px;">Patrique Ouimet</h1>
            <hr style="max-width: 140px; margin: 0 auto 24px auto;" />
            <h2 class="subtitle">Developer</h2>
        </div>
    </div>
@endsection

@section('content')
<section class="section">
    <div class="container">
        <h2 class="title has-text-centered">About Me</h2>
        <div class="columns">
            <div class="column is-size-5">
                <p>
                    Hi there! I'm Patrique Ouimet, a developer who specializes in: PHP (Laravel), JavaScript (AngularJS, VueJS), and CSS (Sass). I have an obssession with learning, whether it’s to sharpen my existing skills or to explore new ones such as: Ruby (Ruby on Rails), Python (Django), AdonisJS, React, etc. I also enjoy running, hiking, biking, weight lifting, soccer, and basketball.
                </p>
                <br>
                <p>
                    As of late I’ve decided to try myself at blogging to share some tips and tricks I’ve learned during my time as a developer, whether they be technical, interpersonel, or otherwise; my hope is that fellow developers may learn something from my blog.
                </p>
                <br>
                <p>
                    If you have any suggestions or materials that would assist me in becoming a better developer or to help me write better content, please don’t hesitate to contact me on Twitter @patoui2.
                </p>
            </div>
        </div>
        <h2 class="title has-text-centered">Work History</h2>
        <div class="columns">
            <div class="column">
                <div class="card">
                    <div class="card-image">
                        <figure class="image">
                            <picture>
                                <source srcset="/img/tether-website.webp" type="image/webp">
                                <img src="/img/tether-website.jpg" alt="Tether Website" class="img-responsive img-centered" />
                            </picture>
                        </figure>
                    </div>
                    <div class="card-content">
                        <div class="media">
                            <div class="media-left">
                                <figure class="image is-48x48">
                                    <picture>
                                        <source srcset="/img/mobilexco-logo.webp" type="image/webp">
                                        <img src="/img/mobilexco-logo.png" alt="MobileXCo logo" />
                                    </picture>
                                </figure>
                            </div>
                            <div class="media-content">
                                <p class="title is-4"><a href="http://mobilexco.com" title="mobilexco.com" style="color:black;" target="_blank">MobileXCo</a></p>
                                <p class="subtitle is-6">
                                    <a href="https://twitter.com/@mobilexco" target="_blank">@mobilexco</a
                                    >&nbsp;|&nbsp;<a href="https://tetherxmp.com" target="_blank">tetherxmp.com</a>
                                </p>
                            </div>
                        </div>

                        <div class="content">
                            <p class="is-size-5">Web &amp; Application Developer</p>
                            <p>MobileXCo uses mobile marketing techniques to provide clients with rich data and relationship based marketing strategies</p>
                            <small>April 2015 - Current</small>
                        </div>
                    </div>
                </div>
            </div>
            <div class="column">
                <div class="card">
                    <div class="card-image">
                        <figure class="image">
                            <picture>
                                <source srcset="/img/thejobwindow-website.webp" type="image/webp">
                                <img src="/img/thejobwindow-website.jpg" alt="The Job Window Website"  class="img-responsive img-centered" />
                            </picture>
                        </figure>
                    </div>
                    <div class="card-content">
                        <div class="media">
                            <div class="media-left">
                                <figure class="image is-48x48">
                                    <picture>
                                        <source srcset="/img/thejobwindow-logo.webp" type="image/webp">
                                        <img src="/img/thejobwindow-logo.png" alt="The Job Window Logo" />
                                    </picture>
                                </figure>
                            </div>
                            <div class="media-content">
                                <p class="title is-4">The Job Window</p>
                                <p class="subtitle is-6"><a href="http://thejobwindow.com" target="_blank">thejobwindow.com</a></p>
                            </div>
                        </div>

                        <div class="content">
                            <p class="is-size-5">Full Stack Developer</p>
                            <p>Website providing job searching functonality to users based on criterias, also aggregates jobs from other boards while pushing jobs to boards via API</p>
                            <small>June 2014 - April 2015</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="columns">
            <div class="column">
                <div class="card">
                    <div class="card-image">
                        <figure class="image">
                            <picture>
                                <source srcset="/img/25todine-website.webp" type="image/webp">
                                <img src="/img/25todine-website.jpg" alt="25 to Dine Website" class="img-responsive img-centered" />
                            </picture>
                        </figure>
                    </div>
                    <div class="card-content">
                        <div class="media">
                            <div class="media-left">
                                <figure class="image is-48x48">
                                    <picture>
                                        <source srcset="/img/25todine-logo.webp" type="image/webp">
                                        <img src="/img/25todine-logo.png" alt="25 to Dine Logo" />
                                    </picture>
                                </figure>
                            </div>
                            <div class="media-content">
                                <p class="title is-4">Smart Circle International</p>
                                <p class="subtitle is-6"><a href="http://25todine.com" target="_blank">25todine.com</a></p>
                            </div>
                        </div>

                        <div class="content">
                            <p class="is-size-5">Full Stack Developer</p>
                            <p>Website to redeem restaurant vouchers</p>
                            <small>January 2015 - April 2015</small>
                        </div>
                    </div>
                </div>
            </div>
            <div class="column">
                <div class="card">
                    <div class="card-image">
                        <figure class="image">
                            <picture>
                                <source srcset="/img/aegolfpass-website.webp" type="image/webp">
                                <img src="/img/aegolfpass-website.jpg" alt="AE Golfpass Website" class="img-responsive img-centered" />
                            </picture>
                        </figure>
                    </div>
                    <div class="card-content">
                        <div class="media">
                            <div class="media-left">
                                <figure class="image is-48x48">
                                    <picture>
                                        <source srcset="/img/aegolfpass-logo.webp" type="image/webp">
                                        <img src="/img/aegolfpass-logo.png" alt="AE Golfpass Logo" />
                                    </picture>
                                </figure>
                            </div>
                            <div class="media-content">
                                <p class="title is-4">Appreciation Events</p>
                                <p class="subtitle is-6">
                                    <a href="http://aegolfpass.com" target="_blank">aegolfpass.com</a>
                                </p>
                            </div>
                        </div>

                        <div class="content">
                            <p class="is-size-5">Full Stack Developer</p>
                            <p>Website to provide information on deals for golf packages for companies</p>
                            <small>February 2015 - April 2015</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="columns" style="max-width: 767px; margin: 0 auto;">
            <div class="column">
                <h2 class="title has-text-centered">Contact Me</h2>
                <form action="{{ route('contact.store') }}" method="post">
                    {{ csrf_field() }}

                    <div class="field">
                        <p class="control">
                            <input name="name" class="input{{ $errors->has('name') ? ' is-danger' : '' }}" type="text" value="{{ old('name') }}" placeholder="Name">
                        </p>

                        @if ($errors->has('name'))
                        <p class="help is-danger">{{ $errors->first('name') }}</p>
                        @endif
                    </div>

                    <div class="field">
                        <p class="control">
                            <input name="email" class="input{{ $errors->has('email') ? ' is-danger' : '' }}" type="text" value="{{ old('email') }}" placeholder="Email">
                        </p>

                        @if ($errors->has('email'))
                        <p class="help is-danger">{{ $errors->first('email') }}</p>
                        @endif
                    </div>

                    <div class="field">
                        <p class="control">
                            <input name="phone" class="input{{ $errors->has('phone') ? ' is-danger' : '' }}" type="text" value="{{ old('phone') }}" placeholder="Phone">
                        </p>

                        @if ($errors->has('phone'))
                        <p class="help is-danger">{{ $errors->first('phone') }}</p>
                        @endif
                    </div>

                    <div class="field">
                        <p class="control">
                            <textarea name="message" class="textarea{{ $errors->has('message') ? ' is-danger' : '' }}" rows="5" placeholder="Message">{{ old('message') }}</textarea>
                        </p>

                        @if ($errors->has('message'))
                        <p class="help is-danger">{{ $errors->first('message') }}</p>
                        @endif
                    </div>

                    <div class="field">
                        <p class="control">
                            {!! Recaptcha::render() !!}
                        </p>

                        @if ($errors->has('g-recaptcha-response'))
                        <p class="help is-danger">{{ $errors->first('g-recaptcha-response') }}</p>
                        @endif
                    </div>

                    <p class="control">
                        <button type="submit" class="button is-primary is-fullwidth">Send</button>
                    </p>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection

@include('vendor.flash.message')
