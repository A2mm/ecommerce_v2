@extends('shop.master')
@section('body')

<div class="content_box">
<div class="container">
  <div class="row">
<div class="col-md-2"></div>
<div class="col-md-8" >

<div class="vendor_details">

</div>

        <div id="cbp-vm" class="cbp-vm-switcher cbp-vm-view-grid">

          <div class="clearfix"></div>
          <ul id="vendor">
          @if(count($auctions_products))
            @foreach ($auctions_products as $product)



            <li class="col-md-4 simpleCart_shelfproduct  @foreach($product->product->colors as $color) c_{{$color->id}} @endforeach g_{{$product->product->category}} s_{{$product->product->subcategory->id}} mix" >

              <a class="cbp-vm-image" href="{{$product->product->auctionPath().getRequest()}}">

               <div class="inner_content clearfix">
                <div class="product_image">
                  <img src="{{asset($product->product->image_path())}}" class="img-responsive" alt="">
                  <div class="product_container">
                     <div class="cart-left">

                     <p class="title">{{(App::isLocale('ar')) ? $product->product->arabic_name : $product->product->name}}</p>

                     </div>
                     <div class="price">

                     start price:
                       @if (App::isLocale('ar'))
                        {{$product->product->price}}
                        @else
                        {{$product->product->price}}
                        @endif
                     </div>
                     @if($product->best_price)

                     <div class="price">

                     best price
                       @if (App::isLocale('ar'))
                        {{$product->best_price}}
                        @else
                        {{$product->best_price}}
                        @endif
                     </div>
                     @else
                     <div class="price">

                       Not Started Yet
                     </div>
                     @endif

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
                          @if($product->product->colors->count() < 4)
                          @foreach ($product->product->colors as $color)
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
          @else
          <p>sorry, there are no auction right now!</p>
          @endif





          </ul>

        </div>
        <script src="js/cbpViewModeSwitch.js" type="text/javascript"></script>
        <script src="js/classie.js" type="text/javascript"></script>
    </div>
    <div class="col-md-2"></div>
  </div>

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
