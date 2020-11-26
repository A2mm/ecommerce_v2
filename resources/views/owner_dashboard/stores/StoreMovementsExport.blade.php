
        <table class="table table-bordered table-striped">
          <thead>
            <tr>
              <th style="text-align: right;">{{__('translations.product_name')}}</th>
              <th style="text-align: right;">{{__('translations.quantity')}}</th>
              <th style="text-align: right;">{{__('translations.reason')}}</th>
              <th style="text-align: right;">{{__('translations.created_at')}}</th>
            </tr>
          </thead>
          <tbody>

            @foreach($movementss as $movement)
            <tr>
              <td>{{$movement->product->name}}</td>
              <td> {{ $movement->quantity }}</td>
              <td> {{$movement->reason}}</td>
              <td> {{$movement->created_at}}</td>
            </tr>
            @endforeach


          </tbody>
        </table>

      