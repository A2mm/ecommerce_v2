  <table class="table table-bordered table-striped" style="text-align: center;">
    <thead>
      <tr class="success">
        <th style="text-align: center;">{{__('translations.seller_name')}}</th>
        <th style="text-align: center;">{{__('translations.store_name')}}</th>
        <th style="text-align: center;">{{__('translations.seller_totalprice')}}</th>
        <th style="text-align: center;">{{__('translations.seller_wholesale_totalprice')}}</th>
        <th style="text-align: center;">{{__('translations.seller_mono_totalprice')}}</th>
      </tr>
    </thead>
    <tbody>
       @foreach ($unique_sellers as $value)
        <?php 
        $wholesale_price = 0;
        $date_from       = $fromExcel;
        $date_to         = $toExcel;

         $this_seller     = App\Seller::where('id', $value['seller_id'])->first(); 
         $this_store      = App\Store::where('id', $value['store_id'])->first();
        
        $total = App\History::where(['seller_id' => $value['seller_id'], 'store_id' => $value['store_id']])
                            ->where('created_at', '>=', $date_from)
                            ->where('created_at', '<=', $date_to)
                            ->sum('price');

        $histories = App\History::where(['seller_id' => $value['seller_id'], 'store_id' => $value['store_id']])
                        ->where('created_at', '>=', $date_from)
                        ->where('created_at', '<=', $date_to)
                        ->where('user_id', '>', 0)
                        ->select('user_id', 'price')->get();

        foreach ($histories as $hist) {
            if ($hist->user_id > 0) {
              if($hist->user->usertype_id > 1){
                $wholesale_price += $hist->price;
              }
            }
        }
       $monoprice = $total - $wholesale_price;
    ?>
            <tr>
              <td> {{ $this_seller->name }}</td>
              <td> {{ $this_store->name }}</td>
              <td> {{ round($total, 10) }}     {{ __('translations.egp') }}</td>
              <td> {{ round($wholesale_price, 10) }}  {{ __('translations.egp') }} </td>
              <td> {{ round($monoprice, 10) }}       {{ __('translations.egp') }} </td>
            </tr>
    @endforeach
    </tbody>
  </table>

            
