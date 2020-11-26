@extends('owner_dashboard.master')
@section('body')
<section class="content-header">
  <h1>

  </h1>
</section>
<?php $user = Auth::user(); ?>
<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-xs-12">
      <div class="box">
        <div class="box-header">

<h3 > {{ __('translations.stores_details') }} </h3>
<div style="color: white; background: black;">
           <table class="table" style="color: white;">
          <thead>
            <tr>
               <th style="text-align: right">{{__('translations.store')}}</th>
               <th style="text-align: right">{{__('translations.quantity')}}</th>
               <th style="text-align: right">{{__('translations.created_at')}}</th>
            </tr>
          </thead>
          <tbody>
            @foreach($store_details as $det)
            <tr>      
              <td>{{$det->store->name }}</td>
              <td>{{-$det->quantity}}</td>
              <td>{{$det->created_at}}</td>
            </tr>
            @endforeach
          </tbody>
        </table>
        </div>
        </div><!-- /.box-header -->
        <h3> {{ __('translations.purchase_details') }} </h3>
        <table class="table">
          <thead>
            <tr>
              <th style="text-align: right;">{{__('translations.user_name')}}</th>
              <th style="text-align: right;">{{__('translations.price')}}</th>
              <th style="text-align: right;">{{__('translations.quantity')}}</th>
              <th style="text-align: right;">{{__('translations.status')}}</th>
              <th style="text-align: right;">{{__('translations.bill_id')}}</th>
              <th style="text-align: right;">{{__('translations.store')}}</th>
              <th style="text-align: right;">{{__('translations.seller')}}</th>
              <th style="text-align: right;">{{__('translations.created_at')}}</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($prod_details as $purchase)
            <tr>
              @if($purchase->user_id!=null)
              <td>{{$purchase->user->name}}</td>
              @else
              <td>{{__('translations.store')}}</td>
              @endif
              <td>{{$purchase->price}}</td>
               <td>{{$purchase->quantity}}</td>
              <td>{{ __('translations.'.$purchase->order_status) }}</td>
              <td>{{$purchase->bill_id}}</td>
              <td>{{$purchase->store_id != null ? $purchase->store->name :  __('translations.No_deliver_yet')  }}</td>
              <td>{{$purchase->seller_id != null ? $purchase->seller->name :  __('translations.No_deliver_yet') }}</td>
              <td>{{$purchase->created_at}}</td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>
</section>
@stop
