@extends('shop.master') @section('body')

<div class="container">
    <div class="col-md-12 check_box">
       <h3>Wish List</h3>
        <div class="col-md-6 cart-items">
            @foreach($wishes as $order)
            <div class="cart-header" id="{{$order->id}}">
                <section id="{{$order->id}}" class="close1" data-href="{{route('remove.wish', $order->id)}}"> </section>
                <div class="cart-sec simpleCart_shelfItem">
                    <div class="cart-item cyc">
                        <img src="{{asset($order->product->image_path())}}" class="img-responsive" alt="">
                    </div>
                    <div class="cart-item-info">
                        <h3><a href="{{route('shop.product.single', [$order->product->id, $order->product->slug])}} ">
                        {{(App::isLocale('ar')) ? $order->product->arabic_name : $order->product->name}}</a></h3>
                        <div class="delivery">
                            <p>{{trans('layout.Price')}} : {{$order->product->price}} {{--@if (App::isLocale('ar')) {{$order->product->currency->arabic_name or ''}} @else {{$order->product->currency->name or ''}} @endif--}}
                            </p>
                            <div class="clearfix"></div>
                        </div>
                    </div>

                    <div class="clearfix"></div>
                </div>
            </div>
            @endforeach
            {{--<!-- @endforeach @if($x == 1)
            <p style="font-weight: bold;"><a href="{{url('/index').getRequest()}}">{{trans('layout.home_page')}}</a></p>
            @else
            <p style="font-weight: bold;"><a href="{{url('/')}}">{{trans('layout.home_page')}}</a></p>
            @endif -->--}}
        </div>
        <div class="clearfix"></div>
        <div id="snackbar"></div>
    </div>
</div>
<script>
var snackbar = document.getElementById("snackbar");
$('section').unbind('click').bind('click', function (e) {
            e.preventDefault();
            var url = ($(this).attr('data-href'));
            var id=$(this).attr('id');
            swal({
                title: "{{trans('layout.alert_title')}}",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#7901FB",
                confirmButtonText: "{{trans('layout.confirm_button')}}!",
                closeOnConfirm: true,
                cancelButtonText: "{{trans('layout.cancel_button')}}",
            },
                function () {
                    //window.location = url;
                    $.ajax({
                        url: url,
                        type: 'GET',
                        success: function (data) {
                            snackbar.innerHTML = 'product deleted from your wishlist';
                            snackbar.className = "show";
                            setTimeout(function () { snackbar.className = snackbar.className.replace("show", ""); }, 2500);
                            $('#'+id+'').hide();
                        }, error: function (error) {
                            snackbar.innerHTML = 'something went wrong';
                            snackbar.className = "show";
                            setTimeout(function () { snackbar.className = snackbar.className.replace("show", ""); }, 2500);
                        }
                    })
                });
})
</script>
@stop
