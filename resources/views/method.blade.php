@extends('shop.master')
@section('body')
<div class="container">
  <div class="check_box">
<h3 style="padding-top: 10px;">Choose your payment method:</h3>

<!-- <form action="https://sandbox.cashu.com/cgi-bin/payment/pcashu.cgi" method="post" id="pay_form">
      <input type="hidden" name="Transaction_Code" value="{{$Transaction_Code}}">
      <a class="order" href="javascript:{}" onclick="document.getElementById('pay_form').submit(); return false;">{{trans('layout.Check out with CashU')}}</a>
     
    </form> -->

    
<form action="{{$paypalUrl}}" method="post" id="paypal_form">
		      <input type="hidden" name="business" value="{{$paypalId}}">
		      <input type="hidden" name="cmd" value="_xclick">
		      <input type="hidden" name="item_name" value="Luxgems Order">
		      <input type="hidden" name="item_number" value="0">
		      <input type="hidden" name="amount" value="{{$checkout_amount}}">
		      <input type="hidden" name="no_shipping" value="1">
		      <input type="hidden" name="currency_code" value="USD">
		      <input type="hidden" name="cancel_return" value="{{route('cart.user')}}">
		      <input type="hidden" name="return" value="{{route('cart.user')}}">
		      <input type="hidden" name="purchase_id" value="{{$purchase->id}}">
		  
       		  <div class="btn_form button item_add item_1">
          		<input type="submit" value="Paypal" title="" id="one_c" >
      		 </div>
  </form>


    			<form action="{{route('shop.cashOnDelivery')}}" method="post">
    				<div class="btn_form button item_add item_1">
          				<input type="submit" value="Cash on delivery" title="" id="one_c" >
      		 		</div>
    				<input type="hidden" name="purchase_id" value="{{$purchase->id}}">
            <input type="hidden" name="price" value="{{$checkout_amount}}">

    			</form>



@if($checkout_amount > 0)
<div class="col-md-3 cart-total" style="float: right;
    top: 40px;
    position: absolute;
    right: 0;">
   
    <div class="price-details">
      <h3>Summary</h3>
      @foreach ($orders as $order)
        <span>{{$loop->index + 1}}- {{$order->product->name}}</span>

        @if($order->product->discount)
        <span class="total1">{{number_format($order->quantity * $order->product->discount,2,",",".")}}</span>
        @else
        <span class="total1">{{number_format($order->quantity * $order->product->price,2,",",".")}}</span>
        @endif
        <div class="clearfix"></div>
      @endforeach

    </div>
    <ul class="total_price">
      <li class="last_price"> <h4>{{trans('layout.TOTAL')}}</h4></li>
      <li class="last_price"><span>{{$checkout_amount}} {{request()->curr}}
      </span></li>
      <div class="clearfix"> </div>
    

      <form action="{{route('cart.user')}}">
        <div class="btn_form button item_add item_1">
            <input type="submit" value="Edit Orders" >
        </div>
      </form>  
    </ul>

   </div>

    @endif


</div>
</div>

@stop

    			