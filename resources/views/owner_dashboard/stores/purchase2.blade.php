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

    {{__('translations.purchases')}}   ( {{ $store->name }} )

    </h1>
  </section>


  <div class="product_movement" style="padding: 25px; border-radius: 25px; width: 600px;">

      <form class="form" method="get" action="{{route('manage.store.purchases', $store->id)}}">


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
<a style="height: 33px; margin-right:10px; margin-top:10px" class="btn btn-sm btn-success" href="{{route('eachStorePurchases.excel', ['id' => $store->id, 'from' => $from, 'to' => $to]) }}">
{{ __('translations.excel') }}  
<i class="fa fa-file-excel-o" aria-hidden="true"></i> </a>

       </form>
    </div>


<section class="content-header">

<div class="row" >
        
        <div class="col-md-3 col-sm-6 col-xs-12 zoom">
          <div class="info-box" style="background: rgb(205, 205, 205);">
            <span class="info-box-icon bg-aqua"><i class="icon ion-android-playstore"></i></span>

            <div class="info-box-content">
              <span class="info-box-text"> {{ __('translations.count_checkout') }} </span>
              <span class="info-box-number"> {{ round($count_checkout, 5) }} {{ __('translations.egp') }}</span>
            </div>
          </div>
        </div>

        <div class="col-md-3 col-sm-6 col-xs-12 zoom">
          <div class="info-box" style="background: rgb(205, 205, 205);">
            <span class="info-box-icon bg-aqua"><i class="icon ion-android-playstore"></i></span>

            <div class="info-box-content">
              <span class="info-box-text"> {{ __('translations.count_checkout_mono') }} </span>
              <span class="info-box-number"> {{ round($mono_price, 5) }} {{ __('translations.egp') }} </span>
            </div>
          </div>
        </div>

        <div class="col-md-3 col-sm-6 col-xs-12 zoom">
          <div class="info-box" style="background: rgb(205, 205, 205);">
            <span class="info-box-icon bg-aqua"><i class="icon ion-android-playstore"></i></span>

            <div class="info-box-content">
              <span class="info-box-text"> {{ __('translations.count_products') }} </span>
              <span class="info-box-number"> {{ $count_products }} </span>
            </div>
          </div>
        </div>

        <div class="col-md-3 col-sm-6 col-xs-12 zoom">
          <div class="info-box" style="background: rgb(205, 205, 205);">
            <span class="info-box-icon bg-aqua"><i class="icon ion-android-playstore"></i></span>

            <div class="info-box-content">
              <span class="info-box-text"> {{ __('translations.count_orders_purchased') }} </span>
              <span class="info-box-number"> {{ $cnt_orders_purchased }} </span>
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
  <!-- Main content -->
                  <table class="table table-bordered table-striped">
                    <thead>
                      <tr class="success">
                        <th scope="col">{{__('translations.product_name')}}</th>
                        <th scope="col">{{__('translations.unique_id')}}</th>
                        <th scope="col">{{__('translations.quantity')}}</th>
                        <th scope="col">{{__('translations.price')}}</th>
                        <th scope="col">{{__('translations.seller_name')}}</th>
                        <th scope="col">{{__('translations.store_name')}}</th>
                        <th scope="col">{{__('translations.client_name')}}</th>
                        <th scope="col">{{__('translations.bill_id')}}</th>
                        <th>{{__('translations.status')}}</th>
                        <th>{{__('translations.payment_method')}}</th>
                        <!-- <th scope="col">{{__('translations.purchase_status')}}</th> -->
                        <th scope="col">{{__('translations.created_at')}}</th>

                      </tr>
                    </thead>
                    <tbody>
                      @foreach($histories as $history)
                      <tr>
                      <td>{{ $history->product->name }}</td>
                      <td>{{ $history->product->unique_id }}</td>
                      <td>{{ $history->quantity }}
                        <?php //{{ $history->quantity < 0 ? -$history->quantity : $history->quantity }} ?></td>
                      <td>
                        {{ $history->price }}
                       <?php  // {{ $history->price - ($history->price * $history->sellerdiscount / 100) }}?>
                      {{ __('translations.egp') }}</td>
                      <td>{{ $history->seller->name }}</td>
                      <td>{{ $history->store->name }}</td>
                      <td>@if(!empty($history->user_id))
                        <?php $thisuser = App\User::withTrashed()->where('id', $history->user_id)->first(); ?>
                           {{$thisuser->name}} <br>
                          (
                          @if(!$thisuser->usertype)
                       {{ 'هاتف خاطئ' }}
                        @else
                         {{ $thisuser->usertype->name }}
                         @endif )

                          @else
                          {{ __('translations.unregistered_client')}}
                          @endif</td>
                      <td>{{ $history->bill_id }}</td>
                      <td>{{ $history->order_status }}</td>
                      <td>{{ 'نقدي في المتجر' }}</td>
                      <td>{{ $history->created_at }}</td>
                      </tr>
                      @endforeach


                    </tbody>
                  </table>


              {!! $histories->appends(["from" => $from, "to" => $to])->render() !!}
                  </div>

                        </div>

                      </div>

                    </section>

                  @stop
