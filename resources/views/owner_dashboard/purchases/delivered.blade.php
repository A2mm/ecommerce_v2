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

    {{__('translations.all_transactions')}}

  </h1>

</section>

<div class="product_movement" style="padding: 25px; border-radius: 25px; width: 600px;">

  <form class="form" method="get" action="{{route('manage.purchase.all.delivered')}}">


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
  <a style="height: 33px;" class="btn btn-sm btn-success" href="{{ route('excel.purchases') }}">
    اكسل <i class="fa fa-file-excel-o" aria-hidden="true"></i> </a>
</div>

<div class="text-center">
  <?php
         //
      ?>

  <div class="zoom count_client_orders" style="text-align: center; display:inline-block; width: 350px; height: 115px; background: rgb(128, 128, 0); border-radius: 15px; padding: 15px; margin-bottom: 10px;">
    <span style="font-size: 20px; color:black;">
      {{ __('translations.count_checkout') }} </span>
    <br>
    <span style="font-size: 35px; color:white; border-radius: 10px; padding: 15px;"> 
  
    {{ round($count_price, 5) + round($sum_purchases_shipments, 5) }} {{ __('translations.egp') }}
   </span>
  </div>
<?php  // store pos total only ?>
  <div class="count_client_orders" style="text-align: center; display:inline-block; width: 350px; height: 115px; background:rgb(128, 128, 0); border-radius: 15px; padding: 15px; margin-bottom: 10px;">
    <span style="font-size: 20px; color:black;">
      {{ 'إجمالي  المتاجر'}} </span>
    <br>
    <span style="font-size: 35px; color:white; border-radius: 10px; padding: 15px;"> 
    {{  round($count_pos, 5) }} {{ __('translations.egp') }}
   </span>
  </div>

  <?php  // online total only ?>
  <div class="count_client_orders" style="text-align: center; display:inline-block; width: 350px; height: 115px; background:rgb(128, 128, 0); border-radius: 15px; padding: 15px; margin-bottom: 10px;">
    <span style="font-size: 20px; color:black;">
      {{ 'إجمالي الأونلاين' }} </span>
    <br>
    <span style="font-size: 35px; color:white; border-radius: 10px; padding: 15px;"> 
    <?php // {{ round($count_price, 5) - round($count_pos, 5) }} {{ __('translations.egp') }} ?>
             {{ round($count_price, 5) -  round($count_pos, 5) }} {{ __('translations.egp') }} 
   </span>
  </div>

  <div class="count_client_orders" style="text-align: center; display:inline-block; width: 350px; height: 115px; background:rgb(128, 128, 0); border-radius: 15px; padding: 15px; margin-bottom: 10px;">
    <span style="font-size: 20px; color:black;">
      {{ __('translations.count_checkout_mono') }}</span>
    <br>
    <span style="font-size: 35px; color:white; border-radius: 10px; padding: 15px;"> 
    {{ round($mono_price, 5)}} {{ __('translations.egp') }} </span>
  </div>

  <div class="count_client_checkout" style="text-align: center; display:inline-block; width: 240px; height: 115px; background:rgb(128, 128, 0); border-radius: 15px; padding: 15px; margin-bottom: 10px;">
    <span style="font-size: 20px; color:black;">
      {{ __('translations.count_products') }}
    </span>
    <br>
    <span style="font-size: 35px; color:white; border-radius: 10px; padding: 15px;">
      {{ $count_proddds }}
    </span>
  </div>

  <div class="count_client_checkout" style="text-align: center; display:inline-block; width: 240px; height: 115px; background:rgb(128, 128, 0); border-radius: 15px; padding: 15px; margin-bottom: 10px;">
    <span style="font-size: 20px; color:black;">{{ __('translations.count_orders_purchased') }}</span>
    <br>
    <span style="font-size: 35px; color:white; border-radius: 10px; padding: 15px;">
      {{ $cnt_orders_purchased }}

    </span>
  </div>

  <div class="count_client_checkout" style="text-align: center; display:inline-block; width: 200px; height: 115px; background:rgb(128, 128, 0); border-radius: 15px; padding: 15px; margin-bottom: 10px;">
    <span style="font-size: 20px; color:black;">{{ __('translations.count_orders_refunded') }}</span>
    <br>
    <span style="font-size: 35px; color:white; border-radius: 10px; padding: 15px;">
      {{ $count_orders_refunded }}

    </span>
  </div>

  <div class="count_client_checkout" style="text-align: center; display:inline-block; width: 200px; height: 115px; background:rgb(128, 128, 0); border-radius: 15px; padding: 15px; margin-bottom: 10px;">
    <span style="font-size: 20px; color:black;">{{ __('translations.count_bills') }}</span>
    <br>
    <span style="font-size: 35px; color:white; border-radius: 10px; padding: 15px;">
      {{ $bills }}

    </span>
  </div>  

  <div class="count_client_checkout" style="text-align: center; display:inline-block; width: 200px; height: 115px; background:rgb(128, 128, 0); border-radius: 15px; padding: 15px; margin-bottom: 10px;">
    <span style="font-size: 20px; color:black;">{{ 'العمليات  الأونلاين' }}</span>
    <br>
    <span style="font-size: 35px; color:white; border-radius: 10px; padding: 15px;">
      {{ $count_purchases_shipments }}

    </span>
  </div>  

   <div class="count_client_checkout" style="text-align: center; display:inline-block; width: 200px; height: 115px; background:rgb(128, 128, 0); border-radius: 15px; padding: 15px; margin-bottom: 10px;">
    <span style="font-size: 20px; color:black;">{{ 'مصاريف الشحن' }}</span>
    <br>
    <span style="font-size: 35px; color:white; border-radius: 10px; padding: 15px;">
      {{ $sum_purchases_shipments }} {{ __('translations.egp') }}

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
              <th style="text-align: right;">{{__('translations.client_name')}}</th>
              <th style="text-align: right;">{{__('translations.seller_name')}}</th>
              <th style="text-align: right;">{{__('translations.store_name')}}</th>
              <th style="text-align: right;">{{__('translations.product_name')}}</th>
              <th style="text-align: right;">{{__('translations.unique_id')}}</th>
              <th style="text-align: right;">{{__('translations.quantity')}}</th>
              <th style="text-align: right;">{{__('translations.price')}}</th>
              <!-- <th>{{__('translations.status')}}</th> -->
              <th style="text-align: right;">{{__('translations.method')}}</th>
              <th style="text-align: right;">{{__('translations.bill_id')}}</th>
              <th style="text-align: right;">{{__('translations.status')}}</th>
              <th style="text-align: right;">{{__('translations.created_at')}}</th>
              <!-- <th>{{__('translations.actions')}}</th> -->

            </tr>
          </thead>
          <tbody>
            @foreach($purchases as $purchase)
              {{-- @if ($purchase->histories) --}}
                {{-- @foreach($purchase->histories as $history) --}}
                  <tr>
                    @if(!empty($purchase->user_id))
                      <td>{{ $purchase->user->name }}<br>
                        ( {{$purchase->user->usertype->name}} )
                      </td>
                    @else
                      <td>{{__('translations.unregistered_client')}}</td>
                    @endif
                    <td>{{$purchase->seller->name ?? __('translations.online') }}</td>
                    <td>{{$purchase->store->name ?? __('translations.online') }}</td>
                    <td>{{ $purchase->product->name }}</td>
                    <td>{{ $purchase->product->unique_id }}</td>
                    <td>{{$purchase->quantity}}
                      <?php
                      /*
                      @if($history->refunded != 0)
                      <br>
                      <span style="color:red;">{{ $history->refunded }} {{ __('translations.refunded_from') }} {{ $history->quantity + $history->refunded }} </span>
                      @endif
                      */
                      ?>
                    </td>
                    <td>
                      {{$purchase->price }}
                      <?php /* @if($history->sellerdiscount > 0)
                      {{ $history->price -($history->price * $history->sellerdiscount / 100) }}
                      @else
                      {{$history->price }}
                      @endif*/?>
                      {{__('translations.egp')}}</td>
                      <!-- <td>{{$purchase->purchase_status}}</td> -->
                      <td>دفع نقدى بالمحل</td>
                      <td>{{$purchase->bill_id}}</td>
                      <td>@if($purchase->order_status == 'delivered')
                        {{ __('translations.delivered') }}
                        @else
                        {{ $purchase->order_status}}
                        @endif
                       </td>
                      <td>{{$purchase->created_at}}</td>
                    </tr>
                  {{-- @endforeach --}}

              {{-- @endif --}}
              @endforeach
          </tbody>
        </table>

        {!! $purchases->appends(["from" => $from, "to" => $to])->render() !!}
      </div>
    </div>
  </div>
  </div>
</section>

@endsection

@section('scripts')

<script type="text/javascript">
  $(document).ready(function() {
    $('#submit').on('click', function(e) {
      e.preventDefault();
      alert('one');
    });
  });
</script>
@endsection
