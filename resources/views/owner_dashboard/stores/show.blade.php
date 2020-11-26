@extends('owner_dashboard.master')

@section('body')

  <section class="content-header">

    <h1>

      {{$store->name}}

    </h1>

  </section>
<br>
<div class="row">

  <div class="col-md-9">
        <form class="form form-horizontal" method="get" action="{{route('manage.store.show', ['id' => $store->id])}}">
                 <div class="row">
       <div class="col-md-3"> 
        @if($search_index == 'not')
            <input type="text" class="form-control" name="search_index" value="" id="search_prods" placeholder="search....."> 

        @else
              <input type="text" class="form-control" name="search_index" value="{{$search_index}}" id="search_prods" placeholder="search....."> 

        @endif
</div>
 <div class="col-md-2" style="margin-right: -25px;"> 
   <button style="height: 33px;" type="submit" class="btn btn-sm btn-primary"> <i class="fa fa-search"></i> {{ __('translations.search') }}</button> </div>
   </div>    

       </form> 
     </div>

     <div class="col-md-2">
   <a style="height: 33px;" class="btn btn-sm btn-success" href="{{ route('showStore.excel', ['id' => $store->id, 'search_index' => $search_index == '' ? 'not' : $search_index]) }}"> 
     {{ __('translations.excel') }} <i class="fa fa-file-excel-o"></i> </a> 
</div>
<div class="col-md-2">
   <a style="height: 33px; margin-top: 15px;" class="btn btn-sm btn-danger" href="{{ route('manage.store.all') }}"> 
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

  <table class="table table-bordered table-striped">

    <thead>

      <tr>
         <th style="text-align: right;">{{__('translations.product_item')}}</th>
         <th style="text-align: right;">{{__('translations.unique_id')}}</th>
         <th style="text-align: right;">{{__('translations.quantity')}}</th>
      </tr>

    </thead>

    <tbody>
      @foreach($products as $product)
      <tr>
       <td>{{$product->name}}</td>
        <td>{{$product->unique_id}}</td>
       <td>{{$store->quantity_in_store($product->id)}}</td>

     </tr>
      @endforeach

    </tbody>

  </table>
           {!! $products->appends(['search_index' => $search_index])->render() !!} 
</div>

      </div>

    </div>

  </section>

@stop
