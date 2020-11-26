@extends('owner_dashboard.master')

@section('body')
<style type="text/css">
<?php 
/* 
.zoom {
  transition: transform .2s; 
} 
.zoom:hover {
  transform: scale(1.5); 
} 
*/ ?>
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
  <?php /*
  <a style="height: 33px;" class="btn btn-sm btn-success" href="{{ route('excel.purchases') }}">
    اكسل <i class="fa fa-file-excel-o" aria-hidden="true"></i> </a>
*/ ?>
     <a style="height: 33px;" class="btn btn-sm btn-success" href="{{ route('excel.ahmed', ['from' => $from, 'to' => $to]) }}">
       {{ __('translations.excel') }}
    <i class="fa fa-file-excel-o" aria-hidden="true"></i> </a>
</div>

 <section class="content-header">

  @if(count($purchases) > 0)

<div class="row" >
        
        <div class="col-md-3 col-sm-6 col-xs-12 zoom">
          <div class="info-box" style="background: rgb(205, 205, 205);">
            <span class="info-box-icon bg-aqua"><i class="icon ion-android-playstore"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">  {{ __('translations.count_checkout') }} </span>
              <span class="info-box-number">{{ round($count_price, 5) + round($sum_purchases_shipments, 5) }}  {{ __('translations.egp') }} </span>
            </div>
          </div>
        </div>

        <div class="col-md-3 col-sm-6 col-xs-12 zoom">
          <div class="info-box" style="background: rgb(205, 205, 205);">
            <span class="info-box-icon bg-aqua"><i class="icon ion-android-playstore"></i></span>

            <div class="info-box-content">
              <span class="info-box-text"> {{ 'إجمالي  المتاجر'}} </span>
              <span class="info-box-number">{{ round($count_pos, 5)  }}  {{ __('translations.egp') }} </span>
            </div>
          </div>
        </div>

        <div class="col-md-3 col-sm-6 col-xs-12 zoom">
          <div class="info-box" style="background: rgb(205, 205, 205);">
            <span class="info-box-icon bg-aqua"><i class="icon ion-ios-cart-outline"></i></span>

            <div class="info-box-content">
              <span class="info-box-text"> {{ 'إجمالي الأونلاين' }} </span>
              <span class="info-box-number">
              <?php // {{ round($onlineTotal, 5) + round($onlineRefund, 5) }} {{ __('translations.egp') }} ?>
                {{ round($onlineTotal, 5) }} {{ __('translations.egp') }}
            </span>

            </div>
          </div>
        </div>

        <div class="col-md-3 col-sm-6 col-xs-12 zoom">
          <div class="info-box" style="background: rgb(205, 205, 205);">
            <span class="info-box-icon bg-aqua"><i class="icon ion-android-playstore"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">{{ __('translations.count_checkout_mono') }}</span>
              <span class="info-box-number"> {{ round($mono_price, 5)}} {{ __('translations.egp') }} </span>
            </div>
          </div>
        </div>

        <div class="col-md-3 col-sm-6 col-xs-12 zoom">
          <div class="info-box" style="background: rgb(205, 205, 205);">
            <span class="info-box-icon bg-aqua"><i class="icon ion-ios-list"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">  {{ __('translations.count_products') }} </span>
              <span class="info-box-number">  {{ $count_proddds }} </span>
            </div>
          </div>
        </div>

        <div class="col-md-3 col-sm-6 col-xs-12 zoom">
          <div class="info-box" style="background: rgb(205, 205, 205);">
            <span class="info-box-icon bg-aqua"><i class="icon ion-ios-list"></i></span>

            <div class="info-box-content">
              <span class="info-box-text"> {{ __('translations.count_orders_purchased') }}</span>
              <span class="info-box-number"> {{ $cnt_orders_purchased }} </span>
            </div>
          </div>
        </div>

        <div class="col-md-3 col-sm-6 col-xs-12 zoom">
          <div class="info-box" style="background: rgb(205, 205, 205);">
            <span class="info-box-icon bg-aqua"><i class="icon ion-ios-undo"></i></span>

            <div class="info-box-content">
              <span class="info-box-text"> {{ __('translations.count_orders_refunded') }} </span>
              <span class="info-box-number">  {{ $count_orders_refunded }} </span>
            </div>
          </div>
        </div>

        <div class="col-md-3 col-sm-6 col-xs-12 zoom">
          <div class="info-box" style="background: rgb(205, 205, 205);">
            <span class="info-box-icon bg-aqua"><i class="icon ion-ios-list"></i></span>

            <div class="info-box-content">
              <span class="info-box-text"> {{ __('translations.count_bills') }} </span>
              <span class="info-box-number">  {{ $bills }} </span>
            </div>
          </div>
        </div>

        <div class="col-md-3 col-sm-6 col-xs-12 zoom">
          <div class="info-box" style="background: rgb(205, 205, 205);">
            <span class="info-box-icon bg-aqua"><i class="icon ion-ios-play"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">{{ 'العمليات  الأونلاين' }}</span>
              <span class="info-box-number"> {{ $count_purchases_shipments }}</span>
            </div>
          </div>
        </div>

        <div class="col-md-3 col-sm-6 col-xs-12 zoom">
          <div class="info-box" style="background: rgb(205, 205, 205);">
            <span class="info-box-icon bg-aqua"> <i class="icon ion-ios-refresh"></i> </span>

            <div class="info-box-content">
              <span class="info-box-text"> {{ 'مصاريف الشحن' }} </span>
              <span class="info-box-number">  {{ $sum_purchases_shipments }} {{ __('translations.egp') }} </span>
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
                      <td>
                        @if($purchase->order_status == 'delivered')
                         شراء اونلاين
                        @else
                         دفع نقدى بالمحل
                        @endif
                    </td>
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
      @else
      <marquee>
        <h3 style="color: red" class="text-center"> {{ __('translations.no_data_found') }}</h3>
      </marquee>
      @endif
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
