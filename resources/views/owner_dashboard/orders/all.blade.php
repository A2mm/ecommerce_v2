@extends('owner_dashboard.master')

@section('body')

  <section class="content-header">

    <h1>

      {{__('translations.all_orders')}}

    </h1>

  </section>



  <!-- Main content -->

  <section class="content">

    <div class="row">

      <div class="col-xs-12">

        <div class="box">

    <div class="box-header">

      <h3 class="box-title"></h3>

    </div><!-- /.box-header -->

    <table class="table table-bordered table-striped" id="orders">
    <thead>
      <tr>
        <th>{{__('translations.customer')}}</th>
        <th>{{__('translations.product')}}</th>
        <th>{{__('translations.code')}}</th>
        <th>{{__('translations.quantity')}}</th>
        <th>{{__('translations.price')}}</th>
        <th>{{__('translations.created_at')}}</th>
        <th>{{__('translations.send_mail')}}</th>
      </tr>
    </thead>
    <tbody>
      @foreach($orders as $order)
            <tr>
            @if($order->user_id!=null)
              <td>{{$order->user->name}}</td>
            @else
              <td>{{__('translations.store')}}</td>
            @endif
              <td>{{$order['product']['name']}}</td>
              <td>{{$order['product']['unique_id']}}</td>
              <td>{{$order->quantity}}</td>
              <td>{{$order->price}}</td>
              <td>{{$order->created_at}}</td>
              <td>
              @if($order->user->email&&$order->user->email!='')
              <a href="{{route('manage.orders.sendMail',['id' => $order->user->id])}}" class="btn btn-xs btn-primary">{{__('translations.send_email')}}</a>
              @endif
              </td>
            </tr>
            @endforeach
    </tbody>
  </table>

</div>

      </div>

    </div>

  </section>

@stop
