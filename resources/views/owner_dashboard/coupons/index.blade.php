@extends('owner_dashboard.master')
@section('body')
<section class="content-header">
  <h1>
    {{trans('layout.coupons')}}
  </h1>
</section>
<?php $user = Auth::user(); ?>

<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-xs-12">
      <div class="box">
        <div class="box-header">
          <h3 class="box-title"></h3>
        </div><!-- /.box-header -->
        <table class="table table-bordered table-striped" id="coupons">
          <thead>
            <tr>
              <th style="text-align: right;">{{trans('layout.Code')}}</th>
              <th style="text-align: right;">{{trans('layout.Type')}}</th>
              <th style="text-align: right;">{{trans('layout.expiry_date')}}</th>
              <th style="text-align: right;">{{trans('layout.Actions')}}</th>
            </tr>
          </thead>
          <tbody>
            @foreach($coupons as $coupon)
            <tr>
              <td>{{$coupon->code}}</td>
              <td>{{__('translations.'.$coupon->type)}}</td>
              <td>{{$coupon->expiry_date}}</td>
              <td>
                @if($user->can('show coupon') || $user->can('Administer'))
                  <a href="{{route('coupon.show',['id' => $coupon->id])}}" class="btn btn-xs btn-primary">{{__('translations.view')}}</a>
                @endif
                @if($user->can('edit coupon') || $user->can('Administer'))
                  @if(!$coupon->IsExpire())
                    <a href="{{route('coupon.edit',['id' => $coupon->id])}}" class="btn btn-xs btn-primary">{{__('translations.edit')}}</a>
                  @endif
                @endif   
                 
                @if($user->can('delete coupon') || $user->can('Administer'))
                  <form method="POST" action="{{ route('coupon.destroy' , ['id' => $coupon->id]) }}" accept-charset="UTF-8" style="display:inline">
                      {{ method_field('DELETE') }}
                      {{ csrf_field() }}
                      <button type="submit" class="btn btn-danger btn-xs" title="{{ __('translations.delete') }}" onclick="return confirm(&quot;{{'تأكيد الحذف'}}&quot;)"> {{ __('translations.delete') }}</button>
                  </form>
                  @endif
                  
                  {{-- <a href="{{route('manage.coupon.delete',['id' => $coupon->id])}}" data-href="{{route('manage.coupon.delete',['id' => $coupon->id])}}" class="btn btn-xs btn-danger delete">{{__('translations.delete')}}</a> --}}
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
