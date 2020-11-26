<table class="table table-bordered table-striped">
  <thead>
    <tr class="success">
      <th scope="col">{{__('translations.product_name')}}</th>
      <th scope="col">{{__('translations.unique_id')}}</th>
      <th scope="col">{{__('translations.quantity')}}</th>
      <th scope="col">{{__('translations.price')}}</th>
      <th scope="col">{{__('translations.seller_name')}}</th>
      <th scope="col">{{__('translations.store_name')}}</th>
      <th scope="col">{{__('translations.client_name')}}</th>
      <th scope="col">{{__('translations.bill_id')}}</th>
      <th>{{__('translations.status')}}</th>
      <th>{{__('translations.payment_method')}}</th>
      <th scope="col">{{__('translations.created_at')}}</th>

    </tr>
  </thead>
  <tbody>
    @foreach($histories as $history)
      <tr>
        <td>{{ $history->product->name }}</td>
        <td>{{ $history->product->unique_id }}</td>
        <td>{{ $history->quantity }}
        <td>{{ $history->price }} {{ __('translations.egp') }}</td>
        <td>{{ $history->seller->name }}</td>
        <td>{{ $history->store->name }}</td>
        <td>
          @if(!empty($history->user->name))
            {{$history->user->name}} <br>
            ( {{$history->user->usertype->name}} )
          @else
            {{ __('translations.unregistered_client')}}
          @endif</td>
        <td>{{ $history->bill_id }}</td>
        <td>{{ $history->order_status }}</td>
        <td>{{ 'نقدي في المتجر' }}</td>
        <td>{{ $history->created_at }}</td>
      </tr>
    @endforeach
  </tbody>
</table>
