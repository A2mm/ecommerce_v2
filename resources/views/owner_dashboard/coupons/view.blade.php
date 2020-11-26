@extends('owner_dashboard.master')

@section('body')

<section class="content-header">
  <h1>
    {{__('translations.copoun')}}
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


        <table class="table table-bordered table-striped text-center">
          <thead>
            <tr>
              <th>{{__('translations.code')}}</th>
              <th>{{$coupon->code}}</th>
            </tr>
            <tr>
              <th>{{__('translations.type')}}</th>
              <th>{{__('translations.'.$coupon->type)}}</th>
            </tr>
            <tr>
              <th>{{__('translations.expire_date')}}</th>
              <th>{{$coupon->expiry_date}}</th>
            </tr>
            @if($coupon->type==='flat_rate')
              <tr>
                <th>{{__('translations.restrict_price')}}</th>
                <th>{{$coupon->restrict_price}}</th>
              </tr>
              <tr>
                <th>{{__('translations.flat_rate')}}</th>
                <th>{{$coupon->flat_rate}}</th>
              </tr>
              @endif
              @if($coupon->type==='total_price')
                <tr>
                  <th>{{__('translations.discount_on_total_price')}}</th>
                  <th>{{$coupon->discount}} %</th>
                </tr>
                @endif
                @if($coupon->type==='product_discount')
                  <tr>
                    <th>{{__('translations.discount_on_product')}}</th>
                    <th>{{$coupon->discount}} %</th>
                  </tr>
                  <tr>
                    <th>{{__('translations.product_code')}}</th>
                    <th>{{$coupon->product->unique_id}}</th>
                  </tr>
                  <tr>
                    <th>{{__('translations.product_name')}}</th>
                    <th>{{$coupon->product->name}}</th>
                  </tr>
                  @endif
          </thead>
          <tbody>
          </tbody>
        </table>

      </div>
    </div>
  </div>
</section>

@stop
