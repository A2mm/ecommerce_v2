@extends('shop.master')
@section('body')
  <div class="content_box">
  <div class="container">
    <div class="row">
              <h3>Name: {{$product->name}}</h3>
              <p>Description: {{$product->description}}</p>
              <p>Price: {{$product->price}}</p>
      </div>

       <form action="{{route('digital.download')}}">
          <input type="hidden" name="file" value="{{$product->file}}">

         <div class="btn_form button item_add item_1">
              <input type="submit" value="DOWNLOAD">
           </div>
      </form>

      <form action="{{$paypalUrl}}" method="post" id="paypal_form">
          <input type="hidden" name="business" value="{{$paypalId}}">
          <input type="hidden" name="cmd" value="_xclick">
          <input type="hidden" name="item_name" value="Luxgems Order">
          <input type="hidden" name="item_number" value="0">
          <input type="hidden" name="amount" value="{{$product->price}}">
          <input type="hidden" name="no_shipping" value="1">
          <input type="hidden" name="currency_code" value="USD">
          <input type="hidden" name="cancel_return" value="{{route('digitals')}}">
          <input type="hidden" name="return" value="{{url('/download?name='.$product->name)}}">
          <input type="hidden" name="name" value="{{$product->name}}">

      
            <div class="btn_form button item_add item_1">
              <input type="submit" value="Buy using Paypal" title="" id="one_c" >
           </div>
  </form>
      </div>
      </div>
      @stop
