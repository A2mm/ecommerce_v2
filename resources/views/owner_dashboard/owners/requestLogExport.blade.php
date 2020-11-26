
    <table class="table table-bordered table-striped" id="vendors">
      <thead>
        <tr>
          <th style="text-align:right;"> {{__('translations.description')}}</th>
          <th style="text-align:right;"> {{__('translations.ip')}}</th>
        <?php //  <th style="text-align:right;"> {{__('translations.action_user_name')}}</th> ?>
          <th style="text-align:right;"> {{__('translations.created_at')}}</th>
        </tr>
      </thead>

      <tbody>
       @foreach($requests as $item)
      <tr>
        
        <td> 
 <?php //  start login response ?>
   <?php /* @if($item->request && strstr($item->url, 'login?'))                   
             
               <?php $part = strstr($item->response, '{'); 
                            $part = json_decode($part); ?>
                        @foreach ($part as $key => $value)
                           @if($key == 'code')
                              @if($value == 200)
                                    {{ __('translations.successfull_login') }}
                              @else
                                   {{ __('translations.failed_login') }}
                              @endif
                           @endif
                        @endforeach 
  @endif  */ ?>

  @if($item->request) 
 <?php  $req = json_decode($item->request); ?>
        @foreach ($req as $key => $value)
        @if($key == 'email')
               <?php $part = strstr($item->response, '{'); 
                            $part = json_decode($part); ?>
                        @foreach ($part as $key => $value)
                           @if($key == 'code')
                              @if($value == 200)
                                    {{ __('translations.successfull_login') }}
                              @else
                                   {{ __('translations.failed_login') }}
                              @endif
                           @endif
                        @endforeach
        @endif
        @endforeach
@endif              
 <?php //  end login response ?>

                 @if($item->request && strstr($item->url, 'search/with/bill'))
                 <?php $bill   = strstr($item->url, '='); 
                  $bill   = trim($bill, '=');
                     ?>
                    <?php $one = json_decode($item->request); ?>
                                        
                    @foreach($one as $key => $value)
                      @if(is_array($value))
                      @else
                      @if($key == 'bill_id')
                      <?php $bill_id = $value; ?>
                      @endif
                      @endif
                    @endforeach

                    <?php $bill_result = App\History::where('bill_id', $bill_id)
                                                    ->get(); ?>
                    @if (count($bill_result) > 0) 
                       {{ __('translations.success_bill_search') }}
                    @else
                       {{ __('translations.failed_bill_search') }}
                    @endif

                  <?php // {{ __('translations.search_with_bill') }} ?>
                 @endif

<?php // start customer register ?>
                 <?php // @if($item->request && strstr($item->url, 'customer/register'))  ?> 
                 @if($item->request)
                 @if(strstr($item->response, 'registercustomer'))

                  <?php $part = strstr($item->response, '{'); 
                            $part = json_decode($part); ?>
                        @foreach ($part as $key => $value)
                           @if($key == 'code')
                              @if($value == 200)
                                    {{ __('translations.success_customer_register') }}
                              @else
                                   {{ __('translations.failed_customer_register') }}
                              @endif
                           @endif
                        @endforeach 
                 @endif
                  @endif
<?php // end customer register ?>

<?php // start put product ?>
                <?php //  @if($item->request && strstr($item->url, 'putproduct')) ?>
                 @if($item->request)
                   @if(strstr($item->response, 'putproduct_dest'))

                          <?php $part = strstr($item->response, '{'); 
                                $part = json_decode($part); ?>

                                @foreach ($part as $key => $value)
                                   @if($key == 'code')
                                      @if($value == 200)
                                            {{ __('translations.success_put_product') }}
                                      @else
                                           {{ __('translations.failed_put_product') }}
                                      @endif
                                   @endif
                                @endforeach 

                         @endif
                      @endif

<?php // end put product ?>

<?php // start seller history ?>
                 @if($item->request)
                  @if(strstr($item->response, 'sellerhistory'))

                  <?php $part = strstr($item->response, '{'); 
                            $part = json_decode($part); ?>
                        @foreach ($part as $key => $value)
                           @if($key == 'code')
                              @if($value == 200)
                                    {{ __('translations.success_seller_history') }}
                              @else
                                   {{ __('translations.failed_seller_history') }}
                              @endif
                           @endif
                        @endforeach 
                 @endif
                 @endif
<?php // end seller history ?>

<?php // start history invoice ?>
                 @if($item->request)
                   @if(strstr($item->response, 'history_invoice'))

                   <?php $part = strstr($item->response, '{'); 
                            $part = json_decode($part); ?>
                        @foreach ($part as $key => $value)
                           @if($key == 'code')
                              @if($value == 200)
                                    {{ __('translations.success_history_invoice') }}
                              @else
                                    {{ __('translations.failed_history_invoice') }}
                              @endif
                           @endif
                        @endforeach 
                 @endif
                  @endif
<?php // end history invoice ?>

<?php // start store last 10 days ?>
                   @if($item->request)
                     @if(strstr($item->response, 'last10_days'))

                  <?php $part = strstr($item->response, '{'); 
                            $part = json_decode($part); ?>
                        @foreach ($part as $key => $value)
                           @if($key == 'code')
                              @if($value == 200)
                                    {{ __('translations.success_store_last_10_days') }}
                              @else
                                    {{ __('translations.failed_store_last_10_days') }}
                              @endif
                           @endif
                        @endforeach 
                 @endif
                  @endif
<?php // end store last 10 days ?>

<?php // start refund ?>
                 @if($item->request)
                   @if(strstr($item->response, 'refundbill'))

                  <?php $part = strstr($item->response, '{'); 
                            $part = json_decode($part); ?>
                        @foreach ($part as $key => $value)
                           @if($key == 'code')
                              @if($value == 200)
                                    {{ __('translations.success_refund') }}
                              @else
                                   {{ __('translations.failed_refund') }}
                              @endif
                           @endif
                        @endforeach  
                 @endif
                 @endif
<?php // end refund ?>

<?php // start checkout ?>
                  @if($item->request)
                   @if(strstr($item->response, 'checkout'))

                   <?php $part = strstr($item->response, '{'); 
                            $part = json_decode($part); ?>
                        @foreach ($part as $key => $value)
                           @if($key == 'code')
                              @if($value == 200)
                                   {{ __('translations.success_checkout') }}
                              @else
                                   {{ __('translations.failed_checkout') }}
                              @endif
                           @endif
                        @endforeach    
                 @endif
                 @endif
<?php // end checkout ?>

<?php // start check products prices ?>
                 <?php //@if($item->request && strstr($item->url, 'checkProducts') && !strstr($item->url, 'checkProducts/phone?') && !strstr($item->url, 'products?')) ?>
                  @if($item->request)
                   @if(strstr($item->response, 'productPrices')) 
                <?php // {{ __('translations.checkProducts') }} ?>

                   <?php $part = strstr($item->response, '{'); 
                            $part = json_decode($part); ?>
                        @foreach ($part as $key => $value)
                           @if($key == 'code')
                              @if($value == 200)
                                  {{ __('translations.success_products_prices_details') }}
                              @else
                              {{ __('translations.failed_products_prices_details') }}
                              @endif
                           @endif
                        @endforeach     

                  @endif
                   @endif
<?php // end check products prices ?>

<?php // start scan bill ?>
                 @if($item->request)
                @if(strstr($item->response, 'scan_bill'))

                   <?php $part = strstr($item->response, '{'); 
                            $part = json_decode($part); ?>
                        @foreach ($part as $key => $value)
                           @if($key == 'code')
                              @if($value == 200)
                                   {{ __('translations.success_scan_bill') }}
                              @else
                                    {{ __('translations.failed_scan_bill') }}
                              @endif
                           @endif
                        @endforeach 
                 @endif
                  @endif
<?php // end scan bill ?>

<?php // store last 7 days history ?>
                 @if($item->request)
                    @if(strstr($item->response, 'store_last_7_days_history'))

                   <?php $part = strstr($item->response, '{'); 
                            $part = json_decode($part); ?>
                        @foreach ($part as $key => $value)
                           @if($key == 'code')
                              @if($value == 200)
                                   {{ __('translations.success_store_last_7_days_history') }}
                              @else
                                    {{ __('translations.failed_store_last_7_days_history') }}
                              @endif
                           @endif
                        @endforeach 
                 @endif
                    @endif
<?php // end last 7 days history ?>

<?php // start store last 7 days ?>
                  @if($item->request)
                   @if(strstr($item->response, 'store_last_7_days_total'))

                  <?php $part = strstr($item->response, '{'); 
                            $part = json_decode($part); ?>
                        @foreach ($part as $key => $value)
                           @if($key == 'code')
                              @if($value == 200)
                                   {{ __('translations.success_store_last_7_days_total') }}
                              @else
                                    {{ __('translations.failed_store_last_7_days_total') }}
                              @endif
                           @endif
                        @endforeach 

                 @endif
                 @endif
<?php // end store last 7 days ?>

<?php // start details of one product ?>
                @if($item->request)
                    @if($item->response && strstr($item->response, 'getproduct_dest'))
                      <?php $part = strstr($item->response, '{'); 
                            $part = json_decode($part); ?>
                        @foreach ($part as $key => $value)
                           @if($key == 'code')
                              @if($value == 200)
                                   {{ __('translations.success_product_details') }}
                              @else
                              {{ __('translations.failed_product_details') }}
                              @endif
                           @endif
                        @endforeach                  
                 @endif
                 @endif
<?php // end details of one product ?>

<?php // end details of seller products ?>
                 @if($item->request)
                  @if(strstr($item->response, 'sellerproducts'))

                  <?php $part = strstr($item->response, '{'); 
                            $part = json_decode($part); ?>
                        @foreach ($part as $key => $value)
                           @if($key == 'code')
                              @if($value == 200)
                                    {{ __('translations.success_products_details') }}
                              @else
                                    {{ __('translations.failed_products_details') }}
                              @endif
                           @endif
                        @endforeach   

                 @endif
                  @endif
<?php // end details of seller products ?>

<?php // start check products phone ?>

                 @if($item->request)
                  @if(strstr($item->response, 'productsPhone'))
                  
                   <?php $vvv = strstr($item->response, '{'); 
                            $vvv = json_decode($vvv); ?>
                        @foreach ($vvv as $key => $value)
                           @if($key == 'code')
                              @if($value == 200)
                                  {{ __('translations.success_chechproducts_phone_details') }}
                              @else
                               {{ __('translations.failed_chechproducts_phone_details') }}
                              @endif
                           @endif
                        @endforeach  

                 
                  @endif
                  @endif
<?php // end check products phone ?>

<?php // start get inprogress  ?>

                 @if($item->request)
                  @if(strstr($item->response, 'getInProgress'))
                  
                   <?php $vvv = strstr($item->response, '{'); 
                            $vvv = json_decode($vvv); ?>
                        @foreach ($vvv as $key => $value)
                           @if($key == 'code')
                              @if($value == 200)
                                  {{ __('translations.success_getInProgress_details') }}
                              @else
                               {{ __('translations.failed_getInProgress_details') }}
                              @endif
                           @endif
                        @endforeach  
<?php $one = json_decode($item->request); ?>
@foreach($one as $key => $value)
                @if (is_array($value))  
                @else
                        @if ($key == 'api_token')
                                
                                  <?php $seller = App\Seller::where('api_token', $value)->first(); ?>
                                  @if (!$seller)
                                    <?php $seller_name =  __('translations.unauthorized_seller'); ?>
                                    @else
                                     <?php  $seller_name = $seller->name; ?>
                                  @endif
                        @endif                            
               @endif
@endforeach

({{ $seller_name }})
                 
                  @endif
                  @endif
<?php // end get inprogress  ?>

<?php // start seller deliver inprogress  ?>

                 @if($item->request)
                  @if(strstr($item->response, 'sellerDeliver'))
                  
                   <?php $vvv = strstr($item->response, '{'); 
                            $vvv = json_decode($vvv); ?>
                        @foreach ($vvv as $key => $value)
                           @if($key == 'code')
                              @if($value == 200)
                                  {{ __('translations.success_sellerDeliver_details') }}
                              @else
                               {{ __('translations.failed_sellerDeliver_details') }}
                              @endif
                           @endif
                        @endforeach  

<?php $one = json_decode($item->request); ?>
@foreach($one as $key => $value)
                @if (is_array($value))  
                @else
                        @if ($key == 'api_token')
                                
                                  <?php $seller = App\Seller::where('api_token', $value)->first(); ?>
                                  @if (!$seller)
                                    <?php $seller_name =  __('translations.unauthorized_seller'); ?>
                                    @else
                                     <?php  $seller_name = $seller->name; ?>
                                  @endif
                        @endif                            
               @endif
@endforeach

({{ $seller_name }})

                 
                  @endif
                  @endif
<?php // end seller deliver inprogress  ?>

        </td>

        <td> {{ $item->ip }}</td>
        <td>  {{ $item->created_at->format('F d, Y h:i a') }}
          <u> {{ $item->created_at->diffForHumans() }} </u>
        </td>

     </tr>
      @endforeach
      </tbody>
    </table>

