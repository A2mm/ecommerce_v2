@extends('owner_dashboard.master')

@section('body')

<section class="content-header">

  <h1>

    {{ 'تفاصيل المعاملات ' }}

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

        <table class="table table-bordered table-striped">
          <thead>
            <tr>
              <th>{{__('translations.username')}}</th>
              <th>
                @if(!empty($purchase['user_id']))
                {{ $purchase->user->name }}
                @else
                {{ __('translations.unregistered_client') }}
                @endif
              </th>
            </tr>
            <tr>
              <th>{{__('translations.email')}}</th>
              <th>
                @if (!empty($purchase['user_id']))
                {{ $purchase->user->email }}
                @else
                {{ __('translations.unregistered_client') }}
                @endif
              </th>
            </tr>
            <tr>
              <th>{{'منطقة'}}</th>
              <th>{{$purchase->delivery_address}}</th>
            </tr>
            <tr>
              <th>{{'العنوان'}}</th>
              <th>{{$purchase->billing_address}}</th>
            </tr>
            <tr>
              <th>{{'رقم تليفون المستقبل'}}</th>
              <th>{{$purchase->receptor_mobile}}</th>
            </tr>
            <tr>
              <th>{{'رقم تليفون المشتري'}}</th>
              <th>{{$purchase->buyer_mobile}}</th>
            </tr>
            <tr>
              <th>{{__('translations.receptor_name')}}</th>
              <th>{{$purchase->receptor_name}}</th>
            </tr>
            <tr>
              <th>{{__('translations.price')}}</th>
              <th><?php echo doubleval($purchase->price) . 'جنيه'  . ' (' . $shipmentPrice . ' شحن)'; ?></th>
            </tr>
            <tr>
              <th>{{__('translations.payment_method')}}</th>
              <th>{{$purchase->payment_method_name()}}</th>
            </tr>
            <tr>
              <th>{{__('translations.status')}}</th>
              <th>{{$purchase->purchase_status()}}</th>
            </tr>
            <tr>
              <th>{{__('translations.bill_id')}}</th>
              <th>{{$purchase->bill_id}}</th>
            </tr>
            <tr>
              <th>{{__('translations.created_at')}}</th>
              <th>{{$purchase->created_at}}</th>
            </tr>
            <tr>
              <th> {{ 'استخدام كود خصم' }}</th>
              <th> {{ $purchase->use_promo ? $purchase->use_promo : 'لا' }}</th>
            </tr>

          </thead>
          <tbody></tbody>
        </table>

        <table class="table table-bordered table-striped">
          <tr>
            <th>{{__('translations.product_name')}}</th>
            <th>{{__('translations.code')}}</th>
            <th>{{__('translations.quantity')}}</th>
            <th>{{__('translations.price')}}</th>
          </tr>
          @foreach($purchase_histories as $history)
          @if($history->store_id == null)
            <tr>
              <th> {{$history->product->name}}</th>
              <th> {{$history->product->unique_id}}</th>


              <th> {{$history->quantity}}</th>


              <th>
                {{ doubleval($history->price)  }}
                جنيه
              </th>

            </tr>
            @endif
            @endforeach
        </table>

      </div>
    </div>
  </div>
</section>

@stop
