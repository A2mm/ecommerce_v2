@extends('owner_dashboard.master')
@section('body')

  <section class="content-header">
    <h1>
      {{__('translations.onlinerefunds')}}
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
  <section class="content">
    <?php /* <a href="{{route('excel.product.refunds')}}" class="btn btn-success">اكسل <i class="fa fa-file-excel-o" aria-hidden="true"></i></a>  */ ?>
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
  {{ $refunds->links()}}
</div>
      </div>
    </div>
  </section>
@stop
