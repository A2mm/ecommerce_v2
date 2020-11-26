@extends('owner_dashboard.master')

@section('body')

  <section class="content-header">

    <h1>

    {{__('translations.purchases')}}

    </h1>

  </section>

  <div class="text-center">
<div class="count_client_orders" style="text-align: center; display:inline-block; width: 250px; height: 115px; background: green; border-radius: 15px; padding: 15px;"> 
  <span style="font-size: 25px; color:black;"> 
  {{ __('translations.count_checkout') }}</span>
  <br>
  <span style="font-size: 35px; color:white; border-radius: 10px; padding: 15px;"> {{ App\History::where('store_id', $store->id)->sum('price') }} {{ __('translations.egp') }}</span>
</div>

<div class="count_client_checkout" style="text-align: center; display:inline-block; width: 250px; height: 115px; background: skyblue; border-radius: 15px; padding: 15px;"> 
   <span style="font-size: 25px; color:black;">{{ __('translations.count_products') }}</span>
  <br> 
  <span style="font-size: 35px; color:white; border-radius: 10px; padding: 15px;">  {{ App\History::where('store_id', $store->id)->sum('quantity') }}</span>
</div>

<div class="count_client_checkout" style="text-align: center; display:inline-block; width: 250px; height: 115px; background: skyblue; border-radius: 15px; padding: 15px;"> 
   <span style="font-size: 25px; color:black;">{{ __('translations.count_orders') }}</span>
  <br> 
  <span style="font-size: 35px; color:white; border-radius: 10px; padding: 15px;">  
     <?php $ords = App\History::where('store_id', $store->id)->get(); ?>  
    {{ count($ords->groupBy('bill_id')) }}</span>
</div>

</div>

  <!-- Main content -->

  <section class="content">

    <div class="row">

      <div class="col-xs-12">

        <div class="box">

    <div class="box-header">

      <h3 class="box-title"></h3>

    </div><!-- /.box-header -->
  <!-- Main content -->
                  <table class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th scope="col">{{__('translations.product_name')}}</th>
                        <th scope="col">{{__('translations.unique_id')}}</th>
                        <th scope="col">{{__('translations.quantity')}}</th>
                        <th scope="col">{{__('translations.price')}}</th>
                        <th scope="col">{{__('translations.seller_name')}}</th>
                        <th scope="col">{{__('translations.bill_id')}}</th>
                        <th>{{__('translations.status')}}</th>
                        <!-- <th scope="col">{{__('translations.purchase_status')}}</th> -->
                        <th scope="col">{{__('translations.created_at')}}</th>

                      </tr>
                    </thead>
                    <tbody>

                        @foreach($purchases as $purchase)
                          @foreach ($purchase->purchase_in_store($store->id) as $purc)
                            <tr>
                              <td scope="row">{{$purc->product->name}}</td>
                              <td scope="row">{{$purc->product->unique_id}}</td>
                              <td> 
                                <?php //{{abs($purc->quantity)}}?> 
                              <?php $item =  App\History::where(['product_id' => $purc->product->id, 'purchase_id' => $purchase->id])->first(); ?>
                                 {{ $item['quantity'] }} 
                                 <?php /*
                                 @if($item['refunded'] != 0)
                                  <br>
                                  <span style="color:red;">{{ $item['refunded'] }} {{ __('translations.refunded_from') }} {{ $item['quantity'] + $item['refunded'] }} </span>
                                  @endif*/?>
                              </td>
                              <td><?php/* @if($purc->product->priceafterdiscount($purc->product->id))
                                   {{ intval($purc->product->priceafterdiscount($purc->product->id)) * abs($purc->quantity) }}
                                   @else
                                   {{ $purc->product->pricing($purc->product->id) * abs($purc->quantity) }}
                                @endif */?>
                                {{App\History::where(['product_id' => $purc->product->id, 'purchase_id' => $purchase->id])->first()['price']}} {{'جنيه'}}
                              </td>
                              <td> {{$purchase->seller->name}}</td>
                              <td> {{$purc->purchase->bill_id}}</td>
                              <td>{{ App\History::where(['product_id' => $purc->product->id, 'bill_id' => $purc->purchase->bill_id ])->select('order_status')->first()['order_status'] }}</td>
                              <!-- <td> {{$purc->purchase->purchase_status}}</td> -->
                              <td> {{$purc->purchase->created_at}}</td>
                            </tr>
                          @endforeach
                        @endforeach


                    </tbody>
                  </table>

                  </div>

                        </div>

                      </div>

                    </section>

                  @stop
