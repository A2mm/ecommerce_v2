@extends('owner_dashboard.master')

@section('body')

  <section class="content-header">
    <h1>
    {{__('translations.sold')}}
    </h1>
  </section>

  <div class="product_movement" style="padding: 25px; border-radius: 25px; width: 600px;">
     
      <form class="form" method="get" action="{{route('sellers.kilo', $seller->id)}}">
            
            
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

<div class="container">
<div class="row">
  <div class="col-md-6">
      <div class="count_client_orders" style="text-align: center; display:inline-block; width: 350px; height: 115px; background: green; border-radius: 15px; padding: 15px; margin-bottom: 10px;"> 
        <span style="font-size: 20px; color:black;"> 
        {{ __('translations.total') }} {{ $category1->name }}</span>
        <br>
        <span style="font-size: 35px; color:white; border-radius: 10px; padding: 15px;"> 
        {{ $cat1 }} {{ __('translations.gm') }} </span>  
      </div>
</div>
<div class="col-md-6" style="margin-right: -180px;">
    <div class="count_client_orders" style="text-align: center; display:inline-block; width: 350px; height: 115px; background: green; border-radius: 15px; padding: 15px; margin-bottom: 10px;"> 

      <span style="font-size: 20px; color:black;"> 
      {{ __('translations.total_mono') }} {{ $category1->name }}</span>
      <br>
      <span style="font-size: 35px; color:white; border-radius: 10px; padding: 15px;"> 
      {{ $sub1_mono_kilo }} {{ __('translations.gm') }} </span>
    </div>
</div>

</div>

<div class="row">

  <div class="col-md-6" style="margin-left: 0px;">
         <div class="count_client_orders" style="text-align: center; display:inline-block; width: 350px; height: 115px; background: green; border-radius: 15px; padding: 15px; margin-bottom: 10px;">  
          <span style="font-size: 20px; color:black;"> 
          {{ __('translations.total') }} {{ $category2->name }}</span>
          <br>
          <span style="font-size: 35px; color:white; border-radius: 10px; padding: 15px;"> 
          {{ $cat2 }} {{ __('translations.gm') }}</span>
        </div>
  </div>

  <div class="col-md-6" style="margin-right: -180px;">
         <div class="count_client_orders" style="text-align: center; display:inline-block; width: 350px; height: 115px; background: green; border-radius: 15px; padding: 15px; margin-bottom: 10px;"> 

          <span style="font-size: 20px; color:black;"> 
          {{ __('translations.total_mono') }} {{ $category2->name }}</span>
          <br>
          <span style="font-size: 35px; color:white; border-radius: 10px; padding: 15px;"> 
          {{ $sub2_mono_kilo }} {{ __('translations.gm') }} </span>
        </div>

</div>

</div>


<div class="row">

<div class="col-md-6">
      <div class="count_client_checkout" style="text-align: center; display:inline-block; width: 350px; height: 115px; background: green; border-radius: 15px; padding: 15px; margin-bottom: 10px;"> 
         <span style="font-size: 20px; color:black;">
               {{ __('translations.total') }} {{ $category3->name }}
       </span>
        <br> 
        <span style="font-size: 35px; color:white; border-radius: 10px; padding: 15px;">
        {{ $cat3 }} {{ __('translations.gm') }}
      </span>
      </div>
</div>

<div class="col-md-6" style="margin-right: -180px;">
        <div class="count_client_orders" style="text-align: center; display:inline-block; width: 350px; height: 115px; background: green; border-radius: 15px; padding: 15px; margin-bottom: 10px;"> 

          <span style="font-size: 20px; color:black;"> 
          {{ __('translations.total_mono') }} {{ $category3->name }}</span>
          <br>
          <span style="font-size: 35px; color:white; border-radius: 10px; padding: 15px;"> 
          {{ $sub3_mono_kilo }} {{ __('translations.gm') }} </span>
        </div>
</div>

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
          <th style="text-align: right;">{{__('translations.category')}}</th>
      <?php //  <th>{{__('translations.client_name')}}</th> ?>
     <?php //      <th>{{__('translations.store_name')}}</th> ?>
          <th style="text-align: right;">{{__('translations.quantity')}}</th> 
          <th style="text-align: right;">{{__('translations.weight')}}</th> 
          <th style="text-align: right;">{{__('translations.total_weight')}}</th> 
          <th style="text-align: right;">{{__('translations.total_weight_mono')}}</th> 
          <th style="text-align: right;">{{__('translations.price')}}</th>
         <?php //  <th>{{__('translations.bill_id')}}</th> ?>
        <?php //    <th>{{__('translations.status')}}</th> ?>
        <?php // <th>{{__('translations.created_at')}}</th> ?>
      </tr>

    </thead> 

    <tbody>
      <tr>
    @foreach($soldprods3 as $item)
      <?php //@foreach($history as $item)?>
      <td>{{ $item->product->name}}</td>
      <td>{{ $item->product->unique_id}}</td>
       <td>{{ $item->product->subcategory->category->name}}</td>
     <?php /* <td>
        @if(!empty($item->user->name)) 
        {{$item->user->name}} <br>
        ( {{$item->user->usertype->name}} )
        @else
        {{ __('translations.unregistered_client')}}
        @endif
      </td> */?>
      <?php //<td>{{ $item->store->name }}</td> ?>
      <td>{{ $item->sumquantity }}
        <?php /*{{ $item->quantity < 0 ? -$item->quantity : $item->quantity }}*/ ?>
       <?php /* @if($item->refunded != 0)
        <br>
        <span style="color:red;">{{ $item->refunded }} {{ __('translations.refunded_from') }} {{ $item->quantity + $item->refunded }} </span>
        @endif*/?>
      </td>
      <td>  {{$item->product->weight}} {{ __('translations.gm') }}</td>
       <td> {{$item->sumquantity * $item->product->weight }} {{ __('translations.gm') }}</td>
       <td> {{ $item->prod_total }} {{ __('translations.gm') }} </td>
      <td>  {{ $item->sumprice }} {{ __('translations.egp') }}
         <?php // {{ $item->price - ($item->price * $item->sellerdiscount / 100) }}  {{ __('translations.egp') }}</td> ?>
      <?php //<td>{{ $item->bill_id }}</td> ?>
      <?php //<td>{{ $item->order_status }}</td> ?>
     <?php // <td>{{$item->created_at}}</td> ?>
      </tr>
      @endforeach

    </tbody>
  </table>
                       
           {!! $soldprods3->appends(["from" => $from, "to" => $to])->render() !!} 
</div>
      </div>
    </div>
  </section>

@stop
