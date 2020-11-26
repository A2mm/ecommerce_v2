
<table class="table table-bordered table-striped">
   <thead>
    <tr class="success">
      <th style="text-align: right;">{{__('translations.product_name')}}</th>
      <th style="text-align: right;">{{__('translations.unique_id')}}</th>
      <th style="text-align: right;">{{__('translations.quantity')}}</th>
      <th style="text-align: right;">{{__('translations.price')}}</th>
      <th style="text-align: right;">{{__('translations.bill_id')}}</th>
      <th style="text-align: right;">{{__('translations.store_name')}}</th>
      <th style="text-align: right;">{{__('translations.seller_name')}}</th>
      <th style="text-align: right;">{{__('translations.status')}}</th>
      <th style="text-align: right;">{{__('translations.created_at')}}</th>
    </tr>
    </thead>
     <tbody>
      @foreach($orders as $order)
      <tr>
      <td> {{ $order->product->name }} </td>
        <td> {{ $order->product->unique_id }} </td>
       <?php /* <td>{{ $order->product['name'] }}</td> */ ?>
        <td> {{ $order->quantity }}
        </td>
        <td> {{ $order->price }}
      
           {{__('translations.egp') }}</td>
        <td> {{ $order->bill_id }} </td>
        <td> @if($order->store_id == null)
                   {{ __('translations.online') }}
            @else
            {{ $order->store->name }}
            @endif
          </td>
         <td> 
            @if($order->store_id == null)
                   {{ __('translations.online') }}
            @else
            {{ $order->seller->name }}
            @endif
             </td>

        <td>{{ $order->order_status == 'delivered' ? __('translations.delivered') : $order->order_status }}</td>
        <td> {{ $order->created_at }} </td>

      @endforeach
    </tbody>
    </table>
