@if(count($histories) <= 0)
<script type="text/javascript">
  document.getElementById('errorbill').innerHTML = 'تاكد من رقم الفاتورة';
</script>
<h3 class="text-center" style="color:red; padding-bottom: 45px;">
{{ __('translations.enter_bill_id_to_start_search') }} 
</h3>
@else

<div class="text-center">
<div class="count_client_checkout" style="text-align: center; display:inline-block; width: 400px; height: 100px; background: orange; border-radius: 15px; padding: 15px; margin-bottom: 21px;"> 
   <span style="font-size: 20px; color:black;">{{ __('translations.bill_totalprice') }}</span>
   <br>
  <span style="font-size: 35px; color:white; border-radius: 10px; padding: 25px;"> 
   {{ $bill_total }}  {{ __('translations.egp') }}
   
  </span>
</div>
</div>
<div id="area">
</div>

  <table class="table table-bordered table-striped">
    <thead>
      <tr class="success">
        <th>{{__('translations.product_name')}}</th>
          <th>{{__('translations.unique_id')}}</th>
        <th>{{__('translations.client_name')}}</th>
          <th>{{__('translations.store_name')}}</th>
          <th>{{__('translations.seller_name')}}</th>
        <th>{{__('translations.quantity')}}</th>
        <th>{{__('translations.price')}}</th>
         <th>{{__('translations.bill_id')}}</th>
           <th>{{__('translations.status')}}</th>
         <th>{{__('translations.created_at')}}</th>
      </tr>

    </thead> 

    <tbody>
      <tr>
    @foreach($histories as $item)
      <?php //@foreach($history as $item)?>
      <td>{{ $item->product->name}}</td>
      <td>{{ $item->product->unique_id}}</td>
      <td>
        @if(!empty($item->user->name)) 
        {{$item->user->name}} <br>
        ( {{$item->user->usertype->name}} )
        @else
        {{ __('translations.unregistered_client')}}
        @endif
      </td>
      <td>{{ $item->store->name }}</td>
      <td>{{$item->seller->name}}</td>
      <td>{{ $item->quantity }}
       
      </td>
      <td>  {{ $item->price }} {{ __('translations.egp') }}
      <td>{{ $item->bill_id }}</td>
      <td>{{ $item->order_status }}</td>
      <td>{{$item->created_at}}</td>
  
      </tr>
      @endforeach

    </tbody>
  </table>
 @endif      