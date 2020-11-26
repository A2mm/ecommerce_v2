@extends('owner_dashboard.master')

@section('body')

<section class="content-header">

  <h1>

    {{ 'تفاصيل المعاملات ' }}

    <?php $user = Auth::user(); ?>

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
              <th> 
                @if($purchase->purchase_status == 'partially delivered')
                {{ __('translations.partially_delivered') }}
                @elseif($purchase->purchase_status == 'total delivered')
                {{ __('translations.total_delivered') }}
                @else
                {{ $purchase->purchase_status }}
                @endif
              </th>
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
             <th>{{__('translations.status')}}</th>
            <th>{{__('translations.price')}}</th>
             <th>{{__('translations.stores')}}</th>
          </tr>
          <?php $unique = array(); ?> 
          @foreach($purchase_histories as $history)
            <?php 
            if (in_array($history->product_id, $unique)) {
              continue; 
            }
             else
             {
              ?>

            <tr>
              <th> {{$history->product->name}}</th>
              <th> {{$history->product->unique_id}}</th>
              <th>
                <?php $qtyy= App\History::where('product_id', $history->product_id)
                                        ->where('purchase_id', $purchase->id)
                                        ->sum('quantity');
                ?>

              {{ $qtyy }}</th>
               <th> 
<?php 
$stat = '';
                $purchase_original = App\History::where('purchase_id', $purchase->id)
                                             ->where('product_id', $history->product_id)
                                             ->where('order_status', '!=', 'delivered')
                                             ->sum('original');

                 $purchase_delivered = App\History::where('purchase_id', $purchase->id)
                                             ->where('product_id', $history->product_id)
                                             ->where('order_status', 'delivered')
                                             ->sum('quantity');
                 
                  if ($purchase_original <= 0) {
                    $stat =  __('translations.total_delivered');
                  }

                  if ($purchase_original == $purchase_delivered) {
                    $stat =  __('translations.total_delivered');
                  }

                   if ($purchase_original > $purchase_delivered) 
                   {
                      if ($purchase_delivered > 0) {
                        $stat = __('translations.partially_delivered');
                      }
                      else{
                       $stat = __('translations.in_progress');
                      }
                  }
?>
                  {{ $stat }}
                </th>
              <th>
                 <?php $pricee = App\History::where('product_id', $history->product_id)
                                        ->where('purchase_id', $purchase->id)
                                        ->sum('price');
                ?>
                {{ doubleval($pricee)  }}
                جنيه
              </th>

               <th>
               
                 @if($user->can('view delivered order details') || $user->can('Administer'))
                  <a href="{{route('delivered.show.details.stores',['id' => $history->product_id, 'purchase_id' => $purchase->id])}}" class="btn btn-xs btn-primary">{{__('translations.details')}}</a>
                @endif           
              </th>

            </tr>
          <?php 
          array_push($unique, $history->product_id);
        }
        ?>
            @endforeach
        </table>

      </div>
    </div>
  </div>
</section>

@stop
