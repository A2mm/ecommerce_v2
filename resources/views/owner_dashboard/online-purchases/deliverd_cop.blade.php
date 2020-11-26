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
              <div class="form-group">
                  <input type="text" class="form-control" name="search" placeholder="{{ __('translations.search') }}" value="{{ request('search') }}">
                </div>

                 <div class="form-group">
                     <button class="btn btn-primary" type="submit">
                          <i class="fa fa-search"></i>
                      </button>
                </div>
          </form>
        </div><!-- /.box-header --><br>
        <table class="table">
          <thead>
            <tr class="success">
              <th style="text-align: right;">{{__('translations.user_name')}}</th>
              <th style="text-align: right;">{{__('translations.price')}}</th>
              <th style="text-align: right;">{{__('translations.status')}}</th>
              <th style="text-align: right;">{{__('translations.method')}}</th>
              <th style="text-align: right;">{{__('translations.bill_id')}}</th>
              <th style="text-align: right;">{{__('translations.created_at')}}</th>
              <th style="text-align: right;">{{__('translations.actions')}}</th>
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
              <td>
                @if($purchase->purchase_status == 'partially delivered')
                {{ __('translations.partially_delivered') }}
                @elseif($purchase->purchase_status == 'total delivered')
                {{ __('translations.total_delivered') }}
                @else
                {{ $purchase->purchase_status }}
                @endif
              </td>
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
