
          <table class="table table-bordered table-striped" id="shiporders">
            <thead>
              <tr>
                <th style="text-align: right;">{{__('translations.shiporder')}}</th>
                <th style="text-align: right;">{{__('translations.store_name')}}</th>
                <th style="text-align: right;">{{__('translations.product_name')}}</th>
                <th style="text-align: right;">{{__('translations.quantity')}}</th>
                <th style="text-align: right;">{{__('translations.reason')}}</th>
                <th style="text-align: right;">{{__('translations.created_at')}}</th>
              </tr>
            </thead>
            <tbody>
              @foreach($items as $movement)
              <tr>
                <td> {{$movement->shiporder_id}}</td>
                <td> {{$movement->store->name}}</td>
                <td> {{$movement->product->name}}</td>
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
               
              </tr>
              @endforeach
            </tbody>
          </table>
