
  <table class="table table-bordered table-striped">
    <thead>
      <tr class="success">
        <th style="text-align: right;">{{__('translations.client_name')}}</th>
        <th style="text-align: right;">{{__('translations.seller_name')}}</th>
        <th style="text-align: right;">{{__('translations.store_name')}}</th>
        <th style="text-align: right;">{{__('translations.product_name')}}</th>
        <th style="text-align: right;">{{__('translations.unique_id')}}</th>
        <th style="text-align: right;">{{__('translations.quantity')}}</th>
        <th style="text-align: right;">{{__('translations.price')}}</th>
        <!-- <th>{{__('translations.status')}}</th> -->
        <th style="text-align: right;">{{__('translations.method')}}</th>
        <th style="text-align: right;">{{__('translations.bill_id')}}</th>
        <th style="text-align: right;">{{__('translations.status')}}</th>
        <th style="text-align: right;">{{__('translations.created_at')}}</th>
        <!-- <th>{{__('translations.actions')}}</th> -->

      </tr>
    </thead>
    <tbody>
    
          
          @foreach($needed_purchases as $history)
           
            <tr>
              @if(!empty($history->user_id))
              <?php $thisuser = App\User::withTrashed()->where('id', $history->user_id)->first(); ?>
              <td>{{ $thisuser->name }}<br>
                ( @if(!$thisuser->usertype)
                       {{ 'هاتف خاطئ' }}
                @else
                 {{ $thisuser->usertype->name }} 
                 @endif ) 
              </td>
              @else
              <td>{{__('translations.unregistered_client')}}</td>
              @endif
              <td>{{ $history->seller->name}}</td>
              <td>{{ $history->store->name}}</td>
              <td>{{ $history->product->name }}</td>
              <td>{{ $history->product->unique_id }}</td>
              <td>{{ $history->quantity}}
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
                {{ $history->price }}
               <?php /* @if($history->sellerdiscount > 0)
                  {{ $history->price -($history->price * $history->sellerdiscount / 100) }}
                @else
                {{$history->price }}
                @endif*/?>
                 {{__('translations.egp')}}</td>
              <?php // <td>{{$purchase->purchase_status}}</td> ?>
              <td>دفع نقدى بالمحل</td>
              <td>{{ $history->bill_id}}</td>
              <td>{{ $history->order_status }}</td>
              <td>{{ $history->created_at}}</td>
            </tr>
    @endforeach
    </tbody>
  </table>
             
          