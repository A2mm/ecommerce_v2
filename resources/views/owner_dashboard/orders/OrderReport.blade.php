@foreach($orders as $order)

<h3>$order->product->name <span>{{__('translations.bill_id')}}{{$order->bill_id}}</span></h3><br>
<p>{{__('translations.quantity')}}: {{$order->quantity}}</p><br>
<p>{{__('translations.price')}}: {{$order->quantity}} * {{$order->product->price}} ={{number_format($order->quantity * $order->product->price,2,",",".")}}

            {{--@if (App::isLocale('ar'))
              {{$order->product->currency->arabic_name or ''}}
              @else
              {{$order->product->currency->name or ''}}
              @endif--}}
              </p>


@endforeach
