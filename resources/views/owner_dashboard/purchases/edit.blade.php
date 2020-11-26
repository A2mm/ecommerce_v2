@extends('owner_dashboard.master')
@section('body')
  <section class="content-header">
    <h1>
      {{__('translations.edit_purchase')}}
    </h1>
  </section>
  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-xs-12">
        <div class="box box-primary"> 

            <?php // added comment edit status of purchase  ?>

                  <!-- form start -->
                  {!! Form::model($purchase, ['route' => ['manage.purchase.edit.post', $purchase->id, 'files' => true]]) !!}
                    {{ csrf_field() }}
                    <div class="box-body">
                      <div class="form-group">
                        <h3 for="name">{{__('translations.purchase_requirements')}}</h3>
                        <br>
                        @foreach($orders as $order)
                          <div class="form-group">
                            <label class="form-contol">{{ $order->product->name }}</label>
                            <span class="label label-success"> {{ 'الكمية المطلوبة' }} {{ $order->quantity }}  </span>
                            <br>
                            @foreach($order->product->stores as $store)
                              @if($order->product->quantity_in_store($store->id) > 0)
                            <span class="badge badge-secondary"> {{ $store->name }} {{__('translations.has')}} {{ $order->product->quantity_in_store($store->id) }} </span>
                            <input type="number" min="0" max="{{ $order->product->quantity_in_store($store->id) }}" name="product_store_quantity[{{$order->id}}][{{$store->id}}]" value="0">
                            <br>
                            @endif
                            @endforeach
                          </div>
                        @endforeach
                      </div>
                    </div><!-- /.box-body -->
                    <div class="box-footer">
                      <button type="submit" class="btn btn-primary">{{__('translations.submit')}}</button>
                    </div>
                  {!! Form::close() !!}
                </div>
      </div>
    </div>
  </section>
@stop
