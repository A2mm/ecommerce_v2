@extends('shop.master')
@section('body')
<style type="text/css">
    #ajax_status {
        display: none;
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
                    <div class="labout span_1_of_a1">
                        <div class="flexslider">
                            <ul class="slides">
                                @foreach ($product->all_images_paths() as $path)
                                <li data-thumb="{{asset($path)}}">
                                    <img alt="{{$page_title}}" title="{{$page_title}}" src="{{asset($path)}}" />
                                </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>

                    @if(Auth::user() && Auth::user()->role('user'))
                    <div class="cont1 span_2_of_a1 simpleCart_shelfItem">
                        <h1>{{(App::isLocale('ar')) ? $product->arabic_name : $product->name}}</h1>

                        @if($vendor)
                        <span id="market_name">vendor: <a href="{{url('/vendors/'.$vendor->id).getRequest()}}">{{$vendor->vendor_name}}</a></span>
                        @endif

                        <div class="price_single">
                            <span class="amount item_price actual">

                                @if(isset($product->discount) && $product->discount > 0)

                                    <div style="color: red;display: inline-block;padding-right: 3px;">
                                    {{$product->discount}}
                                    </div>
                                    <span style="text-decoration: line-through;font-size: 0.77em;">
                                    @if (App::isLocale('ar')) {{$product->price}} @else {{$product->price}} @endif
                                    </span> @else @if (App::isLocale('ar')) {{$product->price}} @else {{$product->price}} @endif @endif





                            </span>
                        </div>
                        @if(!empty($product->description))
                        <h2 class="quick">{{trans('layout.Overview')}}:</h2>
                        <p class="quick_desc">
                            @if (App::isLocale('ar')) @if ($product->arabic_description) {{$product->arabic_description}} @else {{$product->description}} @endif @else {{$product->description}} @endif

                            <!--{{(App::isLocale('ar')) ? $product->arabic_description : $product->description}}-->
                        </p>
                        @else
                        <h2 class="quick">{{trans('layout.Overview')}}:</h2>
                        <p class="quick_desc">{{trans('layout.No_description')}}.</p>
                        @endif

                        <br>
                        <h2 class="quick">Product Code: <span style="font-weight: bold;">{{$product->unique_id}}</span></h2>

                        <br>
                        <h2 class="quick">Gems Subcategory: <span style="font-weight: bold;">{{$product->subcategory->name}}</span></h2>

                        <br>
                        <h2 class="quick">Accessory Type: <span style="font-weight: bold;">{{$product->accessory->name}}</span></h2>

                        <form id="form_cc" method="POST" action="{{route('new.order.user')}}">
                            <input type="hidden" name="g" value="{{request()->g}}">
                            <input type="hidden" name="Subcategory" value="{{request()->Subcategory}}">
                            <input type="hidden" name="accessory" value="{{request()->accessory}}">
                            <input type="hidden" name="c" value="{{request()->c}}">
                            <input type="hidden" name="affiliate" value="{{request()->affiliate}}">

                            <input type="hidden" name="product_id" value="{{$product->id}}">
                            <ul class="product-qty">

                            @if($product->minimum_order > 1 && $product->quantity >= $product->minimum_order)

                            <span>{{trans('layout.Quantity')}}:</span> {{ Form::selectRange('quantity', $product->minimum_order, $product->quantity, $product->minimum_order) }}
                            Minimum Order: {{$product->minimum_order}} Items

                            @elseif($product->minimum_order > 1 && $product->quantity < $product->minimum_order)
                            <span>{{trans('layout.Quantity')}}:</span> {{ Form::selectRange('quantity', 1, $product->quantity, 1) }}
                            Sorry, Minimum Order: {{$product->minimum_order}} Items
                            <p style="font-weight: bold;"><big>Out Of Stock</big></p>

                            @elseif($product->quantity>0)

                                <span>{{trans('layout.Quantity')}}:</span> {{ Form::selectRange('quantity', 1, $product->quantity, 1) }}
                                @else
                                <p style="font-weight: bold;"><big>Out Of Stock</big></p>
                                @endif

                                </select>
                            </ul>
                            @if($product->minimum_order > 1 && $product->quantity >= $product->minimum_order)
                            <div class="btn_form button item_add item_1">
                                <input type="submit" value="Add to Cart" title="" id="one_c"> {!! Form::close() !!}
                            </div>

                            @elseif($product->quantity > 0  &&  $product->minimum_order <= 1)
                            <div class="btn_form button item_add item_1">
                                <input type="submit" value="Add to Cart" title="" id="one_c"> {!! Form::close() !!}
                            </div>
                            @endif
                        </form>
                            <form id="form_ww" method="POST" action="{{route('new.wishlist')}}">
                                <input type="hidden" name="product_id" value="{{$product->id}}">
                                <div class="btn_form button item_add item_1">
                                    <input style="background-color:#373737;" type="submit" value="{{($wishedBefore == 0) ? 'Add To WishList' : 'Remove From WishList'}}" title="" id="ww">
                                    <span id="ajax_status"><img src="http://www.fusioncharts.com/theme/giphy.gif"></span>
                                </div>
                            </form>


                    </div>
                    @elseif (Auth::user() && Auth::user()->role('affiliate')) @if(Auth::user()->slug == NULL)
                    <p>
                        You need to setup your slug to be able to generate links
                        <a href="{{route('affiliate.manage.profile')}}">Go to your settings</a>
                    </p>
                    @else
                    <div class="cont1 span_2_of_a1 simpleCart_shelfItem">
                        <h3>Make a link for this product?</h3>
                        <form action="{{route('affiliate.manage.link.generate')}}" method="POST">
                            <input type="hidden" name="product_id" value="{{$product->id}}">
                            <input type="text" name="username" value="{{Auth::user()->slug}}" disabled> /
                            <input type="text" name="slug" value="">
                            <div class="btn_form button item_add item_1">
                                <input type="submit" value="Generate" title=""> {!! Form::close() !!}
                            </div>
                    </div>
                    @endif @else
                    <div class="cont1 span_2_of_a1 simpleCart_shelfItem">
                        <h1>{{(App::isLocale('ar')) ? $product->arabic_name : $product->name}}</h1>
                        @if($vendor)
                        <span id="market_name">vendor: <a href="{{url('/vendors/'.$vendor->id).getRequest()}}">{{$vendor->vendor_name}}</a></span> @endif
                        <div class="price_single">
                            <span class="amount item_price actual">
                                @if(isset($product->discount) && $product->discount > 0)

                                    <div style="color: red;display: inline-block;padding-right: 3px;">
                                    {{$product->discount}}
                                    </div>
                                    <span style="text-decoration: line-through;font-size: 0.77em;">
                                    @if (App::isLocale('ar')) {{$product->price}} @else {{$product->price}} @endif
                                    </span> @else @if (App::isLocale('ar')) {{$product->price}} @else {{$product->price}} @endif @endif



                            </span>
                        </div>
                        @if(!empty($product->description))
                        <h2 class="quick">{{trans('layout.Overview')}}:</h2>
                        <p class="quick_desc">
                            @if (App::isLocale('ar')) @if ($product->arabic_description) {{$product->arabic_description}} @else {{$product->description}} @endif @else {{$product->description}} @endif

                            <!--{{(App::isLocale('ar')) ? $product->arabic_description : $product->description}}-->
                        </p>
                        @else
                        <h2 class="quick">{{trans('layout.Overview')}}:</h2>
                        <p class="quick_desc">{{trans('layout.No_description')}}.</p>
                        @endif

                        <br>
                        <h2 class="quick">Product Code: <span style="font-weight: bold;">{{$product->unique_id}}</span></h2>

                        <br>
                        <h2 class="quick">Gems Subcategory: <span style="font-weight: bold;">{{$product->subcategory->name}}</span></h2>

                        <br>
                        <h2 class="quick">Accessory Type: <span style="font-weight: bold;">{{$product->accessory->name}}</span></h2>

                        @if (!Auth::check())
                        <a class="woman" href="{{url('login?redirectTo='.Request::url())}}">{{trans('layout.You_need_to_login')}}</a>
                    </div>
                    @endif @endif

                    <div class="clearfix"></div>
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
                <div class="container">
                    <div class="row">

                        <div class="col-md-10 all">
                            <h3 class="m_1">Related Products</h3>
                            <div class="clearfix"></div>

                            <div id="cbp-vm" class="cbp-vm-switcher cbp-vm-view-grid">


                                <ul id="flexiselDemo3">
                                    @foreach ($related_products as $item)
                                    <li class="simpleCart_shelfItem  @foreach($item->colors as $color) c_{{$color->id}} @endforeach g_{{$item->category_id}}  mix">
                                        <a class="cbp-vm-image" href="{{$item->path().getRequest()}}">
                                            <div class="inner_content clearfix">
                                                <div class="product_image" style="width:auto;">
                                                    <img src="{{asset($item->image_path())}}" class="img-responsive" alt="{{$item->name.' '.$item->subcategory->name}}" title="{{$item->name.' '.$item->subcategory->name}}">

                                                    <div class="product_container">
                                                        <div class="cart-left">
                                                            <p class="title">
                                                                @if (App::isLocale('ar')) @if ($item->arabic_name) {{str_limit($item->arabic_name,16)}} @else {{str_limit($item->name,16)}} @endif @else {{str_limit($item->name,16)}} @endif

                                                                <!--{{(App::isLocale('ar')) ? str_limit($item->arabic_name,16) : str_limit($item->name,14)}}-->
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
                <!--End Related Products-->

                <!--Notes-->

        @if(Auth::user() || count($reviews))
        <div class="container bd-example">
        <div class="notes">
        @if(Auth::user())
            <div class="row">
                <div class="col-lg-12">
                    <div id="rev_frm">
                        <div class="form-group">
                            <textarea placeholder="Leave a note" id="review" name="review" class="form-control" rows="2"></textarea>
                        </div>
                                <button type="submit" id="up" class="btn btn-default">Post</button>
                                <input type="hidden" name="product_id" value="{{$product->id}}">
                    </div>

                    </div>
                    </div>
                    <hr>
                    @endif
                    @if(count($reviews))
            <div class="row comments">
                        <div class="col-lg-5" id="reviews_show">
                            @foreach($reviews as $review)

                            <article><big>{{($review->user->name)}} </big><p>{{$review->body}}</p>
                            @if(Auth::user() && $review->user_id == Auth::user()->id)
                            <div id="remove_review" class="close1" data-href="{{route('remove.review', $review->id)}}"> </div>
                            @endif
                            </article>
                            @endforeach
                        </div>
                    </div>
                    @endif
                </div>
            </div>
            @endif

            <!-- END Notes-->


                <!-- <p style="font-weight: bold;"><a href="{{url('/index').getRequest()}}">{{trans('layout.home_page')}}</a></p> -->

            </div>
        </div>

        <script type="text/javascript">
            $('#one_c').click(function() {
                $(this).prop('disabled', true);
                $('#form_cc').submit();
                //alert('laa');
            });

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
                        product_id: {{$product->id}},
                        review: $('#review').val(),
                    })
                    .then(function(response) {
                        $('#up').val(response.data);
                        console.log(response);
                        //NOTES

                        var toAppend = '<article><big>{{(Auth::check() ? Auth::user()->name : '')}}: </big><p>' + $('#review').val() + '</p></article> <br>';

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
$(document).on('click', '#remove_review',function(e){

e.preventDefault();

var url = ($(this).attr('data-href'));

  swal({

    title: "{{trans('layout.alert_title')}}",

    type: "warning",

    showCancelButton: true,

    confirmButtonColor: "#7901FB",

    confirmButtonText: "{{trans('layout.confirm_button')}}!",

    closeOnConfirm: false,
    cancelButtonText: "{{trans('layout.cancel_button')}}",

  },

       function(){

        window.location=url;

  });

});

</script>



        @stop
