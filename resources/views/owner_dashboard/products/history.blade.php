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
     <u> {{__('translations.prod_sold')}} : ({{ $product->name }}) </u>
    </h1>
  </section>

  <div class="product_movement" style="padding: 25px; border-radius: 25px; width: 600px;">
     
      <form class="form" method="get" action="{{route('manage.products.view.history', $product->id)}}">
            
            
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

    <section class="content-header">

<div class="row" >
        
        <div class="col-md-3 col-sm-6 col-xs-12 zoom">
          <div class="info-box" style="background: rgb(205, 205, 205);">
            <span class="info-box-icon bg-aqua"><i class="icon ion-android-playstore"></i></span>

            <div class="info-box-content">
              <span class="info-box-text"> {{ __('translations.count_checkout') }}</span>
              <span class="info-box-number">{{ round($count_checkout, 5) }} {{ __('translations.egp') }}</span>
            </div>
          </div>
        </div>

        <div class="col-md-3 col-sm-6 col-xs-12 zoom">
          <div class="info-box" style="background: rgb(205, 205, 205);">
            <span class="info-box-icon bg-aqua"><i class="icon ion-android-playstore"></i></span>

            <div class="info-box-content">
              <span class="info-box-text"> {{ __('translations.count_products') }}</span>
 
              <span class="info-box-number"> {{ $count_products }}</span>
            </div>
          </div>
        </div>

        <div class="col-md-3 col-sm-6 col-xs-12 zoom">
          <div class="info-box" style="background: rgb(205, 205, 205);">
            <span class="info-box-icon bg-aqua"><i class="icon ion-android-playstore"></i></span>

            <div class="info-box-content">
              <span class="info-box-text"> {{ __('translations.count_orders_refunded') }} </span>
              <span class="info-box-number"> {{ $count_orders_refunded }} </span>
            </div>
          </div>
        </div>
 </div>
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
      <tr class="success">
        <th style="text-align: right;">{{__('translations.product_name')}}</th>
        <th style="text-align: right;">{{__('translations.unique_id')}}</th>
        <th style="text-align: right;">{{__('translations.client_name')}}</th>
        <th style="text-align: right;">{{__('translations.store_name')}}</th>
        <th style="text-align: right;">{{__('translations.quantity')}}</th>
        <th style="text-align: right;">{{__('translations.price')}}</th>
        <th style="text-align: right;">{{__('translations.bill_id')}}</th>
        <th style="text-align: right;">{{__('translations.status')}}</th>
        <th style="text-align: right;">{{__('translations.created_at')}}</th>
      </tr>

    </thead> 

    <tbody>
      <tr>
    @foreach($orders as $item)
      <?php //@foreach($history as $item)?>
      <td>{{ $item->product->name}}</td>
      <td>{{ $item->product->unique_id}}</td>
      <td>
        @if(!empty($item->user->name)) 
        {{$item->user->name}} <br>
        ( {{$item->user->usertype->name}} )
        @else
        {{ __('translations.unregistered_client')}}
        @endif
      </td>
      <td>{{ $item->store->name ?? __('translations.online') }}</td>
      <td>{{ $item->quantity }}
        <?php /*{{ $item->quantity < 0 ? -$item->quantity : $item->quantity }}*/ ?>
       <?php /* @if($item->refunded != 0)
        <br>
        <span style="color:red;">{{ $item->refunded }} {{ __('translations.refunded_from') }} {{ $item->quantity + $item->refunded }} </span>
        @endif*/?>
      </td>
      <td> {{ $item->price }}
         <?php //{{ $item->price - ($item->price * $item->sellerdiscount / 100) }} ?> 
       {{ __('translations.egp') }}</td>
      <td>{{ $item->bill_id }}</td>
      <td>  
        @if($item->order_status == 'delivered')
                        {{ __('translations.delivered') }}
        @else
                        {{ $item->order_status}}
        @endif
      </td>
      <td>{{$item->created_at}}</td>
    
      <?php /*<td>
        <a type="button" class="delete btn btn-xs btn-danger" data-href="{{route('sellers.history.delete', $item->id)}}" href="{{route('sellers.history.delete', $item->id)}}">{{__('translations.delete')}}</a>
      </td>*/ ?>
      </tr>
      @endforeach

    </tbody>
  </table>
  {!! $orders->appends(["from" => $from, "to" => $to])->render() !!} 
</div>
      </div>
    </div>
  </section>

@stop
