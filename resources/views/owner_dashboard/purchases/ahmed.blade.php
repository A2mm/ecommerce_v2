<table class="table table-bordered table-striped" id="purchases">
  <thead>
    <tr>
      <th>{{__('translations.client_name')}}</th>
      <th>{{__('translations.seller_name')}}</th>
      <th>{{__('translations.store_name')}}</th>
      <th>{{__('translations.product_name')}}</th>
      <th>{{__('translations.unique_id')}}</th>
      <th>{{__('translations.quantity')}}</th>
      <th>{{__('translations.price')}}</th>
      <th>{{__('translations.method')}}</th>
      <th>{{__('translations.bill_id')}}</th>
      <th>{{__('translations.status')}}</th>
      <th>{{__('translations.created_at')}}</th>

    </tr>
  </thead>
  <tbody>
  @foreach($purchases as $purchase)
    <tr>
      @if(!empty($purchase->user_id))
        <td>{{ $purchase->user->name }}<br>
          ( {{$purchase->user->usertype->name}} )
        </td>
      @else
        <td>{{__('translations.unregistered_client')}}</td>
      @endif
      <td>{{$purchase->seller->name ?? 'online'}}</td>
      <td>{{$purchase->store->name ?? 'online'}}</td>
      <td>{{ $purchase->product->name }}</td>
      <td>{{ $purchase->product->unique_id }}</td>
      <td>{{$purchase->quantity}} </td>
      <td>{{$purchase->price }} {{__('translations.egp')}}</td>
        <td>دفع نقدى بالمحل</td>
        <td>{{$purchase->bill_id}}</td>
        <td>{{$purchase->order_status }}</td>
        <td>{{$purchase->created_at}}</td>
      </tr>
  @endforeach
  </tbody>
</table>
