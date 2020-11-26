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

    {{__('translations.stores_transfers')}}

    </h1>
  </section>

  <div class="product_movement" style="padding: 25px; border-radius: 25px; width: 600px;">

      <form class="form" method="get" action="{{route('manage.allstores.transfers')}}">


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
<a style="height: 33px; margin-right:10px;" class="btn btn-sm btn-success" href="{{route('storesTransfers.excel', ['from' => $from, 'to' => $to]) }}">
   {{ __('translations.excel') }}
  <i class="fa fa-file-excel-o" aria-hidden="true"></i> </a>

  <!-- Main content --> 
              <?php $user = Auth::user(); ?> 

  <section class="content">

    <div class="row">

      <div class="col-xs-12">

        <div class="box">

    <div class="box-header">


    </div><!-- /.box-header -->
  <!-- Main content -->
                  <table class="table table-bordered table-striped">
                    <thead>
                      <tr class="success">
                        <th style="text-align: right;">{{__('translations.transfer_from_store')}}</th> 
                        <th style="text-align: right;">{{__('translations.transfer_to_store')}}</th>
                        <th style="text-align: right;">{{__('translations.product_name')}}</th>
                        <th style="text-align: right;">{{__('translations.unique_id')}}</th>
                        <th style="text-align: right;">{{__('translations.quantity')}}</th>
                        <th style="text-align: right;">{{__('translations.reason')}}</th>
                        <th style="text-align: right;">{{__('translations.transfer_number')}}</th>
                        <th style="text-align: right;">{{__('translations.created_at')}}</th>
                        <th style="text-align: right;">{{__('translations.actions')}}</th>

                      </tr>
                    </thead>
                    <tbody>
                      @foreach($storesTransfers as $history)
                      <tr>
                      <td>
                      <?php $from_store = App\Store::where('id', $history->from_store)->select('name')->first(); ?>
                        {{ $from_store->name }}
                      </td>
                      <td>  
                      <?php $to_store = App\Store::where('id', $history->to_store)->select('name')->first(); ?> 
                      {{ $to_store->name }}
                      </td>
                      <td>{{ $history->product->name }}</td>
                      <td>{{ $history->product->unique_id }}</td>
                      <td>{{ abs($history->quantity) }} </td>
                      <td>{{ $history->reason }} </td>
                      <td>{{ $history->transfer_id }}</td>
                      <td>{{ $history->created_at }}</td>
                      <td>
                          @if($user->can('edit transfers details') || $user->can('Administer'))
                           <a href="{{ route('edit.transfers.details', ['id' => $history->id])}}" ><button class="btn btn-primary btn-sm"><i class="fa fa-edit" aria-hidden="true"></i> {{__('translations.edit')}} </button></a>
                          @endif 

                  @if($user->can('add new stock transfer') || $user->can('Administer'))
                    <a href="{{ route('stock.add.transfer', ['id' => $history->id])}}" ><button class="btn btn-success btn-sm"><i class="fa fa-plus" aria-hidden="true"></i> {{__('translations.add')}} </button></a>
                  @endif 

                      </td>
                      </tr>
                      @endforeach
                    </tbody>
                  </table>


             {!! $storesTransfers->appends(["from" => $from, "to" => $to])->render() !!} 
                  </div>

                        </div>

                      </div>

                    </section>

                  @stop
