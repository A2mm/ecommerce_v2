@extends('owner_dashboard.master')
@section('body')

<style type="text/css">
.info-box span i{
  margin: 20px;
}

.zoom {
  transition: transform .2s; /* Animation */
}

.zoom:hover {
  transform: scale(1.5); /* (150% zoom - Note: if the zoom is too large, it will go outside of the viewport) */
}
</style>

<!-- Content Wrapper. Contains page content -->
  <div>
    <!-- Content Header (Page header) -->
    <!-- <section class="content-header">
      <h1>
        Dashboard
        <small>Version 2.0</small>
      </h1>
    </section> -->

    <!-- Main content -->
    <section class="content">
      <!-- Info boxes -->
      <div class="row">
        <div class="col-md-3 col-sm-6 col-xs-12 zoom">
          <div class="info-box">
            <span class="info-box-icon bg-aqua"><i class="icon ion-android-playstore"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">{{__('translations.products')}}</span>
              <span class="info-box-number">{{$products_count}}</span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
      
        <div class="col-md-3 col-sm-6 col-xs-12 zoom">
          <div class="info-box">
            <span class="info-box-icon" style="background: rgb(255, 255, 170);"><i class="ion ion-ios-people-outline"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">{{__('translations.archived_products')}}</span>
              <span class="info-box-number">{{$products_archived}}</span>
            </div> 
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>  

        <div class="col-md-3 col-sm-6 col-xs-12 zoom">
          <div class="info-box">
            <span class="info-box-icon" style="background: rgb(13, 255, 13);"><i class="ion ion-ios-people-outline"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">{{__('translations.available_online_products')}}</span>
              <span class="info-box-number">{{$products_available_online}}</span>
            </div> 
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>  

         <div class="col-md-3 col-sm-6 col-xs-12 zoom">
          <div class="info-box">
            <span class="info-box-icon" style="background: rgb(64, 128, 128);"><i class="ion ion-ios-people-outline"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">{{__('translations.customers')}}</span>
              <span class="info-box-number">{{$users_count}}</span>
            </div> 
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>  
        <!-- /.col -->

        <div class="col-md-3 col-sm-6 col-xs-12 zoom">
          <div class="info-box">
            <span class="info-box-icon" style="background: rgb(230, 82, 122);"><i class="ion ion-ios-people-outline"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">{{__('translations.admins')}}</span>
              <span class="info-box-number">{{$admins_count}}</span>
            </div> 
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>  
        <!-- /.col -->

        <!-- fix for small devices only -->
        <div class="clearfix visible-sm-block"></div>


        <div class="col-md-3 col-sm-6 col-xs-12 zoom">
          <div class="info-box">
            <span class="info-box-icon bg-blue"><i class="ion ion-ios-home"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">{{__('translations.stores')}}</span>
              <span class="info-box-number">{{$stores_count}}</span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>

         <div class="col-md-3 col-sm-6 col-xs-12 zoom">
          <div class="info-box">
            <span class="info-box-icon bg-red"><i class="ion ion-android-contacts"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">{{__('translations.sellers')}}</span>
              <span class="info-box-number">{{$sellers_count}}</span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        
        <div class="col-md-3 col-sm-6 col-xs-12 zoom">
          <div class="info-box">
            <span class="info-box-icon bg-green"><i class="ion ion-ios-cart-outline"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">{{__('translations.orders')}}</span>
              <span class="info-box-number">{{$orders_count}}</span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>  

        <div class="col-md-3 col-sm-6 col-xs-12 zoom">
          <div class="info-box">
            <span class="info-box-icon bg-grey"><i class="ion ion-ios-cart-outline"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">{{__('translations.pending_orders')}}</span>
              <span class="info-box-number">{{$orders_count_pending}}</span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div> 

        <div class="col-md-3 col-sm-6 col-xs-12 zoom">
          <div class="info-box">
            <span class="info-box-icon" style="background: yellow;"><i class="ion ion-ios-cart-outline"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">{{__('translations.inprogress_orders')}}</span>
              <span class="info-box-number">{{$orders_count_inprogress}}</span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div> 

         <div class="col-md-3 col-sm-6 col-xs-12 zoom">
          <div class="info-box">
            <span class="info-box-icon" style="background: rgb(185, 185, 0);"><i class="ion ion-ios-cart-outline"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">{{__('translations.today_orders')}}</span>
              <span class="info-box-number">{{$today_orders}}</span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div> 

         <div class="col-md-3 col-sm-6 col-xs-12 zoom">
          <div class="info-box">
            <span class="info-box-icon" style="background: orange;"><i class="ion ion-ios-pricetags"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">{{__('translations.categories')}}</span>
              <span class="info-box-number">{{$categories_count}}</span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>

         <div class="col-md-3 col-sm-6 col-xs-12 zoom">
          <div class="info-box">
            <span class="info-box-icon" style="background: coral;"><i class="ion ion-ios-pricetags-outline"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">{{__('translations.subcategories')}}</span>
              <span class="info-box-number">{{$subcategories_count}}</span>
            </div>

             </div> 
            <!-- /.info-box-content -->
          </div>

          <div class="col-md-3 col-sm-6 col-xs-12 zoom">
          <div class="info-box">
            <span class="info-box-icon" style="background: rgb(196, 196, 255);"><i class="ion ion-ios-list"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">{{__('translations.categories_online')}}</span>
              <span class="info-box-number">{{$categories_online}}</span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>

            <div class="col-md-3 col-sm-6 col-xs-12 zoom">
          <div class="info-box">
            <span class="info-box-icon" style="background: pink"><i class="ion ion-ios-people-outline"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">{{__('translations.banners')}}</span>
              <span class="info-box-number">{{$count_banners}}</span>
            </div> 
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>

        <div class="col-md-3 col-sm-6 col-xs-12 zoom">
          <div class="info-box">
            <span class="info-box-icon" style="background: rgb(0, 255, 255);"><i class="ion ion-ios-star"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">{{__('translations.top_sold_product')}}</span>
              <span class="info-box-number" style="font-size: 12px;">
              @foreach($best_seller_products as $productt)
               {{ $productt->name }}<br>
               {{ __('translations.subcategory') }} ( {{ $productt->subcategory->name }} ) 
              @endforeach 
            </span>
            </div> 
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
<?php /*
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-green"><i class="ion ion-ios-cart"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">{{__('translations.today_orders')}}</span>
              <span class="info-box-number">{{$today_orders}}</span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
      </div>
  </section>
 </div>
*/
?>

@endsection


  @section('scrips')
    @parent
    <script>
    var data = {
      labels: {!!json_encode($last_week)!!},
      series: [
        {!!json_encode($last_week_orders)!!},
        {!!json_encode($last_week_orders)!!}
      ],
      colors:["#333", "#222", "#111", "#000"]
    };
    var options = {
      axisY: {
        onlyInteger: true
      },
      plugins: [
      ]
    };
    new Chartist.Line('.ct-chart', data,options);
    </script>
  @show
