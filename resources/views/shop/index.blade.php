@extends('shop.master')
@section('body')
<div class="content_box" ng-controller="currency_converter">
    <!--SEARCH-->
    <div class="container search_block">
        <!--CHOOSE-->
        <div class="Subcategory">
            <div>
                <select class="form-control" id="dynamic_select">
                   <option value="" select="selected">{{trans('layout.Choose a Subcategory to know more about it')}}</option>
                   @foreach ($show_all_Subcategorys as $subcategory)
                   <option value="{{$subcategory->path().getRequest()}}">{{(App::isLocale('ar')) ? $subcategory->arabic_name : $subcategory->name}}
                   </option>
                   @endforeach
                </select>
            </div>
        </div>
        <!---->
        <div class="register-top-grid">
            <form id="subb">
                <input type="hidden" name="g" value="{{request()->g}}">
                <!--Subcategory-->
                <div class="col-lg-3">
                    <select class="form-control" id="sub" name="Subcategory">

                     <option value="ALL" @if(!isset(request()->Subcategory) || request()->Subcategory == 'ALL')selected="selected"@endif >{{trans('layout.All Subcategory')}}</option>

                    @foreach ($subcategories as $subcategory)
                    <option value="{{(App::isLocale('ar')) ? $subcategory->arabic_name : $subcategory->name}}"
                    @if(isset(request()->Subcategory))
                        @if($subcategory->name == request()->Subcategory)
                            selected="selected"
                        @endif
                    @endif
                    >{{(App::isLocale('ar')) ? $subcategory->arabic_name : $subcategory->name}}</option>
                    @endforeach


                    </select>
                </div>
                <!--ACCESSORIES-->
                <div class="col-lg-3">
                    <select class="form-control" id="acc" name="accessory">

                     <option value="ALL" @if(!isset(request()->accessory) || request()->accessory == 'ALL')selected="selected"@endif >{{trans('layout.All Accessories')}}</option>

                    @foreach ($accessories as $accessory)
                    <option value="{{(App::isLocale('ar')) ? $accessory->arabic_name : $accessory->name}}"
                    @if(isset(request()->accessory))
                        @if($accessory->name == request()->accessory)
                            selected="selected"
                        @endif
                    @endif
                    >{{(App::isLocale('ar')) ? $accessory->arabic_name : $accessory->name}}
                    </option>
                    @endforeach


                    </select>
                </div>
                <!--SHAPE-->
                <div class="col-lg-3">
                    <select class="form-control" id="sha" name="gem_shape">

                    <option value="ALL" @if(!isset(request()->gem_shape) || request()->gem_shape == 'ALL')selected="selected"@endif >All Shapes</option>

                    @foreach ($shapes as $gem_shape)
                    <option value="{{(App::isLocale('ar')) ? $gem_shape->arabic_name : $gem_shape->name}}"
                    @if(isset(request()->gem_shape))
                        @if($gem_shape->name == request()->gem_shape)
                            selected="selected"
                        @endif
                    @endif
                    >{{(App::isLocale('ar')) ? $gem_shape->arabic_name : $gem_shape->name}}
                    </option>
                    @endforeach



                    </select>
                </div>
                <!---->


                <!--LocalOrGlobalProducts-->
                <div class="col-lg-3">
                    <select class="form-control" id="local" name="local">
                    <option value="ALL" @if(!isset(request()->local) || request()->local == 'ALL')selected="selected"@endif >All Products</option>
                    <option value="SA" @if(isset(request()->local) && request()->local == 'SA')selected="selected"@endif >Saudi Products</option>
                    <option value="EG" @if(isset(request()->local) && request()->local == 'EG')selected="selected"@endif >Egypt Products</option>
                    </select>
                </div>
                <!---->

                @if(isset(request()->c))
                <input type="hidden" name="c" value="{{request()->c}}"> @endif
            </form>

            <!--<div class="col-lg-6">
            <form class="navbar-left" role="Search" action="{{url('search'.getRequest())}}">
                <div class="form-group" style="margin-right:-10px;">
                    <input type="text" name="query" class="form-control" placeholder="{{trans('layout.Find product')}}">
                    <input type="hidden" name="g" value="{{request()->g}}">
                    <input type="hidden" name="Subcategory" value="{{request()->Subcategory}}">
                    <input type="hidden" name="accessory" value="{{request()->accessory}}">
                    <input type="hidden" name="gem_shape" value="{{request()->gem_shape}}"> @if(isset(request()->c))
                    <input type="hidden" name="c" value="{{request()->c}}"> @endif
                </div>
                <button type="submit" class="btn btn-default">{{trans('layout.Search')}}</button>
            </form>
            </div>-->

            <div class="col-lg-4">
                <form class="navbar-form" role="search" action="{{url('search'.getRequest())}}">
                    <div class="input-group add-on">
                        <!--<input class="form-control" placeholder="Search" name="srch-term" id="srch-term" type="text">-->

                    <input type="text" name="word" class="form-control bg-white" placeholder="{{trans('layout.Find product')}}">
                    <input type="hidden" name="g" value="{{request()->g}}">
                    @if(isset(request()->Subcategory)) <input type="hidden" name="Subcategory" value="{{request()->Subcategory}}"> @endif
                    @if(isset(request()->accessory)) <input type="hidden" name="accessory" value="{{request()->accessory}}"> @endif
                    @if(isset(request()->gem_shape)) <input type="hidden" name="gem_shape" value="{{request()->gem_shape}}"> @endif
                    @if(isset(request()->c))
                    <input type="hidden" name="c" value="{{request()->c}}"> @endif

                        <div class="input-group-btn">
                            <button class="btn btn-default" type="submit"><i class="fa fa-search" aria-hidden="true"></i></button>
                        </div>
                    </div>
                </form>
            </div>

            <div class="col-lg-8">
                <div id="reco" class="text-center">
                    <a class="btn btn-default" href="{{route('auction').getRequest()}}">Auctions</a>
                    <!-- <a class="btn btn-default" href="{{route('digitals').getRequest()}}">Digital Products</a> -->
                </div>
            </div>
        </div>
        <!--end-register-top-grid-->
    </div>
    <!--END SEARCH-->




            <div class="col-md-10 all" style="clear: both;">
                <h3 class="m_1">{{trans('layout.All Products')}}</h3>

                <div id="cbp-vm" class="cbp-vm-switcher cbp-vm-view-grid">
                    <div class="clearfix"></div>
                    <!-- GRID -->
                    <ul id="products_mix">
                        @if(count($new_products)>0) @foreach ($new_products as $item)
                        <li class="mb-3 item  col-xs-4 col-lg-4   g_{{$item->category_id}}  mix">
                                <div class="inner_content clearfix">
        <!--//////////////////////////////////-->
                                    <div class="product_image shadow">
                                    @if(Auth::check())
                                        <div class="wish-list p-2" id="{{$item->id}}"><i class="fa {{$item->wished==0?'fa-star-o':'fa-star'}} fa-lg"></i></div>
                                    @endif
                                        <a class="cbp-vm-image" href="{{$item->path().getRequest()}}">
                                        <img src="{{asset($item->image_path())}}" class="img-responsive" alt="{{$item->name.' '.$item->subcategory->name}}" title="{{$item->name.' '.$item->subcategory->name}}">
                                        @if(isset($item->discount)&&$item->discount!=0)
                                            <div class="sale text-uppercase">Sale</div>
                                        @endif
                                        <div class="product_container">
                                            <div class="cart-left">
                                                <p class="title">

                                                    @if (App::isLocale('ar')) @if ($item->arabic_name) {{str_limit($item->arabic_name,39)}} @else {{str_limit($item->name,34)}} @endif @else {{str_limit($item->name,34)}} @endif {{--{{(App::isLocale('ar')) ? str_limit($item->arabic_name,16) : str_limit($item->name,14)}}--}}


                                                </p>
                                            </div>
                                            <div class="price">
                                                @if(isset($item->discount) && $item->discount > 0)

                                                <div style="color: red;display: inline-block;padding-right: 3px;">
                                                    {{$item->discount}} {{-- {{$item->currency->name}} --}}
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
                        @endforeach @else
                        <p style="padding: 40px; text-align: center; font-size: 40px;">Sorry, there are no products from this selection</p>
                        @endif
                    </ul>
                    <!-- END GRID -->
                    {{ $new_products->appends(getRequestBetweenPages())->links() }}

                    <!-- BEST SELLERS
                    <div class="container" style="width:100%;">
                        <div class="row">
                            <div class="col-md-12" style="padding:0;">
                                <!--
                                <ul class="col-md-6">
                                    <h3 class="m_1">Best Seller</h3>
                                    <div class="clearfix"></div>
                                    <li class="col-md-12  g_{{$best_seller->category_id}}  mix">
                                        <a class="cbp-vm-image" href="{{$best_seller->path().getRequest()}}">
                                            <div class="inner_content clearfix">
                                                <div class="product_image">
                                                    <img src="{{asset($best_seller->image_path())}}" class="img-responsive" alt="{{$best_seller->name.' '.$best_seller->subcategory->name}}" title="{{$best_seller->name.' '.$best_seller->subcategory->name}}">

                                                    <div class="product_container">
                                                        <div class="cart-left">
                                                            <p class="title">
                                                                @if (App::isLocale('ar')) @if ($best_seller->arabic_name) {{str_limit($best_seller->arabic_name,39)}} @else {{str_limit($best_seller->name,34)}} @endif @else {{str_limit($best_seller->name,34)}} @endif
                                                            </p>
                                                        </div>
                                                        <div class="price">
                                                            @if(isset($best_seller->discount) && $best_seller->discount > 0)

                                                            <div style="color: red;display: inline-block;padding-right: 3px;">
                                                                {{$best_seller->discount}} {{$best_seller->currency->name}}
                                                            </div>
                                                            <span style="text-decoration: line-through;font-size: 0.77em;">
                                                @if (App::isLocale('ar')) {{$best_seller->price}} @else {{$best_seller->price}} @endif
                                                </span> @else @if (App::isLocale('ar')) {{$best_seller->price}} @else {{$best_seller->price}} @endif @endif
                                                        </div>

                                                        <div class="clearfix"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                    </li>
                                </ul>
                                <!---
                                {{--
                                <ul class="col-md-6">
                                    <h3 class="m_1">Most Viewed</h3>
                                    <div class="clearfix"></div>
                                    <li class="simpleCart_shelfItem  g_{{$mostly_viewed_product->category_id}} s_{{$mostly_viewed_product->subcategory->id}} mix">
                                        <a class="cbp-vm-image" href="{{$mostly_viewed_product->path().getRequest()}}">
                                            <div class="inner_content clearfix">
                                                <div class="product_image">

                                                    <img src="{{asset($mostly_viewed_product->image_path())}}" class="img-responsive" alt="{{$mostly_viewed_product->name.' '.$mostly_viewed_product->subcategory->name}}" title="{{$mostly_viewed_product->name.' '.$mostly_viewed_product->subcategory->name}}">
                                                    <div class="product_container">
                                                        <div class="cart-left">
                                                            <p class="title">

                                                                @if (App::isLocale('ar')) @if ($mostly_viewed_product->arabic_name) {{str_limit($mostly_viewed_product->arabic_name,39)}} @else {{str_limit($mostly_viewed_product->name,34)}} @endif @else {{str_limit($mostly_viewed_product->name,34)}} @endif

                                                            </p>
                                                        </div>
                                                        <div class="price">
                                                            @if(isset($mostly_viewed_product->discount) && $mostly_viewed_product->discount > 0 )

                                                            <div style="color: red;display: inline-block;padding-right: 3px;">
                                                                {{$mostly_viewed_product->discount}} {{$mostly_viewed_product->currency->name}}
                                                            </div>
                                                            <span style="text-decoration: line-through;font-size: 0.77em;">
                                                @if (App::isLocale('ar')) {{$mostly_viewed_product->price}} @else {{$mostly_viewed_product->price}} @endif
                                                </span> @else @if (App::isLocale('ar')) {{$mostly_viewed_product->price}} @else {{$mostly_viewed_product->price}} @endif @endif
                                                        </div>

                                                        <div class="clearfix"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                    </li>
                                </ul>
                                --}}
                                <!---
                            </div>
                        </div>
                    </div>
                    <!-- END BEST SELLERS -->
                </div>
                <script src="js/cbpViewModeSwitch.js" type="text/javascript"></script>
                <script src="js/classie.js" type="text/javascript"></script>
            </div>
        </div>
    </div>
</div>




<!--<div class="form-group">
  <form id="subb">
    {!! Form::select('sub',$subcategories,request()->Subcategory, ['class' => 'form-control', 'id' => 'sub']) !!}
    <input type="hidden" name="g" value="{{request()->g}}">
    </form>
 </div>-->

{{--<label class="checkbox-inline"><input name="category" type="radio" value="{{
@foreach (App\Subcategory::all() as $sub)
    @if(!$loop->last)
         .s_{{$sub->id}},
     @endif
  .s_{{$sub->id}}
@endforeach}}">all</label> --}} {{--
<hr> @if($video->url)
<h3>
    {{trans('layout.Video')}}
</h3>



<iframe width="100%" height="350px" src="https://www.youtube.com/embed/{{ $video_id }}?autoplay=
    {{$played}}&controls=1&showinfo=0" frameborder="0" allowfullscreen></iframe> @endif --}}


<script type="text/javascript">
    $(function() {
        var $categorySelect = $('input[type=radio][name=category]'),
            $colorSelect = $('input[type=radio][name=colors]'),
            $categorySelect = $('input[type=radio][name=category]'),
            $container = $('#products_mix');
        $container.mixItUp({
            animation: {
                effects: 'fade translateZ(-100px)'
            }
        });

        $categorySelect.on('change', function() {
            $container.mixItUp('filter', this.value);

        });

        $colorSelect.on('change', function() {
            $container.mixItUp('filter', this.value);

        });

        $categorySelect.on('change', function() {
            $container.mixItUp('filter', this.value);

        });


    });
</script>

<script type="text/javascript">
    $("#sub").change(function() {
        $("#subb").submit();

    });
</script>


<script type="text/javascript">
    $("#acc").change(function() {
        $("#subb").submit();

    });
</script>


<script type="text/javascript">
    $("#sha").change(function() {
        $("#subb").submit();

    });
</script>


<script type="text/javascript">
    $("#local").change(function() {
        $("#subb").submit();

    });
</script>


<script>
    $(function() {
        // bind change event to select
        $('#dynamic_select').on('change', function() {
            var url = $(this).val(); // get selected value
            if (url) { // require a URL
                window.location = url; // redirect
            }
            return false;
        });
    });
</script>
<!-- // wish-list -->
<!-- <script src="{{asset('js/shop.js')}}"></script> -->

<script type="text/javascript">
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
    $(".wish-list").on("click", function(){
        var product_uid = $(this).attr('id');
        if (product_uid) {
            var data = { product_id: product_uid };
            $.ajax({
                url: '/wishlist/post',
                type: 'POST',
                data: data,
                success: function (data) {
                    if (data.code == 200) {
                        $('#' + product_uid + '').children().removeClass("fa-star-o").addClass("fa-star");
                    } else if (data.code == 202) {
                        $('#' + product_uid + '').children().removeClass("fa-star").addClass("fa-star-o");
                    }
                },
                error: function (error) {

                }
            })
        }
    });
</script>
@stop
