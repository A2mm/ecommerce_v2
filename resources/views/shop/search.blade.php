@extends('shop.master')
@section('body')

<h3 style="text-align: center;padding-top: 15px;">{{trans('layout.your search for')}} "<span style="font-weight: bold;">{{ Request::input('word') }}</span>"</h3>

  @if(!$products->count())
    <p style="padding: 50px; font-size: 50px; text-align: center;">{{trans('layout.No results found')}}</p>

    <!-- <p style="font-weight: bold;"><a href="{{route('shop.index').getRequest()}}">{{trans('layout.home_page')}}</a></p> -->

  @else

<div class="content_box">
<div class="container">
  <div class="row">



            @foreach ($products as $product)
      <div class="col-md-4 mb-3">


        <div id="cbp-vm" class="cbp-vm-switcher cbp-vm-view-grid">

          <ul id="vendor">
            <li class="simpleCart_shelfproduct product_image  g_{{$product->category}}  mix" style="width:100%;">
            @if(Auth::check())
            <div class="wish-list p-2" id="{{$product->id}}"><i class="fa {{$product->wished==0?'fa-star-o':'fa-star'}} fa-lg"></i></div>
            @endif
              <a class="cbp-vm-image" href="{{$product->path().getRequest()}}">
               <div class="inner_content clearfix">
                <div class="product_image">
                  <img src="{{asset($product->image_path())}}" class="img-responsive" alt="">
                  @if(isset($product->discount)&&$product->discount!=0)
                    <div class="sale text-uppercase">Sale</div>
                  @endif
                  <div class="product_container">
                     <div class="cart-left">

                     <p class="title">
                     @if (App::isLocale('ar'))
                        @if ($product->arabic_name)
                        {{str_limit($product->arabic_name,16)}}
                        @else
                        {{str_limit($product->name,16)}}
                        @endif
                    @else
                      {{str_limit($product->name,16)}}
                    @endif
                    <!--{{(App::isLocale('ar')) ? $product->arabic_name : $product->name}}-->
                     </p>

                     </div>
                     <div class="price">
                       @if (App::isLocale('ar'))
                        {{$product->price}}
                        @else
                        {{$product->price}}
                        @endif
                     </div>
                     <div class="clearfix"></div>
                     </div>
                  </div>
                           </div>
                        </a>

            </li>
            </ul>
            </div>

    </div>
          @endforeach




          <div class="col-md-12 d-flex justify-content-center">
            {{ $products->appends(getRequestBetweenPages())->links() }}
          </div>
          <!--{{ $products->links() }}-->

          <script src="js/cbpViewModeSwitch.js" type="text/javascript"></script>
        <script src="js/classie.js" type="text/javascript"></script>
  </div>
    <!-- <p style="font-weight: bold;"><a href="{{route('shop.index').getRequest()}}">{{trans('layout.home_page')}}</a></p> -->

</div>
</div>
@endif

<script type="text/javascript">
$(function(){
  var $container = $('#products_mix');
  $container.mixItUp({
    animation: {
        effects: 'fade translateZ(-100px)'
    }
  });




});
</script>
<script type="text/javascript">
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
    $(".wish-list").on("click", function(){
        /*if ($(this).children().hasClass("fa-star-o")) {
            $(this).children().removeClass("fa-star-o").addClass("fa-star");
        }else{
            $(this).children().removeClass("fa-star").addClass("fa-star-o");
        }*/
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
