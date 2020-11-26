</div>

<div class="container">

</div>
<div class="container">
    {{--
    <div class="instagram_top">
        <div class="instagram text-center">
            <h3><i class="insta_icon"> </i> Instagram feed:&nbsp;<span class="small">#Surfhouse</span></h3>
        </div>
        <ul class="instagram_grid">
            <li><a class="popup-with-zoom-anim" href="#small-dialog1"><img src="{{asset('images/i1.jpg')}}" class="img-responsive"alt=""/></a></li>
            <li><a class="popup-with-zoom-anim" href="#small-dialog1"><img src="{{asset('images/i2.jpg')}}" class="img-responsive" alt=""/></a></li>
            <li><a class="popup-with-zoom-anim" href="#small-dialog1"><img src="{{asset('images/i3.jpg')}}" class="img-responsive" alt=""/></a></li>
            <li><a class="popup-with-zoom-anim" href="#small-dialog1"><img src="{{asset('images/i4.jpg')}}" class="img-responsive" alt=""/></a></li>
            <li><a class="popup-with-zoom-anim" href="#small-dialog1"><img src="{{asset('images/i5.jpg')}}" class="img-responsive" alt=""/></a></li>
            <li class="last_instagram"><a class="popup-with-zoom-anim" href="#small-dialog1"><img src="{{asset('images/i6.jpg')}}" class="img-responsive" alt=""/></a></li>
            <div class="clearfix"></div>
            <div id="small-dialog1" class="mfp-hide">
                <div class="pop_up">
                    <h4>A Sample Photo Stream</h4>
                    <img src="{{asset('images/i_zoom.jpg')}}" class="img-responsive" alt="" />
                </div>
            </div>
        </ul>
    </div> --}}
</div>
</div>
<div class="footer p-4">
    <div class="container">
        <div class="footer-grid">
            <p style="font-family: 'Raleway', sans-serif; color: #fff">{{trans('layout.Copyright')}} &copy; {{trans('layout.Luxgems Shop')}} 2017</p>
            <ul class="footer_social" style="vertical-align: middle; display:inline-block!important;">
                <li><a href="https://www.facebook.com/LuxGemsEG/" target="_blank"> <i class="fb"> </i> </a></li>
                <li><a href="https://twitter.com/LuxGemsEG" target="_blank"><i class="tw"> </i> </a></li>
                <li><a href="https://www.instagram.com/LuxGemsEG/" target="_blank"><i class="fa fa-instagram insta pt-1"> </i> </a></li>
                <div class="clearfix"></div>
            </ul>


            {{--
            @if(Auth::check())
            @if (!Auth::user()->role('affiliate')&&!Auth::user()->role('owner')&&!Auth::user()->role('vendor'))
            <a class="btn btn-primary" href="{{route('shop.affiliate.register')}}" style="vertical-align: middle;">Become an Affiliate</a>
            @elseif(Auth::user()->role('affiliate'))
            <a class="btn btn-primary" href="/affiliate/dashboard" style="vertical-align: middle;">Affiliate dashboard</a>
            @elseif(Auth::user()->role('vendor'))
            <a class="btn btn-primary" href="/vendor/dashboard" style="vertical-align: middle;">Vendor dashboard</a>
            @endif
            @else
            <a class="btn btn-primary" href="{{route('shop.affiliate.register')}}" style="vertical-align: middle;">Become an affiliate</a>
            @endif
            --}}

            {{--
            <h3>Category</h3>
            <ul class="list1">
                <li><a href="{{url('/')}}">Home</a></li>
                @foreach(App\Category::all() as $category)
                <li><a href="{{$category->path()}}">{{$category->name}}</a></li>
                @endforeach
            </ul> --}}
        </div>
        {{--
        <div class="footer-grid">
            <h3>Our Account</h3>
            <ul class="list1">
                <li><a href="#">Your Account</a></li>
                <li><a href="#">Personal information</a></li>
                <li><a href="#">Addresses</a></li>
                <li><a href="#">Discount</a></li>
                <li><a href="#">Orders history</a></li>
                <li><a href="#">Addresses</a></li>
                <li><a href="#">Search Terms</a></li>
            </ul>
        </div>
        <div class="footer-grid">
            <h3>Our Support</h3>
            <ul class="list1">
                <li><a href="#">Site Map</a></li>
                <li><a href="#">Search Terms</a></li>
                <li><a href="#">Advanced Search</a></li>
                <li><a href="#">Mobile</a></li>
                <li><a href="#">Contact Us</a></li>
                <li><a href="#">Mobile</a></li>
                <li><a href="#">Addresses</a></li>
            </ul>
        </div>
        <div class="footer-grid">
            <h3>Newsletter</h3>
            <p class="footer_desc">Nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat</p>
            <div class="search_footer">
                <input type="text" class="text" value="Insert Email" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Insert Email';}">
                <input type="submit" value="Submit">
            </div>
            <img src="{{asset('images/payment.png')}}" class="img-responsive" alt="" />
        </div>
        <div class="footer-grid footer-grid_last">
            <h3>About Us</h3>
            <p class="footer_desc">Diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam,.</p>
            <p class="f_text">Phone: &nbsp;&nbsp;&nbsp;00-250-2131</p>
            <p class="email">Email: &nbsp;&nbsp;&nbsp;<a href="#">info(at)Shape.com</a></p>
        </div>
        <div class="clearfix"> </div> --}}
    </div>
</div>
<script src="{{asset('js/xzoom.min.js')}}"></script>
<script>
    $(".hamburger").click(function() {
        $('.nav').toggle("slide");
        $(this).toggleClass('is-active');
    });
    $("#curr").change(function() {
        $("#curr_form").submit();
    });

    /* calling Xzoom script */
    $(".xzoom, .xzoom-gallery").xzoom({tint: '#333', Xoffset: 15});
</script>
<script src="{{asset('js/shop.js')}}"></script>
</body>

</html>
