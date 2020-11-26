@extends('shop.master')
@section('body')
  <div class="content_box">
  <div class="container">
    <div class="row">
              <h3>All Digital Products</h3>
              <ul>
                @foreach ($digital_products as $product)
                  <li><a href="{{url('/digital/'.$product->id).getRequest()}}">{{$product->name}}</a></li>
              @endforeach
             </ul>
      </div>
      </div>
      </div>
      @stop
