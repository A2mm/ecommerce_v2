@extends('owner_dashboard.master')

@section('body')

<section class="content-header">
  <h1>
    {{__('translations.orders_shiped')}}
  </h1>
</section>

<div class="product_movement" style="padding: 25px; border-radius: 25px; width: 600px;">

      <form class="form" method="get" action="{{route('manage.orders.shiped')}}"> 

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
<a style="height: 33px; margin-right:10px;" class="btn btn-sm btn-success" href="{{route('storesShipedOrders.excel', ['from' => $from, 'to' => $to]) }}">
   {{ __('translations.excel') }}
  <i class="fa fa-file-excel-o" aria-hidden="true"></i> </a>
     
     <?php $user = Auth::user(); ?> 

  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-xs-12">
        <div class="box">
          <div class="box-header">
          </div><!-- /.box-header -->
          <!-- Main content -->
          <table class="table table-bordered table-striped" id="shiporders">
            <thead>
              <tr>
                <th style="text-align: right;">{{__('translations.shiporder')}}</th>
                <th style="text-align: right;">{{__('translations.store_name')}}</th>
                <th style="text-align: right;">{{__('translations.product_name')}}</th>
                <th style="text-align: right;">{{__('translations.quantity')}}</th>
                <th style="text-align: right;">{{__('translations.reason')}}</th>
                <th style="text-align: right;">{{__('translations.created_at')}}</th>
                <th style="text-align: right;">{{__('translations.actions')}}</th>
              </tr>
            </thead>
            <tbody>
              @foreach($items as $movement)
              <tr>
                <td> {{$movement->shiporder_id}}</th>
                <td> {{$movement->store->name}}</th>
                <td> {{$movement->product->name}}</th>
                <td> {{abs($movement->quantity)}}</td>
                <td> @if($movement->reason == 'add')
                        {{__('translations.add') }}
                      @elseif($movement->reason == 'initial')
                        {{__('translations.add')}}
                      @elseif($movement->reason == __('translations.added'))
                        {{__('translations.add') }}
                        @elseif($movement->reason == 'بداية المدة')
                        {{__('translations.add') }}
                      @else
                        {{ $movement->reason }}
                        <?php // {{__('translations.subtract') }} ?>
                      @endif
                      </td>
                <td> {{$movement->created_at}}</td>
                <td> 

                  @if($user->can('edit shipedorders details') || $user->can('Administer'))
                    <a href="{{ route('edit.shipedorders.details', ['id' => $movement->id])}}" ><button class="btn btn-primary btn-sm"><i class="fa fa-edit" aria-hidden="true"></i> {{__('translations.edit')}} </button></a>
                  @endif 

                   @if($user->can('ship known order') || $user->can('Administer'))
                    <a href="{{ route('ship.known.order', ['id' => $movement->id])}}" ><button class="btn btn-success btn-sm"><i class="fa fa-plus" aria-hidden="true"></i> {{__('translations.add')}} </button></a>
                  @endif 

                </td>
              </tr>
              @endforeach
            </tbody>
          </table>

           {!! $items->appends(["from" => $from, "to" => $to])->render() !!}  

        </div>
      </div>
    </div>
  </section>
  @stop
