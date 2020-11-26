@extends('owner_dashboard.master')

@section('body')

<section class="content-header">
  <h1>
    {{__('translations.store_products_movements')}} ( {{ $store->name }} )
  </h1>
</section>

</section>
<br>
<div class="row">

  <div class="col-md-9">

    <form class="form form-horizontal" method="get" action="{{route('manage.store.movements', ['id' => $store->id])}}">
      <div class="row">
        <div class="col-md-3">
           <label>{{ __('translations.search_index') }}</label>
            @if($search_index == 'not')
          <input type="text" class="form-control" name="search_index" value="" id="search_prods" placeholder="{{__('translations.search') }}">

        @else
          <input type="text" class="form-control" name="search_index" value="{{$search_index}}" id="search_prods" placeholder="{{__('translations.search') }}">

        @endif
        </div>
         <div class="col-md-3">
        <div class="form-group">
          <label>{{ __('translations.from') }}</label>
          <input type="date" name="from" class="form-control" value="{{$from}}" style="border-radius: 15px;">
        </div>
      </div>
         <div class="col-md-3">
        <div class="form-group">
          <label>{{ __('translations.to') }}</label>
          <input type="date" name="to" class="form-control" value="{{$to}}" style="border-radius: 15px;">
        </div>
      </div>
 <div class="col-md-2" style="margin-right: -25px;"> 
   <label style="margin-right: 15px;">{{ __('translations.search') }} </label><br>
   <button style="height: 33px; margin-right: 15px;" type="submit" class="btn btn-sm btn-primary"> <i class="fa fa-search"></i> {{ __('translations.search') }}</button> </div>
   </div>

    </form>
  </div>


    <a style="height: 33px;" class="btn btn-sm btn-success" href="{{ route('storeMovements.excel', ['id' => $store->id, 'from' => $from, 'to' => $to, 'search_index' => $search_index == '' ? 'not' : $search_index]) }}">
       {{ __('translations.excel') }}
    <i class="fa fa-file-excel-o" aria-hidden="true"></i> </a>

  <?php /* <a style="height: 33px;" class="btn btn-sm btn-success" href="{{ url('/excel/store/products?id=' . $store->id)}}">
    اكسل <i class="fa fa-file-excel-o" aria-hidden="true"></i> </a> */ ?>
  <div class="col-md-2">
  <div class="col-md-2">
    <a style="height: 33px;" class="btn btn-sm btn-danger" href="{{ route('manage.store.all') }}">
      {{ __('translations.back_home_stores') }} <i class="fa fa-arrow-left"></i> </a>
  </div>
</div>
<br>


<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-xs-12">
      <div class="box">
        <div class="box-header">
          <h3 class="box-title"></h3>

        </div><!-- /.box-header -->
        <!-- Main content -->

        @if(count($movementss) > 0)

        <table class="table table-bordered table-striped">
          <thead>
            <tr>
              <th style="text-align: right;">{{__('translations.product_name')}}</th>
              <th style="text-align: right;">{{__('translations.quantity')}}</th>
              <th style="text-align: right;">{{__('translations.reason')}}</th>
              <th style="text-align: right;">{{__('translations.created_at')}}</th>
            </tr>
          </thead>
          <tbody>

            @foreach($movementss as $movement)
            <tr>
              <td>{{$movement->product->name}}</th>
              <td> {{ $movement->quantity }}</td>
              <td> {{$movement->reason}}</td>
              <td> {{$movement->created_at}}</td>
            </tr>
            @endforeach


          </tbody>
        </table>

        @else
        <h3 class="text-center" style="padding-bottom: 25px; color: red;"> {{ __('translations.no_data_found') }} </h3>

        @endif


        {{ $movementss->appends(['from' => $from, 'to' => $to, 'search_index' => $search_index])->render() }}
      </div>
    </div>
  </div>
</section>
@stop
