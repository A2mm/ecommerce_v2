@extends('owner_dashboard.master')

@section('body')
  {{-- {{ dd('jhfjdfjdjf')}} --}}

  <section class="content-header">
    <h1>
    {{__('translations.allsellers_bykilo_report')}}
    </h1>
  </section>
  <div class="product_movement" style="padding: 25px; border-radius: 25px; width: 600px;">

      <form class="form" method="get" action="{{route('manage.allsellers.kilo.report')}}">

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
<a class="btn  btn-success" style="margin: -10px 20px 10px 0;" href="{{ route('allSellersKilo.excel', ['from' => $from, 'to' => $to])}}">
 {{ __('translations.excel') }}
  <i class="fa fa-file-excel-o" aria-hidden="true"></i> </a>

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
        <th style="text-align: center;">{{ __('translations.seller_name') }}</th>
        <th style="text-align: center;">{{ __('translations.store_name') }}</th>
        <th style="text-align: center;">{{ __('translations.totalsold_bykilo') }}</th>

        <th style="text-align: center;">{{ __('translations.mono')}} {{ $category1->name }}</th>
        <th style="text-align: center;">{{ __('translations.total')}} {{ $category1->name }}</th>

        <th style="text-align: center;">{{ __('translations.mono')}} {{ $category2->name }}</th>
        <th style="text-align: center;">{{ __('translations.total')}} {{ $category2->name }}</th>

        <th style="text-align: center;">{{ __('translations.mono')}} {{ $category3->name }}</th>
        <th style="text-align: center;">{{ __('translations.total')}} {{ $category3->name }}</th>
      </tr>
    </thead>
    <tbody>
    @foreach($unique_sellers as $seller)
    <?php  
    $wholesale_price  = 0;
    $totalsold_bykilo = 0;
    $cat1_mono        = 0;
    $cat2_mono        = 0;
    $cat3_mono        = 0;
    $cat1_wholesale   = 0;
    $cat2_wholesale   = 0;
    $cat3_wholesale   = 0;
    $qty = 0;
    $date_from        = $from.' 00:00:00';
    $date_to          = $to.' 23:59:59';
    $this_seller      = App\Seller::where('id', $seller['seller_id'])->first(); 
    $this_store       = App\Store::where('id', $seller['store_id'])->first();
    $soldprods    = App\History::where('seller_id', $seller['seller_id'])
                                  ->where('store_id', $seller['store_id'])
                                   ->where('order_status', '!=', 'pending')
                          ->where('order_status', '!=', 'in progress')
                          ->where('order_status', '!=', 'canceled')
                           ->where('order_status', '!=', 'delivered')
                                  ->where('created_at', '>=', $date_from)
                                  ->where('created_at', '<=', $date_to)
                                  ->get();
      
            foreach($soldprods as $prod)
            {
                    $product = App\Product::where('id', $prod->product_id)->first();
                    $qty += $product->weight * $prod->quantity;
                    if($prod->user_id == null || $prod->user_id == 0)
                    {
                          if ($prod->product->subcategory->category_id == 1)
                          {
                              $cat1_mono += $prod->product->weight * $prod->quantity;
                          }
                          elseif($prod->product->subcategory->category_id == 2) {
                              $cat2_mono += $prod->product->weight * $prod->quantity;
                          }
                          else{
                              $cat3_mono += $prod->product->weight * $prod->quantity;
                          }
                    }
                    else
                    {
                      $thisuser_id = $prod->user_id;
                      $this_user = App\User::select('id', 'name', 'phone', 'usertype_id')->where('id', $thisuser_id)->first();
                      if ($this_user->usertype_id == 1)
                      {
                           if ($prod->product->subcategory->category_id == 1)
                          {
                              $cat1_mono += $prod->product->weight * $prod->quantity;
                          }
                          elseif($prod->product->subcategory->category_id == 2) {
                              $cat2_mono += $prod->product->weight * $prod->quantity;
                          }
                          else{
                              $cat3_mono += $prod->product->weight * $prod->quantity;
                          }
                      }
                      else
                      {
                           if ($prod->product->subcategory->category_id == 1)
                          {
                              $cat1_wholesale += $prod->product->weight * $prod->quantity;
                          }
                          elseif($prod->product->subcategory->category_id == 2) {
                              $cat2_wholesale += $prod->product->weight * $prod->quantity;
                          }
                          else{
                              $cat3_wholesale += $prod->product->weight * $prod->quantity;
                          }
                      }
                    }
           }
    ?>
            <tr>
              <td> {{ $this_seller->name }}</td>
              <td> {{ $this_store->name }}</td>

              <td> {{  $qty }} {{ __('translations.gm') }} </td>

              <td> {{  $cat1_mono }}  {{ __('translations.gm') }} </td>
              <td> {{  $cat1_wholesale }}  {{ __('translations.gm') }} </td>

              <td> {{  $cat2_mono }}  {{ __('translations.gm') }} </td>
              <td> {{  $cat2_wholesale }}  {{ __('translations.gm') }} </td>

              <td> {{  $cat3_mono }}  {{ __('translations.gm') }} </td>
              <td> {{  $cat3_wholesale }}  {{ __('translations.gm') }} </td>

            </tr>
    @endforeach
    </tbody>
  </table>

              {!! $unique_sellers->appends(["from" => $from, "to" => $to])->render() !!}
             </div>
</div>
      </div>
    </div>
  </section>

@endsection
