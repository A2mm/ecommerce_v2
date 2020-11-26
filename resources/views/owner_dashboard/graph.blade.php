@extends('owner_dashboard.master')
@section('body')

<style type="text/css">
.info-box span i{
  margin: 20px;
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
        <div class="col-md-3 col-sm-6 col-xs-12">
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
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-yellow"><i class="ion ion-ios-people-outline"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">{{__('translations.customers')}}</span>
              <span class="info-box-number">{{$users_count}}</span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->

        <!-- fix for small devices only -->
        <div class="clearfix visible-sm-block"></div>


        <div class="col-md-3 col-sm-6 col-xs-12">
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

         <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-green"><i class="ion ion-android-contacts"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">{{__('translations.sellers')}}</span>
              <span class="info-box-number">{{$sellers_count}}</span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        
        <div class="col-md-3 col-sm-6 col-xs-12">
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

         <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-green"><i class="ion ion-ios-pricetags"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">{{__('translations.categories')}}</span>
              <span class="info-box-number">{{$categories_count}}</span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>

         <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-green"><i class="ion ion-ios-pricetags-outline"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">{{__('translations.subcategories')}}</span>
              <span class="info-box-number">{{$subcategories_count}}</span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
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
