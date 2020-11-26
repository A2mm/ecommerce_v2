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
        <?php $prices = App\Usertypeprice::where('product_id', $product->id)->get(); ?>
        @foreach($prices as $price)
          <tr>
            <td>{{$product->name}}</td>
            <td>{{$product->unique_id}}</td>
            <td>{{$product->subcategory->name}}</td>
            <td>{{$product->weight}}</td>
            <td>
              {{ 'السعر' }} {{$price->usertype->name}} : {{ $price->price }} {{ __('translations.egp')}} <br>
            </td>
          </tr>
        @endforeach
      @endforeach
    </tbody>
</table>
