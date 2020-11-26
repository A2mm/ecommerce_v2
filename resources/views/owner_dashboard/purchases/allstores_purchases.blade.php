@extends('owner_dashboard.master')

@section('body')

  <section class="content-header">

    <h1>

    {{__('translations.all_transactions')}}

    </h1>

  </section>

  <div class="product_movement" style="padding: 25px; border-radius: 25px; width: 600px;">
     
      <form class="form" method="get" action="{{route('manage.purchase.all.delivered')}}">
            
            
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
      <?php
         // 
      ?>

<div class="count_client_orders" style="text-align: center; display:inline-block; width: 350px; height: 115px; background: green; border-radius: 15px; padding: 15px; margin-bottom: 10px;"> 
  <span style="font-size: 20px; color:black;"> 
  {{ __('translations.count_checkout') }}</span>
  <br>
  <span style="font-size: 35px; color:white; border-radius: 10px; padding: 15px;"> {{ round($count_price, 5) }} {{ __('translations.egp') }} </span>
</div>

<div class="count_client_orders" style="text-align: center; display:inline-block; width: 350px; height: 115px; background: green; border-radius: 15px; padding: 15px; margin-bottom: 10px;">  
  <span style="font-size: 20px; color:black;"> 
  {{ __('translations.count_checkout_mono') }}</span>
  <br>
  <span style="font-size: 35px; color:white; border-radius: 10px; padding: 15px;"> {{ round($mono_price, 5) }} {{ __('translations.egp') }} </span>
</div>

<div class="count_client_checkout" style="text-align: center; display:inline-block; width: 240px; height: 115px; background: skyblue; border-radius: 15px; padding: 15px; margin-bottom: 10px;"> 
   <span style="font-size: 20px; color:black;">
         {{ __('translations.count_products') }}
 </span>
  <br> 
  <span style="font-size: 35px; color:white; border-radius: 10px; padding: 15px;">
  {{ $count_proddds }}  
</span>
</div>

<div class="count_client_checkout" style="text-align: center; display:inline-block; width: 240px; height: 115px; background: skyblue; border-radius: 15px; padding: 15px; margin-bottom: 10px;"> 
   <span style="font-size: 20px; color:black;">{{ __('translations.count_orders_purchased') }}</span>
  <br> 
  <span style="font-size: 35px; color:white; border-radius: 10px; padding: 15px;"> 
   {{ $count_orders_purchased }}   
   
  </span>
</div>

<div class="count_client_checkout" style="text-align: center; display:inline-block; width: 200px; height: 115px; background: orange; border-radius: 15px; padding: 15px; margin-bottom: 10px;"> 
   <span style="font-size: 20px; color:black;">{{ __('translations.count_orders_refunded') }}</span>
  <br> 
  <span style="font-size: 35px; color:white; border-radius: 10px; padding: 15px;"> 
   {{ $count_orders_refunded }}  
   
  </span>
</div>

<div class="count_client_checkout" style="text-align: center; display:inline-block; width: 200px; height: 115px; background: orange; border-radius: 15px; padding: 15px; margin-bottom: 10px;"> 
   <span style="font-size: 20px; color:black;">{{ __('translations.count_bills') }}</span>
  <br> 
  <span style="font-size: 35px; color:white; border-radius: 10px; padding: 15px;"> 
   {{ $bills }}  
   
  </span>
</div>

</div>

  <!-- Main content -->

  <section class="content">

    <div class="row">

      <div class="col-xs-12">

        <div class="box">

    <div class="box-header">

      <h3 class="box-title"></h3>

    </div><!-- /.box-header -->

  <table class="table table-bordered table-striped">
    <thead>
      <tr class="success">
        
        <th>{{__('translations.store_name')}}</th>
        <th>{{__('translations.client_name')}}</th>
        <th>{{__('translations.seller_name')}}</th>
        <th>{{__('translations.product_name')}}</th>
        <th>{{__('translations.unique_id')}}</th>
        <th>{{__('translations.quantity')}}</th>
        <th>{{__('translations.price')}}</th>
        <!-- <th>{{__('translations.status')}}</th> -->
        <th>{{__('translations.method')}}</th>
        <th>{{__('translations.bill_id')}}</th>
        <th>{{__('translations.status')}}</th>
        <th>{{__('translations.created_at')}}</th>
        <!-- <th>{{__('translations.actions')}}</th> -->

      </tr>
    </thead>
    <tbody>
    @foreach($purchases as $purchase)
    <?php /*
            <tr>
              {{-- <td>{{$purchase->purchaser}}</td> --}}
              @if(!empty($purchase->user_id))
              <td>{{ $purchase->user->name }}</td>
              @else
              <td>{{__('translations.unregistered_client')}}</td>
              @endif
              <!-- @if(!empty($purchase->user_id))
              <td>{{ '' }}</td>
              @else
              <td>{{__('translations.store')}}</td>
              @endif -->
              <td>{{$purchase->seller->name}}</td>
              <td>{{$purchase->store->name}}</td>
              <td>{{App\History::where('bill_id' => $purchase->bill_id, '' => )->first()['']}}</td>
              <td>{{$purchase->store->name}}</td>
              <td>{{$purchase->price}}</td>
              <!-- <td>{{$purchase->purchase_status}}</td> -->
              <td>دفع نقدى بالمحل</td>
              <td>{{$purchase->bill_id}}</td>
              <td>{{$purchase->created_at}}</td>
              <td>
              <!-- <a href="{{route('manage.purchase.edit',['id' => $purchase->id])}}" class="btn btn-xs btn-primary">{{__('translations.edit_status')}}</a> -->
              <!-- <a data-href="{{route('manage.purchase.delete',['id' => $purchase->id])}}" class="delete btn btn-xs btn-danger">{{__('translations.delete')}}</a> -->
              <!-- <a href="{{route('manage.purchase.details',['id' => $purchase->id])}}" class="btn btn-xs btn-primary">{{__('translations.view')}}</a> -->
              </td>
            </tr>
            */
            ?>
            @foreach($purchase->histories as $history)
            <tr>
              <td>{{$purchase->store->name}}</td>
              @if(!empty($purchase->user_id))
              <td>{{ $purchase->user->name }}<br>
                ( {{$purchase->user->usertype->name}} )
              </td>
              @else
              <td>{{__('translations.unregistered_client')}}</td>
              @endif
              <td>{{$purchase->seller->name}}</td>
              <td>{{ $history->product->name }}</td>
               <td>{{ $history->product->unique_id }}</td>
              <td>{{$history->quantity}}
                <?php
                /*
              @if($history->refunded != 0)
              <br>
              <span style="color:red;">{{ $history->refunded }} {{ __('translations.refunded_from') }} {{ $history->quantity + $history->refunded }} </span>
              @endif
              */
              ?>
            </td>
              <td>
                {{$history->price }}
               <?php /* @if($history->sellerdiscount > 0)
                  {{ $history->price -($history->price * $history->sellerdiscount / 100) }}
                @else
                {{$history->price }}
                @endif*/?>
                 {{__('translations.egp')}}</td>
              <!-- <td>{{$purchase->purchase_status}}</td> -->
              <td>دفع نقدى بالمحل</td>
              <td>{{$purchase->bill_id}}</td>
              <td>{{$history->order_status }}</td>
              <td>{{$purchase->created_at}}</td>
            </tr>
    @endforeach
    @endforeach
    </tbody>
  </table>
             
              {!! $purchases->appends(["from" => $from, "to" => $to])->render() !!} 
             </div>
</div>
      </div>
    </div>
  </section>

@endsection

@section('scripts')

<script type="text/javascript">
  $(document).ready(function()
    {
      $('#submit').on('click', function(e)
        {
          e.preventDefault();
          alert('one');
        });
    });
</script>
@endsection