<table class="table table-bordered table-striped">
  <thead>
    <tr>
      <th style="text-align: right;">{{__('translations.product_name')}}</th>
      <th style="text-align: right;">{{__('translations.store_name')}}</th>
      <th style="text-align: right;">{{__('translations.quantity')}}</th>
    </tr>
  </thead>
  <tbody>
    @foreach($products as $item)
      <tr>
        <td>{{ $item['product'] }}</td>
        <td>{{ $item['store'] }}</td>
        <td>{{ $item['quantity'] }}</td>
      </tr>
    @endforeach
  </tbody>
</table>
