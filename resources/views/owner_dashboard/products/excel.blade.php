<table class="table">
    <thead>
        <tr>
          <th style="text-align: right;"> {{ __('translations.name') }} </th>
          <th style="text-align: right;">{{__('translations.unique_id')}}</th>
          <th style="text-align: right;">{{__('translations.weight')}}</th>
          <th style="text-align: right;">{{__('translations.subcategory')}}</th>
          <th style="text-align: right;">{{__('translations.category')}}</th>
          <th style="text-align: right;">{{trans('layout.Price')}}</th>
          <th style="text-align: right;">{{__('translations.created_at')}}</th>
        </tr>
    </thead>
    <tbody>
    @foreach($products as $product)
        <tr>
          <td>{{ $product->name}}</td>
          <td>{{ $product->unique_id }}</td>
          <td>{{ $product->weight }}</td>
          <td>{{ $product->subcategory->name }}</td>
          <td>{{ $product->subcategory->category->name }}</td>
          <td>{{ $product->pricing($product->id)}} {{ __('translations.egp') }}</td>
          <td>{{$product->created_at}}</td>
        </tr>
    @endforeach
    </tbody>
</table>
