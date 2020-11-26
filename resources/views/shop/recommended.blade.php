@extends('shop.master')
@section('body')

<div class="content_box">
<div class="container">
  <div class="row">
  <div class="col-md-10 all" style="text-align:center;">



<h3 class="m_1">Recommended</h3>


        <div id="cbp-vm" class="cbp-vm-switcher cbp-vm-view-grid">

          <div class="clearfix"></div>

          <ul id="products_mix">
            @foreach ($recommended_products as $recommended_product)
            <li class="simpleCart_shelfproduct  @foreach($recommended_product->colors as $color) c_{{$color->id}} @endforeach g_{{$recommended_product->category}}  mix" >

              <a class="cbp-vm-image" href="{{$recommended_product->path().getRequest()}}">
               <div class="inner_content clearfix">
                <div class="product_image">
                  <img src="{{asset($recommended_product->image_path())}}" class="img-responsive" alt="">
                  <div class="product_container">
                     <div class="cart-left">

                     <p class="title">{{(App::isLocale('ar')) ? $recommended_product->arabic_name : $recommended_product->name}}</p>

                     </div>
                     <div class="price">
                       @if (App::isLocale('ar'))
                        {{$recommended_product->price}}
                        @else
                        {{$recommended_product->price}}
                        @endif
                     </div>
                     <div class="clearfix"></div>
                     </div>
                  </div>
                           </div>
                        </a>

            </li>
          @endforeach




          </ul>
          {{-- {{ $recommended_product->appends(getRequestBetweenPages())->links() }} --}}
        </div>
        <script src="js/cbpViewModeSwitch.js" type="text/javascript"></script>
        <script src="js/classie.js" type="text/javascript"></script>
    </div>
  </div>
  </div>
  </div>

    <!-- <p style="font-weight: bold;"><a href="{{route('shop.index').getRequest()}}">{{trans('layout.home_page')}}</a></p> -->

</div>
</div>


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

@stop
