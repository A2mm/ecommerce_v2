@extends('owner_dashboard.master')

@section('body')

  <section class="content-header">
    <h1>
    {{__('translations.allcustomers_report')}}
    </h1>
  </section>

  <div class="product_movement" style="padding: 25px; border-radius: 25px; width: 600px;">

      <form class="form" method="get" action="{{route('manage.allcustomers.report')}}">

<div class="row">
<div class="col-md-4">
<div class="form-group">
              <label>{{ __('translations.from') }}</label>
                <input type="date" name="from" class="form-control" value="{{$from}}" style="border-radius: 15px;">
</div>
</div>

<div class="col-md-4">
<div class="form-group">
              <label>{{ __('translations.to') }}</label>
              <input type="date" name="to" class="form-control" value="{{$to}}" style="border-radius: 15px;">
</div>
</div>

<div class="col-md-4">
<div class="form-group"><br>
    <button type="submit" name="submit" class="btn btn-sm btn-primary" style="margin-top: 10px; border-radius: 15px; "> {{__('translations.search')}} <i class="fa fa-search"></i> </button>
</div>
</div>

</div>

       </form>

    <?php /*   <a href="{{ url('/excel/customer/reports?from=' . $from . '&to=' . $to)}}" class="btn btn-success">اكسل <i class="fa fa-file-excel-o" aria-hidden="true"></i></a> */ ?>

     

     <a style="height: 33px; margin-right:10px;" class="btn btn-sm btn-success" href="{{route('allCustomerss.excel', ['from' => $from, 'to' => $to]) }}">
   {{ __('translations.excel') }}
  <i class="fa fa-file-excel-o" aria-hidden="true"></i> </a>


    </div>

    <div class="text-center">
      <?php // ?>
<?php /*
<div class="count_client_orders" style="text-align: center; display:inline-block; width: 350px; height: 115px; background: green; border-radius: 15px; padding: 15px; margin-bottom: 10px;">
  <span style="font-size: 20px; color:black;">
  {{ __('translations.allstores_total') }}</span>
  <br>
  <span style="font-size: 35px; color:white; border-radius: 10px; padding: 15px;"> {{ round($count_price, 5) }} {{ __('translations.egp') }} </span>
</div>
*/ ?>
</div>

  <!-- Main content -->

  <section class="content">
    <div class="row">
      <div class="col-xs-12">
        <div class="box">
    <div class="box-header">
      <h3 class="box-title"></h3>
    </div><!-- /.box-header -->
  <table class="table table-bordered table-striped" style="text-align: center;">
    <thead>
      <tr class="success">
        <th style="text-align: center;">{{ __('translations.user_name') }}</th>
        <th style="text-align: center;">{{ __('translations.user_phone') }}</th>
        <th style="text-align: center;">{{ __('translations.usertype') }}</th>
        <th style="text-align: center;">{{ __('translations.total')}} </th>
        <th style="text-align: center;">{{ __('translations.sumWeight')}} </th>
      </tr>
    </thead>
    <tbody>
    @foreach($unique_users as $user)
            <tr>
              <td> {{  $user['user_name'] }}</td>
               <td>{{  $user['user_phone'] }}</td>
              <td> {{  $user['usertype'] }} </td>
              <td> 
          <?php //  {{  round($user['total'], 10) }}   ?>
          {{  round($user['total'], 10) + round($user['sum_purchases_shipments'], 10)}} 
          {{ __('translations.egp') }} 
              </td>
               <td> {{  $user['sumWeight'] }} {{ __('translations.gm')}} </td>
            </tr>
    @endforeach
    </tbody>
  </table>

              {!! $unique_users->appends(["from" => $from, "to" => $to])->render() !!}
             </div>
</div>
      </div>
    </div>
  </section>

@endsection
