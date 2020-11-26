  <table class="table table-bordered table-striped" style="text-align: center;">
     <thead>
      <tr class="success">
        <th style="text-align: center;">{{ __('translations.seller_name') }}</th>
        <th style="text-align: center;">{{ __('translations.store_name') }}</th>
        <th style="text-align: center;">{{ __('translations.totalsold_bykilo') }}</th>

        <th style="text-align: center;">{{ __('translations.mono')}} {{ $category1->name }}</th>
        <th style="text-align: center;">{{ __('translations.total')}} {{ $category1->name }}</th>

        <th style="text-align: center;">{{ __('translations.mono')}} {{ $category2->name }}</th>
        <th style="text-align: center;">{{ __('translations.total')}} {{ $category2->name }}</th>

        <th style="text-align: center;">{{ __('translations.mono')}} {{ $category3->name }}</th>
        <th style="text-align: center;">{{ __('translations.total')}} {{ $category3->name }}</th>
      </tr>
    </thead>
    <tbody>
    @foreach($unique_sellers as $seller)
    <?php  
    $wholesale_price  = 0;
    $totalsold_bykilo = 0;
    $cat1_mono        = 0;
    $cat2_mono        = 0;
    $cat3_mono        = 0;
    $cat1_wholesale   = 0;
    $cat2_wholesale   = 0;
    $cat3_wholesale   = 0;
    $qty = 0;
    $date_from        = $fromExcel;
    $date_to          = $toExcel;
    $this_seller      = App\Seller::where('id', $seller['seller_id'])->first(); 
    $this_store       = App\Store::where('id', $seller['store_id'])->first();
    $soldprods    = App\History::where('seller_id', $seller['seller_id'])
                                  ->where('store_id', $seller['store_id'])
                                  ->where('created_at', '>=', $date_from)
                                  ->where('created_at', '<=', $date_to)
                                  ->get();
      
            foreach($soldprods as $prod)
            {
                    $product = App\Product::where('id', $prod->product_id)->first();
                    $qty += $product->weight * $prod->quantity;
                    if($prod->user_id == null || $prod->user_id == 0)
                    {
                          if ($prod->product->subcategory->category_id == 1)
                          {
                              $cat1_mono += $prod->product->weight * $prod->quantity;
                          }
                          elseif($prod->product->subcategory->category_id == 2) {
                              $cat2_mono += $prod->product->weight * $prod->quantity;
                          }
                          else{
                              $cat3_mono += $prod->product->weight * $prod->quantity;
                          }
                    }
                    else
                    {
                      $thisuser_id = $prod->user_id;
                      $this_user = App\User::select('id', 'name', 'phone', 'usertype_id')->where('id', $thisuser_id)->first();
                      if ($this_user->usertype_id == 1)
                      {
                           if ($prod->product->subcategory->category_id == 1)
                          {
                              $cat1_mono += $prod->product->weight * $prod->quantity;
                          }
                          elseif($prod->product->subcategory->category_id == 2) {
                              $cat2_mono += $prod->product->weight * $prod->quantity;
                          }
                          else{
                              $cat3_mono += $prod->product->weight * $prod->quantity;
                          }
                      }
                      else
                      {
                           if ($prod->product->subcategory->category_id == 1)
                          {
                              $cat1_wholesale += $prod->product->weight * $prod->quantity;
                          }
                          elseif($prod->product->subcategory->category_id == 2) {
                              $cat2_wholesale += $prod->product->weight * $prod->quantity;
                          }
                          else{
                              $cat3_wholesale += $prod->product->weight * $prod->quantity;
                          }
                      }
                    }
           }
    ?>
            <tr>
              <td> {{ $this_seller->name }}</td>
              <td> {{ $this_store->name }}</td>

              <td> {{  $qty }} {{ __('translations.gm') }} </td>

              <td> {{  $cat1_mono }}  {{ __('translations.gm') }} </td>
              <td> {{  $cat1_wholesale }}  {{ __('translations.gm') }} </td>

              <td> {{  $cat2_mono }}  {{ __('translations.gm') }} </td>
              <td> {{  $cat2_wholesale }}  {{ __('translations.gm') }} </td>

              <td> {{  $cat3_mono }}  {{ __('translations.gm') }} </td>
              <td> {{  $cat3_wholesale }}  {{ __('translations.gm') }} </td>

            </tr>
    @endforeach
    </tbody>
  </table>

            