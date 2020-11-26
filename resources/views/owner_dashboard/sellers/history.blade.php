@extends('owner_dashboard.master')

@section('body')

  <section class="content-header">
    <h1>
    {{__('translations.sold')}}
    </h1>
  </section>

  <div class="product_movement" style="padding: 25px; border-radius: 25px; width: 600px;">
     
      <form class="form" method="get" action="{{route('sellers.soldprods', $seller->id)}}">
            
            
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

  <div class="text-center">
<div class="count_client_orders" style="text-align: center; display:inline-block; width: 350px; height: 115px; background: rgb(128, 128, 0); border-radius: 15px; padding: 15px;"> 
  <span style="font-size: 20px; color:black;"> 
  {{ __('translations.count_checkout') }}</span>
  <br>
  <span style="font-size: 35px; color:white; border-radius: 10px; padding: 15px;"> {{ round($count_checkout,5) }} {{ __('translations.egp') }}</span>
</div>

<div class="count_client_orders" style="text-align: center; display:inline-block; width: 350px; height: 115px; background: rgb(128, 128, 0); border-radius: 15px; padding: 15px; margin-bottom: 10px;">  
  <span style="font-size: 20px; color:black;"> 
  {{ __('translations.count_checkout_mono') }}</span>
  <br>
  <span style="font-size: 35px; color:white; border-radius: 10px; padding: 15px;"> {{ round($mono_price, 5) }} {{ __('translations.egp') }} </span>
</div>

<div class="count_client_checkout" style="text-align: center; display:inline-block; width: 230px; height: 115px; background: rgb(128, 128, 0); border-radius: 15px; padding: 15px;"> 
   <span style="font-size: 20px; color:black;">   
         {{ __('translations.count_products') }}
  <br> 
  <span style="font-size: 35px; color:white; border-radius: 10px; padding: 15px;">  
    {{ $count_products }}</span>
</div>

<div class="count_client_checkout" style="text-align: center; display:inline-block; width: 230px; height: 115px; background: rgb(128, 128, 0); border-radius: 15px; padding: 15px;"> 
   <span style="font-size: 20px; color:black;">{{ __('translations.count_orders_purchased') }}</span>
  <br> 
  <span style="font-size: 35px; color:white; border-radius: 10px; padding: 15px;"> 
   {{ $count_orders_purchased }}  
   
  </span>
</div>

<div class="count_client_checkout" style="text-align: center; display:inline-block; width: 230px; height: 115px; background: rgb(128, 128, 0); border-radius: 15px; padding: 15px;"> 
   <span style="font-size: 20px; color:black;">{{ __('translations.count_orders_refunded') }}</span>
  <br> 
  <span style="font-size: 35px; color:white; border-radius: 10px; padding: 15px;"> 
   {{ $count_orders_refunded }}  
   
  </span>
</div>

<div class="count_client_checkout" style="text-align: center; display:inline-block; width: 200px; height: 115px; background: rgb(128, 128, 0); border-radius: 15px; padding: 15px; margin: 10px;"> 
   <span style="font-size: 20px; color:black;">{{ __('translations.count_bills') }}</span>
  <br> 
  <span style="font-size: 35px; color:white; border-radius: 10px; padding: 15px;"> 
   {{ $bills }}  
   
  </span>
</div>

</div>


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
    @foreach($soldprods as $item)
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
      <td>{{ $item->store->name }}</td>
      <td>{{ $item->quantity }}
        <?php /*{{ $item->quantity < 0 ? -$item->quantity : $item->quantity }}*/ ?>
       <?php /* @if($item->refunded != 0)
        <br>
        <span style="color:red;">{{ $item->refunded }} {{ __('translations.refunded_from') }} {{ $item->quantity + $item->refunded }} </span>
        @endif*/?>
      </td>
      <td>  {{ $item->price }} {{ __('translations.egp') }}
         <?php // {{ $item->price - ($item->price * $item->sellerdiscount / 100) }}  {{ __('translations.egp') }}</td> ?>
      <td>{{ $item->bill_id }}</td>
      <td>{{ $item->order_status }}</td>
      <td>{{$item->created_at}}</td>
    
      <?php /*<td>
        <a type="button" class="delete btn btn-xs btn-danger" data-href="{{route('sellers.history.delete', $item->id)}}" href="{{route('sellers.history.delete', $item->id)}}">{{__('translations.delete')}}</a>
      </td>*/ ?>
      </tr>
      @endforeach

    </tbody>
  </table>
                       
              {!! $soldprods->appends(["from" => $from, "to" => $to])->render() !!} 
</div>
      </div>
    </div>
  </section>

@stop
