@extends('shop.master')
@section('body')

<div class="content_box">
<div class="container">
  <div class="row">

<div class="col-md-9" style="width: 101%">

<div class="vendor_details">
<h2 style="text-align: center;padding-top: 15px;">{{$vendor->vendor_name}}</h2>
<!--<h4>{{$vendor->phone}}</h4>
<h4>{{$vendor->email}}</h4>-->
</div>


        <div id="cbp-vm" class="cbp-vm-switcher cbp-vm-view-grid">

          <div class="clearfix"></div>

          <ul id="vendor">
            @foreach ($products as $product)
            <li class="simpleCart_shelfproduct  @foreach($product->colors as $color) c_{{$color->id}} @endforeach g_{{$product->category}} s_{{$product->subcategory->id}} mix" >

              <a class="cbp-vm-image" href="{{$product->path().getRequest()}}">
               <div class="inner_content clearfix">
                <div class="product_image">
                  <img src="{{asset($product->image_path())}}" class="img-responsive" alt="">
                  <div class="product_container">
                     <div class="cart-left">

                     <p class="title">{{(App::isLocale('ar')) ? $product->arabic_name : $product->name}}</p>

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
                        <div class="colors" style="
                             position: absolute;
                             top: 20px;
                             left: 20px;
                         ">
                          @if($product->colors->count() < 4)
                          @foreach ($product->colors as $color)
                           <div class="color" style="
                                 background-color: {{$color->code}};
                                 width: 20px;
                                 height: 20px;
                                 margin-bottom: 5px;
                                 border: 1px solid white;
                                 border-radius: 100%;
                             "></div>
                            @endforeach
                          @else
                            <img src="http://www.thecolorwheel.org/img/new_icon.png" style="
                                width: 25px;
                                height: 15px;
                            ">
                          @endif
                         </div>
            </li>
          @endforeach




          </ul>
        </div>
        <script src="js/cbpViewModeSwitch.js" type="text/javascript"></script>
        <script src="js/classie.js" type="text/javascript"></script>
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
