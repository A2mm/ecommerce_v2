@extends('owner_dashboard.master')

@section('body')
<style type="text/css">
.zoom {
  transition: transform .2s; /* Animation */
}
.zoom:hover {
  transform: scale(1.5); /* (150% zoom - Note: if the zoom is too large, it will go outside of the viewport) */
}
</style>
  <section class="content-header">

    <h1>

    {{__('translations.stores_purchases')}}

    </h1>

  </section>

  <div class="product_movement" style="padding: 25px; border-radius: 25px; width: 600px;">

      <form class="form" method="get" action="{{route('manage.allstores.purchases')}}">


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
<a class="btn  btn-success" style="margin-right: 16px;" href="{{ route('excel.stores.purchases', ['from' => $from, 'to' => $to])}}">
{{ __('translations.excel') }}  <i class="fa fa-file-excel-o" aria-hidden="true"></i> </a>

</div>

       </form>
    </div>

    <section class="content-header">

<div class="row" >
        
        <div class="col-md-3 col-sm-6 col-xs-12 zoom">
          <div class="info-box" style="background: rgb(205, 205, 205);">
            <span class="info-box-icon bg-aqua"><i class="icon ion-android-playstore"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">   {{ __('translations.allstores_total') }}</span>
              <span><b> {{ round($count_price, 5) }} {{ __('translations.egp') }} </b> </span>
            </div>
          </div>
        </div>

      </div>
    </section>

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
        <th style="text-align: center;">{{__('translations.store_getname')}}</th>
        <th style="text-align: center;">{{__('translations.store_totalprice')}}</th>
      </tr>
    </thead>
    <tbody>
    @foreach($unique_stores as $store)
            <tr>
              <td> {{ $store['store_name'] }}</td>
              <td> {{ round($store['store_price'], 10) }} {{ __('translations.egp') }}</td>
            </tr>
    @endforeach
    </tbody>
  </table>

            <?php //  {!! $unique_stores->appends(["from" => $from, "to" => $to])->render() !!}  ?>
             </div>
</div>
      </div>
    </div>
  </section>



@endsection
