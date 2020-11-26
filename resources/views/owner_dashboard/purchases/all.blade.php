@extends('owner_dashboard.master')

@section('body')

  <section class="content-header">

    <h1>

    {{__('translations.all_transactions')}}

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

  <table class="table table-bordered table-striped" id="purchases">
    <thead>
      <tr>
        <th>{{__('translations.username')}}</th>
        <th>{{__('translations.price')}}</th>
        <!-- <th>{{__('translations.status')}}</th> -->
        <th>{{__('translations.method')}}</th>
        <th>{{__('translations.bill_id')}}</th>
        <th>{{__('translations.created_at')}}</th>
        <th>{{__('translations.actions')}}</th>

      </tr>
    </thead>
    <tbody>
    @foreach($purchases as $purchase)
            <tr>
              @if($purchase->user_id!=null)
              <td>{{$purchase->user->name}}</td>
              @else
              <td>{{__('translations.store')}}</td>
              @endif
              <td>{{$purchase->price}}</td>
              <!-- <td>{{$purchase->purchase_status}}</td> -->
              <td><?php //{{$purchase->payment_method->name}} ?> نقدي بالمحل</td>
              <td>{{$purchase->bill_id}}</td>
              <td>{{$purchase->created_at}}</td>
              <td>
              <a href="{{route('manage.purchase.edit',['id' => $purchase->id])}}" class="btn btn-xs btn-primary">{{__('translations.edit_status')}}</a>
              <a data-href="{{route('manage.purchase.delete',['id' => $purchase->id])}}" class="delete btn btn-xs btn-danger">{{__('translations.delete')}}</a>
              <a href="{{route('manage.purchase.details',['id' => $purchase->id])}}" class="btn btn-xs btn-primary">{{__('translations.view')}}</a>
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
