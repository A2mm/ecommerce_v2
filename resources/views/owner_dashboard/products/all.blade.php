@extends('owner_dashboard.master')
@section('body')

  <section class="content-header">
    <h1>
      {{trans('layout.All Products')}}
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
    <div class="row">
      <div class="col-xs-12">
        <div class="box">
    <div class="box-header">
      <h3 class="box-title"></h3>
    </div><!-- /.box-header -->

     <?php $user = Auth::user(); ?>

  <div class="row">

  <div class="col-md-9">

              <form class="form form-horizontal" method="get" action="{{route('manage.products.all')}}">
                 <div class="row">
       <div class="col-md-3">
  <input type="text" class="form-control" name="search_index" value="{{$search_index}}" id="search_prods" placeholder="{{ __('translations.search') }}">
</div>
 <div class="col-md-2" style="margin-right: -25px;">
   <button style="height: 33px;" type="submit" class="btn btn-sm btn-primary"> <i class="fa fa-search"></i> {{ __('translations.search') }}</button> </div>
   </div>
       </form>
     </div>
<div class="col-md-3 sub">
   <a style="height: 33px; background: coral; color: white;" class="btn btn-sm back_home" href="{{ route('manage.products.all') }}">
     {{ __('translations.back_home') }} <i class="fa fa-refresh"></i> </a>

     <a style="height: 33px;" class="btn btn-sm btn-success" href="{{ route('excel.products') }}">
       اكسل <i class="fa fa-file-excel-o" aria-hidden="true"></i> </a>
</div>
</div>
<br>
           </div>
         </div>
<div id="dynamic_content">
  <table class="table table-bordered table-striped">
    <thead>
      <tr>
        <th style="text-align: right;"> {{ __('translations.name') }} </th>
       <?php /* <th>{{__('translations.count_orders_refunded')}}</th>
        <th>{{ __('translations.count_products')}}</th>
        <th>{{ __('translations.count_checkout') }}</th> */ ?>
        <th style="text-align: right;">{{__('translations.unique_id')}}</th>
        <th style="text-align: right;">{{__('translations.weight')}}</th>
        <th style="text-align: right;">{{__('translations.subcategory')}}</th>
        <th style="text-align: right;">{{__('translations.category')}}</th>
        <th style="text-align: right;">{{trans('layout.Price')}}</th>
        <th style="text-align: right;"> {{__('translations.available_online')}} </th>
        <?php // <th>{{__('translations.available_quantity')}}</th> ?>
        <th style="text-align: right;">{{__('translations.created_at')}}</th>
        <th style="text-align: right;">{{trans('layout.Actions')}}</th>
      </tr>
    </thead>
    <tbody id="table_body">


         @foreach($products as $product)
            <tr>
              <td>{{ $product->name}}</td>
            <?php /*
              <td>{{ App\History::where('product_id', $product->id)->where('quantity', '<', 0)->count()}}</td>
              <td> {{ App\History::where('product_id', $product->id)->sum('quantity') }}</td>
              <td> {{ App\History::where('product_id', $product->id)->sum('price') }}
                   {{ __('translations.egp') }}</td>
                   */ ?>
              <td>{{ $product->unique_id }}</td>
              <td>{{ $product->weight }} {{ __('translations.gm') }}</td>
              <td>{{ $product->subcategory->name }}</td>
              <td>{{ $product->subcategory->category->name }}</td>
              <td>
                  {{ $product->pricing($product->id)}} {{ __('translations.egp') }}
              </td>
              <td>
                  @if($product->available_online == null || $product->available_online == 0)
                    <span class="label label-default"> {{ __('translations.unavailable') }} </span>
                  @else
                   <label class="label label-success"> {{ __('translations.available') }}</label>
                  @endif
              </td>
             <?php // <td>{{$product->quantity}}</td> ?>
              <td>{{$product->created_at}}</td>
              <td>
               <div class="dropdown">
<button class="btn btn-primary btn-xs dropdown-toggle" type="button" id="about-us" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
{{ __('translations.select_action') }}
<span class="caret"></span>
</button>
<ul class="dropdown-menu actionsmenu" aria-labelledby="about-us" style="background: skyblue;">

@if($user->can('product discount') || $user->can('Administer'))
<li><a href="{{route('manage.products.discount.get',['id' => $product->id])}}" class="btn btn-xs ">{{__('translations.discount')}}</a></li><li class="divider"></li>
 @endif

<?php // @if($user->can('edit store') || $user->can('Administer')) ?>
@if($user->can('view specific product') || $user->can('Administer'))
            <li><a href="{{route('manage.products.view',['id' => $product->id])}}" class="btn btn-xs ">{{__('translations.view')}}</a></li><li class="divider"></li>
@endif
<?php // @endif ?>

@if($user->can('edit product') || $user->can('Administer'))
                <li><a href="{{route('manage.products.edit',['id' => $product->id])}}" class="btn btn-xs ">{{__('translations.edit')}}</a> </li><li class="divider"></li>
 @endif

@if($user->can('change product quantity') || $user->can('Administer'))
                <li><a href="{{route('manage.products.Quantity',['id' => $product->id])}}" class="btn btn-xs">{{__('translations.change_quantity')}}</a></li><li class="divider"></li>
 @endif

@if($user->can('change product price') || $user->can('Administer'))
                <li><a href="{{route('manage.products.price',['id' => $product->id])}}" class="btn btn-xs">{{__('translations.change_price')}}</a></li><li class="divider"></li>
 @endif

 @if($user->can('view all tags') || $user->can('Administer'))
                <li><a href="{{route('product.alltags',['id' => $product->id])}}" class="btn btn-xs">{{__('translations.tags')}}</a></li><li class="divider"></li>
 @endif

@if($user->can('view product history') || $user->can('Administer'))
<li><a href="{{route('manage.products.view.history',['id' => $product->id])}}" class="btn btn-xs ">{{__('translations.view_product_history')}}</a></li><li class="divider"></li>
 @endif

                @if($product->archive == 0)
@if($user->can('archive product') || $user->can('Administer'))
                <li><a href="{{route('manage.products.archive',['id' => $product->id])}}" class="btn btn-xs">{{__('translations.add_to_archive')}}</a></li><li class="divider"></li>
 @endif

                @elseif($product->archive == 1)
@if($user->can('unarchive product') || $user->can('Administer'))
                <li><a href="{{route('manage.products.archive',['id' => $product->id])}}" class="btn btn-xs">{{__('translations.remove_from_archive')}}</a></li><li class="divider"></li>
 @endif
                @endif
  @if($user->can('create discount') || $user->can('Administer'))
    <li><a href="{{route('online.discount.create', $product->id)}}" class="btn btn-xs">{{'خصم اونلاين'}}</a></li>
  @endif
  {{-- @if($user->can('product reviews') || $user->can('Administer'))
    <li><a href="{{route('product.reviews', $product->id)}}" class="btn btn-xs">{{'تقييمات المنتج'}}</a></li>
  @endif --}}

</ul>
</div>
              </td>

            </tr>
    @endforeach

  </tbody>
  </table>
 {!! $products->appends(['search_index' => $search_index])->render() !!}
   </div>


</div>
      </div>
    </div>
  </section>

 <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>

 <?php /*
  <script type="text/javascript">
       $(document).ready(function()
      {
        // fkey();
              $(window).keydown(function(event){
           if(event.keyCode == 116) {
     // alert('oooo');
     $('.back_home').click(true);
    }
});    */ ?>
      <?php /*
       fetch_data();

        function fetch_data(page, search_index = '')
        {
          $.ajax({
            //  url  : '{{ route("manage.products.all.ajax") }}',  manage/products/ajax
             url  : '/owner/manage/products/ajax?page='+page+'&serach_index='+search_index,
              type : 'GET',
              data : { 'search_index' : search_index },
              success : function(data)
              {
               // alert('one');
                $('#table_body').empty().html(data);
               // $('#total_records').text(data.total_data);
              }
            });
            // alert('one');
        }

         $('#search_prods').on('keyup', function()
         {
            var search_index = $(this).val();
            var page = $('#hidden_page').val();
            fetch_data(page, search_index);
         });


         $(document).on('click', '.pagination a', function(event){
            event.preventDefault();
            var page = $(this).attr('href').split('page=')[1];
            $('#hidden_page').val(page);
            // var column_name = $('#hidden_column_name').val();
           // var sort_type = $('#hidden_sort_type').val();

            var search_index = $('#search_prods').val();

            $('li').removeClass('active');
                  $(this).parent().addClass('active');
            fetch_data(page, search_index);
           });

*/ ?>
      });
  </script>

@stop
