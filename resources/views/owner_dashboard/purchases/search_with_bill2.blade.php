@extends('owner_dashboard.master')

@section('body')

  <section class="content-header">

<div style="color:red;" id="billerror"> </div>
    <h1>
    {{__('translations.search_with_bill')}}
    </h1>
  </section>


  <div class="product_movement" style="padding: 25px; border-radius: 25px; width: 600px;">

      <form class="form" method="get" action="{{route('manage.search.bill')}}">

            <div class="form-group">
                        <label for="name">* {{__('translations.bill_id')}}</label>
                        <input style="width: 400px;" class="form-control" id="name" type="number" name="bill_id" value="{{$bill_id}}">
            </div>

                    <div class="form-group">
                      <button id="submit" type="submit" class="btn btn-primary">{{__('translations.search')}}</button>
                    </div>

       </form>
    </div>

  <section class="content">


@if(count($histories) <= 0)
@if($bill_id != 'not')
<?php /*
<div class="text-center" style="color:red; padding-bottom : 45px;"> {{ __('translations.make_sure_about_bill_id') }} {{ $bill_id }}</div>
*/ ?>
<script type="text/javascript">
  var html = '<div class="alert alert-danger"><ul><li style="text-align: center;list-style: none;"> {{ __("translations.make_sure_about_bill_id") }}</li></ul></div>';
  document.getElementById('billerror').innerHTML = html;
</script>
@endif
@else
 <div class="row">
      <div class="col-xs-12">
        <div class="box">
    <div class="box-header">
      <h3 class="box-title"></h3>
    </div><!-- /.box-header -->


<div class="text-center">
<div class="count_client" style="text-align: center; display:inline-block; width: 800px; height: 100px; background: rgb(128, 128, 0); border-radius: 15px; padding: 15px; margin-bottom: 21px;">
   <span style="font-size: 20px; color:black;">{{ __('translations.bill_totalprice') }}</span>
   <br>
  <span style="font-size: 35px; color:white; border-radius: 10px; padding: 25px;">
   {{ round($bill_total, 10) }} {{ __('translations.egp') }}

  </span>
</div>
</div>

  <table class="table table-bordered table-striped">
    <thead>
      <tr class="success">
        <th style="text-align: right;">{{__('translations.product_name')}}</th>
        <th style="text-align: right;">{{__('translations.unique_id')}}</th>
        <th style="text-align: right;">{{__('translations.client_name')}}</th>
        <th style="text-align: right;">{{__('translations.store_name')}}</th>
        <th style="text-align: right;">{{__('translations.seller_name')}}</th>
        <th style="text-align: right;">{{__('translations.quantity')}}</th>
        <th style="text-align: right;">{{__('translations.price')}}</th>
        <th style="text-align: right;">{{__('translations.bill_id')}}</th>
        <th style="text-align: right;">{{__('translations.status')}}</th>
        <th style="text-align: right;">{{__('translations.created_at')}}</th>
      </tr>

    </thead>

    <tbody>
      <tr>
    @foreach($histories as $item)
      <?php //@foreach($history as $item)?>
      <td>{{ $item->product->name}}</td>
      <td>{{ $item->product->unique_id}}</td>
      <td>
        @if(!empty($item->user->name))
        {{$item->user->name}} <br>
        ( {{$item->user->usertype->name}} )
        @else
        {{ __('translations.unregistered_client')}}
        @endif
      </td>
      <td>{{ $item->store->name ?? __('translations.online') }}</td>
      <td>{{ $item->seller->name ?? __('translations.online') }}</td>
      <td>{{ $item->quantity }}

      </td>
      <td> {{ $item->price }} {{ __('translations.egp') }}
      <td> {{ $item->bill_id }}</td>
      <td>
          @if($item->order_status == 'pending')
               {{ __('translations.pending') }}
          @elseif($item->order_status == 'canceled')
               {{ __('translations.canceled') }}
          @elseif($item->order_status == 'in progress')
               {{ __('translations.in progress') }}
          @elseif($item->order_status == 'delivered')
               {{ __('translations.delivered') }}
          @else
                {{ $item->order_status }}
          @endif            
             </td>
      <td> {{$item->created_at}}</td>

      </tr>
      @endforeach

    </tbody>
  </table>
 @endif


</div>
      </div>
    </div>
  </section>
@endsection
