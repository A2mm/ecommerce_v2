@extends('shop.master') @section('body')

<style>
    #panel,
    .flip {
        font-size: 9pt;
    }

    #panel {
        padding: 0;
        display: none;
        width: 250px;
    }
</style>

<div class="container">
    <div class="check_box">
        <div class="col-md-9 cart-items">
            <h1>{{trans('layout.My_Shopping_Cart')}} ({{Auth::user()->cart_summary()}})</h1>
            @foreach($orders as $order)
            <div class="cart-header" id="{{$order->id}}">
                <div id="remove_order" class="close1" data-href="{{route('remove.order', $order->id)}}"> </div>
                <div class="cart-sec simpleCart_shelfItem">
                    <div class="cart-item cyc">
                        <img src="{{$order->product->image_path()}}" class="img-responsive" alt="">
                    </div>
                    <div class="cart-item-info">
                        <h3><a href="{{route('shop.product.single', [$order->product->id, $order->product->slug])}} ">{{(App::isLocale('ar')) ? $order->product->arabic_name : $order->product->name}}</a></h3>
                        <ul class="qty">
                            <li>
                                <p>{{trans('layout.Quantity')}} : {{$order->quantity}}</p>
                                <p>{{trans('layout.Price')}} : {{$order->product_price_without_currency}} {{request()->c?request()->c:'GBP'}}</p>
                            </li>
                        </ul>

                        <div class="btn btn-primary flip">Edit Quantity</div>
                        <div id="panel">
                        @if($order->product->quantity + $order->quantity > 0)
                            <form method="POST" action="{{route('quantity.edit')}}">
                                <input type="hidden" name="id" value="{{$order->id}}">
                                <ul class="product-qty">
                                    <span>{{trans('layout.Quantity')}}:</span> {{ Form::selectRange('quantity', 1, $order->product->quantity + $order->quantity, 1) }}
                                </ul>
                                <button type="submit" class="btn btn-primary">Submit</button> {!! Form::close() !!}
                            </form>
                        @else
                        <p style="font-weight: bold; color:red;"><big>Out Of Stock</big></p>
                        @endif
                        </div>

                        <ul class="qty">
                            <li>
                                <p>{{trans('layout.Order_date')}} : {{$order->created_at}}</p>
                            </li>
                        </ul>
                        <div class="delivery">
                            @if($order->product_discount_without_currency!=0)
                            <p>{{trans('layout.Price')}} : {{$order->quantity}} * {{$order->product_discount_without_currency}} {{request()->c?request()->c:'GBP'}} = {{$order->quantity * $order->product_discount_without_currency}} {{request()->c?request()->c:'GBP'}}
                            </p>
                            @else
                            <p>{{trans('layout.Price')}} : {{$order->quantity}} * {{$order->product_price_without_currency}} {{request()->c?request()->c:'GBP'}} = {{$order->quantity * $order->product_price_without_currency}} {{request()->c?request()->c:'GBP'}}
                            </p>
                            @endif
                            <div class="clearfix"></div>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
            @endforeach
            <!-- @if(app('request')->input('gen'))
            <p style="font-weight: bold;"><a href="{{url('/index').getRequest()}}">{{trans('layout.home_page')}}</a></p>
            @else
            <p style="font-weight: bold;"><a href="{{url('/')}}">{{trans('layout.home_page')}}</a></p>
            @endif -->
        </div>

        @if($checkout_amount > 0)
        <div class="col-md-3 cart-total">

            <div class="price-details">
                <h3>{{trans('layout.Price_Details')}}</h3>
                @foreach ($orders as $order)
                <span>{{trans('layout.Order')}} #{{$loop->index + 1}}</span> @if($order->product_discount_without_currency!=0)
                <span class="total1">{{$order->quantity * $order->product_discount_without_currency}} {{request()->c?request()->c:'GBP'}}</span> @else
                <span class="total1">{{$order->quantity * $order->product_price_without_currency}} {{request()->c?request()->c:'GBP'}}</span> @endif
                <div class="clearfix"></div>
                @endforeach

            </div>
            <ul class="total_price">
            <li class="last_price">
                    <h4>shipment</h4>
                </li>
                <li class="last_price">
                    <span>{{$shipment}} {{request()->c?request()->c:'GBP'}}</span>
                </li>
                <div class="clearfix"> </div>
                <li class="last_price">
                    <h4>{{trans('layout.TOTAL')}}</h4>
                </li>
                <li class="last_price"><span>{{$checkout_amount + $shipment}} {{request()->c?request()->c:'GBP'}}
      {{--@if (App::isLocale('ar'))
      {{$order->product->currency->arabic_name or ''}}
      @else
      {{$order->product->currency->name or ''}}
      @endif--}}
      </span></li>
                <div class="clearfix"> </div>
            </ul>


            <div class="clearfix"></div>


            {{--
            <form action="https://sandbox.cashu.com/cgi-bin/payment/pcashu.cgi" method="post" id="pay_form">
                <input type="hidden" name="Transaction_Code" value="{{$Transaction_Code}}">
                <a class="order" href="javascript:{}" onclick="document.getElementById('pay_form').submit(); return false;">{{trans('layout.Check out with CashU')}}</a>

            </form>


            <form action="{{$paypalUrl}}" method="post" id="paypal_form">
                <input type="hidden" name="business" value="{{$paypalId}}">
                <input type="hidden" name="cmd" value="_xclick">
                <input type="hidden" name="item_name" value="Luxgems Order">
                <input type="hidden" name="item_number" value="0">
                <input type="hidden" name="amount" value="{{$checkout_amount}}">
                <input type="hidden" name="no_shipping" value="1">
                <input type="hidden" name="currency_code" value="GBP">
                <input type="hidden" name="cancel_return" value="{{route('cart.user')}}">
                <input type="hidden" name="return" value="{{route('cart.user')}}">
                <a class="order" href="javascript:{}" onclick="document.getElementById('paypal_form').submit(); return false;">{{trans('layout.Check out with Paypal')}}</a>

            </form>


            <form action="{{$payTabUrl}}" id="paytabs_form">
                <input type="hidden" name="return_url" value="{{route('cart.user')}}">
                <a class="order" href="javascript:{}" onclick="document.getElementById('paytabs_form').submit(); return false;">{{trans('layout.Check out with PayTabs')}}</a>
            </form>--}}

            <form action="{{route('shop.buy')}}">
                <button type="submit" title="" id="one_c" class="btn btn-primary">{{trans('layout.Buy')}}</button>
            </form>

        </div>

        @endif
        <div class="clearfix"></div>

    </div>
</div>
<script>
    $(document).on('click', '#remove_order', function(e) {
        e.preventDefault();
        var url = ($(this).attr('data-href'));
        swal({
                title: "{{trans('layout.alert_title')}}",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#009c6a",
                confirmButtonText: "{{trans('layout.confirm_button')}}!",
                closeOnConfirm: false,
                cancelButtonText: "{{trans('layout.cancel_button')}}",
            },
            function() {
                window.location = url;
            });
    });
</script>

<script>
    $(document).ready(function() {
        $(".flip").click(function() {
            $(this).next("#panel").slideToggle("fast");
        });
    });

</script>

@stop
