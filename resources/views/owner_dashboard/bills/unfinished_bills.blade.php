@extends('owner_dashboard.master')

@section('body')

  <section class="content-header">

    <h1>

    {{__('translations.all_unfinished_bills')}}

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
        <th>{{__('translations.product_name')}}</th>
        <th>{{__('translations.quantity')}}</th>
        <th>{{__('translations.remaining')}}</th>
        <th>{{__('translations.reason')}}</th>
        <th>{{__('translations.created_at')}}</th>
        <th>{{__('translations.actions')}}</th>

      </tr>
    </thead>
    <tbody>
    @foreach($bills as $bill)
            <tr>
              <td>{{$bill->product->name}}</td>
              <td>{{ abs($bill->quantity) }}</td>
              <td>{{$bill->remaining}}</td>
              <td>{{$bill->reason}}</td>
              <td>{{$bill->created_at}}</td>
              <td>
                <a href="{{route('manage.purchase.bill.settle',['id' => $bill->id])}}" class="btn btn-xs btn-primary">{{__('translations.settle')}}</a>
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
