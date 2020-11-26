<table class="table table-bordered table-striped">
  <thead>
    <tr class="success">
      <th>{{__('translations.product_name')}}</th>
      <th>{{__('translations.unique_id')}}</th>
      <th>{{__('translations.quantity')}}</th>
      <th>{{__('translations.price')}}</th>
      <th>{{__('translations.bill_id')}}</th>
      <th>{{__('translations.store_name')}}</th>
      <th>{{__('translations.seller_name')}}</th>
      <th>{{__('translations.status')}}</th>
      <th>{{__('translations.created_at')}}</th>
    </tr>
  </thead>
  <tbody>
    @foreach($orders as $order)
      <tr>
        <td> {{ App\Product::where('id', $order->product_id)->select('name')->first()['name']}} </td>
        <td> {{ App\Product::where('id', $order->product_id)->select('unique_id')->first()['unique_id']}} </td>
        <td> {{ $order->quantity }} </td>
        <td> {{ $order->price }} {{__('translations.egp') }}</td>
        <td> {{ $order->bill_id }} </td>
        <td> {{ App\Store::where('id', $order->store_id)->select('name')->first()['name']}} </td>
        <td> {{ App\Seller::where('id', $order->seller_id)->select('name')->first()['name']}} </td>
        <td>{{ App\History::where(['product_id' => $order->product_id, 'bill_id' => $order->bill_id , 'order_id' => $order->id])->select('order_status')->first()['order_status'] }}</td>
        <td> {{ $order->created_at }} </td>
      </tr>
      @endforeach
  </tbody>
</table>
