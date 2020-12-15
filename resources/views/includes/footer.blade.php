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
            <p style="font-family: 'Raleway', sans-serif; color: #fff"> &copy; {{ 'project' }} date('Y')</p>
            <ul class="footer_social" style="vertical-align: middle; display:inline-block!important;">
                <li><a href="" target="_blank"> <i class="fb"> </i> </a></li>
                <li><a href="" target="_blank"><i class="tw"> </i> </a></li>
                <li><a href="" target="_blank"><i class="fa fa-instagram insta pt-1"> </i> </a></li>
                <div class="clearfix"></div>
            </ul>


    
        </div>
       
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
