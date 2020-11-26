@extends('owner_dashboard.master')
@section('body')
<section class="content-header">
  <h1>
    {{'المعاملات المسلمة'}}

  </h1>
</section>
<?php $user = Auth::user(); ?>
<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-xs-12">
      <div class="box">
        <div class="box-header">
          <form method="GET" action="{{ route('delieverd.purchases') }}" accept-charset="UTF-8" class="form-inline my-2 my-lg-0 float-right" role="search">
              <div class="input-group">
                  <input type="text" class="form-control" name="search" placeholder="{{ __('translations.search') }}" value="{{ request('search') }}">
                  <span class="input-group-append">
                      <button class="btn btn-secondary" type="submit">
                          <i class="fa fa-search"></i>
                      </button>
                  </span>
              </div>
          </form>
        </div><!-- /.box-header -->
        <table class="table">
          <thead>
            <tr>
              <th>{{__('translations.user_name')}}</th>
              <th>{{__('translations.price')}}</th>
              <th>{{__('translations.status')}}</th>
              <th>{{__('translations.method')}}</th>
              <th>{{__('translations.bill_id')}}</th>
              <th>{{__('translations.created_at')}}</th>
              <th>{{__('translations.actions')}}</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($purchases as $purchase)
            <tr>
              @if($purchase->user_id!=null)
              <td>{{$purchase->user->name}}</td>
              @else
              <td>{{__('translations.store')}}</td>
              @endif
              <td>{{$purchase->price}}</td>
              <td>{{$purchase->purchase_status()}}</td>
              <td>{{$purchase->payment_method_name()}}</td>
              <td>{{$purchase->bill_id}}</td>
              <td>{{$purchase->created_at}}</td>
              <td>
                @if($user->can('view delivered order details') || $user->can('Administer'))
                  <a href="{{route('delivered.show.details',['id' => $purchase->id])}}" class="btn btn-xs btn-primary">{{__('translations.view')}}</a>
                @endif
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
        <div class="pagination-wrapper"> {!! $purchases->appends(['search' => Request::get('search')])->render() !!} </div>
      </div>
    </div>
  </div>
</section>
@stop
