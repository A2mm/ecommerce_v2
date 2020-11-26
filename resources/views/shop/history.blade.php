@extends('shop.master') @section('body')
<style>
    #panel,
    .flip {
        padding: 5px;
        text-align: center;
        background-color: #e5eecc;
        border: solid 1px #c3c3c3;
        width: 80px;
    }

    #panel {
        padding: 50px;
        display: none;
        width: 250px;
    }

</style>

<div class="container">
    <div class="check_box d-flex justify-content-center negative-margin">
        <div class="col-md-10 h2">
        <div class="cart-header shadow rounded py-5 mb-3" style="">
            <h1 class="text-center text-uppercase">old purchases</h1>
        </div>
        @if(count($purchases)==0)
                <p style="font-size:30px;">No history</p>
            @else
                @foreach($purchases as $purchase)
            <div class="cart-header shadow rounded py-5 mb-3" style="">
                <div class="my-5 d-flex justify-content-between bg-dark text-white p-3 rounded">
            
                        <p class="d-inline"><span style="font-size:16px;">{{trans('layout.Bill #ID')}}: {{$purchase->bill_id}}</span></p>
                        <p class="d-inline"><span style="font-size:16px;">{{trans('layout.Order_date')}} : {{$purchase->created_at}}</span></p>
                        <p class="d-inline"><span style="font-size:16px;">status : {{$purchase->purchase_status}}</span></p>
                    </div>
                    <table class="table table-hover table-bordered table-responsive-md text-center">
                        <thead>
                            <tr>
                                <th scope="col" class="font-weight-bold text-center text-uppercase">product image</th>
                                <th scope="col" class="font-weight-bold text-center text-uppercase">product name</th>
                                <th scope="col" class="font-weight-bold text-center text-uppercase">product coast</th>
                                <th scope="col" class="font-weight-bold text-center text-uppercase">reorder</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($purchase->histories as $history)
                            <!--<p style="display: inline-block;font-size: 15px;font-weight: bold;color: #009c6a;"></p>-->
                            <tr class="my-2">
                                <td class="align-middle">
                                    <img style="" class="img-fluid rounded" src="{{asset($history->product->image_path())}}" alt="{{(App::isLocale('ar')) ? $history->product->arabic_name : $history->product->name}}"/>
                                </td>
                                <td class="align-middle">
                                    <h3 style="display: inline-block;font-size: 18px;white-space: nowrap;overflow: hidden;width: 200px;text-overflow: ellipsis;margin: 0px 5px;">
                                        <a href="{{route('shop.product.single', [$history->product->id, $history->product->slug])}} ">
                                        {{(App::isLocale('ar')) ? $history->product->arabic_name : $history->product->name}}
                                        </a>
                                    </h3>
                                </td>
                                <td class="align-middle">
                                    <p style="display: inline-block; font-size: 18px; margin: 0px 20px;">{{$history->order->quantity}} * {{$history->order->product->price}} = {{number_format($history->price,2,",",".")}} {{ request()->c ? request()->c :'USD' }} {{--@if (App::isLocale('ar')) {{$history->product->currency->arabic_name or ''}} @else {{$history->product->currency->name or ''}} @endif--}}
                                    </p>
                                </td>
                                <td class="align-middle">
                                    @if($history->product->quantity >= $history->quantity)
                                        <form action="{{route('shop.reOrder')}}" method="POST">
                                            <div class="button item_add item_1">
                                                <input type="submit" value="re-order" class="btn btn-success btn-block">
                                            </div>
                                            <input type="hidden" name="product_id" value="{{$history->product->id}}">
                                            <input type="hidden" name="quantity" value="{{$history->quantity}}">
                                        </form>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                    <div class="mt-5">
                        <h3 class="d-inline pull-left"><span>shipment: {{$shipment}} {{request()->c?request()->c:'USD'}}</span></h3>
                        <h3 class="d-inline pull-right"><span>Total with shipment: {{$purchase->price}}</span></h3>
                        <div class="clearfix"></div>
                    </div>

                </div>
                @endforeach
            @endif
            {{--@endforeach @if($x == 1)
            <p style="font-weight: bold;"><a href="{{url('/index').getRequest()}}">{{trans('layout.home_page')}}</a></p>
            @else
            <p style="font-weight: bold;"><a href="{{url('/')}}">{{trans('layout.home_page')}}</a></p>
            @endif --}}

        </div>

    </div>
</div>
<script>
    $(document).on('click', '#remove_history', function(e) {

        e.preventDefault();

        var url = ($(this).attr('data-href'));

        swal({

                title: "{{trans('layout.alert_title')}}",

                type: "warning",

                showCancelButton: true,

                confirmButtonColor: "#7901FB",

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
