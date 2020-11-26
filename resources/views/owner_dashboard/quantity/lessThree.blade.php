@extends('owner_dashboard.master')
@section('body')
  <section class="content-header">
    <h1>
      {{__('translations.less_than_25')}}
    </h1><br>
  </section>

  <div class="row">
  <div class="col-md-9">

              <form class="form form-horizontal" method="get" action="{{route('manage.quantity.three')}}">
                 <div class="row">
       <div class="col-md-3">
  <input type="text" class="form-control" name="search_index" value="{{$search_index}}" id="search_prods" placeholder="{{ __('translations.search') }}">
</div>
 <div class="col-md-2" style="margin-right: -25px;">
   <button style="height: 33px;" type="submit" class="btn btn-sm btn-primary"> <i class="fa fa-search"></i> {{ __('translations.search') }}</button> </div>
   </div>
       </form>
     </div>
     <?php /*
<div class="col-md-2">
   <a style="height: 33px;" class="btn btn-sm btn-danger back_home" href="{{ route('manage.quantity.three') }}">
     {{ __('translations.back_home') }} <i class="fa fa-arrow-left"></i> </a>
</div> */ ?>
</div>
<a class="btn  btn-success" style="margin: 2px;" href="{{ route('excel.quantity.twentyFive')}}">
  اكسل <i class="fa fa-file-excel-o" aria-hidden="true"></i> </a>

<br>
      <?php $user = Auth::user(); ?>

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
        <th style="text-align: right;">{{__('translations.product_name')}}</th>
        <th style="text-align: right;">{{__('translations.store_name')}}</th>
        <th style="text-align: right;">{{__('translations.quantity')}}</th>
        <th style="text-align: right;">{{trans('layout.Actions')}}</th>
      </tr>
    </thead>
    <tbody>
    @foreach($rare_products as $item)
    <tr>
    <td>{{ $item['product'] }}</td>
    <td>{{ $item['store'] }}</td>
    <td>{{ $item['quantity'] }}</td>
    <td>
      @if($user->can('change product quantity') || $user->can('Administer'))
    <a href="{{route('manage.products.Quantity',['id' => $item['id']])}}" class="btn btn-xs btn-primary">{{__('translations.edit_quantity')}}</a>
    @endif
    </td>
    </tr>
    @endforeach
    </tbody>
  </table>

    {!! $rare_products->links() !!}

</div>
      </div>
    </div>
  </section>
@stop
