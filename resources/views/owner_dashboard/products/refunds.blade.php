@extends('owner_dashboard.master')
@section('body')

  <section class="content-header">
    <h1>
      {{__('translations.refunds')}}
    </h1>
  </section>
<style type="text/css">
  .actionsmenu li a{
    font-size: 12px;
    padding-bottom: -55px;
  }
  .actionsmenu li {
    margin: -5px;
  }
   .actionsmenu li a:hover{
    background: blue;
  }
</style>
  <!-- Main content -->

<div class="product_movement" style="padding: 25px; border-radius: 25px; width: 600px;">

  <form class="form" method="get" action="{{route('manage.products.refunds')}}">


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
     <a style="height: 33px;" class="btn btn-sm btn-success" href="{{ route('allRefunds.excel', ['from' => $from, 'to' => $to]) }}">
       {{ __('translations.excel') }}
    <i class="fa fa-file-excel-o" aria-hidden="true"></i> </a>
</div>

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
        <th style="text-align: right;">{{trans('layout.Name')}}</th>
        <th style="text-align: right;">{{__('translations.code')}}</th>
        <th style="text-align: right;">{{__('translations.quantity_refunded')}}</th>
        <th style="text-align: right;">{{__('translations.bill_id')}}</th>
        <th style="text-align: right;">{{trans('layout.Price')}}</th>
        <th style="text-align: right;">{{__('translations.client_name')}}</th>
        <th style="text-align: right;">{{__('translations.seller_name')}}</th>
        <th style="text-align: right;">{{__('translations.store_name')}}</th>
        <th style="text-align: right;">{{__('translations.created_at')}}</th>
      </tr>
    </thead>
    <tbody>
    @foreach($refunds as $product)
            <tr>
              <td>{{$product->product->name}}</td>
              <td>{{ $product->product->unique_id }}</td>
              <td>{{ - $product->refunded }}</td>
               <td>{{ $product->bill_id }}</td>
              <td>{{ - $product->price}} {{ __('translations.egp') }}</td>
              <td>
                @if(!empty($product->user_id))
                <?php $user = App\User::withTrashed()->where('id', $product->user_id)->first(); ?>
                {{ $user->name }}  <?php //{{ ( $product->user->usertype->name }}?>
                @else
                {{ __('translations.unregistered_client')}}
                @endif
              </td>
              <td>{{$product->seller->name}}</td>
              <td>{{$product->store->name}}</td>
              <td>{{$product->created_at}}</td>
            </tr>
    @endforeach
    </tbody>
  </table>

   {!! $refunds->appends(["from" => $from, "to" => $to])->render() !!}  

</div>
      </div>
    </div>
  </section>
@stop
