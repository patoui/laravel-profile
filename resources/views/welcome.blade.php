<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Patrique Ouimet</title>

    <link href="{{ asset('css/all.css') }}" rel="stylesheet">

    <!-- Theme CSS -->
    <link href="{{ asset('css/freelancer.min.css') }}" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Lato:400,700,400italic,700italic" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body id="page-top" class="index">

    <!-- Navigation -->
    <nav id="mainNav" class="navbar navbar-default navbar-fixed-top navbar-custom">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header page-scroll">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span> Menu <i class="fa fa-bars"></i>
                </button>
                <a class="navbar-brand" href="#page-top">Patrique Ouimet</a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-right">
                    <li class="hidden">
                        <a href="#page-top"></a>
                    </li>
                    <li class="page-scroll">
                        <a href="#portfolio">Portfolio</a>
                    </li>
                    <li class="page-scroll">
                        <a href="#about">About</a>
                    </li>
                    <li class="page-scroll">
                        <a href="#contact">Contact</a>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container-fluid -->
    </nav>

    <!-- Header -->
    <header>
        <div class="container">
            @include('vendor.flash.message')
            <div class="row">
                <div class="col-lg-12">
                    <img class="img-responsive img-circle" src="{{ asset('image/black-white-profile.png') }}" alt="Profile" width="300" height="300">
                    <div class="intro-text">
                        <span class="name">Patrique Ouimet</span>
                        <hr class="star-light">
                        <span class="skills">Developer</span>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- Portfolio Grid Section -->
    <section id="portfolio">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2>Portfolio</h2>
                    <hr class="star-primary">
                </div>
            </div>
            <div class="row">
                <div class="col-sm-4 portfolio-item">
                    <a href="#portfolioModal1" class="portfolio-link" data-toggle="modal">
                        <div class="caption">
                            <div class="caption-content">
                                <i class="fa fa-search-plus fa-3x"></i>
                            </div>
                        </div>
                        <picture>
                            <source media="(min-width: 414px)" srcset="{{ asset('image/profile-website.png?width=354') }}">
                            <img src="{{ asset('image/profile-website.png?width=720') }}" class="img-responsive img-centered">
                        </picture>
                    </a>
                </div>
                <div class="col-sm-4 portfolio-item">
                    <a href="#portfolioModal3" class="portfolio-link" data-toggle="modal">
                        <div class="caption">
                            <div class="caption-content">
                                <i class="fa fa-search-plus fa-3x"></i>
                            </div>
                        </div>
                        <picture>
                            <source media="(min-width: 414px)" srcset="{{ asset('image/tether-website.png?width=354') }}">
                            <img src="{{ asset('image/tether-website.png?width=720') }}" class="img-responsive img-centered">
                        </picture>
                    </a>
                </div>
                <div class="col-sm-4 portfolio-item">
                    <a href="#portfolioModal4" class="portfolio-link" data-toggle="modal">
                        <div class="caption">
                            <div class="caption-content">
                                <i class="fa fa-search-plus fa-3x"></i>
                            </div>
                        </div>
                        <picture>
                            <source media="(min-width: 414px)" srcset="{{ asset('image/thejobwindow-website.png?width=354') }}">
                            <img src="{{ asset('image/thejobwindow-website.png?width=720') }}" class="img-responsive img-centered">
                        </picture>
                    </a>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-4 portfolio-item">
                    <a href="#portfolioModal5" class="portfolio-link" data-toggle="modal">
                        <div class="caption">
                            <div class="caption-content">
                                <i class="fa fa-search-plus fa-3x"></i>
                            </div>
                        </div>
                        <picture>
                            <source media="(min-width: 414px)" srcset="{{ asset('image/25todine-website.png?width=354') }}">
                            <img src="{{ asset('image/25todine-website.png?width=720') }}" class="img-responsive img-centered">
                        </picture>
                    </a>
                </div>
                <div class="col-sm-4 portfolio-item">
                    <a href="#portfolioModal6" class="portfolio-link" data-toggle="modal">
                        <div class="caption">
                            <div class="caption-content">
                                <i class="fa fa-search-plus fa-3x"></i>
                            </div>
                        </div>
                        <picture>
                            <source media="(min-width: 414px)" srcset="{{ asset('image/aegolfpass-website.png?width=354') }}">
                            <img src="{{ asset('image/aegolfpass-website.png?width=720') }}" class="img-responsive img-centered">
                        </picture>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- About Section -->
    <section class="success" id="about">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2>About</h2>
                    <hr class="star-light">
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4 col-lg-offset-2">
                    <p>My name is Patrique Ouimet, I'm a young developer looking to make an impact on the programming community. My current technologies (and frameworks) are: MySQL, PHP, Laravel, JavaScript, Angular JS, CSS/CSS3, and HTML5.</p>
                </div>
                <div class="col-lg-4">
                    <p>I have an obsession with learning new technologies. I am currently meddling with ones which have a focus on Canvas animations which include: NodeJS (ExpressJS), CreateJS, and D3JS.</p>
                </div>
<!--                 <div class="col-lg-8 col-lg-offset-2 text-center">
                    <a href="/download-resume" class="btn btn-lg btn-outline">
                        <i class="fa fa-download"></i> Download Resume
                    </a>
                </div> -->
            </div>
        </div>
    </section>

    <!-- Contact Section -->
    <section id="contact">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2>Contact Me</h2>
                    <hr class="star-primary">
                </div>
            </div>
            <div class="row">
                <div class="col-lg-8 col-lg-offset-2">
                    <form action="/contact-me" method="post">
                        {{ csrf_field() }}
                        <div class="row control-group">
                            <div class="form-group col-xs-12 floating-label-form-group controls">
                                <label>Name</label>
                                <input type="text" class="form-control" placeholder="Name" name="name">
                                @if ($errors->has('name'))
                                <div class="alert alert-danger">
                                    {{ $errors->first('name') }}
                                </div>
                                @endif
                            </div>
                        </div>
                        <div class="row control-group">
                            <div class="form-group col-xs-12 floating-label-form-group controls">
                                <label>Email Address</label>
                                <input type="email" class="form-control" placeholder="Email Address" name="email">
                                @if ($errors->has('email'))
                                <div class="alert alert-danger">
                                    {{ $errors->first('email') }}
                                </div>
                                @endif
                            </div>
                        </div>
                        <div class="row control-group">
                            <div class="form-group col-xs-12 floating-label-form-group controls">
                                <label>Phone Number</label>
                                <input type="tel" class="form-control" placeholder="Phone Number" name="phone">
                                @if ($errors->has('phone'))
                                <div class="alert alert-danger">
                                    {{ $errors->first('phone') }}
                                </div>
                                @endif
                            </div>
                        </div>
                        <div class="row control-group">
                            <div class="form-group col-xs-12 floating-label-form-group controls">
                                <label>Message</label>
                                <textarea rows="5" class="form-control" placeholder="Message" name="message"></textarea>
                                @if ($errors->has('message'))
                                <div class="alert alert-danger">
                                    {{ $errors->first('message') }}
                                </div>
                                @endif
                            </div>
                        </div>
                        <br>
                        <div id="success"></div>
                        <div class="row">
                            <div class="form-group col-xs-12">
                                <button type="submit" class="btn btn-success btn-lg">Send</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="text-center">
        <div class="footer-above">
            <div class="container">
                <div class="row">
                    <div class="footer-col col-md-6">
                        <h3>Location</h3>
                        <p>Ontario, Canada</p>
                    </div>
                    <div class="footer-col col-md-6">
                        <h3>Around the Web</h3>
                        <ul class="list-inline">
                            <li>
                                <a href="https://github.com/patoui" target="_blank" class="btn-social btn-outline"><i class="fa fa-fw fa-github"></i></a>
                            </li>
                            <li>
                                <a href="https://mobile.twitter.com/OuimetPatrique" target="_blank" class="btn-social btn-outline"><i class="fa fa-fw fa-twitter"></i></a>
                            </li>
                            <li>
                                <a href="https://www.linkedin.com/public-profile/settings?trk=prof-edit-edit-public_profile" target="_blank" class="btn-social btn-outline"><i class="fa fa-fw fa-linkedin"></i></a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer-below">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        Copyright &copy; http://patriqueouimet.com 2016
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <!-- Scroll to Top Button (Only visible on small and extra-small screen sizes) -->
    <div class="scroll-top page-scroll hidden-sm hidden-xs hidden-lg hidden-md">
        <a class="btn btn-primary" href="#page-top">
            <i class="fa fa-chevron-up"></i>
        </a>
    </div>

    <!-- Portfolio Modals -->
    <div class="portfolio-modal modal fade" id="portfolioModal1" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-content">
            <div class="close-modal" data-dismiss="modal">
                <div class="lr">
                    <div class="rl">
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 col-lg-offset-2">
                        <div class="modal-body">
                            <h2>Profile Website</h2>
                            <hr class="star-primary">
                            <picture>
                                <source media="(min-width: 414px)" srcset="{{ asset('image/profile-website.png?width=354') }}">
                                <img src="{{ asset('image/profile-website.png?width=720') }}" class="img-responsive img-centered">
                            </picture>
                            <p>Profile website used to display work from current/previous employers and future aspirations</p>
                            <ul class="list-inline item-details">
                                <li>Client:
                                    <strong><a href="http://patriqueouimet.com">Patrique Ouimet</a>
                                    </strong>
                                </li>
                                <li>Date:
                                    <strong><a href="http://patriqueouimet.com">August 2016</a>
                                    </strong>
                                </li>
                                <li>Service:
                                    <strong><a href="http://patriqueouimet.com">Web Development - Full Stack</a>
                                    </strong>
                                </li>
                            </ul>
                            <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="portfolio-modal modal fade" id="portfolioModal3" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-content">
            <div class="close-modal" data-dismiss="modal">
                <div class="lr">
                    <div class="rl">
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 col-lg-offset-2">
                        <div class="modal-body">
                            <h2>Tether XMP</h2>
                            <hr class="star-primary">
                            <picture>
                                <source media="(min-width: 414px)" srcset="{{ asset('image/tether-website.png?width=354') }}">
                                <img src="{{ asset('image/tether-website.png?width=720') }}" class="img-responsive img-centered">
                            </picture>
                            <p>Current employer uses mobile marketing techniques to provide clients with rich data and relationship based marketing strategies.</p>
                            <ul class="list-inline item-details">
                                <li>Client:
                                    <strong><a href="https://tetherxmp.com">The Mobile Experience Company</a>
                                    </strong>
                                </li>
                                <li>Date:
                                    <strong><a href="https://tetherxmp.com">April 2015 - Current</a>
                                    </strong>
                                </li>
                                <li>Service:
                                    <strong><a href="https://tetherxmp.com">Web Development - Full Stack</a>
                                    </strong>
                                </li>
                            </ul>
                            <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="portfolio-modal modal fade" id="portfolioModal4" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-content">
            <div class="close-modal" data-dismiss="modal">
                <div class="lr">
                    <div class="rl">
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 col-lg-offset-2">
                        <div class="modal-body">
                            <h2>The Job Window</h2>
                            <hr class="star-primary">
                            <picture>
                                <source media="(min-width: 414px)" srcset="{{ asset('image/thejobwindow-website.png?width=354') }}">
                                <img src="{{ asset('image/thejobwindow-website.png?width=720') }}" class="img-responsive img-centered">
                            </picture>
                            <p>Website providing job searching functonality to users based on criterias, also aggregates jobs from other boards while pushing jobs to boards via API</p>
                            <ul class="list-inline item-details">
                                <li>Client:
                                    <strong><a href="http://thejobwindow.com">The Job Window Enterprises</a>
                                    </strong>
                                </li>
                                <li>Date:
                                    <strong><a href="http://thejobwindow.com">June 2014 - April 2015</a>
                                    </strong>
                                </li>
                                <li>Service:
                                    <strong><a href="http://thejobwindow.com">Web Development - Full Stack | Feature implementation to existing site</a>
                                    </strong>
                                </li>
                            </ul>
                            <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="portfolio-modal modal fade" id="portfolioModal5" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-content">
            <div class="close-modal" data-dismiss="modal">
                <div class="lr">
                    <div class="rl">
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 col-lg-offset-2">
                        <div class="modal-body">
                            <h2>25 To Dine</h2>
                            <hr class="star-primary">
                            <picture>
                                <source media="(min-width: 414px)" srcset="{{ asset('image/25todine-website.png?width=354') }}">
                                <img src="{{ asset('image/25todine-website.png?width=720') }}" class="img-responsive img-centered">
                            </picture>
                            <p>Website to redeem restaurant vouchers</p>
                            <ul class="list-inline item-details">
                                <li>Client:
                                    <strong><a href="http://25todine.com">Smart Circle International</a>
                                    </strong>
                                </li>
                                <li>Date:
                                    <strong><a href="http://25todine.com">January 2015 - April 2015</a>
                                    </strong>
                                </li>
                                <li>Service:
                                    <strong><a href="http://25todine.com">Web Development - Full Stack</a>
                                    </strong>
                                </li>
                            </ul>
                            <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="portfolio-modal modal fade" id="portfolioModal6" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-content">
            <div class="close-modal" data-dismiss="modal">
                <div class="lr">
                    <div class="rl">
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 col-lg-offset-2">
                        <div class="modal-body">
                            <h2>25 To Dine</h2>
                            <hr class="star-primary">
                            <picture>
                                <source media="(min-width: 414px)" srcset="{{ asset('image/aegolfpass-website.png?width=354') }}">
                                <img src="{{ asset('image/aegolfpass-website.png?width=720') }}" class="img-responsive img-centered">
                            </picture>
                            <p>Website to provide information on deals for golf packages for companies</p>
                            <ul class="list-inline item-details">
                                <li>Client:
                                    <strong><a href="http://aegolfpass.com">Appreciation Events</a>
                                    </strong>
                                </li>
                                <li>Date:
                                    <strong><a href="http://aegolfpass.com">February 2015 - April 2015</a>
                                    </strong>
                                </li>
                                <li>Service:
                                    <strong><a href="http://aegolfpass.com">Web Development - Full Stack</a>
                                    </strong>
                                </li>
                            </ul>
                            <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('js/all.js') }}"></script>
    <script src="{{ asset('js/freelancer.min.js') }}"></script>

    <!-- Plugin JavaScript -->
    <script src="http://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js"></script>
    <script>$('div#flash-message').not('.alert-important').delay(3000).fadeOut(350);</script>

</body>

</html>
