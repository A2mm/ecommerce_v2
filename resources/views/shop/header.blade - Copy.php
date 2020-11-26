<!DOCTYPE HTML>
<html>
<head>
<title>{{trans('layout.Luxgems Shop')}}</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="Luxgems market" />
<link rel="shortcut icon" type="image/png" href="http://luxgems.co.uk/logos_e/fav.ico"/>
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>



<!--GoogleAnalytics-->
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-57415851-18', 'auto');
  ga('send', 'pageview');
</script>

<link href="{{asset('css/bootstrap.css')}}" rel='stylesheet' type='text/css' />
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
{{-- <script src="{{asset('js/simpleCart.min.js')}}"> </script> --}}
<script src="{{asset('js/jquery.min.js')}}"></script>

<!-- Custom Theme files -->
<link href="{{asset('css/style.css')}}" rel='stylesheet' type='text/css' />
<!-- Custom Theme files -->
<!--webfont-->
<link href='https://fonts.googleapis.com/css?family=Raleway:100,200,300,400,500,600,700,800,900' rel='stylesheet' type='text/css'>
<link href='https://fonts.googleapis.com/css?family=Audiowide' rel='stylesheet' type='text/css'>
<script src="{{asset('js/jquery.easydropdown.js')}}"></script>
<!-- Add fancyBox main JS and CSS files -->
<script src="{{asset('js/jquery.magnific-popup.js')}}" type="text/javascript"></script>
<script src="{{asset('js/cbpViewModeSwitch.js')}}" type="text/javascript"></script>
<script src="{{asset('js/classie.js')}}" type="text/javascript"></script>

<script src="{{asset('js/easyResponsiveTabs.js')}}" type="text/javascript"></script>
<script src="{{asset('js/jquery.flexisel.js')}}" type="text/javascript"></script>
<link href="{{asset('css/flexslider.css')}}" rel="stylesheet" type="text/css">
<script src="{{asset('js/jquery.flexslider.js')}}" type="text/javascript"></script>
<link href="{{asset('css/magnific-popup.css')}}" rel="stylesheet" type="text/css">
<link href="{{asset('css/sweetalert.min.css')}}" rel="stylesheet" type="text/css">
<script src="{{asset('js/sweetalert.min.js')}}" type="text/javascript"></script>


<script src="{{asset('js/jquery.countdown.js')}}"></script>

<link href="{{asset('css/hamburger.css')}}" rel="stylesheet" type="text/css">

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
		});
		</script>
</head>

<body>
<div class="header">
      <div class="container">
         <div class="header-top">
      		 <div class="logo">
				<a href="{{url('/')}}"><img src="{{asset('logos_e/logo_2_m.png')}}" alt=""/></a>
			 </div>
		   <div class="header_right">
      		 {{-- <div class="logo">
				<a href="{{url('/')}}"><img src="{{asset('logos_e/logo_2_m.png')}}" alt=""/></a>
			 </div> --}}

@if(!Auth::check())
			 <ul class="social">

                                <li><a href="{{route('shop.register')}}">Sign Up</a></li>
				<li><a id="social_login" href="{{route('shop.login')}}">Login</a></li>
</ul>
@endif
<!--
				<li><a href=""><i class="tw"> </i> </a></li>
				<li><a href=""><i class="utube"> </i> </a></li>
				<li><a href=""><i class="pin"> </i> </a></li>
				<li><a href=""><i class="instagram"> </i> </a></li>
			 </ul>
		    <div class="lang_list">
			  <select tabindex="4" class="dropdown">
				<option value="" class="label" value="">En</option>
				<option value="1">English</option>
				<option value="2">French</option>
				<option value="3">German</option>
			  </select>
   			</div>
			<div class="clearfix"></div>

-->


          </div>
          <div class="clearfix"></div>
		 </div>
		 <div class="banner_wrap">

@if(Auth::check())

			 <div class="bannertop_box">
    		 		<ul class="login">
 						@if(Auth::check())
 							<li class="login_text">Hi, {{Auth::user()->name}}</li>
 						@else
    		 			<li class="login_text"><a href="{{route('shop.login')}}">Login</a></li>
 						@endif
    		 			<div class='clearfix'></div>
    		 		</ul>
						@if(Auth::check())
    		 		<div class="cart_bg">
 	   		 	  <ul class="cart">
 	   		 		 <a href="{{route('cart.user')}}">

 					    <h4><i class="cart_icon"> </i><p>Cart: <span class="simpleCart_total"><span id="simpleCart_quantity" class="simpleCart_quantity">{{Auth::user()->cart_summary()}}</span> {{str_plural('order', Auth::user()->cart_summary())}}</span> </p><div class="clearfix"> </div></h4>

 					 </a>
 				     <div class="clearfix"> </div>
                   </ul>
 	   		 	</div>
					@endif
 			  	<ul class="quick_access">
    		 			{{-- <li class="view_cart"><a href="{{route('logout.user')}}">View Cart</a></li> --}}
 						@if(Auth::check())
 							<li class="check"><a href="{{route('logout.user')}}">Logout</a></li>
 						@endif
    		 			<div class='clearfix'></div>
    		 		</ul>
    		 		<!-- <div class="search">
 	  			   <input type="text" value="Search" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Search';}">
 				   <input type="submit" value="">
 	  			</div> -->
 	  			{{-- <div class="welcome_box">
 	  				<h2>Welcome to windsur</h2>
 	  				<p>It is a long established fact that a reader will be distracted by the readable content of a page</p>
 	  			</div> --}}
    		 	</div>

@endif


   		 	<div class="banner_right">

   		 		{{-- <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's.</p>
   		 		<a href="#" class="banner_btn">Buy Now</a> --}}
   		 	</div>
   		 	<div class='clearfix'></div>
	    </div>
	   </div>
	</div>
  <div class="main">
