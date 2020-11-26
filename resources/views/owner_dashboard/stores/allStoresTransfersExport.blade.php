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
                     
                      </tr>
                      @endforeach
                    </tbody>
                  </table>

