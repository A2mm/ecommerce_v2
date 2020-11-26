@extends('owner_dashboard.master')
@section('body')
  <section class="content-header">
    <h1>
      <u> {{__('translations.product_movements')}} : ({{ $prod->name }}) </u>
    </h1>
  </section>
<br>
<div class="row">

  <div class="col-md-9">

        <form class="form form-horizontal" method="get" action="{{route('manage.products.all.movements', ['id' => $product_id])}}">
                 <div class="row">
       <div class="col-md-3"> 
  <input type="text" class="form-control" name="search_index" value="{{$search_index}}" id="search_prods" placeholder="{{__('translations.search') }}"> 
</div>
 <div class="col-md-2" style="margin-right: -25px;"> 
   <button style="height: 33px;" type="submit" class="btn btn-sm btn-primary"> <i class="fa fa-search"></i> {{ __('translations.search') }}</button> </div>
   </div>    
       </form> 
     </div>
<div class="col-md-2">
   <a style="height: 33px;" class="btn btn-sm btn-success" href="{{ route('manage.products.all') }}"> 
     {{ __('translations.all_back_home') }} <i class="fa fa-arrow-left"></i> </a> 
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
  <table class="table table-bordered table-striped">
    <thead>
      <tr>
        <th style="text-align: right;">{{trans('layout.Name')}}</th>
        <th style="text-align: right;">{{trans('layout.Quantity')}}</th>
        <th style="text-align: right;">{{__('translations.reason')}}</th>
        <th style="text-align: right;">{{__('translations.By_purchase')}}</th>
        <th style="text-align: right;">{{__('translations.type')}}</th>
        <th style="text-align: right;">{{__('translations.created_at')}}</th>
      </tr>
    </thead>
    <tbody>
    @foreach($movements as $movement)
            <tr>
              <td> {{$movement->store->name}}</td>
              <td> {{ $movement->quantity }} <?php // {{abs($movement->quantity)}} ?> </td>
              <td>
              @if($movement->reason != null)
              {{ $movement->reason }}
              @else
              <small style="opacity: 0.7">{{__('translations.n/a')}}</small>
              @endif
              </td>
              <td>
              @if($movement->purchase_id != null)
              {{__('translations.yes_purchased')}}
              @else
              {{__('translations.no')}}
              @endif
              </td>
              <td>
              @if($movement->type == '+')
              {{__('translations.addition')}}
              @else
              {{__('translations.subtraction')}}
              @endif
              </td>
              <td>{{$movement->created_at}}</td>
            </tr>
    @endforeach
    </tbody>
  </table>
</div>

 {!! $movements->appends(['search_index' => $search_index])->render() !!}

      </div>
    </div>
  </section>
@stop
