
          <table class="table table-bordered table-striped">
                    <thead>
                      <tr class="success">
                        <th style="text-align: right;">{{__('translations.store')}}</th>
                        <th style="text-align: right;">{{__('translations.product_name')}}</th>
                        <th style="text-align: right;">{{__('translations.unique_id')}}</th>
                        <th style="text-align: right;">{{__('translations.quantity')}}</th>
                        <th style="text-align: right;">{{__('translations.reason')}}</th>
                        <th style="text-align: right;">{{__('translations.settle_number')}}</th>
                        <th style="text-align: right;">{{__('translations.created_at')}}</th>

                      </tr>
                    </thead>
                    <tbody>
                      @foreach($storesSettlements as $history)
                      <tr>
                      <td>{{ $history->store->name }}</td>
                      <td>{{ $history->product->name }}</td>
                      <td>{{ $history->product->unique_id }}</td>
                      <td>{{ abs($history->quantity) }} </td>
                      <td>{{ $history->reason }} </td>
                      <td>{{ $history->settle_id }}</td>
                      <td>{{ $history->created_at }}</td>
                     
                      </tr>
                      @endforeach
                    </tbody>
                  </table>

