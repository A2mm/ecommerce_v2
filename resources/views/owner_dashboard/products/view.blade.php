@extends('owner_dashboard.master')
<style>
  @page {
    size: auto;
    margin: 0mm;
  }
</style>
@section('body')
<section class="content-header">
  <h1>
    {{__('translations.product')}} : {{ $product->name }}
  </h1>
  <?php $logged_user = Auth::user(); ?>

  @if($logged_user->can('view product movements') || $logged_user->can('Administer'))
    <div class="row">
      <div class="col-md-2">
        <a style="letter-spacing: 1.9px;" href="{{ route('manage.products.all.movements', $product->id) }}">
          <h3>{{__('translations.product_movements')}}</h3>
        </a>
      </div>
    </div>
    @endif
    <?php //<h3>{{__('translations.product_movements')}}</h3></a> ?>



</section>
<!-- Main content -->


<section class="content">
  <div class="row">
    <div class="col-xs-12">
      <div class="box">
        <div class="box-header">
          <h3 class="box-title"></h3>
        </div><!-- /.box-header -->

        <table class="table table-bordered table-striped">
          <thead>
            <tr>
              <th>{{__('translations.product_name')}}</th>
              <th>{{$product->name}}</th>
            </tr>
            <tr>
              <th>{{__('translations.unique_id')}}</th>
              <th>{{$product->unique_id}}</th>
            </tr>

            <tr>
              <th>{{__('translations.weight')}}</th>
              <th>{{$product->weight}}</th>
            </tr>

              <tr>
              <th>{{__('translations.slug')}}</th>
              <th>{{str_replace('-', ' ', $product->slug) }}</th>
            </tr>

              <tr>
              <th>{{__('translations.product_benefits')}}</th>
              <th>{!! $product->product_benefits !!}</th>
            </tr>

             <tr>
              <th>{{__('translations.description')}}</th>
              <th><p class="text-lead">{!! $product->description !!} </p> </th>
            </tr>

             <tr>
              <th>{{__('translations.seo_description')}}</th>
              <th><p class="text-lead">{!! $product->seo_description !!} </p> </th>
            </tr>

            <tr>
              <th>{{__('translations.total_quantity')}}</th>
              <th>
                {{ $product->existQuantity() }}
              </th>
<?php /*
             <tr>
              <th>{{__('translations.inprogress_quantity')}}</th>
              <th>
                {{ -($product->inprogressQuantity()) }}
              </th>
            </tr>
*/ ?>
          <tr>
              <th>{{__('translations.available_quantity')}}</th>
              <th>
                {{ $product->availableQuantity() }}
              </th>
            </tr>

            <tr>
              <th>{{__('translations.quantity_details')}}</th>
              <th>
                <table class="table table-bordered table-striped">
                  <thead>
                    @foreach($product->stores as $key => $store)
                      <tr>
                        <th>{{__('translations.quantity_at_store')}} {{ $store->name }}</th>
                        <th>{{ $store->quantity_in_store($product->id) }}</th>
                      </tr>
                      @endforeach
                  </thead>
                  <tbody>
                  </tbody>
                </table>
              </th>
            </tr>
            <tr>
              <th style="vertical-align: middle;">{{__('translations.price')}}</th>
              <th>
                @foreach($prices as $price)
                <p>السعر {{$price->usertype->name}} : {{ $price->price }} جنيه</p>
                @endforeach
              </th>
            </tr>
            <tr>
              <th>{{__('translations.subcategory')}}</th>
              <th>{{$product->subcategory->name}}</th>
            </tr>
            <tr>
              <th>{{__('translations.category')}}</th>
              <th>{{$product->subcategory->category->name}}</th>
            </tr> 
            
             <tr>
              <th>{{__('translations.category_online')}}</th>
              <th>
                @if(!empty($product->category_online_id))
                  {{ $product->category_online->name}}
                @else
                  {{ __('translations.no_category_online') }}
                @endif
              </th>
            </tr> 

            <?php /* 
             <tr>
              <th style="vertical-align: middle;">{{__('translations.tags')}}</th>
              <th>
                <table class="table table-bordered table-striped">
                  <thead>
                    @foreach($product->tags as $key => $tag)
                      <tr>
                        <?php // <th>{{__('translations.tag')}} {{ $key + 1 }}</th> ?>
                        <th>{{ $tag->tag }}</th>
                      </tr>
                      @endforeach
                  </thead>
                  <tbody>
                  </tbody>
                </table>
              </th>
            </tr>
            */
            ?>
            @foreach ($product->images as  $image)
              <tr>
                <th> صورة {{$loop->iteration}}</th>
                <th><img src="{{asset('storage/'.$image->image)}}" width="100" height="100"> </th>
              </tr>
            @endforeach

            <tr>
                 <th>{{__('translations.available_online')}}</th>
                <th>
                  @if($product->available_online == null || $product->available_online == 0)
                    <label class="label label-warning"> {{ __('translations.unavailable') }} </label>
                  @else
                   <label class="label label-success"> {{ __('translations.available') }}</label>
                  @endif
              </th>
            </tr>

            <tr>
              <th>{{__('translations.qrcode')}}</th>
              <!-- <th id="bar">  <p> {!! DNS2D::getBarcodeSVG($product->unique_id, 'QRCODE') !!}</p> -->
              <th id="bar">
                <p> {!! DNS1D::getBarcodeSVG($product->unique_id, 'C128') !!}</p>
                <p style="font-size:9px">{{$product->unique_id}}</p>
              </th>
              <th> <a style="cursor: pointer;" onclick="print()">{{__('translations.print')}}</a> </th>

            </tr>

          </thead>
          <tbody>
          </tbody>
        </table>

      </div>
    </div>
  </div>
</section>


<!--
  <script type="text/javascript" src="{{asset('js/jquery.min.js')}}"></script>
  <script type="text/javascript" src="{{asset('js/printarea.js')}}"></script> -->

<script>
  function print() {
    // alert('asdasd');
    // var mode = 'iframe';
    // var close = mode == "popup";
    // var options ={mode : mode, popClose : close };
    // $("#bar").printArea(options);


    var divToPrint = document.getElementById('bar');
    var newWin = window.open('', 'Print-Window');
    newWin.document.open();
    newWin.document.write('<html><body onload="window.print()">' + divToPrint.innerHTML + '</body></html>');
    newWin.document.close();
    setTimeout(function() {
      newWin.close();
    }, 1);

  }
</script>
<!--

  <script>
    $(document).ready(function(){

      $("#print_button2").click(function(){
        var mode = 'iframe';
        var close = mode == "popup";
        var options ={mode : mode, popClose : close };
        $("#bar").printArea(options);
      });

    });
  </script> -->


@stop
