@extends('shop.master')
@section('body')

<div class="content_box">
<div class="container">
  <div class="row">

<div class="col-md-10 all">

<div class="vendor_details">
<h2 style="text-align: center;padding-top: 15px;">{{$vendor->vendor_name}}</h2>
<!--<h4>{{$vendor->phone}}</h4>
<h4>{{$vendor->email}}</h4>-->
</div>


        <div id="cbp-vm" class="cbp-vm-switcher cbp-vm-view-grid">

          <div class="clearfix"></div>

          <ul id="vendor">
            @foreach ($products as $product)
            <li class="item  col-xs-4 col-lg-4  g_{{$product->category}} mix" >

              <a class="cbp-vm-image" href="{{$product->path().getRequest()}}">
               <div class="inner_content clearfix">
                <div class="product_image">
                  <img src="{{asset($product->image_path())}}" class="img-responsive" alt="{{$product->name.' '.$product->subcategory->name}}"  title="{{$product->name.' '.$product->subcategory->name}}">

                  <div class="product_container">
                     <div class="cart-left">

                     <p class="title">@if (App::isLocale('ar')) @if ($product->arabic_name) {{str_limit($product->arabic_name,39)}} @else {{str_limit($product->name,34)}} @endif @else {{str_limit($product->name,34)}} @endif</p>

                     </div>
                     <div class="price">
                       @if(isset($product->discount) && $product->discount > 0)

                        <div style="color: red;display: inline-block;padding-right: 3px;">
                        {{$product->discount}}
                        </div>
                        <span style="text-decoration: line-through;font-size: 0.77em;">
                        @if (App::isLocale('ar')) {{$product->price}} @else {{$product->price}} @endif
                        </span>
                        @else
                        @if (App::isLocale('ar')) {{$product->price}} @else {{$product->price}} @endif
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
          {{ $products->appends(getRequestBetweenPages())->links() }}
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
