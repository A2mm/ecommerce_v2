<!DOCTYPE HTML>
<html>

<head>
    @if(isset($page_title))
    <title>{{$page_title}}</title>
    @else
    <title>{{ 'project' }}</title>
    @endif

<meta property="og:title" content="{{ 'project' }}" />
<meta property="og:type" content="website" />
<meta property="og:image" content="{{asset('logos_e/logo_2_m.png')}}" />


    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="keywords" content="" />
    <link rel="shortcut icon" type="image/png" href="" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

    <!--JS-->
    <script src="{{asset('js/jquery.min.js')}}"></script>
    <script src='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js'></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.10.0/js/bootstrap-select.min.js'></script>

    <script type="application/x-javascript">
        addEventListener("load", function() {
            setTimeout(hideURLbar, 0);
        }, false);

        function hideURLbar() {
            window.scrollTo(0, 1);
        }

    </script>
    <!--GoogleAnalytics-->
    <script>
        (function(i, s, o, g, r, a, m) {
            i['GoogleAnalyticsObject'] = r;
            i[r] = i[r] || function() {
                (i[r].q = i[r].q || []).push(arguments)
            }, i[r].l = 1 * new Date();
            a = s.createElement(o),
                m = s.getElementsByTagName(o)[0];
            a.async = 1;
            a.src = g;
            m.parentNode.insertBefore(a, m)
        })(window, document, 'script', 'https://www.google-analytics.com/analytics.js', 'ga');

        ga('create', 'UA-57415851-18', 'auto');
        ga('send', 'pageview');

    </script>


    @if (App::isLocale('en'))
    <link href="{{asset('css/bootstrap.css')}}" rel='stylesheet' type='text/css' />
    <link href="{{asset('css/bootstrap-select.min.css')}}" rel='stylesheet' type='text/css' /> @else
    <link href="{{asset('css/ar/bootstrap.css')}}" rel='stylesheet' type='text/css' /> @endif

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://js.pusher.com/4.1/pusher.min.js"></script>
    {{--
    <script src="{{asset('js/simpleCart.min.js')}}">


    </script> --}}

    <script>
        $(window).load(function() {
            $('.flexslider').flexslider({
                animation: "slide",
                start: function(slider) {
                    $('body').removeClass('loading');
                }
            });
        });

    </script>


    <script src="{{ asset('js/share.js') }}"></script>
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">


    <!-- Custom Theme files -->

    @if (App::isLocale('en')) @if (request()->g =='Women')
    <link href="{{asset('css/women.css')}}" rel='stylesheet' type='text/css' />
    <link href="{{asset('css/style.css')}}" rel='stylesheet' type='text/css' /> @elseif (request()->g =='Kids')
    <link href="{{asset('css/kids.css')}}" rel='stylesheet' type='text/css' />
    <link href="{{asset('css/style.css')}}" rel='stylesheet' type='text/css' /> @else
    <link href="{{asset('css/style.css')}}" rel='stylesheet' type='text/css' /> @endif @else @if (request()->g =='Women')
    <link href="{{asset('css/women.css')}}" rel='stylesheet' type='text/css' />
    <link href="{{asset('css/ar/style.css')}}" rel='stylesheet' type='text/css' /> @elseif (request()->g =='Kids')
    <link href="{{asset('css/kids.css')}}" rel='stylesheet' type='text/css' />
    <link href="{{asset('css/ar/style.css')}}" rel='stylesheet' type='text/css' /> @else
    <link href="{{asset('css/ar/style.css')}}" rel='stylesheet' type='text/css' /> @endif @endif
    <style type="text/css">
        .active span {
            color: #fff !important;
            text-decoration: none;
            background-color: #009c6a !important;
        }

        .pager li>a,
        .pager li>span {
            border-radius: 2px;
            font-family: sans-serif;
            padding: 5px 10px;
            border: none;
        }

        .pager li {
            margin: 20px 0px 0px 0px !important;
            padding: 0 !important;
        }
        .fa-facebook-official:before{
            color: #4267b2;
        }
        .fa-twitter:before{
            color: #3fccfd;
        }
        .fa-linkedin:before{
            color: #0077B5;
        }

        /* The snackbar - position it at the bottom and in the middle of the screen */
#snackbar {
    visibility: hidden;
    min-width: 250px;
    border-radius: 10px;
    margin-left: -125px;
    background-color: #33735e;
    color: #f1f1f1;
    box-shadow: 0px 0px 7px 3px #8c8c8c8a;
    /* border: 1px solid #716767; */
    text-align: center;
    /* border-radius: 2px; */
    padding: 16px;
    position: fixed;
    z-index: 1;
    left: 50%;
    bottom: 30px;
}
#register_alert{
    visibility: hidden;
    min-width: 250px;
    border-radius: 10px;
    margin-left: -125px;
    background-color: #e43131;
    color: #f2f2f2;
    box-shadow: 0px 0px 7px 3px #8c8c8c8a;
    /* border: 1px solid #716767; */
    text-align: center;
    /* border-radius: 2px; */
    padding: 16px;
    position: fixed;
    z-index: 1;
    left: 50%;
    bottom: 30px;
}
/* Show the snackbar when clicking on a button (class added with JavaScript) */
#register_alert.show {
    visibility: visible; /* Show the snackbar */

/* Add animation: Take 0.5 seconds to fade in and out the snackbar.
However, delay the fade out process for 2.5 seconds */
    -webkit-animation: fadein 0.2s, fadeout 0.5s 2.5s;
    animation: fadein 0.2s, fadeout 0.5s 2.5s;
}

/* Animations to fade the snackbar in and out */
@-webkit-keyframes fadein {
    from {bottom: 0; opacity: 0;}
    to {bottom: 30px; opacity: 1;}
}

@keyframes fadein {
    from {bottom: 0; opacity: 0;}
    to {bottom: 30px; opacity: 1;}
}

@-webkit-keyframes fadeout {
    from {bottom: 30px; opacity: 1;}
    to {bottom: 0; opacity: 0;}
}

@keyframes fadeout {
    from {bottom: 30px; opacity: 1;}
    to {bottom: 0; opacity: 0;}
}

/* Show the snackbar when clicking on a button (class added with JavaScript) */
#snackbar.show {
    visibility: visible; /* Show the snackbar */

/* Add animation: Take 0.5 seconds to fade in and out the snackbar.
However, delay the fade out process for 2.5 seconds */
    -webkit-animation: fadein 0.2s, fadeout 0.5s 2.5s;
    animation: fadein 0.2s, fadeout 0.5s 2.5s;
}

/* Animations to fade the snackbar in and out */
@-webkit-keyframes fadein {
    from {bottom: 0; opacity: 0;}
    to {bottom: 30px; opacity: 1;}
}

@keyframes fadein {
    from {bottom: 0; opacity: 0;}
    to {bottom: 30px; opacity: 1;}
}

@-webkit-keyframes fadeout {
    from {bottom: 30px; opacity: 1;}
    to {bottom: 0; opacity: 0;}
}

@keyframes fadeout {
    from {bottom: 30px; opacity: 1;}
    to {bottom: 0; opacity: 0;}
}

.active{
    background-color: #f1f1f1!important;
    color: #009c6a!important;
}
.alert-danger {
    left: 25%;
    width: 50%;
    text-align: center;
    bottom: 30px;
    position: fixed;
    background-color: #e43131;
    color: #f2f2f2;
    z-index: 1005;
    box-shadow: 0px 0px 7px 3px #8c8c8c8a;
    border-radius: 10px;
    border-color: #d2c1c100;
}
    </style>
    <!--JS-->
    <script src="{{asset('js/jquery.easydropdown.js')}}"></script>
    <script src="{{asset('js/jquery.magnific-popup.js')}}" type="text/javascript"></script>
    <script src="{{asset('js/cbpViewModeSwitch.js')}}" type="text/javascript"></script>
    <script src="{{asset('js/classie.js')}}" type="text/javascript"></script>
    <script src="{{asset('js/jquery.flexslider.js')}}" type="text/javascript"></script>
    <script src="{{asset('js/sweetalert.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('js/easyResponsiveTabs.js')}}" type="text/javascript"></script>
    <script src="{{asset('js/jquery.flexisel.js')}}" type="text/javascript"></script>
    <script src="{{asset('js/jquery.countdown.js')}}"></script>
    <script src="{{asset('js/mdb.min.js')}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/mixitup/2.1.11/jquery.mixitup.js" type="text/javascript"></script>
    <!--CSS-->
    <!--webfont-->
    <link href='https://fonts.googleapis.com/css?family=Raleway:100,200,300,400,500,600,700,800,900' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Audiowide' rel='stylesheet' type='text/css'>
    <link href="{{asset('css/flexslider.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('css/magnific-popup.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('css/sweetalert.min.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('css/hamburger.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('css/component.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('css/mdb.min.css')}}" rel="stylesheet" type="text/css">

    <script>
        $(document).ready(function() {
            $('.popup-with-zoom-anim').magnificPopup({
                type: 'inline',
                fixedContentPos: false,
                fixedBgPos: true,
                overflowY: 'auto',
                closeBtnInside: true,
                preloader: false,
                midClick: true,
                removalDelay: 300,
                mainClass: 'my-mfp-zoom-in'
            });
            $('select').selectpicker();
        });

    </script>

    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-57415851-18"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());

        gtag('config', 'UA-57415851-18');

    </script>
    <style>
        #products_mix .mix {
            display: none;
        }

        .colorPlatte {
            display: none;
            height: 20px;
            width: 20px;
            top: 0;
            left: 0;
            z-index: 2;
        }

        .colorPlatte+label {
            height: 20px;
            width: 20px;
            display: inline-block;
            padding: 0 0 0 0px;
            top: 0;
            left: 0;
            z-index: 1;
            border-radius: 100%;
            border: 1px solid #999;
            box-sizing: border-box;
        }

        .colorPlatte:checked+label {
            height: 20px;
            width: 20px;
            display: inline-block;
            padding: 0 0 0 0px;
            border: 5px solid #999;
            box-sizing: border-box;
            border-radius: 100%;
        }

    </style>
</head>

<body>
    <header>
        <div class="header_right">
            {{-- @if(App::isLocale('en'))
            <a href="{{url('/trans/ar')}}" class="lang">عربي</a> @else
            <a href="{{url('/trans/en')}}" class="lang">English</a> @endif --}}

            @if(!Auth::check())
            <ul class="social">
                <li><!--<i class="fa fa-user-plus" aria-hidden="true"></i>--><a href="" class="text-primary text-uppercase" type="" data-toggle="modal" data-target="#reg_form">{{trans('layout.sign_up')}}</a></li>
                <li><!--<i class="fa fa-sign-in" aria-hidden="true"></i>--><a id="social_login"  type="" class="btn btn-primary rounded" data-toggle="modal" data-target="#login_form">{{trans('layout.login')}}</a></li>
            </ul>
            <div class="form-group pull-left">
                <form id="curr_form" style="margin:0;">
                    <input type="hidden" name="g" value="{{request()->g}}">
                    <input type="hidden" name="Subcategory" value="{{(isset(request()->Subcategory)) ? request()->Subcategory : 'ALL'}}">
                    <input type="hidden" name="accessory" value="{{(isset(request()->accessory)) ? request()->accessory : 'ALL'}}">
                    <input type="hidden" name="gem_shape" value="{{(isset(request()->gem_shape)) ? request()->gem_shape : 'ALL'}}">
                    @if(isset($currencies))
                    {!! Form::select('c',$currencies,request()->c, ['class' => 'form-control', 'id' => 'curr']) !!}
                    @endif
                </form>
            </div>
            @endif

            <!--BANNER WRAP-->
            <div class="banner_wrap">
                @if(Auth::check())
                <div class="bannertop_box">
                    <ul class="login">
                        @if(Auth::check())
                        <li class="cart_bg">
                            <div class="cart">
                                <a href="{{route('cart.user').getRequest()}}">
                                     <i class="cart_icon fa fa-shopping-cart"></i>
                                     <span id="simpleCart_quantity" class="simpleCart_quantity">{{Auth::user()->cart_summary()}}</span>
                                      <!--<p>{{--{{trans('layout.cart')}}:--}}
                                          <span class="simpleCart_total">
                                              {{--{{trans('layout.Order')}}--}}
                                          </span>
                                      </p>-->
                                     <div class="clearfix"> </div>
                                     </a>
                                <div class="clearfix"> </div>
                            </div>
                        </li>
                        @endif
                        @if(Auth::check())
                        <li class="login_text">{{trans('layout.hi')}}, <a href="{{route('shop.profile').getRequest()}}">
                            {{Auth::user()->name}}</a></li>
                        @else
                        <li class="login_text"><a href="{{route('shop.login')}}">{{trans('layout.login')}}</a></li>
                        @endif
                        <!--LOGOUT-->
                        {{--
                        <li class="view_cart"><a href="{{route('logout.user')}}">View Cart</a></li> --}}
                        @if(Auth::check())
                        <li class="check"><a href="{{route('logout.user')}}"><i class="fa fa-sign-out" aria-hidden="true"></i> {{trans('layout.logout')}}</a></li>
                        @endif
                        <!---->
                    </ul>
                    <div class="form-group pull-left">
                        <form id="curr_form" style="margin:0;">
                            <input type="hidden" name="g" value="{{request()->g}}">
                            <input type="hidden" name="Subcategory" value="{{(isset(request()->Subcategory)) ? request()->Subcategory : 'ALL'}}">
                            <input type="hidden" name="accessory" value="{{(isset(request()->accessory)) ? request()->accessory : 'ALL'}}">
                            <input type="hidden" name="gem_shape" value="{{(isset(request()->gem_shape)) ? request()->gem_shape : 'ALL'}}">
                            @if(isset($currencies))
                            {!! Form::select('c',$currencies,request()->c, ['class' => 'form-control', 'id' => 'curr']) !!}
                            @endif
                        </form>
                    </div>
                </div>
                @endif
                <div class='clearfix'></div>
            </div>
            <!--END BANNER WRAP-->
        </div>
        <!--END HEADER RIGHT-->
    </header>
    <!--END HEADER-->
    <div class="header">
        <!--CONTAINER-->
        <div class="logo">
            <a href="{{url('/')}}{{(isset(request()->c)) ? '?c='.request()->c : ''}}"><img src="{{asset('logos_e/logo_2_m.png')}}" alt=""/></a>
        </div>
        @if(isset(request()->g))
        <a href="/index?g={{request()->g}}{{request()->c?'&c='.request()->c:''}}">
            <p style="position: absolute;width: auto;margin: 0;right: 0;text-align: right;z-index: 888;top: 0;font-family: 'Raleway', sans-serif;font-size: 50pt;font-weight: 300; color: #FFF;padding: 0px 40px 0px 0px;overflow: hidden;">{{request()->g}}</p>
        </a>
        @endif
        <div class="clearfix"></div>
        <!--END CONTAINER-->
    </div>
    <!--END HEADER-->

<!-- Login Modal -->
<div class="modal fade" id="login_form" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content rounded">
      <div class="modal-header">
        <h2>login</h2>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body text-center py-5">
            {!! Form::open(['route' => 'login.user']) !!}
            <div class="row justify-content-center">
                <div class="col-md-10 pb-3">
                    <input type="text" name="email" autocomplete="off" placeholder="Email*" class="form-control" autofocus>
                </div>

                <div class="col-md-10 pb-3">
                    <input type="password" name="password" autocomplete="off" placeholder="password*" class="form-control">
                </div>
                <div class="col-md-10 pb-3">
                    <button type="submit" title="" id="" class="btn btn-success btn-block rounded">{{trans( 'layout.login_submit')}}</button>
                    <div class="clearfix"></div>
                    {{-- <input type="hidden" value="{{request()->redirectTo}}" name="redirectTo">{!! Form::close() !!} --}}
                    {{-- <input type="hidden" value="{{URL::Current()}}" name="redirectTo">{!! Form::close() !!} --}}
                    <input type="hidden" value="{{(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://{$_SERVER['HTTP_HOST']}{$_SERVER['REQUEST_URI']}"}}" name="redirectTo">{!! Form::close() !!}
                </div>


            <a style="color: #003569;" href="{{route('shop.forgot').getRequest()}}">Forgot password?</a>

            <div class="col-md-10 social-auth-links text-center">

                <p style="margin:10px 0px">- OR -</p>

                <!-- <a href="{{url('facebook')}}" class="fb-login-button">
                    <img style="width: 200px;" src="{{asset('fb_logo.png')}}">
                </a> -->
                <a href="{{url('facebook')}}" class="nounderline">
                    <div class="loginBtn loginBtn--facebook">
                      Login with Facebook
                    </div>
                </a>
            </div>
              {{--

                <div class="fb-login-button" data-max-rows="1" data-size="medium" data-button-type="continue_with" data-show-faces="false" data-auto-logout-link="false" data-use-continue-as="true"></div>--}} {{-- <a href="#" class="btn btn-block btn-social btn-google btn-flat"><i class="fa fa-google-plus"></i> Sign up using Google+</a> --}}

            </div>
      </div>
      <!--<div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>-->
    </div>
  </div>
</div>
<!-- registraion Modal -->
<div class="modal fade" id="reg_form" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content rounded">
      <div class="modal-header">
        <h2>register</h2>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body text-center" style="padding: 50px 0">
          {!! Form::open(['route' => 'register.user']) !!}
            <div class="row justify-content-center">
                <div class="col-md-10 pb-3">
                    <input type="text" id="register_username" name="name" autocomplete="off" placeholder="user name*">
                </div>
                <div class="col-md-10 pb-3">
                    <input type="text" id="register_email" name="email" autocomplete="off" placeholder="email*">
                </div>
                <div class="col-md-10 pb-3">
                    <input id="register_password" type="password" name="password" autocomplete="off" placeholder="password*">
                </div>
                <div class="col-md-10 pb-3">
                    <input  type="password" name="password_confirmation" id="register_password-confirmation" placeholder="confirm password*">
                </div>
                <div class="col-md-10">
                    <input class="btn btn-success btn-block" id="shop_register_btn" type="button" value={{trans( 'layout.signUp_submit')}}>
                    <div class="clearfix"> </div>
                    {!! Form::close() !!}
                </div>
            </div>
      </div>
    </div>
  </div>
  <div id="snackbar"></div>
  <div id="register_alert"></div>
</div>
