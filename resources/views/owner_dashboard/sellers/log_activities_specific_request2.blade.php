@extends('owner_dashboard.master')

@section('body')

  <section class="content-header">
    <h1>
      {{__('translations.log')}}
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
    <table class="table table-bordered table-striped" id="vendors">
      <thead>

      </thead>
      <tbody>
              <?php // start search with bill request  ?> 

                     @if($item->request && strstr($item->url, 'search/with/bill'))

<?php // start  ?>
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
                      <h4>  {{ __('translations.success_bill_search') }} <br><br>
                        {{ $item->created_at->format('F d, Y h:i a') }}</h4>
                       <?php $bill_total = App\History::where('bill_id', $bill_id)
                                                    ->sum('price'); ?>
                         <table class="table">
                            <tbody>
                              <tr> 
                                <td> {{ __('translations.bill_total') }}</td>
                                <td> {{ $bill_total }} {{ __('translations.egp') }}</td>
                              </tr>
                            </tbody>
                         </table>
                    @else
                      <h4>  {{ __('translations.failed_bill_search') }} <br><br> {{ $item->created_at->format('F d, Y h:i a') }}</h4>
                    @endif

                  <?php // {{ __('translations.search_with_bill') }} ?>
                 @endif
<?php // end ?>
                     <?php $bill   = strstr($item->url, '='); 
                           $bill   = trim($bill, '=');
                     ?>
                    <?php $one = json_decode($item->request); ?>
                       <table class="table table-bordered" id="vendors" style="font-size: 11px;">
                        <thead>
                          <tr>
                            <td>{{__('translations.action_user_name')}}</td>
                            <td>{{__('translations.bill_id')}}</td>
                          </tr>
                        </thead>
                        <tbody>    
                        <tr>                    
                    @foreach($one as $key => $value)
                      @if(is_array($value))
                      @else
                      <td> {{ Auth::user()->name }}</td>
                      <td> {{ $value }}</td>
                      @endif
                    @endforeach
                  </tr>
                  </tbody>
                </table>

                @endif
                <?php // end search with bill request  ?> 


                <?php // start customer register request  ?> 

                     @if($item->request)
                        @if(strstr($item->response, 'registercustomer'))

                    <?php $one = json_decode($item->request); ?>
                    <?php $count = 0; ?> 
@foreach($one as $key => $value)


@if($key == 'api_token')
<?php $count++; ?> 
@endif
                @if (is_array($value))  
                @else

                        @if ($key == 'api_token')
                                
                                  <?php $seller = App\Seller::where('api_token', $value)->first(); ?>
                                  @if (!$seller)
                                    <?php $seller_name =  __('translations.unauthorized_seller'); ?>
                                    @else
                                     <?php  $seller_name = $seller->name; ?>
                                  @endif
                        @else
                        @endif                            
               @endif
@endforeach
@if($count < 1)
<?php $seller_name = __('translations.unauthorized_seller'); ?>
@endif

                     <?php $record = strstr($item->response, '{'); ?>
                      <?php $part = json_decode($record); ?>

                      @foreach ($part as $key => $value)
                           @if($key == 'code')
                              @if($value == 200)
                                 <h4> {{ __('translations.success_customer_register') }}
                                    {{ __('translations.by') }}
                                    {{ $seller_name }} <br><br>
                                  {{ $item->created_at->format('F d, Y h:i a') }}
                                </h4>
                              @else
                                 <h4>  {{ __('translations.failed_customer_register') }}
                                   {{ __('translations.by') }}
                                   {{ $seller_name }} <br><br>
                                 {{ $item->created_at->format('F d, Y h:i a') }}
                               </h4>
                              @endif
                           @endif

                           @if($key == 'message')
                                       @if($value !== false && $value !== true)
                                         <tr>
                                          <td> {{ __('translations.'.$key) }}</td>
                                          <td> {{ __('translations.'.$value) }}</td>
                                        </tr>
                                        @endif
                          @endif

                           @if($key == 'error')
                                @foreach($value as $errk => $err)
                                @foreach($err as $errorkey => $errorval)
                                   <tr><td style="padding-top: 25px;"> {{ __('translations.error') }} </td>
                                       <td style="padding-top: 25px;"> {{ $errorval }} </td></tr>
                                @endforeach
                                @endforeach
                          @endif

                        @endforeach 

                        <table class="table table-bordered table-striped">
                          <hr>
                          <tr>
                            <td> {{ __('translations.client_name') }}</td>
                            <td> {{ __('translations.client_phone') }}</td>
                            <td> {{ __('translations.usertype') }}</td>
                          </tr>  <tr>
                          @foreach($one as $keyr => $requesting)
                            <td> 
                              @if($keyr != 'api_token')

                              @if(!empty($requesting))
                                 @if($keyr == 'usertype_id')
                                    {{ 'قطاعي' }}
                                 @else
                                   {{ $requesting }}
                                @endif
                              @else
                              {{ 'يرجي الادخال' }}
                              @endif
                            @endif
                            </td>
                          @endforeach
                        </tr>
                        </table>

                @endif
                @endif
                <?php // end customer register request  ?> 

                <?php // start seller history request  ?>  
                
                     @if($item->request)
                       @if(strstr($item->response, 'sellerhistory'))

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
                      
                   <?php $part = strstr($item->response, '{'); 
                            $part = json_decode($part); ?>
                        @foreach ($part as $key => $value)
                           @if($key == 'code')
                              @if($value == 200)
                                 <h4> {{ __('translations.success_seller_history') }}
                                    {{ __('translations.by') }}
                                    {{ $seller_name }} <br><br>
                                  {{ $item->created_at->format('F d, Y h:i a') }}
                                </h4>
                              @else
                                 <h4>  {{ __('translations.failed_seller_history') }}
                                   {{ __('translations.by') }}
                                   {{ $seller_name }} <br><br>
                                 {{ $item->created_at->format('F d, Y h:i a') }}
                               </h4>
                              @endif
                           @endif

                           @if($key == 'message')
                                       @if($value !== false && $value !== true)
                                         <tr>
                                          <td> {{ __('translations.'.$key) }}</td>
                                          <td> {{ __('translations.'.$value) }}</td>
                                        </tr>
                                        @endif
                                        @endif
                        @endforeach  

                @endif
                 @endif
                <?php // end seller history request  ?> 

                <?php // start seller history invoice request  ?> 

                     @if($item->request)
                      @if(strstr($item->response, 'history_invoice'))

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

                  <?php $part = strstr($item->response, '{'); 
                            $part = json_decode($part); ?>
                        @foreach ($part as $key => $value)
                           @if($key == 'code')
                              @if($value == 200)
                              <h4>
                                    {{ __('translations.success_history_invoice') }}
                                    {{ __('translations.by') }}
                                    {{ $seller_name }} <br><br>
                                  {{ $item->created_at->format('F d, Y h:i a') }}
                                </h4>
                              @else
                                <h4>    {{ __('translations.failed_history_invoice') }}
                                    {{ __('translations.by') }}
                                    {{ $seller_name }} <br><br>
                                  {{ $item->created_at->format('F d, Y h:i a') }}
                                </h4>
                              @endif
                           @endif
                        @endforeach 

               @endif
                @endif
                <?php // end history invoice request  ?> 

                <?php // start store last 10 days request  ?> 

                     @if($item->request)
                       @if(strstr($item->response, 'last10_days'))

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

                            <?php $part = strstr($item->response, '{'); 
                            $part = json_decode($part); ?>

                        @foreach ($part as $key => $value)
                           @if($key == 'code')
                              @if($value == 200)
                                <h4>    {{ __('translations.success_store_last_10_days') }}
                                    {{ __('translations.by') }}
                                    {{ $seller_name }} <br><br>
                                  {{ $item->created_at->format('F d, Y h:i a') }}
                                </h4>
                              @else
                                <h4>    {{ __('translations.failed_store_last_10_days') }}
                                    {{ __('translations.by') }}
                                    {{ $seller_name }} <br><br>
                                  {{ $item->created_at->format('F d, Y h:i a') }}
                                </h4>
                              @endif
                           @endif
                        @endforeach 
@endif
@endif
                <?php // end store last 10 days request  ?> 

              <!-- // start refund request -->

            @if($item->request)
              @if(strstr($item->response, 'refundbill'))

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

<?php // added ?> 
                           <?php $part = strstr($item->response, '{'); 
                            $part = json_decode($part); ?>
                        
                        @foreach ($part as $key => $value)
                           @if($key == 'code')
                         
                              @if($value == 200)
                                 <h4>   {{ __('translations.success_refund') }}
                                    {{ __('translations.by') }}
                                    {{ $seller_name }} <br><br>
                                  {{ $item->created_at->format('F d, Y h:i a') }}
                                </h4>

                                    <?php  $refunded_price = 0; ?>
                                    <?php  $bill_id = null; ?>    
                                @else
                                    <h4> {{ __('translations.failed_refund') }}
                                    {{ __('translations.by') }}
                                    {{ $seller_name }} <br><br>
                                  {{ $item->created_at->format('F d, Y h:i a') }}
                                </h4>

                                    <table class="table table-bordered">
                                     @foreach($one as $key => $value)
                                     @if($key != 'api_token')
                                     <tr>
                                            @if (is_array($value)) 
                                              @if ($key == 'refunds') 
                                                 
                                              @endif
                                     
                                            @else
                                            @if($key != 'message')
                                             <td> {{ __('translations.'.$key) }}</td> <td> {{ $value == null ? 'يرجي ادخال رقم الفاتورة' : $value }}</td> 
                                          @endif
                                            @endif
                                             </tr>
                                            @endif
                                    @endforeach
                                     <?php  $part = strstr($item->response, '{'); 
                                            $part = json_decode($part); ?>
                                              @foreach ($part as $key => $value)
                                                 @if($key == 'message')
                                                    <tr> <td> {{ __('translations.'.$key) }} </td> <td> {{ $value }}</td></tr>
                                                 @endif
                                              @endforeach 
                                  </table>
                                @endif
                            @endif

                          @if($key == 'histories_ids')
                         <?php /* @foreach($value as $index => $val)
                            {{ $val }} <br>
                          @endforeach */ ?>
                                <?php $histories = App\History::whereIn('id', $value)->get(); ?>
                                @foreach($histories as $history)
                                <?php $bill_id = $history->bill_id; ?>
                               <?php  $refunded_price += $history->price; ?>
                                @endforeach
                                <table class="table">
                                <thead>
                                   <th style="text-align: center;"> {{ __('translations.refunded_price') }} </th>
                                   <th style="text-align: center;">  {{ __('translations.bill_id') }}</th>
                                </thead>
                                <tbody>
                                  <tr style="text-align: center;"> 
                                    <td>  {{ -$refunded_price }} {{ __('translations.egp') }}</td>
                                    <td>  {{ $bill_id }}</td>
                                  </tr>
                                </tbody>
                              </table>
                          @endif

               @endforeach
<hr>
               <table class="table table-bordered">
                    <tr>
                      <td> {{ __('translations.unique_id') }} </td>
                      <td> {{ __('translations.quantity') }} </td>
                    </tr>
                                     @foreach($one as $key => $value)
                                              @if($key == 'refunds') 
                                                 @foreach($value as $refk => $ref)
                                                 <tr>
                                                  <td> {{ $ref->unique_id == null ? 'يرجي ادخال كود المنتج' : $ref->unique_id }} </td>
                                                  <td> {{ $ref->quantity }} </td>
                                                </tr>
                                                 @endforeach
                                              @endif
                                    @endforeach
            </table>
@endif              
@endif

          <!-- // end refund request -->

          <!-- // start checkout request -->

            @if($item->request)
              @if(strstr($item->response, 'checkout'))

                <?php $one =  json_decode($item->request); ?>
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
   
  <?php // added ?>
     <?php $part = strstr($item->response, '{'); 
    $part = json_decode($part); ?>
    
                        @foreach ($part as $key => $value)
                           @if($key == 'code')
    
                              @if($value == 200)
                                    <h4> {{ __('translations.success_checkout') }}
                                    {{ __('translations.by') }}
                                    {{ $seller_name }} <br><br>
                                  {{ $item->created_at->format('F d, Y h:i a') }}
                                </h4>

                                    <table class="table">
                                    <tbody>
                                      @foreach ($part as $key => $value)
                                        @if ($key == 'products' || $key == 'auth_id')
                                          <?php continue; ?>
                                        @else
                                            @if ($key != 'created_at' && $key != 'code' && $key != 'dest')  
                                             <tr>
                                              <td> {{ __('translations.'.$key) }}</td>
                                              <td> {{ $value }}</td>
                                             </tr>
                                           
                                            @endif
                               
                                        @endif
                                      @endforeach
                                       </tbody>
                                        </table>
                              @else
                                  <h4> {{ __('translations.failed_checkout') }}
                                   {{ __('translations.by') }}
                                   {{ $seller_name }} <br><br>
                                 {{ $item->created_at->format('F d, Y h:i a') }}
                               </h4>
                                
                                  <?php $record = strstr($item->response, '{'); ?>
                                  <?php $part = json_decode($record); ?>
                                        @foreach ($part as $k => $val)
                                        
                                                   @if($key == 'message')
                                                  
                                                   <table class="table table-bordered"><tbody><tr>
                                                        <td> {{ __('translations.'.$k) }}</td>
                                                        <td> {{ $val }}</td>
                                                      </tr> <tbody> </table>
                                                    @endif 
                                        @endforeach 
                              @endif
                              
                    @endif

                    @if($key == 'message')
                     
                                       @if($value !== false && $value !== true)
                                         <tr>
                                          <td> {{ __('translations.'.$key) }}</td>
                                          <td> {{ $value }}</td>
                                        </tr>
                                        @endif
                    @endif 
                   
                   

                    @if($key == 'error')
                                @foreach($value as $errk => $err)
                                @foreach($err as $errorkey => $errorval)
                                   <tr><td style="padding-top: 25px;"> {{ __('translations.error') }} </td>
                                       <td style="padding-top: 25px;"> {{ $errorval }} </td></tr>
                                @endforeach
                                @endforeach
                            @endif

                    @endforeach  

  <table class="table table-bordered">
    <?php $one = json_decode($item->request);  ?>
                 @foreach($one as $key => $value)
                
                        @if (is_array($value)) 
                            @if ($key = 'codes') 
                            
                                <tr>
                                <td> {{ __('translations.unique_id') }}</td>
                                <td> {{ __('translations.quantity') }}</td>
                              </tr>
                              @foreach($value as $i)
                              <tr>
                                  <td> {{$i->code}}</td>
                                  <td> {{ $i->quantity }}</td>
                                </tr>
                              @endforeach
                             
                            @endif
                
                        @else
                  </table>

                            @if ($key != 'api_token')
                             @if ($key != 'auth_id')
                            
                               <span style="border-style: solid; padding-left: 100px; padding-right: 100px; text-align: center;">{{ __('translations.'.$key) }} </span> 
                               <span style="border-style: solid; padding-left: 100px; padding-right: 100px; text-align: center;">{{ $value }}</span><br><br>
                            @endif
                             @endif
                       @endif
                  @endforeach 
        
@endif
        @endif
          <!-- // end checkout request -->

          <!-- // start getProductsPrices request -->

           <?php /* @if($item->request && strstr($item->url, 'checkProducts') && !strstr($item->url, 'checkProducts/phone?') && !strstr($item->url, 'products?')) */ ?>

            @if($item->request)
               @if(strstr($item->response, 'productPrices')) 

                <?php $one = json_decode($item->request); ?>

                      @foreach($one as $key => $value)

                        @if ($key == 'api_token')
                                
                                  <?php $seller = App\Seller::where('api_token', $value)->first(); ?>
                                  @if (!$seller)
                                    <?php $seller_name =  __('translations.unauthorized_seller'); ?>
                                    @else
                                     <?php  $seller_name = $seller->name; ?>
                                  @endif
                        @else
                                  <?php $seller_name =  __('translations.unauthorized_seller'); ?>
                        @endif                       
@endforeach

 <?php $part = strstr($item->response, '{'); 
                            $part = json_decode($part); ?>
                        @foreach ($part as $key => $value)
                           @if($key == 'code')
                            
                              @if($value == 200)
                                 <h4>  {{ __('translations.success_following_products_prices_details') }}
                                   {{ __('translations.by') }}
                                  {{ $seller_name }} <br><br>
                                {{ $item->created_at->format('F d, Y h:i a') }}
                              </h4><br>
                                  
                              @else
                               <h4> {{ __('translations.failed_following_products_prices_details') }}
                               {{ __('translations.by') }}
                               {{ $seller_name }} <br><br>
                             {{ $item->created_at->format('F d, Y h:i a') }}
                           </h4>
                              @endif

                           @endif


                                   @if($key == 'message')
                                       @if($value !== false && $value !== true)
                                         <tr>
                                          <td> {{ __('translations.'.$key) }}</td>
                                          <td> {{ __('translations.'.$value) }}</td>
                                        </tr>
                                        @endif
                                        @endif
                        @endforeach    

                        <table class="table table-bordered">
                                  <tr>
                                    <td style="text-align: center;"> {{ __('translations.unique_id') }}</td>
                                  </tr>
                                   @foreach($one as $key => $code)
                                                  
                                                  @if (is_array($code)) 
                                                      @foreach($code as $i)
                                                        <tr>
                                                          <td style="text-align: center;"> 
                                                          {{ $i != null ? $i : 'يرجي ادخال كود المنتج'}}</td>
                                                        </tr>
                                                      @endforeach
                                                  @else
                                                          @if ($key != 'api_token')
                                                                  <tr>
                                                                    <td style="text-align: center;">  {{ __('translations.'.$key) }} </td>
                                                                    <td style="text-align: center;"> {{ $code }} </td>
                                                                  </tr>
                                                          @endif                           
                                                 @endif
                                  @endforeach
                                  </table>                 
@endif
@endif
          <!-- // end getProductsPrices request -->

          <!-- // start login request -->

          @if($item->request) 
           @if(strstr($item->response, 'selllogin'))

 <?php  $req = json_decode($item->request); ?>
        @foreach ($req as $key => $value)
        @if($key == 'email')
        <?php $email = $value; ?>
          @endif
          @endforeach

                           <?php $part = strstr($item->response, '{'); 
                            $part = json_decode($part); ?>
                             <table class="table table-bordered">
                        @foreach ($part as $key => $value)
                           @if($key == 'code')
                                @if($value == 200)
                                     <h4> {{ __('translations.successfull_login') }} {{ __('translations.by')}} {{ $email }} <br><br>
                                     {{ $item->created_at->format('F d, Y h:i a') }}
                                   </h4>
                                @else <h4> 
                                     {{ __('translations.failed_login') }}
                                      @if(!empty($email))
                                     {{ __('translations.by')}} {{ $email }}
                                     @else
                                      ( {{ __('translations.enter_email') }} )
                                     @endif  <br><br>
                                     {{ $item->created_at->format('F d, Y h:i a') }}
                                      </h4>
                                @endif         
                            @endif

                            @if($key == 'error')
                                @foreach($value as $errk => $err)
                                @foreach($err as $errorkey => $errorval)
                                   <tr><td style="padding-top: 25px;"> {{ __('translations.error') }} </td>
                                       <td style="padding-top: 25px;"> {{ $errorval }} </td></tr>
                                @endforeach
                                @endforeach
                            @endif

                            @if($key == 'message')
                              @if($value !== false)
                                   <tr><td style="padding-top: 25px;"> {{ __('translations.'.$key) }} </td>
                                       <td style="padding-top: 25px;"> {{ $value }} </td></tr>
                            @endif
                            @endif
                           
                        @endforeach </table>
       
@endif       
@endif              
 <?php //  end login response ?>
<?php /*
@if($item->request && strstr($item->url, 'login?'))
<?php $one = json_decode($item->request); ?> 
 @if($item->response && strstr($item->url, 'login'))
@foreach($one as $key => $value)
                @if (is_array($value))  
                @else
                        @if ($key != 'api_token')
                               @if($key == 'email' && $key != '')
                            <?php $email = $value; ?>
                            @endif
                        @endif                            
               @endif
@endforeach
<?php $part = strstr($item->response, '{'); 
                            $part = json_decode($part); ?>
                        @foreach ($part as $key => $value)
                           @if($key == 'code')
                              @if($value == 200)
                                    {{ __('translations.successfull_login') }} {{ __('translations.by')}} {{ $email }}
                              @else
                                   {{ __('translations.failed_login') }}
                                   @if(!empty($email))
                          {{ __('translations.by')}} {{ $email }}
                      @else
                          ( {{ __('translations.enter_email') }} )
                      @endif   
                              @endif
                           @endif
                        @endforeach 
@endif
@endif
*/ ?>


          <!-- // end login request -->

      <!-- // start scan bill request -->

@if($item->request)
  @if(strstr($item->response, 'scan_bill'))
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
                        @else
                                  <?php $seller_name =  __('translations.unauthorized_seller'); ?>
                        @endif  

               @endif
@endforeach

<?php $part = strstr($item->response, '{'); 
$part = json_decode($part); ?>

 @foreach ($part as $key => $value)
                           @if($key == 'code')
                              @if($value == 200)<h4>
                                   {{ __('translations.success_scan_bill') }}
                                    {{ __('translations.by') }}
                                   {{ $seller_name }} <br><br>
                                 {{ $item->created_at->format('F d, Y h:i a') }}
                               </h4>
                              @else
                              <h4>
                                    {{ __('translations.failed_scan_bill') }}
                                     {{ __('translations.by') }}
                                   {{ $seller_name }} <br><br>
                                 {{ $item->created_at->format('F d, Y h:i a') }}
                               </h4>
                              @endif
                           @endif

                           @if($key == 'message')
                                       @if($value !== false && $value !== true)
                                         <tr>
                                          <td> {{ __('translations.'.$key) }}</td>
                                          <td> {{ $value }}</td>
                                        </tr>
                                        @endif
                                        @endif
@endforeach 

<?php $one = json_decode($item->request); ?>
                                <table class="table table-bordered table-striped">
                                  <tr><td style="text-align: center;"> {{__('translations.bill_id')}}</td></tr>
                               <tbody>
                                   @foreach($one as $key => $value)
                                                  @if (is_array($value))  
                                                  @else
                                                          @if ($key == 'bill_id')
                                                                 <tr> 
                                                                    <td style="text-align: center;">
                                              {{$value != null ? $value : 'يرجي ادخال رقم الفاتورة' }}
                                                                  </td>
                                                                    </tr>   
                                                          @endif            
                                                 @endif
                                  @endforeach
                                </tbody>
                              </table>

<?php /*
                <table class="table table-bordered">
                  <thead>
                    <tr>
                      <td> {{ __('translations.bill_id') }} </td>
                    </tr>
                  </thead>
                  <tbody><tr>
 @foreach($one as $key => $value)
                @if (is_array($value))  
                @else
                 <td>
                            @if($key == 'bill_id')
                            {{ $value }}
                        @else
                         <?php continue;  ?>
                        @endif    
                        </td>     
               @endif
@endforeach
</tr>
</tbody>
</table> */ ?>
@endif
@endif
          <!-- // end scan bill request -->

          <!-- // start store last 7 days request -->

@if($item->request)
   @if(strstr($item->response, 'store_last_7_days_total'))

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



                   <?php $part = strstr($item->response, '{'); 
                            $part = json_decode($part); ?>
                        @foreach ($part as $key => $value)
                           @if($key == 'code')
                              @if($value == 200)
                              <h4>
                                   {{ __('translations.success_store_last_7_days_total') }}
                                    {{ __('translations.by') }}
                                   {{ $seller_name }} <br><br>
                                 {{ $item->created_at->format('F d, Y h:i a') }}
                               </h4>

                              @else
                              <h4>
                                    {{ __('translations.failed_store_last_7_days_total') }}
                                     {{ __('translations.by') }}
                                   {{ $seller_name }} <br><br>
                                 {{ $item->created_at->format('F d, Y h:i a') }}
                               </h4>
                              @endif
                           @endif
                        @endforeach 
            
            
            @foreach ($part as $key => $value) 
                  @if (is_array($value))
                    
                @else
                  @if ($key == 'total_price_sold')
                   <table class="table table-bordered">
                    <tr>
                      <td> {{ __('translations.'.$key) }} </td> <td> {{ $value}} </td> 
                    </tr>
                 </table>
                  @endif
              @endif
            @endforeach
 
 @endif
@endif
          <!-- // end store last 7 days bill request -->

  <!-- // start store last 7 days history request -->

@if($item->request)
   @if(strstr($item->response, 'store_last_7_days_history'))
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


              <?php $record = $item->response; ?>
              <?php $record = strstr($item->response, '{'); ?>
              <?php  $part   = json_decode($record); ?>

                @foreach ($part as $key => $value)
                           @if($key == 'code')
                              @if($value == 200)
                              <h4>
                                   {{ __('translations.success_store_last_7_days_history') }}
                                    {{ __('translations.by') }}
                                   {{ $seller_name }} <br><br>
                                 {{ $item->created_at->format('F d, Y h:i a') }}
                               </h4>


                              @else
                                  <h4>  {{ __('translations.failed_store_last_7_days_history') }}
                                     {{ __('translations.by') }}
                                    {{ $seller_name }} <br><br>
                                  {{ $item->created_at->format('F d, Y h:i a') }}
                                </h4>


                              @endif
                           @endif
                @endforeach 

             
             <table class="table table-bordered">
            @foreach ($part as $key => $value) 
                  
                    @if ($key == 'day_details')
                    <tr>
                      <td> {{ __('translations.day') }}</td>    
                      <td> {{ __('translations.day_total_price') }}</td>
                      <td></td>
                    </tr>
                     @foreach ($value as $keyy => $prod)<tr>
                        @foreach ($prod as $keyyy => $section)
                       <td>  {{ $section }} </td>
                         @endforeach
                       </tr>
                       @endforeach
                  
                @else
                
              @if ($key != 'apitoken')
              @if($key != 'code' && $key != 'dest' && $key != 'auth_id')
                <tr>
                   <td> {{ __('translations.'.$key) }} </td> <td> {{ $value}} </td> 
                </tr>
              @endif
              @endif
              @endif
            @endforeach
 </table> 
                  
@endif
@endif
          <!-- // end store last 7 days history request -->

<!-- // start check one product request -->

<?php // @if($item->request && strstr($item->url, 'putproduct?')) ?>
@if($item->request)
 @if(strstr($item->response, 'putproduct_dest'))

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
                      

                          <?php $part = strstr($item->response, '{'); 
                                $part = json_decode($part); ?>

                                @foreach ($part as $key => $value)
                                   @if($key == 'code')
                                      @if($value == 200)
                                           <h4> {{ __('translations.success_put_product') }}  {{ __('translations.by') }} 
                                   {{ $seller_name }} <br><br> {{ $item->created_at->format('F d, Y h:i a') }}
                                 </h4>
                                      @else
                                          <h4> {{ __('translations.failed_put_product') }}  {{ __('translations.by') }} 
                                   {{ $seller_name }} <br><br> {{ $item->created_at->format('F d, Y h:i a') }}
                                 </h4>
                                      @endif
                                   @endif

                                   @if($key == 'message')
                                       @if($value !== false && $value !== true)
                                         <tr>
                                          <td> {{ __('translations.'.$key) }}</td>
                                          <td> {{ __('translations.'.$value) }}</td>
                                        </tr>
                                        @endif
                                        @endif
                            
                                @endforeach 

                                <?php $one = json_decode($item->request); ?>
                                <table class="table table-bordered table-striped">
                                  <tr><td style="text-align: center;"> {{__('translations.unique_id')}}</td></tr>
                               <tbody>
                                   @foreach($one as $key => $value)
                                                  @if (is_array($value))  
                                                  @else
                                                          @if ($key == 'code')
                                                                 <tr> 
                                                                    <td style="text-align: center;">{{$value}}</td>
                                                                    </tr>   
                                                          @endif            
                                                 @endif
                                  @endforeach
                                </tbody>
                              </table>

                         @endif
                      @endif
  
          <!-- // end check putproduct -->

          <!-- // start check one product request -->

@if($item->request)
  @if(strstr($item->response, 'getproduct_dest'))

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

                  <?php $part = strstr($item->response, '{'); 
                                $part = json_decode($part); ?>

                                @foreach ($part as $key => $value)
                                   @if($key == 'code')
                                      @if($value == 200)
                                      <h4>
                                      {{ __('translations.success_product_details') }}  {{ __('translations.by') }} 
                                   {{ $seller_name }}<br><br>
                                   {{ $item->created_at->format('F d, Y h:i a') }}
                                   <h4> <br>
                                    @foreach ($part as $key => $value)
                                      @if($key == 'product')
                                      <table class="table table-bordered"> 
                                        <thead> 
                                          <tr> 
                                            <th style="text-align: right;"> {{ __('translations.unique_id') }}</th>
                                          </tr>
                                        </thead>
                                        <tbody>
                                          <tr><td> {{ $value->unique_id }}</td></tr>
                                        </tbody>
                                      </table>
                                      @endif
                                    @endforeach
                                      @else
                                      <h4>
                                        {{ __('translations.failed_product_details') }} {{ __('translations.by') }} 
                                       {{ $seller_name }} <br><br>
                                     {{ $item->created_at->format('F d, Y h:i a') }}
                                   </h4>

                                      @endif
                                      @endif

                                       @if($key == 'message')
                                       @if($value !== false && $value !== true)
                                         <tr>
                                          <td> {{ __('translations.'.$key) }}</td>
                                          <td> {{ __('translations.'.$value) }}</td>
                                        </tr>
                                        @endif
                                        @endif

                                @endforeach 
  @endif
@endif
          <!-- // end check one product request -->

  <!-- // start check seller products request -->

@if($item->request)
   @if(strstr($item->response, 'sellerproducts'))
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

                  <?php $part = strstr($item->response, '{'); 
                            $part = json_decode($part); ?>
                        @foreach ($part as $key => $value)
                           @if($key == 'code')
                              @if($value == 200)
                                <h4>    {{ __('translations.success_products_details') }} 
                                  {{ __('translations.by') }} 
                                    {{ $seller_name }} <br><br>
                                  {{ $item->created_at->format('F d, Y h:i a') }}
                                </h4>
                              @else
                                <h4>    {{ __('translations.failed_products_details') }} 
                                  {{ __('translations.by') }} 
                                   {{ $seller_name }} <br><br>
                                 {{ $item->created_at->format('F d, Y h:i a') }}
                               </h4>
                              @endif
                           @endif
                        @endforeach 


@endif
@endif
          <!-- // end check seller products request -->

<!-- // start check products prices by phone request -->

<?php // @if($item->request && strstr($item->url, 'checkProducts/phone?')) ?>
@if($item->request)
    @if(strstr($item->response, 'productsPhone'))
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

                            <?php $part = strstr($item->response, '{'); 
                            $part = json_decode($part); ?>
                        @foreach ($part as $key => $value)
                           @if($key == 'code')
                            
                              @if($value == 200)
                                 <h4>  {{ __('translations.success_following_chechproducts_phone_details') }}
                                   {{ __('translations.by') }}
                                  {{ $seller_name }} <br><br> {{ $item->created_at->format('F d, Y h:i a') }}
                                </h4><br>
                              @else
                             <h4>   {{ __('translations.failed_following_chechproducts_phone_details') }}
                               {{ __('translations.by') }}
                               {{ $seller_name }} <br><br> {{ $item->created_at->format('F d, Y h:i a') }}
                             </h4>

                              @endif
                           @endif

                           @if($key == 'message')
                                       @if($value !== false && $value !== true)
                                         <tr>
                                          <td> {{ __('translations.'.$key) }}</td>
                                          <td> {{ $value }}</td>
                                        </tr>
                                        @endif
                                        @endif
                        @endforeach  

                        <table class="table table-bordered">
                                  <tr><td> {{ __('translations.unique_id') }}</td></tr>
                                   @foreach($one as $key => $code)
                                                  
                                                  @if (is_array($code)) 
                                                      @foreach($code as $i)
                                                        <tr>
                                                          <td> {{ $i == null ? 'يرجي ادخال كود المنتج' : $i}}</td>
                                                        </tr>
                                                      @endforeach
                                                  @else
                                                          @if ($key != 'api_token')
                                                          @if($key == 'phone')
                                                                  <tr>
                                                                    <td>  {{ __('translations.'.$key) }} </td>
                                                                    <td> {{ $code == null ? 'يرجي ادخال رقم التليفون' : $code}} </td>
                                                                  </tr>
                                                           @endif
                                                          @endif                           
                                                 @endif
                                  @endforeach
                                  </table>                   
@endif
@endif
<!-- // end check products prices by phone request -->

<!-- // start get in progress request -->

<?php // @if($item->request && strstr($item->url, 'checkProducts/phone?')) ?>
@if($item->request)
    @if(strstr($item->response, 'getInProgress'))
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

                            <?php $part = strstr($item->response, '{'); 
                            $part = json_decode($part); ?>
                        @foreach ($part as $key => $value)
                           @if($key == 'code')
                            
                              @if($value == 200)
                                 <h4>  {{ __('translations.success_getInProgress_details') }}
                                   {{ __('translations.by') }}
                                  {{ $seller_name }} <br><br> {{ $item->created_at->format('F d, Y h:i a') }}
                                </h4><br>
                              @else
                             <h4>   {{ __('translations.failed_getInProgress_details') }}
                               {{ __('translations.by') }}
                               {{ $seller_name }} <br><br> {{ $item->created_at->format('F d, Y h:i a') }}
                             </h4>

                              @endif
                           @endif

                           @if($key == 'message')
                                       @if($value !== false && $value !== true)
                                         <tr>
                                          <td> {{ __('translations.'.$key) }}</td>
                                          <td> {{ $value }}</td>
                                        </tr>
                                        @endif
                                        @endif
@endforeach  
  
@foreach ($part as $key => $value)
                        @if($key == 'items') 
                        <table class="table">
                         
                          <thead>
                            <tr>
                              <th style="text-align: right"> {{ __('translations.bill_id') }} </th>
                              <th style="text-align: right"> {{ __('translations.purchase_id') }} </th> 
                             <?php /*
                              <th style="text-align: right"> {{ __('translations.shipmento') }} </th>
                              <th style="text-align: right"> {{ __('translations.use_promo') }} </th> 
                              <th style="text-align: right"> {{ __('translations.purchase_price') }} </th> 
                              <th style="text-align: right"> {{ __('translations.bill_price_without_shipment') }} </th>
                              */ ?>
                              <th style="text-align: right"> {{ __('translations.store') }} </th>
                               <th style="text-align: right"> {{ __('translations.user') }} </th>
                                <th style="text-align: right"> {{ __('translations.created_at') }} </th>
                            </tr>
                          </thead>
                         
                            @foreach($value as $kee => $bv)  
                            <tr>
                             @foreach($bv as $cx => $cxv) 
                             @if($cx != 'bill_products' && $cx != 'shipment' && $cx != 'use_promo' && $cx != 'purchase_price' && $cx != 'bill_price_without_shipment')
                             
                               <td>  {{ $cxv }}</td>
                               @endif
                            
                            @endforeach
                             </tr>
                             @endforeach
                        </table>
                        
                        @endif

                      <?php   /*
                        <td>  {{ $bv->user_name }}</td>
                              <td> {{ $bv->product_name }}</td>
                               <td> {{ $bv->store_name }}</td>
                                <td> {{ $bv->quantity }}</td>
                                <td> {{ $bv->order_status }}</td>
                                <td> {{ $bv->bill_id }}</td>
                                <td> {{ $bv->purchase_id }}</td>
                                <td> {{ $bv->bought_price }}</td>
                                <td> {{ $bv->bill_price_without_shipment }}</td>
                                <td> {{ $bv->created_at }}</td> 
                        */ ?>

 @endforeach                           
@endif
@endif
<!-- // end get in progress request -->

<!-- // start get in progress request -->

<?php // @if($item->request && strstr($item->url, 'checkProducts/phone?')) ?>
@if($item->request)
    @if(strstr($item->response, 'sellerDeliver'))
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

                            <?php $part = strstr($item->response, '{'); 
                            $part = json_decode($part); ?>
                        @foreach ($part as $key => $value)
                           @if($key == 'code')
                            
                              @if($value == 200)
                                 <h4>  {{ __('translations.success_sellerDeliver_details') }}
                                   {{ __('translations.by') }}
                                  {{ $seller_name }} <br><br> {{ $item->created_at->format('F d, Y h:i a') }}
                                </h4><br>
                              @else
                             <h4>   {{ __('translations.failed_sellerDeliver_details') }}
                               {{ __('translations.by') }}
                               {{ $seller_name }} <br><br> {{ $item->created_at->format('F d, Y h:i a') }}
                             </h4>

                              @endif
                           @endif

                           @if($key == 'message')
                                       @if($value !== false && $value !== true)
                                         <tr>
                                          <td> {{ __('translations.'.$key) }}</td>
                                          <td> {{ $value }}</td>
                                        </tr>
                                        @endif
                                        @endif

                                         @if($key == 'bill_id')
                                      
                                         <tr>
                                          <td> {{ __('translations.'.$key) }}</td>
                                          <td> {{ $value }}</td>
                                        </tr>
                                        @endif
                                       

                                         @if($key == 'seller_name')
                                         <tr>
                                          <td> {{ __('translations.'.$key) }}</td>
                                          <td> {{ $value }}</td>
                                        </tr>
                                        @endif
                                       

                                         @if($key == 'store_name')
                                      
                                         <tr>
                                          <td> {{ __('translations.'.$key) }}</td>
                                          <td> {{ $value }}</td>
                                        </tr>
                                        @endif
                                       
@endforeach  
  

@endif
@endif
<!-- // end get in progress request -->

                
            </td> 

            <td>
            
      </tbody>
    </table>
</div>

      </div>

    </div>

  </section>
  

@stop
