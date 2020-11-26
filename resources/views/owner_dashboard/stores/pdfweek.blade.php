
                  <table style="width:300px; font-size: 13px;">
                    <thead>
                      <tr class="success">
                        <th scope="col">{{ 'product_name' }}</th>
                        <th scope="col">{{ 'unique_id' }}</th>
                        <th scope="col">{{ 'quantity' }}</th>
                        <th scope="col">{{ 'price' }}</th>
                        <th scope="col">{{ 'seller_name' }}</th>
                        <th scope="col">{{ 'store_name' }}</th>
                        <th scope="col">{{ 'client_name' }}</th>
                        <th scope="col">{{ 'bill_id' }}</th>
                        <th>{{ 'status' }}</th>
                        <th>{{ 'payment_method' }}</th>
                        <!-- <th scope="col">{{__('translations.purchase_status')}}</th> -->
                        <th scope="col">{{ 'created_at' }}</th>

                      </tr>
                    </thead>
                    <tbody>
                      @foreach($histories as $history)
                      <tr>
                      <td>{{ $history->product->name }}</td>
                      <td>{{ $history->product->unique_id }}</td>
                      <td>{{ $history->quantity }}
                        <?php //{{ $history->quantity < 0 ? -$history->quantity : $history->quantity }} ?></td>
                      <td>
                        {{ $history->price }} 
                       <?php  // {{ $history->price - ($history->price * $history->sellerdiscount / 100) }}?>
                      </td>
                      <td>{{ $history->seller->name }}</td>
                      <td>{{ $history->store->name }}</td>
                      <td>@if(!empty($history->user->name)) 
                          {{$history->user->name}} <br>
                         <?php // ( {{$history->user->usertype->name}} ) ?>
                          @else
                          {{ 'عميل غير مسجل' }}
                          @endif</td>
                      <td>{{ $history->bill_id }}</td>
                      <td>{{ $history->price > 0 ? 'purchased' : 'refunded' }}
                        </td>
                      <td>{{ 'cash store' }}</td>
                      <td>{{ $history->created_at }}</td>
                      </tr>
                      @endforeach


                    </tbody>
                  </table>


