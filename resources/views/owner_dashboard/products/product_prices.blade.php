@extends('owner_dashboard.master')

@section('body')

  <section class="content-header">
    <h1>
     {{__('translations.product_prices')}}
    </h1>
  </section>
  <!-- Main content -->

  <section class="content">

    <div class="row">

      <div class="col-xs-12">

        <div class="box">

    <div class="box-header">

      <h3 class="box-title"></h3>
      <a href="{{route('excel.product.prices')}}" class="btn btn-success">اكسل <i class="fa fa-file-excel-o" aria-hidden="true"></i></a>

    </div><!-- /.box-header -->


<table class="table table-bordered table-striped">
<thead>
      <tr>
        <th>{{__('translations.product_name')}}</th>
        <th>{{__('translations.unique_id')}}</th>
        <th>{{__('translations.subcategory')}}</th>
         <th>{{__('translations.weight')}}</th>
        <th style="vertical-align: middle;">{{__('translations.price')}}</th>
      </tr>
      <thead>
        <tbody>
          @foreach($products as $product)
             <tr>
              <td>{{$product->name}}</td>
              <td>{{$product->unique_id}}</td>
              <td>{{$product->subcategory->name}}</td>
              <td>{{$product->weight}}</td>
              <td>
                <?php $prices = App\Usertypeprice::where('product_id', $product->id)->get(); ?>
                @foreach($prices as $price)
                {{ 'السعر' }} {{$price->usertype->name}} : {{ $price->price }} {{ __('translations.egp')}} <br>
                @endforeach
               </td>
             </tr>
          @endforeach
        </tbody>
    </table>

    </div>
      </div>
    </div>
  </section>

@stop
