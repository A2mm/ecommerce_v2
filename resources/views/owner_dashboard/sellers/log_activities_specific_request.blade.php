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
              <h3 style="color:green"> &nbsp; {{ __('translations.request') }}</h3>

                     <?php $bill   = strstr($item->url, '='); 
                           $bill   = trim($bill, '=');
                     ?>
                    <?php $one = json_decode($item->request); ?>
                       <table class="table table-bordered" id="vendors" style="font-size: 11px;">
                        <thead>
                          <tr>
                            <td>{{__('translations.name')}}</td>
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

                     @if($item->request && strstr($item->url, 'customer/register'))
       <h3 style="color:green"> &nbsp; {{ __('translations.request') }}</h3>

                    <?php $one = json_decode($item->request); ?>
                       <table class="table table-bordered" id="vendors" style="font-size: 11px;">
                        <thead>
                          <tr>
        
                            <td>{{__('translations.name')}}</td>
                            <td>{{__('translations.phone')}}</td>
                            <td>{{__('translations.usertype')}}</td>
        
                          </tr>
                        </thead>
                        <tbody>    
                        <tr>                    
                    @foreach($one as $key => $value)
                      @if(is_array($value))
                      @else
                      <td> @if($key == 'usertype_id') 
                        <?php $usertype = App\Usertype::where('id', $value)->first(); 
                          if($usertype) { $user_type = $usertype->name; } else { $user_type = '___'; }
                        ?> 
                        {{ $user_type}}
                        @else 
                        {{ $value }}
                        @endif
                      </td> 
                      @endif
                    @endforeach
                  </tr>
                  </tbody>
                </table>

                @endif
                <?php // end customer register request  ?> 

                <?php // start seller history request  ?>  
                
              

                     @if($item->request && strstr($item->url, 'history') && !strstr($item->url, 'history/invoice') && !strstr($item->url, 'store/last/7/days/history'))
                   <h3 style="color:green;"> {{ __('translations.request') }}</h3>
                    <?php $one = json_decode($item->request); ?>
                       <table class="table table-bordered" id="vendors" style="font-size: 11px;">
                        <thead>
                          <tr>
                            <td>{{__('translations.seller')}}</td>
                            <td>{{__('translations.per_page')}}</td>
                          </tr>
                        </thead>
                        <tbody>    
                        <tr>                    
                    @foreach($one as $key => $value)
                      @if(is_array($value))
                      @else
                      <td> 
                        @if($key == 'api_token')
                              <?php $seller = App\Seller::where('api_token', $value)->first(); ?>
                                  @if (!$seller)
                                    <?php $seller_name =  __('translations.unauthorized_seller'); ?>
                                    @else
                                    <?php  $seller_name = $seller->name; ?>
                                  @endif
                                  {{ $seller_name }}
                        @else
                        {{ $value }} 
                        @endif
                      </td>
                      @endif
                    @endforeach
                  </tr>
                  </tbody>
                </table>

                @endif
                <?php // end seller history request  ?> 

                <?php // start seller history invoice request  ?> 

                     @if($item->request && strstr($item->url, 'history/invoice'))
        <h3 style="color:green;"> {{ __('translations.request') }}</h3>
                    <?php $one = json_decode($item->request); ?>
                       <table class="table table-bordered" id="vendors" style="font-size: 11px;">
                        <thead>
                          <tr>
                            <td>{{__('translations.seller')}}</td>
                          </tr>
                        </thead>
                        <tbody>                        
                    @foreach($one as $key => $value)
                      @if (is_array($value))  
                @else
                        @if ($key == 'api_token')
                                <tr>
                                 
                                  <?php $seller = App\Seller::where('api_token', $value)->first(); ?>
                                  @if (!$seller)
                                    <?php $seller_name =  __('translations.unauthorized_seller'); ?>
                                    @else
                                    <?php  $seller_name = $seller->name; ?>
                                  @endif
                                  <td> {{ $seller_name }} </td>
                                </tr>
                        @endif                               
               @endif
               @endforeach
             </tbody>
           </table>
               @endif
                <?php // end store last 10 days request  ?> 

                <?php // start store last 10 days request  ?> 

                     @if($item->request && strstr($item->url, 'store/last/10/days'))
       <h3 style="color:green"> &nbsp; {{ __('translations.request') }}</h3>

                    <?php $one = json_decode($item->request); ?>
                       <table class="table table-bordered" id="vendors" style="font-size: 11px;">
                        <thead>
                          <tr>
                            <td>{{__('translations.seller')}}</td>
                          </tr>
                        </thead>
                        <tbody>                        
                    @foreach($one as $key => $value)
                      @if (is_array($value))  
                @else
                        @if ($key == 'api_token')
                                <tr>
                                 
                                  <?php $seller = App\Seller::where('api_token', $value)->first(); ?>
                                  @if (!$seller)
                                    <?php $seller_name =  __('translations.unauthorized_seller'); ?>
                                    @else
                                    <?php  $seller_name = $seller->name; ?>
                                  @endif
                                  <td> {{ $seller_name }} </td>
                                </tr>
                        @endif                               
               @endif
               @endforeach
             </tbody>
           </table>
               @endif
                <?php // end store last 10 days request  ?> 

              <!-- // start refund request -->

            @if($item->request && strstr($item->url, 'refund'))
            <h3 style="color:green"> &nbsp; {{ __('translations.request') }}</h3>

                <?php $one = json_decode($item->request); ?>

                <table class="table table-bordered">
                  <tr>
                  <td> {{ __('translations.code') }}</td>
                  <td> {{ __('translations.quantity') }}</td>
                </tr>
               @foreach($one as $key => $value)
               @if($key != 'api_token')
               <tr>
                      @if (is_array($value)) 
                        @if ($key == 'refunds') 
                           @foreach($value as $i)
                              <td> {{ $i->unique_id }}</td>
                              <td> {{ $i->quantity }}</td>
                           @endforeach
                        @endif
               
                      @else
                      
                        <td> {{ __('translations.'.$key) }}</td> <td> {{ $value }}</td>
                      
                      @endif
                       </tr>
                      @endif
              @endforeach
            </table>
            @endif

          <!-- // end refund request -->

          <!-- // start checkout request -->

            @if($item->request && strstr($item->url, 'checkout'))
            <h3 style="color:green"> &nbsp; {{ __('translations.request') }}</h3>

                <?php $one =  json_decode($item->request); ?>
        
                 @foreach($one as $key => $value)
                
                        @if (is_array($value)) 
                            @if ($key = 'codes') 
                             <table class="table table-bordered">
                                <tr>
                                <td> {{ __('translations.code') }}</td>
                                <td> {{ __('translations.quantity') }}</td>
                              </tr>
                              @foreach($value as $i)
                              <tr>
                                  <td> {{$i->code}}</td>
                                  <td> {{ $i->quantity }}</td>
                                </tr>
                              @endforeach
                              </table>  
                            @endif
                
                        @else
                  
                            @if ($key != 'api_token')
                            {{ __('translations.'.$key) }} {{ $value }} <br>
                            @endif
                          
                       @endif
                  @endforeach
            @endif

          <!-- // end checkout request -->

          <!-- // start getProductsPrices request -->

            @if($item->request && strstr($item->url, 'checkProducts') && !strstr($item->url, 'checkProducts/phone?') && !strstr($item->url, 'products?'))
            <h3 style="color:green"> &nbsp; {{ __('translations.request') }}</h3>

                <?php $one = json_decode($item->request); ?>

 @foreach($one as $key => $value)

                @if (is_array($value)) 
                      @if ($key = 'codes')
                      <table class="table table-bordered">
                      <tr>
                      <td> {{ __('translations.code') }}</td>
                    </tr> 
                         @foreach($value as $i)
                            <tr><td> {{ $i }}</td></tr>
                         @endforeach
                       </table>
                      @endif
                
                @else
                        @if ($key != 'api_token')
                          {{ $key }} {{ $value }}
                        @endif
                  
               @endif
                  
@endforeach
@endif
          <!-- // end getProductsPrices request -->

          <!-- // start login request -->

@if($item->request && strstr($item->url, 'login?'))
   <h3 style="color:green"> &nbsp; {{ __('translations.request') }}</h3>
                <?php $one = json_decode($item->request); ?>

                <table class="table table-bordered">
 @foreach($one as $key => $value)
                @if (is_array($value))  
                @else
                        @if ($key != 'api_token')
                                <tr>
                                  <td>  {{ __('translations.'.$key) }} </td>
                                  <td> {{ $value }} </td>
                                </tr>
                        @endif                            
               @endif
@endforeach
</table>
@endif
          <!-- // end login request -->

      <!-- // start scan bill request -->

@if($item->request && strstr($item->url, 'scan/bill?'))
<h3 style="color:green"> &nbsp; {{ __('translations.request') }}</h3>

                <?php $one = json_decode($item->request); ?>

                <table class="table table-bordered">
                  <thead>
                    <tr>
                      <td> {{ __('translations.bill_id') }} </td>
                      <td> {{ __('translations.seller') }}</td>
                    </tr>
                  </thead>
                  <tbody><tr>
 @foreach($one as $key => $value)
                @if (is_array($value))  
                @else
                 <td>
                            @if($key == 'api_token')
                           
                              <?php $seller = App\Seller::where('api_token', $value)->first(); ?>
                                  @if (!$seller)
                                    <?php $seller_name =  __('translations.unauthorized_seller'); ?>
                                    @else
                                    <?php  $seller_name = $seller->name; ?>
                                  @endif
                                  {{ $seller_name }}
                        @else
                        {{ $value }} 
                        @endif    
                        </td>     
               @endif
@endforeach
</tr>
</tbody>
</table>
@endif
          <!-- // end scan bill request -->

          <!-- // start store last 7 days request -->

@if($item->request && strstr($item->url, 'store/last/7/days') && !strstr($item->url, 'store/last/7/days/history?'))
<h3 style="color:green"> &nbsp; {{ __('translations.request') }}</h3>

                <?php $one = json_decode($item->request); ?>

                <table class="table table-bordered">
 @foreach($one as $key => $value)
                @if (is_array($value))  
                @else
                        @if ($key == 'api_token')
                                <tr>
                                  <td>  {{ __('translations.seller_name') }} </td>
                                  <?php $seller = App\Seller::where('api_token', $value)->first(); ?>
                                  @if (!$seller)
                                    <?php $seller_name =  __('translations.unauthorized_seller'); ?>
                                    @else
                                    <?php  $seller_name = $seller->name; ?>
                                  @endif
                                  <td> {{ $seller_name }} </td>
                                </tr>
                        @endif                               
               @endif
@endforeach
</table>
@endif
          <!-- // end store last 7 days bill request -->

  <!-- // start store last 7 days history request -->

@if($item->request && strstr($item->url, 'store/last/7/days/history?'))
<h3 style="color:green"> &nbsp; {{ __('translations.request') }}</h3>

                <?php $one = json_decode($item->request); ?>

                <table class="table table-bordered">
 @foreach($one as $key => $value)
                @if (is_array($value))  
                @else
                        @if ($key == 'api_token')
                                <tr>
                                  <td>  {{ __('translations.seller_name') }} </td>
                                  <?php $seller = App\Seller::where('api_token', $value)->first(); ?>
                                  @if (!$seller)
                                    <?php $seller_name =  __('translations.unauthorized_seller'); ?>
                                    @else
                                    <?php  $seller_name = $seller->name; ?>
                                  @endif
                                  <td> {{ $seller_name }} </td>
                                </tr>
                        @endif                               
               @endif
@endforeach
</table>
@endif
          <!-- // end store last 7 days history request -->

          <!-- // start check one product request -->

@if($item->request && strstr($item->url, 'product?') && !strstr($item->url, 'products?'))
<h3 style="color:green"> &nbsp; {{ __('translations.request') }}</h3>

                <?php $one = json_decode($item->request); ?>

                <table class="table table-bordered">
 @foreach($one as $key => $value)
                @if (is_array($value))  
                @else
                        @if ($key != 'api_token')
                                <tr>
                                  <td>  {{ __('translations.'.$key) }} </td>
                                  <td> {{ $value }} </td>
                                </tr>
                        @endif                            
               @endif
@endforeach
</table>
@endif
          <!-- // end check one product request -->

  <!-- // start check seller products request -->

@if($item->request && strstr($item->url, 'products?') && !strstr($item->url, 'checkProducts') && !strstr($item->url, 'checkProducts') && !strstr($item->url, 'product?'))
<h3 style="color:green"> &nbsp; {{ __('translations.request') }}</h3>

                <?php $one = json_decode($item->request); ?>

                <table class="table table-bordered">
 @foreach($one as $key => $value)
                @if (is_array($value))  
                @else
                        @if ($key == 'api_token')
                                <tr>
                                  <td>  {{ __('translations.seller_name') }} </td>
                                  <?php $seller = App\Seller::where('api_token', $value)->first(); ?>
                                  @if (!$seller)
                                    <?php $seller_name =  __('translations.unauthorized_seller'); ?>
                                    @else
                                     <?php  $seller_name = $seller->name; ?>
                                  @endif
                                  <td> {{ $seller_name }} </td>
                                </tr>
                        @endif                            
               @endif
@endforeach
</table>
@endif
          <!-- // end check seller products request -->

<!-- // start check products prices by phone request -->

@if($item->request && strstr($item->url, 'checkProducts/phone?'))
<h3 style="color:green"> &nbsp; {{ __('translations.request') }}</h3>
                <?php $one = json_decode($item->request); ?>

                <table class="table table-bordered">
                  <tr><td> {{ __('translations.code') }}</td></tr>
 @foreach($one as $key => $code)
                
                @if (is_array($code)) 
                    @foreach($code as $i)
                      <tr>
                        <td> {{ $i }}</td>
                      </tr>
                    @endforeach
                @else
                        @if ($key != 'api_token')
                                <tr>
                                  <td>  {{ __('translations.'.$key) }} </td>
                                  <td> {{ $code }} </td>
                                </tr>
                        @endif                            
               @endif
@endforeach
</table>
@endif

<!-- // end check products prices by phone request -->

                
            </td> 

            <td>

              <?php // start search with bill response  ?> 

                     @if($item->request && strstr($item->url, 'search/with/bill'))
                     <h3 style="color:green"> &nbsp; {{ __('translations.response') }}</h3>
                     <?php $bill   = strstr($item->url, '='); 
                           $bill   = trim($bill, '=');
                     ?>
                    <?php $one = json_decode($item->request); ?>
                       <table class="table table-bordered" id="vendors" style="font-size: 11px;">
                        <thead>
                          <tr>
                                @if(App\History::where('bill_id', $bill)->first()) 
                                  <td> {{ __('translations.bill_totalprice') }} </td>
                                @else 
                                   <td> {{ __('translations.error') }}</td>  
                                @endif  
                          </tr>
                        </thead>
                        <tbody>    
                        <tr>                    
                    @foreach($one as $key => $value)
                      @if(is_array($value))
                      @else
                      <td> 
                               <?php 
                                     $bill_total = App\History::where('bill_id', $value)
                                                              ->sum('price'); 
                                ?>  {{ $bill_total > 0 ? $bill_total .' '. __('translations.egp') : __('translations.wrong_bill_id') }}
                      </td> 
                      @endif
                    @endforeach
                  </tr>
                  </tbody>
                </table>

                @endif
                <?php // end search with bill response  ?> 

              <?php // start seller history invoice response ?>  

              @if($item->response && strstr($item->url, 'history/invoice'))
              <h3 style="color:green;"> {{ __('translations.response') }}</h3>

                      <?php $record = strstr($item->response, '{'); ?>
                      <?php $part = json_decode($record); ?>
                      @if(!strstr($item->response, 'message'))
                    <?php /*  <table class="table table-bordered"> 
                        <thead>
                          <tr>
                            <td> {{ __('translations.user_name') }} </td>
                            <td> {{ __('translations.product_name') }} </td>
                            <td> {{ __('translations.unique_id') }} </td>
                            <td> {{ __('translations.quantity') }} </td>
                            <td> {{ __('translations.price') }} </td>
                            <td> {{ __('translations.bill_id') }} </td>
                            <td> {{ __('translations.refunded') }} </td>
                            <td> {{ __('translations.sellerdiscount') }} </td>
                            <td> {{ __('translations.created_at') }} </td>
                          </tr>
                        </thead> */ ?>
                        <tbody>
                          @else
                          <table class="table table-bordered"> 
                            <tbody>
                          @endif
                       @foreach ($part as $key => $value)
                         @if($key == 'histories')
                        <h4> 
                          {{ __('translations.seller_successfully_viewd_his_history') }}
                        </h4>
                        <?php /*   @foreach ($value as $index => $history)
                            <?php // <tr><td> {{ $index }} </td> </tr> ?>
                              @foreach($history as $keyy => $rec) 
                                <tr> 
                                    <?php $user = App\User::where('id', $rec->user_id)->first(); 
                                              if(!$user) { $user_name = __('translations.unregistered_client'); }
                                              else { $user_name = $user->name; }
                                    ?>  

                                  <td> {{ $user_name }} </td> 
                                  <td> {{ $rec->product_name }} </td>
                                  <td> {{ $rec->product_unique_id }} </td>
                                  <td> {{ $rec->quantity }} </td>
                                  <td> {{ $rec->price }} {{ __('translations.egp') }}</td>
                                  <td> {{ $rec->bill_id }} </td>
                                  <td> {{ $rec->refunded > 0 ? $rec->refunded : '___' }} </td>
                                  <td> {{ $rec->sellerdiscount > 0 ? $rec->sellerdiscount. ' % ' : __('translations.no_seller_discount') }} </td>
                                  <td> {{ $rec->created_at }} </td>
                                </tr>
                              @endforeach
                           @endforeach */ ?>
                          @else
                            @if($key != 'code')
                          <tr> <td> {{ __('translations.'.$key) }}</td> <td> {{ $value }}</td></tr>
                           @endif
                         @endif

                       @endforeach
          </tbody>
          </table>
          @endif
                      
                <?php // end seller history invoice response  ?>

              <?php // start customer register response ?>  

              @if($item->response && strstr($item->url, 'customer/register'))
              <h3 style="color:green"> &nbsp; {{ __('translations.response') }}</h3>
                      <?php $record = strstr($item->response, '{'); ?>
                      <?php $part = json_decode($record); ?>
                      <table class="table table-bordered"> 
                       @foreach ($part as $key => $value)
                         @if($key == 'error')
                           @foreach ($value as $index => $history)
                             <tr><td> {{ __('translations.'.$index) }} </td>
                              @foreach($history as $keyy => $rec) 
                                <td> {{ $rec }} </td>
                              @endforeach
                           @endforeach
                          @else
                          <tr> <td> {{ __('translations.'.$key) }}</td> <td> {{ $value }}</td></tr>
                         @endif

                       @endforeach
            </tr>
          </table>
          @endif
                      
                <?php // end customer register response  ?>

                  <?php // start seller history response ?>  

              @if($item->response && strstr($item->url, 'history') && !strstr($item->url, 'history/invoice') && !strstr($item->url, 'store/last/7/days/history'))
             
              <h3 style="color:green"> &nbsp; {{ __('translations.response') }}</h3>
              
             
                      <?php $record = strstr($item->response, '{'); ?>
                      <?php $record = json_decode($record); ?>
                      
                      @if(!strstr($item->response, 'message'))
                   <table class="table table-bordered" style="font-size: 11px;">
                      <?php /*  <thead>
                          <tr>
                            <td>{{__('translations.user_name')}}</td>
                            <td>{{__('translations.product_name')}}</td>
                            <td>{{__('translations.unique_id')}}</td>
                            <td>{{__('translations.quantity')}}</td>
                            <td>{{__('translations.price')}}</td>
                            <td>{{__('translations.refunded')}}</td>
                            <td>{{__('translations.bill_id')}}</td>
                            <td>{{__('translations.item_price')}}</td>
                            <td>{{__('translations.total_price')}}</td>
                            <td>{{__('translations.created_at')}}</td>
                            <td>{{__('translations.order_status')}}</td>
                          </tr>
                        </thead> */ ?>
                        <tbody> {{ __('translations.seller_successfully_viewd_his_history') }}</tbody>
                        </table>
                  @else
                         <table class="table table-bordered" style="font-size: 11px;">
                        <thead></thead>
                        <tbody>                    
                  @endif

 
                      @foreach($record as $key => $value)
                      
                         @if($key == 'histories') <?php /*
                            @foreach ($value as $index => $history)
                               @if($index == 'data')
                                  <?php // $hist = $history; ?>
                                     @foreach($history as $keyy => $rec)
                                      
                                          
                                             <tr>
                                              <?php $user = App\User::where('id', $rec->user_id)->first(); 
                                              if(!$user) { $user_name = __('translations.unregistered_client'); }
                                              else { $user_name = $user->name; }
                                              ?> 

                                            <td>{{ $user_name }}</td>
                                            <td>{{ $rec->product_name }}</td>
                                            <td>{{ $rec->product_unique_id }}</td>
                                            <td>{{ $rec->quantity }}</td>
                                            <td>{{ $rec->price }} {{ __('translations.egp')}}</td>
                                            <td>{{ $rec->refunded != null ? $rec->refunded : '____' }}</td>
                                            <td>{{ $rec->bill_id }}</td>
                                            <td>{{ $rec->item_price }}</td>
                                            <td>{{ $rec->total_price }}</td>
                                            <td>{{ $rec->order_status }}</td>
                                            <td>{{ $rec->created_at }}</td>
                                            
                                             
                                      </tr>
                                     @endforeach
                               @endif
                            @endforeach
                      */?>
                         @else
                           @if($key != 'code')
                           <tr> <td> {{ __('translations.'.$key) }}</td> <td> {{ $value }} </td> </tr>
                            @endif
                         @endif
                      @endforeach

                    </tbody>
                  </table>
              @endif
             
             
                <?php // end seller history response  ?>

              <?php // start store last 10 days response  ?>  

              @if($item->response && strstr($item->url, 'store/last/10/days'))
              <h3 style="color:green"> &nbsp; {{ __('translations.response') }}</h3>
                  <?php  $record = strstr($item->response, '{'); ?>
                  <?php  $record = json_decode($record); ?>       
                  @if(!strstr($item->response, 'message'))
                  <table class="table table-bordered" style="font-size: 11px;">
                        <thead>
                          <tr>
                            <td>{{__('translations.product_name')}}</td>
                            <td>{{__('translations.unique_id')}}</td>
                            <td>{{__('translations.store')}}</td>
                            <td>{{__('translations.quantity')}}</td>
                            <td>{{__('translations.shiporder_id')}}</td>
                            <td>{{__('translations.reason')}}</td>
                            <td>{{__('translations.created_at')}}</td>
                          </tr>
                        </thead>
                        <tbody> 
                  @else
                         <table class="table table-bordered" style="font-size: 11px;">
                        <thead></thead>
                        <tbody>                    
                  @endif
                      @foreach($record as $key => $value)  
                          
                          @if (is_array($value))
                               @if($key == 'details')
                                 @foreach ($value as $index => $prod)
                                  <tr> 
                                      <td> {{ $prod->product_name }}</td>
                                      <td> {{ $prod->product_unique_id }}</td>
                                      <td> {{ $prod->store_name }}</td>
                                      <td> {{ $prod->quantity }}</td>
                                      <td> {{ $prod->shiporder_id }}</td>
                                      <td> {{ $prod->reason }}</td>
                                      <td> {{ $prod->created_at }}</td>
                                  </tr>
                                  @endforeach
                              @endif
                           @else
                                  @if ($key != 'code')
                                   <tr>
                                     <td> {{ __('translations.'.$key) }} </td>  <td> {{ $value }}  </td>
                                   </tr>
                                  @endif
                           @endif
                      @endforeach
                      </tbody>
                      </table> 
              @endif 
                <?php // end store last 10 days response ?> 

              <?php //  start store last 7 days response ?>

              @if($item->response && strstr($item->url, 'store/last/7/days') && 
              !strstr($item->url, 'store/last/7/days/history?'))
              <h3 style="color:green"> &nbsp; {{ __('translations.response') }}</h3>
              <?php $record = $item->response; ?>
              <?php $record = strstr($item->response, '{'); ?>
             <?php  $part   = json_decode($record); ?>
             
             <table class="table table-bordered">
            @foreach ($part as $key => $value) 
                  @if (is_array($value))
                    
                @else
              @if ($key != 'apitoken')
              @if($key != 'code')
                <tr>
                   <td> {{ __('translations.'.$key) }} </td> <td> {{ $value}} </td>
                </tr>
              @endif
              @endif
              @endif
            @endforeach
 </table>
            @endif
            
               <?php //  end store last 7 days response ?>

   <?php //  start store last 7 days history response ?>

              @if($item->response && strstr($item->url, 'store/last/7/days/history?'))
              <h3 style="color:green"> &nbsp; {{ __('translations.response') }}</h3>
              <?php $record = $item->response; ?>
              <?php $record = strstr($item->response, '{'); ?>
             <?php  $part   = json_decode($record); ?>
             
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
              @if($key != 'code')
                <tr>
                   <td> {{ __('translations.'.$key) }} </td> <td> {{ $value}} </td>
                </tr>
              @endif
              @endif
              @endif
            @endforeach
 </table>
            @endif
            
               <?php //  end store last 7 days history response ?>

              <?php //  start login response ?>
             

              @if($item->response && strstr($item->url, 'login'))
                <h3 style="color:green"> &nbsp; {{ __('translations.response') }}</h3>
              <?php $record = $item->response; ?>
              <?php $record = strstr($item->response, '{'); ?>
             <?php  $part   = json_decode($record); ?>
             
             <table class="table table-bordered">
            @foreach ($part as $key => $value) 
                  @if ($key == 'error')
                    @foreach ($value as $index => $history)
                       @foreach($history as $keyy => $rec)
                       <tr><td> {{ $rec }}</td></tr>
                       @endforeach
                    @endforeach
                @else
              @if ($key != 'apitoken')
              @if($key != 'code')
               
                <tr>
                   <td> {{ __('translations.'.$key) }} </td> <td> {{ $value }} </td>
                </tr>
            
               @endif
              @endif
              @endif
            @endforeach
 </table>
            @endif
            
               <?php //  end login response ?>

   <?php //  start seller products response ?>

@if($item->response && strstr($item->url, 'products?') && !strstr($item->url, 'checkProducts') && !strstr($item->url, 'checkProducts/phone') && !strstr($item->url, 'product?'))

  <h3 style="color:green"> &nbsp; {{ __('translations.response') }}</h3>

              <?php $record = $item->response; ?>
              <?php $record = strstr($item->response, '{'); ?>
             <?php  $part   = json_decode($record); ?>
             
             @if(!strstr($item->response, 'message'))
             <table class="table table-bordered"><thead><tr>
                            <td>{{__('translations.unique_id')}}</td>
                            <td>{{__('translations.product_name')}}</td>
                            <td>{{__('translations.category')}}</td>
                            <td>{{__('translations.subcategory')}}</td>
                            <td>{{__('translations.price')}}</td>  
                            <td>{{__('translations.discount')}}</td>
                            <td>{{__('translations.quantity')}}</td>
                            <td>{{__('translations.weight')}}</td>
                                                      
                        </tr>
                      </thead><tbody>
                        @else
                        <table class="table table-bordered"><thead>
                      </thead><tbody>
            @endif
           
            @foreach ($part as $key => $value)
             @if($key != 'code') 
                  @if ($key == 'products')
                    @foreach ($value as $keyy => $result)

                    <tr>
                       <?php $category = App\Category::where('id', $result->category_id)->first(); ?> 
                        <?php if ($category) { $category_name = $category->name; } ?>
                         <?php $subcategory = App\Subcategory::where('id', $result->subcategory_id)->first(); ?> 
                        <?php if ($subcategory) { $subcategory_name = $subcategory->name; } ?>
                     <?php /* @foreach ($result as $index => $product)
                           
                           @if ($index == 'product_store_quantities')
                               <?php continue; ?>
                           @else
                              @if($product == 'id' || $product == 'status' || $product == 'slug' || $product == 'num_of_orders' || $product == 'deleted_at' || $product == 'archive')
                              <?php continue; ?>
                              @else
                                   <td> {{ $product }} </td>
                              @endif
                           
                           @endif

                     @endforeach */ ?>
                     <tr>  
                      <td> {{ $result->unique_id}} </td>
                      <td> {{ $result->name  }} </td>
                      <td> {{ $category_name }} </td>
                      <td> {{ $subcategory_name }} </td>
                      <td> {{ $result->price }} </td>
                      <td> {{ $result->discount > 0 ? $result->discount :  __('translations.no_discount') }} </td>
                      <td> {{ $result->quantity }} </td>
                      @if($result->weight > 0)
                       <td> {{$result->weight }} </td>
                       @else
                         <td> {{ __('translations.no_weight') }}</td>
                      @endif
                     
                     </tr>
                   @endforeach 

                   @else
                   <tr>
                      <td> {{ __('translations.'.$key)}} </td>
                      <td> {{ $value }} </td>
                   </tr>
                    
              @endif
          @endif         
          @endforeach 

           </tbody>
               </table>
                
@endif
            
               <?php //  end seller products response ?>


    <?php //  start scan bill response ?>

              @if($item->response && strstr($item->url, 'scan/bill?'))
                <h3 style="color:green"> &nbsp; {{ __('translations.response') }}</h3>
              <?php $record = $item->response; ?>
              <?php   $record = strstr($item->response, '{'); ?>
             <?php  $part = json_decode($record); ?>
             @if(!strstr($item->response, 'message'))
             <table class="table table-bordered"><thead><tr>
                            <td>{{__('translations.product_name')}}</td>
                            <td>{{__('translations.unique_id')}}</td>
                            <td>{{__('translations.price')}}</td>
                            <td>{{__('translations.order_status')}}</td>
                            <td>{{__('translations.quantity')}}</td>
                            <td>{{__('translations.refunded')}}</td>
                            <td>{{__('translations.user_name')}}</td>
                        </tr>
                      </thead><tbody>
                        @else
                        <table class="table table-bordered"><thead>
                      </thead><tbody>
            @endif
            @foreach ($part as $key => $value) 
                  @if ($key == 'bill_products')
                  @if($key != 'code')
                   
                    @foreach ($value as $keyy => $result)
                       <?php $user    = App\User::where('id', $result->user_id)->first(); ?> 
                        <?php if ($user) { $user_name = $user->name; }else
                        { $user_name = __('translations.uregistered_client');} ?>
                        <?php $product = App\Product::where('id', $result->product_id)->first(); ?> 
                        <?php if ($product) { $product_name = $product->name; } ?>
                    <tr>
                    <td> {{ $product_name }} </td>
                    <td> {{ $result->product_unique_id }} </td>
                    <td> {{ $result->price }} {{__('translations.egp')}}</td>
                    <td> {{ $result->order_status }} </td>
                    <td> {{ $result->quantity }} </td>
                    <td> {{ $result->refunded != null ? $result->refunded : 0 }}</td>
                    <td> {{ $user_name }}</td>
                  </tr>
                   @endforeach
                   @endif
                 @else
                  @if($key != 'code')
                 <tr>
                      <td> {{ __('translations.'.$key) }}</td>
                      <td> {{ $value }}</td>
                </tr>
                @endif
              @endif
            @endforeach 
           </tbody>
               </table>
                
            @endif
            
               <?php //  end scan bill response ?>

               <?php //  start getProducts Prices phone response ?>

              @if($item->response && strstr($item->url, 'checkProducts/phone?'))
              <h3 style="color:green"> &nbsp; {{ __('translations.response') }}</h3>

              <?php $record = $item->response; ?>
              <?php   $record = strstr($item->response, '{'); ?>
             <?php  $part = json_decode($record); ?>
             @if(!strstr($item->response, 'message'))
             <table class="table table-bordered"><thead><tr>
                            <td>{{__('translations.product_name')}}</td>
                            <td>{{__('translations.unique_id')}}</td>
                            <td>{{__('translations.price')}}</td>
                            <td>{{__('translations.discount')}}</td>
                            <td>{{__('translations.price_after_discount')}}</td>
                            <td>{{__('translations.quantity')}}</td>
                            <td>{{__('translations.user_type')}}</td>
                            <td>{{__('translations.user_price')}}</td>
                        </tr>
                      </thead><tbody>
                        @else
                        <table class="table table-bordered"><thead>
                      </thead><tbody>
            @endif
            @foreach ($part as $key => $value) 
                  @if ($key == 'products')
                  @if($key != 'code')
                   
                    @foreach ($value as $keyy => $product)
                    <tr>
                    <td> {{ $product->name }} </td>
                    <td> {{ $product->unique_id }} </td>
                    <td> {{ $product->price }}</td>
                    <td> {{ $product->discount }} </td>
                    <td> {{ $product->price_after_discount }} </td>
                    <td> {{ $product->quantity }}</td>
                    <td> {{ $product->user_type }}</td>
                    <td> {{ $product->user_price }}</td>
                  </tr>
                   @endforeach
                   @endif
                 @else
                  @if($key != 'code')
                 <tr>
                      <td> {{ __('translations.'.$key) }}</td>
                      <td> {{ $value }}</td>
                </tr>
                @endif
              @endif
            @endforeach 
           </tbody>
               </table>
                
            @endif
            
               <?php //  end getProducts Prices phone response ?>

               <?php //  start get Product response ?>

              @if($item->response && strstr($item->url, 'product') && !strstr($item->url, 'checkProducts/phone?') && !strstr($item->url, 'checkProducts') && !strstr($item->url, 'products?'))
                <h3 style="color:green"> &nbsp; {{ __('translations.response') }}</h3>
              <?php $record = $item->response; ?>
              <?php   $record = strstr($item->response, '{'); ?>
             <?php  $part = json_decode($record); ?>
             
            @foreach ($part as $key => $value) 
                  @if ($key == 'product')
                   <table class="table table-bordered"><thead><tr>
                            <td>{{__('translations.product_name')}}</td>
                            <td>{{__('translations.unique_id')}}</td>
                            <td>{{__('translations.price')}}</td>
                            <td>{{__('translations.discount')}}</td>
                            <td>{{__('translations.price_after_discount')}}</td>
                            <?php // <td>{{__('translations.currency')}}</td> ?>
                            <td>{{__('translations.quantity')}}</td>
                        </tr>
                      </thead><tbody>
                        <tr>
                    @foreach ($value as $keyy => $product)
                    @if($keyy == 'product_store_quantities')
                    <?php break; ?>
                    @else
                        @if($keyy == 'currency')
                        <?php continue; ?>
                        @else
                          <td> {{ $product }} </td>
                        @endif
                          
                    @endif
                   @endforeach
                    </tr>
                 </tbody>
               </table>
                @else
              @if ($key != 'created_at')
              @if($key != 'code')
                {{ $value }}
              @endif
              @endif
              @endif
            @endforeach

            @endif
            
               <?php //  end get Product response ?>

              <?php //  start getProductsPrices response ?>

              @if($item->response && strstr($item->url, 'checkProducts') && !strstr($item->url, 'checkProducts/phone?'))
                <h3 style="color:green"> &nbsp; {{ __('translations.response') }}</h3>
              <?php $record = $item->response; ?>
              <?php   $record = strstr($item->response, '{'); ?>
             <?php  $part = json_decode($record); ?>
             
            @foreach ($part as $key => $value) 
                  @if ($key == 'products')
                   <table class="table table-bordered"><thead><tr>
                            <td>{{__('translations.product_name')}}</td>
                            <td>{{__('translations.unique_id')}}</td>
                            <td>{{__('translations.price')}}</td>
                            <td>{{__('translations.discount')}}</td>
                            <td>{{__('translations.price_after_discount')}}</td>
                            <td>{{__('translations.quantity')}}</td>
                        </tr>
                      </thead><tbody>
                    @foreach ($value as $keyy => $product)
                    <tr>
                    <td> {{ $product->name }} </td>
                    <td> {{ $product->unique_id }} </td>
                    <td> {{ $product->price }}</td>
                    <td> {{ $product->discount }} </td>
                    <td> {{ $product->price_after_discount }} </td>
                    <td> {{ $product->quantity }}</td>
                  </tr>
                   @endforeach
                 </tbody>
               </table>
                @else
              @if ($key != 'created_at')
              @if($key != 'code')
                {{ $value }}
              @endif
              @endif
              @endif
            @endforeach

            @endif
            
               <?php //  end getProductsPrices response ?>

                <?php //  start refund response ?>

              @if($item->response && strstr($item->url, 'refund'))
                @if (strstr($item->response, '"refunded_at"'))
                  <h3 style="color:green"> &nbsp; {{ __('translations.response') }}</h3>
                  <?php $one = json_decode($item->request); ?>
                  <?php $bill_id = $one->bill_id; ?>
                  <?php  $results = App\History::where('bill_id', $bill_id)
                                           ->where('refunded', '<', 0)
                                           ->get(); ?>
                    <table class="table table-bordered"><thead><tr>
                            <td>{{__('translations.user_name')}}</td>
                            <td>{{__('translations.product_name')}}</td>
                            <td>{{__('translations.refunded')}}</td>
                            <td>{{__('translations.order_status')}}</td>
                            <td>{{__('translations.price')}}</td>
                            <td>{{__('translations.store_name')}}</td>
                            <td>{{__('translations.seller_name')}}</td>
                            <td>{{__('translations.created_at')}}</td>
                        </tr>
                      </thead><tbody>
                        @foreach($results as $result)
                        
                        <?php $user    = App\User::where('id', $result->user_id)->first(); ?> 
                        <?php if ($user) { $user_name = $user->name; }else
                        { $user_name = __('translations.uregistered_client');} ?>
                        <?php $product = App\Product::where('id', $result->product_id)->first(); ?> 
                        <?php if ($product) { $product_name = $product->name; } ?>
                        <?php $seller  = App\Seller::where('id', $result->seller_id)->first(); ?> 
                        <?php if ($seller) { $seller_name = $seller->name; } ?> 
                        <?php $store   = App\Store::where('id', $result->store_id)->first(); ?> 
                        <?php if ($store) { $store_name = $store->name; } ?>
                        
                        <tr>
                          <td> {{ $user_name }} </td>
                          <td> {{ $product_name }} </td>
                          <td> {{ -$result->refunded }} </td>
                          <td> {{ $result->order_status }} </td>
                          <td> {{ -$result->price }} {{ __('translations.egp') }}</td>
                          <td> {{ $store_name }} </td>
                          <td> {{ $seller_name }} </td>
                          <td> {{ $result->created_at }} </td>
                        </tr>
                        @endforeach
                        </tbody></table>
                @endif
                
                    <?php $section = strstr($item->response, '{'); ?>
                    <?php $section = json_decode($section); ?>
                      @foreach ($section as $key => $value)
                          @if($key == 'message')
                             {{ __('translations.message') }} >>> {{ $value }}
                          @endif
                      @endforeach
                
                @endif
              
              <?php //  end refund response ?>

         
              <?php //  start checkout response ?>

              @if($item->response && strstr($item->url, 'checkout'))
                <h3 style="color:green"> &nbsp; {{ __('translations.response') }}</h3>
                  <?php $record = strstr($item->response, '{'); ?>
                  <?php $part = json_decode($record); ?>
                      @foreach ($part as $key => $value)
                        @if ($key == 'products')
                          <table class="table table-bordered"><thead><tr>
                            <td>{{__('translations.product_name')}}</td>
                            <td>{{__('translations.unique_id')}}</td>
                            <td>{{__('translations.seller_quantity')}}</td>
                            <td>{{__('translations.price')}}</td>
                            <td>{{__('translations.product_total')}}</td>
                        </tr>
                      </thead>
                           @foreach ($value as $index => $product)
                           <tr>
                            <td> {{ $product->name }} </td>
                            <td> {{ $product->unique_id }} </td>
                            <td> {{ $product->seller_quantity }} </td>
                            <td> {{ $product->price }} </td>
                            <td> {{ $product->product_total }} </td>
                           </tr>
                           @endforeach
                         </table>
                        @else
                            @if ($key != 'created_at') 
                            {{ __('translations.'.$key) }} {{ $value }} <br>
                            @endif
               
                        @endif
                      @endforeach
              @endif

              
                
              
              <?php //  end checkout response ?>
      </tbody>
    </table>
</div>

      </div>

    </div>

  </section>





  

@stop
