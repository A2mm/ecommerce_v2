@extends('owner_dashboard.master')

@section('body')

  <section class="content-header">

    <h1>

    {{__('translations.all_transactions')}}

    </h1>

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


      <tr>
        <th>{{__('translations.username')}}</th>
        <th>{{$purchase->user->name}}</th>
      </tr>
      <!-- <tr>
        <th>{{__('translations.delivery_address')}}</th>
        <th>{{$purchase->delivery_address}}</th>
      </tr>
      <tr>
        <th>{{__('translations.billing_address')}}</th>
        <th>{{$purchase->billing_address}}</th>
      </tr>
      <tr>
        <th>{{__('translations.receptor_mobile')}}</th>
        <th>{{$purchase->receptor_mobile}}</th>
      </tr>
      <tr>
        <th>{{__('translations.buyer_mobile')}}</th>
        <th>{{$purchase->buyer_mobile}}</th>
      </tr>
      <tr>
        <th>{{__('translations.receptor_name')}}</th>
        <th>{{$purchase->receptor_name}}</th>
      </tr> -->
      <tr>
        <th>{{__('translations.price')}}</th>
        <th>{{$purchase->price}}</th>
      </tr>
      <tr>
        <th>{{__('translations.method')}}</th>
        <th>{{$purchase->method}}</th>
      </tr>
      <tr>
        <th>{{__('translations.status')}}</th>
        <th>{{$purchase->purchase_status}}</th>
      </tr>
      <!-- <tr>
        <th>{{__('translations.note')}}</th>
        <th>{{$purchase->note}}</th>
      </tr> -->
      <tr>
        <th>{{__('translations.bill_id')}}</th>
        <th>{{$purchase->bill_id}}</th>
      </tr>
      <tr>
        <th>{{__('translations.created_at')}}</th>
        <th>{{$purchase->created_at}}</th>
      </tr>
    </thead>
     <tbody>
    </tbody>
    </table>

    <table class="table table-bordered table-striped">
      <tr>
        <th>{{__('translations.product_name')}}</th>
        <th>{{__('translations.code')}}</th>
        <th>{{__('translations.quantity')}}</th>
        <th>{{__('translations.price')}}</th>
      </tr>
      @foreach($purchase->histories as $history)
      <tr>
        <th>{{$history->product->name}}</th>
        <th>{{$history->product->unique_id}}</th>
        <th>{{$history->quantity}}</th>
        @if(isset($history->product->discount) && $history->product->discount!=0)
          <th>{{$history->quantity * $history->product->discount}}</th>
        @else
          <th>{{ (int) $history->quantity * (int) $history->product->price}}</th>
        @endif
      </tr>
      @endforeach
  </table>



    </div>
      </div>
    </div>
  </section>

@stop
