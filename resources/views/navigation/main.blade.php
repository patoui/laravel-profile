<nav class="navbar navbar-default navbar-fixed-top">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="{{ Auth::check() ? route('dashboard') : route('post.index') }}">Patrique Ouimet - @yield('title')</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
            <!-- <ul class="nav navbar-nav">
                <li class="active"><a href="#">Home</a></li>
                <li><a href="#about">About</a></li>
                <li><a href="#contact">Contact</a></li>
                <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Dropdown <span class="caret"></span></a>
                <ul class="dropdown-menu">
                    <li><a href="#">Action</a></li>
                    <li><a href="#">Another action</a></li>
                    <li><a href="#">Something else here</a></li>
                    <li role="separator" class="divider"></li>
                    <li class="dropdown-header">Nav header</li>
                    <li><a href="#">Separated link</a></li>
                    <li><a href="#">One more separated link</a></li>
                </ul>
                </li>
            </ul> -->
            <ul class="nav navbar-nav navbar-right">
                @if (Auth::check())
                    <li><a href="{{ route('dashboard') }}"><i class="fa fa-tachometer" aria-hidden="true"></i> Dashboard</a></li>
                    <li><a href="{{ route('post.create') }}"><i class="fa fa-plus" aria-hidden="true"></i> New</a></li>
                    <li>
                        <form method="POST" action="{{ route('logout') }}">
                            {{ csrf_field() }}
                            <button type="submit" style="color: #777; background-color: rgba(0,0,0,0); background: none; border: none; padding: 15px;"><i class="fa fa-sign-out" aria-hidden="true"></i></button>
                        </form>
                    </li>
                @else
                    <li><a href="/"><i class="fa fa-home" aria-hidden="true"></i> Home</a></li>
                    <li><a href="{{ route('post.index') }}"><i class="fa fa-newspaper-o" aria-hidden="true"></i> Blog</a></li>
                @endif
                <!-- <li class="active"><a href="./">Fixed top <span class="sr-only">(current)</span></a></li> -->
            </ul>
        </div><!--/.nav-collapse -->
    </div>
</nav>
