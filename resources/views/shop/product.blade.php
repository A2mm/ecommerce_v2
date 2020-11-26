@extends('shop.master') @section('body')

<meta property="og:title" content="{{$product->name}}" />
<meta property="og:type" content="website" />
<meta property="og:url" content="http://159.203.161.30/public" />
<meta property="og:image" content="http://www.abc.net.au/news/image/8280754-3x2-940x627.jpg" />
<meta property="og:description" content="{{$product->description}}" />
<link href="{{asset('css/xzoom.css')}}" rel="stylesheet" type="text/css">
<style type="text/css">
    #ajax_status {
        display: none;
    }

    .flexslider .slides img {
        object-fit: cover;
        width: 100%;
    }

</style>
<div class="content_box">
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <div class="menu_box">
                    {{--
                    <h3 class="menu_head">{{trans('layout.Subcategories')}}
                        <button class="hamburger hamburger--collapse hidden-md hidden-lg" type="button">
                          <span class="hamburger-box">
                            <span class="hamburger-inner"></span>
                          </span>
                        </button>
                    </h3>
                    <ul class="nav">
                        @forelse ($subcategories as $sub)
                        <li><a href="{{$sub->path().getRequest()}}">{{(App::isLocale('ar')) ? $sub->arabic_name : $sub->name}}</a></li>
                        @empty
                        <li>{{trans('layout.No_categories')}}</li>
                        @endforelse
                    </ul>
                    --}}
                </div>
            </div>

            <div class="col-md-12">
                {{--
                <div class="dreamcrub">
                    <ul class="breadcrumbs">
                        <li class="home">
                            <a href="{{url('/index').getRequest()}}" title="Go to Home Page">{{trans('layout.Home')}}</a>&nbsp;
                            <span>&gt;</span>
                        </li>
                        <li class="home">&nbsp;
                            <a href="{{$product->category->path().getRequest()}}">{{(App::isLocale('ar')) ? $product->category->arabic_name : $product->category->name}}</a>&nbsp;
                            <span>&gt;</span>&nbsp;
                        </li>
                        <li class="home">
                            <a href="{{$product->subcategory->path().getRequest()}}">{{(App::isLocale('ar')) ? $product->subcategory->arabic_name : $product->subcategory->name}}</a>&nbsp;
                            <span>&gt;</span>&nbsp;
                        </li>
                        <li class="women">
                            {{(App::isLocale('ar')) ? $product->arabic_name : $product->name}}
                        </li>
                    </ul>
                    <ul class="previous">
                        <li><a href="{{URL::previous().getRequest()}}">{{trans('layout.Previous_Page')}}</a></li>
                    </ul>
                    <div class="clearfix"></div>
                </div>--}}
                <div class="singel_right">
                    <!--IMAGES SLIDER-->
                    <!--<div class="col-md-6">
                        <div class="flexslider">
                            <ul class="slides">
                                @foreach ($product->all_images_paths() as $path)
                                <li data-thumb="{{asset($path)}}">
                                    <img alt="{{$page_title}}" title="{{$page_title}}" src="{{asset($path)}}" />
                                </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>-->
                    <div class="col-md-6">
                        <img class="xzoom img-fluid mb-2" src="{{asset($product_imgs[0])}}" xoriginal="{{asset($product_imgs[0])}}"/>
                        <div class="xzoom-thumbs">
                        @foreach ($product->all_images_paths() as $path)
                            <a href="{{asset($path)}}">
                                <img class="xzoom-gallery" width="80" src="{{asset($path)}}"  xpreview="{{asset($path)}}">
                            </a>
                        @endforeach
                        </div>
                    </div>
                    <!--END IMAGES SLIDER-->

                    {{-- @if(Auth::user() && Auth::user()->role('user')) --}}
                    <div class="col-md-6">
                        <h1 class="@if($product->discount != 0 && isset($product->discount)) heading-lbl @endif">{{(App::isLocale('ar')) ? $product->arabic_name : $product->name}}</h1>

                        @if($vendor)
                        <span id="market_name" style="font-weight: bold;">Vendor: <a href="{{url('/vendors/'.$vendor->id).getRequest()}}">{{$vendor->vendor_name}}</a></span> @endif
                        <!--PRICE-->
                        <div class="col-md-12 price_single">
                            <span class="amount actual">
                                @if(isset($product->discount) && $product->discount != 0)
                                <strike class="mr-2">@if (App::isLocale('ar')) {{$product->price}} @else {{$product->price}} @endif</strike>
                                <div style="color: red;display: inline-block;padding-right: 3px;">
                                {{$product->discount}}
                                </div>
                                @else
                                <div style="display: inline-block;padding-right: 3px;">
                                {{$product->price}}
                                </div>
                                @endif
                            </span>
                        </div>
                        <!--END PRICE-->

                        @if(!empty($product->description))

                        <h2 class="quick" style="font-weight: bold;">{{trans('layout.Overview')}}:</h2>
                        <p class="quick_desc">
                            @if (App::isLocale('ar')) @if ($product->arabic_description) {{$product->arabic_description}} @else {{$product->description}} @endif @else {{$product->description}} @endif

                            <!--{{(App::isLocale('ar')) ? $product->arabic_description : $product->description}}-->
                        </p>
                        @else

                        <h2 class="quick" style="font-weight: bold;">{{trans('layout.Overview')}}:</h2>
                        <p class="quick_desc">{{trans('layout.No_description')}}.</p>
                        @endif

                        <br>
                        <h2 class="quick"><span style="font-weight: bold;">Product Code: </span>{{$product->unique_id}}</h2>

                        <br>
                        <h2 class="quick"><span style="font-weight: bold;">Gems Subcategory: </span>{{$product->subcategory->name}}</h2>

                        <br>
                        <h2 class="quick"><span style="font-weight: bold;">Accessory Type: </span>{{$product->accessory->name}}</h2>
                        @if($product->archive==0)
                        @if (Auth::check())
                        <div class="col-md-12" style="padding:0;">
                                <input type="hidden" id="g_G" name="g" value="{{request()->g}}">
                                <input type="hidden" id="m_M" name="Subcategory" value="{{request()->Subcategory}}">
                                <input type="hidden" id="acc_ACC" name="accessory" value="{{request()->accessory}}">
                                <input type="hidden" id="c_C" name="c" value="{{request()->c}}">
                                <input type="hidden" id="aff_AFF" name="affiliate" value="{{request()->affiliate}}">

                                <input type="hidden" id="product_uUiD" name="product_id" value="{{$product->id}}">
                                <ul class="product-qty">
                                    @if($product->minimum_order > 1 && $product->quantity >= $product->minimum_order)
                                    <span>{{trans('layout.Quantity')}}:</span>
                                    {{ Form::selectRange('quantity', $product->minimum_order, $product->quantity, $product->minimum_order,['id'=>'quantity_order']) }} Minimum Order: {{$product->minimum_order}} Items
                                    @elseif($product->minimum_order > 1 && $product->quantity < $product->minimum_order)
                                    <span>{{trans('layout.Quantity')}}:</span> {{ Form::selectRange('quantity', 1, $product->quantity, 1,['id'=>'quantity_order']) }} Sorry, Minimum Order: {{$product->minimum_order}} Items
                                    <p style="font-weight: bold; color:red;"><big>Out Of Stock</big></p>
                                    @elseif($product->quantity>0)
                                    <span>{{trans('layout.Quantity')}}:</span> {{ Form::selectRange('quantity', 1, $product->quantity, 1,['id'=>'quantity_order']) }}
                                    @else
                                    <p style="font-weight: bold; color:red;"><big>Out Of Stock</big></p>
                                    @endif
                                </ul>
                                @if($product->minimum_order > 1 && $product->quantity >= $product->minimum_order)
                                <button title="" id="one_c" class="btn btn-primary">
                                    <i class="fa fa-shopping-cart"></i> Add to Cart
                                </button>
                                @elseif($product->quantity > 0 && $product->minimum_order<=1 )
                                <button title="" id="one_c" class="btn btn-primary">
                                <i class="fa fa-shopping-cart"></i> Add to Cart
                                </button>
                                @endif
                            <input type="hidden" id="product_Uid" name="product_id" value="{{$product->id}}">
                            <div class="btn_form button item_add item_1 d-inline">
                                <button id="wishlist__Btn" class="btn btn-primary">
                                    <i class="fa fa-heart"></i> {{($wishedBefore == 0) ? 'Add To WishList' : 'Remove From WishList'}}
                                </button>
                                    <span id="ajax_status"><img src="http://www.fusioncharts.com/theme/giphy.gif"></span>
                            </div>
                            @else
                            <a class="btn btn-primary woman" type="" class="btn btn-info rounded" data-toggle="modal" data-target="#login_form">{{trans('layout.You_need_to_login')}}</a>
                            @endif {!!$shares!!}
                        </div>
                        @endif



                        {{--<a href="https://www.facebook.com/sharer/sharer.php?u=http://159.203.161.30/public/product/158/the-traitor-king?g=Women&Subcategory=ALL&accessory=ALL&display=popup"> share this </a> --}}
                    </div>

                    @if (Auth::user() && Auth::user()->role('affiliate')) @if(Auth::user()->slug == NULL)
                    <p>
                        You need to setup your slug to be able to generate links
                        <a href="{{route('affiliate.manage.profile')}}" target="_blank">Go to your settings</a>
                    </p>
                    @else
                    <div class="cont1 span_2_of_a1 simpleCart_shelfItem">
                        <h3>Make a link for this product?</h3>
                        <form action="{{route('affiliate.manage.link.generate')}}" method="POST">
                            <input type="hidden" name="product_id" value="{{$product->id}}">
                            <input type="text" name="username" value="{{Auth::user()->slug}}" disabled> /
                            <input type="text" name="slug" value="">
                            <div class="btn_form button item_add item_1">
                                <input class="btn btn-primary" type="submit" value="Generate" title=""> {!! Form::close() !!}
                            </div>
                    </div>
                    @endif @endif

                    <div class="clearfix"></div>
                    <div id="snackbar"></div>
                </div>
                <script type="text/javascript">
                    $(window).load(function() {
                        $('.flexslider').flexslider({
                            animation: "slide",
                            controlNav: "thumbnails"
                        });
                    });

                </script>
            </div>
        </div>
        <div class="clearfix"></div>

        <!--Related products-->
        @if(count($related_products)>0)

        <div class="container">
            <div class="row">

                <div class="col-md-10 all">
                    <h3 class="m_1">Related Products</h3>
                    <div class="clearfix"></div>
                    <div id="cbp-vm" class="cbp-vm-switcher cbp-vm-view-grid">

                        <ul id="flexiselDemo3" style="display: block!important;">
                            @foreach ($related_products as $item)
                            <li class="item  col-xs-4 col-lg-4  g_{{$item->category_id}}  mix">
                                <a class="cbp-vm-image" href="{{$item->path().getRequest()}}">
                                    <div class="inner_content clearfix">
                                        <div class="product_image" style="width:auto;">
                                            <img src="{{asset($item->image_path())}}" class="img-responsive" alt="{{$item->name.' '.$item->subcategory->name}}" title="{{$item->name.' '.$item->subcategory->name}}">
                                            @if($item->discount!=0 && isset($item->discount))
                                                <div class="sale text-uppercase">Sale</div>
                                            @endif
                                            <div class="product_container">
                                                <div class="cart-left">
                                                    <p class="title">
                                                        @if (App::isLocale('ar')) @if ($item->arabic_name) {{str_limit($item->arabic_name,16)}} @else {{str_limit($item->name,16)}} @endif @else {{str_limit($item->name,16)}} @endif
                                                    </p>
                                                </div>
                                                <div class="price">
                                                    @if(isset($item->discount) && $item->discount > 0)

                                                    <div style="color: red;display: inline-block;padding-right: 3px;">
                                                        {{$item->discount}} {{$item->currency->name}}
                                                    </div>
                                                    <span style="text-decoration: line-through;font-size: 0.77em;">
                                                    @if (App::isLocale('ar')) {{$item->price}} @else {{$item->price}} @endif
                                                    </span> @else @if (App::isLocale('ar')) {{$item->price}} @else {{$item->price}} @endif @endif

                                                </div>
                                                <div class="clearfix"></div>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </div>

            </div>
        </div>
        @endif
        <!--End Related Products-->

        <!--Notes-->
        <div class="container bd-example">
                <div class="row comments">
                    <div class="col-lg-12" id="reviews_show" style="max-height: 500px;overflow: auto;">
                    @if(count($reviews))
                    <big style="font-size:25px;">Reviews</big>
                    <hr style="border-top: 1px solid #070706; margin-top:50px!important;">
                        @foreach($reviews as $review)
                        <article class="article" style="position:relative;" id="{{$review->id}}">
                            <big>{{($review->user->name)}} </big>
                            <hr style="margin-top:30px!important;">
                            <p>{{$review->body}}</p>
                            @if(Auth::user() && $review->user_id == Auth::user()->id)
                            <section id="{{$review->id}}" class="close1" data-href="{{route('remove.review', $review->id)}}"> </section>
                            @endif
                        </article>
                        @endforeach
                        @endif
                </div>
                </div>
            <div class="notes" style="margin-top: 20px!important;">
                @if(Auth::user())
                <div class="row add">
                    <div class="col-lg-12">
                        <div id="rev_frm">
                            <div class="form-group">
                                <textarea placeholder="Leave a note" id="review" name="review" class="form-control" rows="2"></textarea>
                            </div>
                            <button type="submit" id="post_review" class="btn btn-primary">Post</button>
                            <input type="hidden" name="product_id" id="product_review_id" value="{{$product->id}}">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endif
        <!-- END Notes-->
        <!--<p style="font-weight: bold;"><a href="{{url('/index').getRequest()}}">{{trans('layout.home_page')}}</a></p>-->

    </div>
</div>

<script type="text/javascript">
    //$('#one_c').click(function() {
    //    $(this).prop('disabled', true);
    //    $('#form_cc').submit();
    //    //alert('laa');
    //});

    //SLIDER
    $(window).load(function() {
        $("#flexiselDemo3").flexisel({
            visibleItems: 3,
            animationSpeed: 1000,
            autoPlay: false,
            autoPlaySpeed: 3000,
            pauseOnHover: true,
            enableResponsiveBreakpoints: true,
            responsiveBreakpoints: {
                portrait: {
                    changePoint: 480,
                    visibleItems: 1
                },
                landscape: {
                    changePoint: 640,
                    visibleItems: 2
                },
                tablet: {
                    changePoint: 768,
                    visibleItems: 3
                }
            }
        });
    });

</script>

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.16.2/axios.js"></script>
<!-- <script type="text/javascript">
            $('#ww').click(function() {
                $(this).prop('disabled', true);
                $('#ajax_status').show();
                axios.post('{{url("/wishlist/post")}}', {
                        product_id: {{$product->id}},
                    })
                    .then(function(response) {
                        $('#ww').val(response.data);
                        console.log(response);
                        $('#ajax_status').hide();
                        $('#ww').removeAttr("disabled");
                    })
                    .catch(function(error) {
                        console.log(error);
                    });

            });

        </script> -->

<script type="text/javascript">
    $('#up').click(function() {
        $(this).prop('disabled', true);

        axios.post('{{url("/review/post")}}', {
                product_id: {
                    {
                        $product - > id
                    }
                },
                review: $('#review').val(),
            })
            .then(function(response) {
                $('#up').val(response.data);
                console.log(response);
                //NOTES


                var toAppend = '<article><big>{{(Auth::check() ? Auth::user()->name : '
                ')}}: </big><p>' + $('#review').val() + '</p></article> <br>';

                console.log(toAppend);
                $('#reviews_show').prepend(toAppend);
                $('#up').removeAttr("disabled");
                $('#review').val("");
            })
            .catch(function(error) {
                console.log(error);
                var toAppend = '<p>' + $('#review').val() + '</p><br>';
                console.log(toAppend);
                $('#reviews_show').prepend(toAppend);

            });

    });

</script>

<script>
    var snackbar = document.getElementById("snackbar");
    $(document).on("click", ".close1", function(e){
            e.preventDefault();
            var url = ($(this).attr('data-href'));
            var id=$(this).attr('id');
            swal({
                title: "{{trans('layout.alert_title')}}",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#7901FB",
                confirmButtonText: "{{trans('layout.confirm_button')}}!",
                closeOnConfirm: true,
                cancelButtonText: "{{trans('layout.cancel_button')}}",
            },
                function () {
                    //window.location = url;
                    $.ajax({
                        url: url,
                        type: 'GET',
                        success: function (data) {
                            snackbar.innerHTML = 'your post has been deleted';
                            snackbar.className = "show";
                            setTimeout(function () { snackbar.className = snackbar.className.replace("show", ""); }, 2500);
                            $('#'+id+'').hide();
                        }, error: function (error) {
                            snackbar.innerHTML = 'something went wrong';
                            snackbar.className = "show";
                            setTimeout(function () { snackbar.className = snackbar.className.replace("show", ""); }, 2500);
                        }
                    })
                });
})
</script>

 <script src="{{asset('js/jquery.min.js')}}"></script>
 <script src="{{asset('js/xzoom.min.js')}}"></script>
 <script type="text/javascript">
     /* calling Xzoom script */
    $(".xzoom, .xzoom-gallery").xzoom({tint: '#333', Xoffset: 15});
 </script>
 <script src="{{asset('js/shop.js')}}"></script>

@stop
