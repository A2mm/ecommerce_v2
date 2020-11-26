@extends('owner_dashboard.master')
@section('body')

<style type="text/css">
.zoom {
  transition: transform .2s; /* Animation */
}
.zoom:hover {
  transform: scale(1.5); /* (150% zoom - Note: if the zoom is too large, it will go outside of the viewport) */
}
</style>

  <section class="content-header">
    <h1>
    {{__('translations.show_orders')}} ({{ $customer->name }})
    </h1>
  </section>

  <div class="product_movement" style="padding: 25px; border-radius: 25px; width: 600px;">

      <form class="form" method="get" action="{{route('manage.customers.details', $customer->id)}}">


<div class="row">

<div class="col-md-4">
<div class="form-group">
              <label>{{ __('translations.from') }}</label>
                <input type="date" name="from" class="form-control" value="{{$from}}" style="border-radius: 15px;">
</div>
</div>

<div class="col-md-4">
<div class="form-group">
              <label>{{ __('translations.to') }}</label>
              <input type="date" name="to" class="form-control" value="{{$to}}" style="border-radius: 15px;">
</div>
</div>

<div class="col-md-4">
<div class="form-group"><br>
    <button type="submit" name="submit" class="btn btn-sm btn-primary" style="margin-top: 10px; border-radius: 15px; "> {{__('translations.search')}} <i class="fa fa-search"></i> </button>
</div>
</div>

</div>

       </form>
    </div>
    <a class="btn  btn-success" style="margin: -10px 20px 10px 0;" href="{{route('eachCustomerPurchases.excel', ['id' => $customer->id, 'from' => $from, 'to' => $to])}}">
{{ __('translations.excel') }}
      <i class="fa fa-file-excel-o" aria-hidden="true"></i> </a>


<section class="content-header">

<div class="row" >
        
        <div class="col-md-3 col-sm-6 col-xs-12 zoom">
          <div class="info-box" style="background: rgb(205, 205, 205);">
            <span class="info-box-icon bg-aqua"><i class="icon ion-android-playstore"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">  {{ 'سعر الشراء' }}</span>
              <span class="info-box-number"> {{ round($count_checkout, 10) }} {{ __('translations.egp') }}</span>
            </div>
          </div>
        </div>

        <div class="col-md-3 col-sm-6 col-xs-12 zoom">
          <div class="info-box" style="background: rgb(205, 205, 205);">
            <span class="info-box-icon bg-aqua"><i class="icon ion-android-playstore"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">  {{ 'مصاريف الشحن' }} </span>
              <span class="info-box-number">  {{ $sum_purchases_shipments }} {{ __('translations.egp') }} </span>
            </div>
          </div>
        </div>

        <div class="col-md-3 col-sm-6 col-xs-12 zoom">
          <div class="info-box" style="background: rgb(205, 205, 205);">
            <span class="info-box-icon bg-aqua"><i class="icon ion-android-playstore"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">  {{ __('translations.count_checkout') }}</span>
              <span class="info-box-number">  
              {{ round($count_checkout, 10)  + round($sum_purchases_shipments, 5) }} {{ __('translations.egp') }}</span>
            </div>
          </div>
        </div>

        <div class="col-md-3 col-sm-6 col-xs-12 zoom">
          <div class="info-box" style="background: rgb(205, 205, 205);">
            <span class="info-box-icon bg-aqua"><i class="icon ion-android-playstore"></i></span>

            <div class="info-box-content">
              <span class="info-box-text"> {{ __('translations.count_products_user') }} </span>
              <span class="info-box-number"> {{ $count_products }} </span>
            </div>
          </div>
        </div>

        <div class="col-md-3 col-sm-6 col-xs-12 zoom">
          <div class="info-box" style="background: rgb(205, 205, 205);">
            <span class="info-box-icon bg-aqua"><i class="icon ion-android-playstore"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">   {{ __('translations.count_orders_refunded') }}</span>
              <span class="info-box-number"> {{ $count_orders_refunded }} </span>
            </div>
          </div>
        </div>

        <div class="col-md-3 col-sm-6 col-xs-12 zoom">
          <div class="info-box" style="background: rgb(205, 205, 205);">
            <span class="info-box-icon bg-aqua"><i class="icon ion-android-playstore"></i></span>

            <div class="info-box-content">
              <span class="info-box-text"> {{ __('translations.count_orders_purchased_user') }} </span>
              <span class="info-box-number"> {{ $count_orders_purchased }} </span>
            </div>
          </div>
        </div>

        <div class="col-md-3 col-sm-6 col-xs-12 zoom">
          <div class="info-box" style="background: rgb(205, 205, 205);">
            <span class="info-box-icon bg-aqua"><i class="icon ion-android-playstore"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">   {{ 'العمليات  الأونلاين' }} </span>
              <span class="info-box-number">  {{ $count_purchases_shipments }} </span>
            </div>
          </div>
        </div>  

</div>
</section>


  <section class="content">
    <div class="row">
      <div class="col-xs-12">
        <div class="box">
    <div class="box-header">
      <h3 class="box-title"></h3>
    </div>
<table class="table table-bordered table-striped">
   <thead>
    <tr class="success">
      <th style="text-align: right;">{{__('translations.product_name')}}</th>
      <th style="text-align: right;">{{__('translations.unique_id')}}</th>
      <th style="text-align: right;">{{__('translations.quantity')}}</th>
      <th style="text-align: right;">{{__('translations.price')}}</th>
      <th style="text-align: right;">{{__('translations.bill_id')}}</th>
      <th style="text-align: right;">{{__('translations.store_name')}}</th>
      <th style="text-align: right;">{{__('translations.seller_name')}}</th>
      <th style="text-align: right;">{{__('translations.status')}}</th>
      <th style="text-align: right;">{{__('translations.created_at')}}</th>
    </tr>
    </thead>
     <tbody>
      @foreach($orders as $order)
      <tr>
      <td> {{ $order->product->name }} </td>
        <td> {{ $order->product->unique_id }} </td>
       <?php /* <td>{{ $order->product['name'] }}</td> */ ?>
        <td> {{ $order->quantity }}
          <?php //{{ $order->quantity < 0 ? -$order->quantity : $order->quantity}} ?>
          <?php /*
          @if($order->refunded != 0)
              <br>
              <span style="color:red;">{{ $order->refunded }} {{ __('translations.refunded_from') }} {{ $order->quantity + $order->refunded }} </span>
              @endif*/
              ?>
        </td>
        <td> {{ $order->price }}
        <?php /*
          @if($order->sellerdiscount > 0)
          {{ $order->price - ($order->price * $order->sellerdiscount / 100)  }}
          @else
          {{ $order->price }}
          @endif*/?>
           {{__('translations.egp') }}</td>
        <td> {{ $order->bill_id }} </td>
        <td> @if($order->store_id == null)
                   {{ __('translations.online') }}
            @else
            {{ $order->store->name }}
            @endif
          </td>
         <td> 
            @if($order->store_id == null)
                   {{ __('translations.online') }}
            @else
            {{ $order->seller->name }}
            @endif
             </td>

        <td>{{ $order->order_status == 'delivered' ? __('translations.delivered') : $order->order_status }}</td>
        <td> {{ $order->created_at }} </td>

      @endforeach
    </tbody>
    </table>

    {!! $orders->appends(["from" => $from, "to" => $to])->render() !!}
    </div>
      </div>
    </div>
  </section>

@stop
