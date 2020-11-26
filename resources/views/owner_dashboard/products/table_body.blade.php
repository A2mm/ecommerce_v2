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
              <td>{{ $product->weight }}</td>
              <td>{{ $product->subcategory->name }}</td>
              <td>{{ $product->subcategory->category->name }}</td>
              <td>
                  {{ $product->pricing($product->id)}} {{ __('translations.egp') }}
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
<li><a href="{{route('manage.products.discount.get',['id' => $product->id])}}" class="btn btn-xs ">{{__('translations.discount')}}</a></li><li class="divider"></li>

            <li><a href="{{route('manage.products.view',['id' => $product->id])}}" class="btn btn-xs ">{{__('translations.view')}}</a></li><li class="divider"></li>

                <li><a href="{{route('manage.products.edit',['id' => $product->id])}}" class="btn btn-xs ">{{__('translations.edit')}}</a> </li><li class="divider"></li>
             
                <li><a href="{{route('manage.products.Quantity',['id' => $product->id])}}" class="btn btn-xs">{{__('translations.change_quantity')}}</a></li><li class="divider"></li>

                <li><a href="{{route('manage.products.price',['id' => $product->id])}}" class="btn btn-xs">{{__('translations.change_price')}}</a></li><li class="divider"></li>

                <li><a href="{{route('manage.products.view.history',['id' => $product->id])}}" class="btn btn-xs ">{{__('translations.view_product_history')}}</a></li><li class="divider"></li>


                @if($product->archive == 0)
                <li><a href="{{route('manage.products.archive',['id' => $product->id])}}" class="btn btn-xs">{{__('translations.add_to_archive')}}</a></li>
                @elseif($product->archive == 1)
                <li><a href="{{route('manage.products.archive',['id' => $product->id])}}" class="btn btn-xs">{{__('translations.remove_from_archive')}}</a></li>
                @endif

</ul>
</div>
              </td>
             
            </tr>
    @endforeach

   
   </tbody>
 </table>

  {{ $products->links() }}
   

