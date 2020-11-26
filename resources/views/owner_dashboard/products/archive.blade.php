@extends('owner_dashboard.master')
@section('body')
  <section class="content-header">
    <h1>
      {{__('translations.archived_products')}}
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
     
     <?php $user = Auth::user(); ?>

  <table class="table table-bordered table-striped">
    <thead>
      <tr>
        <th style="text-align: right;">{{trans('layout.Name')}}</th>
        <th style="text-align: right;">{{__('translations.code')}}</th>
        <th style="text-align: right;">{{__('translations.weight')}}</th>
        <th style="text-align: right;">{{__('translations.subcategory')}}</th>
        <th style="text-align: right;">{{__('translations.category')}}</th>
        <th style="text-align: right;">{{trans('layout.Price')}}</th>
        <th style="text-align: right;">{{__('translations.available_quantity')}}</th>
        <th style="text-align: right;">{{trans('layout.Actions')}}</th>
      </tr>
    </thead>
    <tbody>
    @foreach($products as $product)
            <tr>
              <td>{{$product->name}}</td>
              <td>{{$product->unique_id}}</td>
              <td>{{$product->weight}}</td>
              <td>{{$product->subcategory->name}}</td>
              <td>{{$product->subcategory->category->name}}</td>
              <td>{{ $product->pricing($product->id)}}</td>
              <td>
                 <?php $product_quantity = App\ProductStoreQuantity::where('product_id', $product->id)
                                                                   ->sum('quantity'); ?> 
                     {{ $product_quantity }}
             </td>
              <td>
             
              @if($user->can('view specific archived product') || $user->can('Administer'))
              <a href="{{route('manage.products.view',['id' => $product->id])}}" class="btn btn-xs btn-info">{{__('translations.view')}}</a>
              @endif
           
                <!--<a data-href="{{route('manage.products.delete',['id' => $product->id])}}" class="delete btn btn-xs btn-danger">Delete</a>-->
                @if($user->can('change product quantity') || $user->can('Administer'))
                <a href="{{route('manage.products.Quantity',['id' => $product->id])}}" class="btn btn-xs btn-primary">{{__('translations.change_quantity')}}</a>
                 @endif

                @if($product->archive==0)
                @if($user->can('archive product') || $user->can('Administer'))
                <a style="background: coral;" href="{{route('manage.products.archive',['id' => $product->id])}}" class="btn btn-xs">{{__('translations.add_to_archive')}}</a>
                 @endif

                @elseif($product->archive==1)
                @if($user->can('unarchive product') || $user->can('Administer'))
                <a style="background: coral;" href="{{route('manage.products.archive',['id' => $product->id])}}" class="btn btn-xs">{{__('translations.remove_from_archive')}}</a>
                @endif
                 @endif
              </td>
            </tr>
    @endforeach
    </tbody>
  </table>

  {{ $products->links() }}
</div>
      </div>
    </div>
  </section>
@stop
