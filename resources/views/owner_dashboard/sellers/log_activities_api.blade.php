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
    <table class="table table-bordered" id="vendors" style="font-size: 11px;">
      <thead>
        <tr>
          <th>{{__('translations.ip')}}</th>
          <th>{{__('translations.url')}}</th>
          <th>{{__('translations.request')}}</th>
          <th>{{__('translations.response')}}</th>
          <th>{{__('translations.created_at')}}</th>
        </tr>
      </thead>

      <tbody>
        @foreach($requests as $item)
            <tr>
              <td> {{  $item->ip }} </td>
              <td> 
                @if(strstr($item->url, '?'))
                {{ stristr($item->url, '?', true) }} 
                @else
                {{ $item->url }}
                @endif
              </td>
              <td>


            @if($item->request && strstr($item->url, 'refund'))
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
                      
                        <td> {{ $key }}</td> <td> {{ $value }}</td>
                      
                      @endif
                       </tr>
                      @endif
              @endforeach
            </table>
            @endif

               
                <?php $one = json_decode($item->request); ?>
              
                @foreach($one as $key => $value)
                 @if($key != 'api_token')

                    @if (is_array($value)) 

                      @if ($key = 'codes' && !strstr($item->url, 'checkProducts'))
                      <table class="table table-bordered" id="vendors" style="font-size: 11px;">
                        <thead>
                          <tr>
                            <td>{{__('translations.unique_id')}}</td>
                            <td>{{__('translations.quantity')}}</td>
                          </tr>
                        </thead>
                        <tbody>
                        @foreach($value as $i)
                        <tr> 
                          <td>  {{ $i->code }} </td> 
                          <td>  {{ $i->quantity }} </td> 
                        </tr>
                          @endforeach
                      </tbody></table>
                    
                    @endif 

                      @if ($key = 'codes' && strstr($item->url, 'checkProducts') )    
                      <table class="table table-bordered" id="vendors" style="font-size: 11px;">

                        <thead>
                          <tr>
                            <td>{{__('translations.code')}}</td>
                          </tr>
                        </thead>

                        <tbody>
                        @foreach($value as $i)
                        <tr> 
                          <td>  {{ $i }} </td> 
                        </tr>
                          @endforeach
                      </tbody></table>
                    @endif 

                    @else
                    @if(!strstr($item->url, 'product'))
                    <table style="font-size: 11px;"><tbody>
                    <tr> 
                      <td style="width: 150px; border-bottom: ;"> {{ $value }} </td> 
                      <td style="margin-left: 25px; border-bottom: ;"> {{ __('translations.'.$key) }} </td> 
                    </tr>
                    </tbody></table>
                    @endif
                    @endif
                    @endif
                @endforeach
            </td> 

            <td>

                <?php //  start refund ?>

              @if($item->response && strstr($item->url, 'refund'))
                @if (strstr($item->response, '"refunded_at"'))
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
                          <td> {{ -$result->price }} </td>
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
              
              <?php //  end refund   ?>

              @if($item->response && strstr($item->url, 'products?'))
              
              @if(strstr($item->response, 'message'))
                     <?php $record = strstr($item->response, '{'); ?> 

              <?php $record = json_decode($record); ?>
               <table class="table table-bordered" id="vendors" style="font-size: 11px;">
                        <tbody>    
              @foreach($record as $key => $value)         
                        <tr> 
                          <td> {{ __('translations.'.$key) }} </td>
                          <td> {{ $value }} </td>
                        </tr>
              @endforeach
            </tbody>
          </table>
              @else

              <table class="table table-bordered" id="vendors" style="font-size: 11px;">
                        <thead>
                          <tr>
                            <td>{{__('translations.name')}}</td>
                            <td>{{__('translations.unique_id')}}</td>
                            <td>{{__('translations.price')}}</td>
                            <td>{{__('translations.discount')}}</td>
                          </tr>
                        </thead>
                        <tbody>                        
                        <tr> 

                            <?php $record = strstr($item->response, '"products":'); ?>
                            <?php  $q = strpos($record, ',"product_store_quantities"'); ?>
                            <?php $len = strstr($record, ',"product_store_quantities"'); ?>
                            <?php $length = strlen($len); ?>
                            <?php $i = substr($record, $q, $length-1); ?>
                            <?php $want = str_replace($i , '', $record); ?>
                            <?php $tw = '"products":[';  ?>
                            <?php $on = ltrim($want, $tw); ?>
                           
                            <?php $part = json_decode($on); ?>
                           <?php // return $s->name; ?>

                          <td>  {{ $part->name }} </td> 
                          <td>  {{ $part->unique_id }} </td> 
                          <td>  {{ $part->price }} </td> 
                          <td>  {{ $part->discount > 0 ? $part->discount : __('translations.no_disc') }} </td> 
                        </tr>
                       
                      </tbody></table>
                      @endif
                       @endif
             
              @if($item->response && strstr($item->url, 'product?'))
              
              @if(strstr($item->response, 'message'))
                     <?php $record = strstr($item->response, '{'); ?> 

              <?php $record = json_decode($record); ?>
               <table class="table table-bordered" id="vendors" style="font-size: 11px;">
                        <tbody>    
              @foreach($record as $key => $value)         
                        <tr> 
                          <td> {{ __('translations.'.$key) }} </td>
                          <td> {{ $value }} </td>
                        </tr>
              @endforeach
            </tbody>
          </table>
              @else

              <table class="table table-bordered" id="vendors" style="font-size: 11px;">
                        <thead>
                          <tr>
                            <td>{{__('translations.name')}}</td>
                            <td>{{__('translations.unique_id')}}</td>
                            <td>{{__('translations.price')}}</td>
                            <td>{{__('translations.discount')}}</td>
                            <td>{{__('translations.price_after_discount')}}</td>
                            <td>{{__('translations.quantity')}}</td>
                          </tr>
                        </thead>
                        <tbody>                        
                        <tr> 

                            <?php $record = strstr($item->response, '"product":'); ?>
                            <?php  $q = strpos($record, ',"product_store_quantities"'); ?>
                            <?php $len = strstr($record, ',"product_store_quantities"'); ?>
                            <?php $length = strlen($len); ?>
                            <?php $i = substr($record, $q, $length-1); ?>
                            <?php $want = str_replace($i , '', $record); ?>
                            <?php $tw = '"product":';  ?>
                            <?php $on = ltrim($want, $tw); ?>
                           
                            <?php $part = json_decode($on); ?>
                           <?php // return $s->name; ?>

                          <td>  {{ $part->name }} </td> 
                          <td>  {{ $part->unique_id }} </td> 
                          <td>  {{ $part->price }} </td> 
                          <td>  {{ $part->discount > 0 ? $part->discount : __('translations.no_disc') }} </td> 
                          <td>  {{ $part->price_after_discount }} </td> 
                          <td>  {{ $part->quantity }} </td> 
                        </tr>
                       
                      </tbody></table>
                      @endif
              @else

             <?php $record = strstr($item->response, '{'); ?> 

              <?php $record = json_decode($record); ?>
              
              @foreach($record as $key => $value)
              
                @if (!is_array($value))
                @if ($key != 'products')
                @if ($key != 'created_at')
                @if ($key != 'api_token')
                @if ($key != 'apitoken')
                 <table style="font-size: 11px;"><tbody>
                <tr> 
                  <td style="width: 300px; border-bottom: ; border-radius: 5px; padding : 1px;"> 
                      {{ __('translations.'.$key) }}
                 </td> 
                 <td style="width: 300px; border-bottom: ; border-radius: 5px; padding : 1px;"> 
                      {{ $value }}
                 </td> 

           </tr>
            </tbody></table>
              @endif
              @endif
              @endif
              @endif
              @endif


              @if($key != 'apitoken')
              @if (is_array($value))
              @if ($key == 'bill_products')
                
                     <table class="table table-bordered table-striped" id="vendors" style="font-size: 11px;">

                        <thead>
                          <tr>
                          
                            <td>{{__('translations.user_name')}}</td>
                            <td>{{__('translations.product_name')}}</td>
                            <td>{{__('translations.unique_id')}}</td>
                            <td>{{__('translations.order_status')}}</td>
                            <td>{{__('translations.quantity')}}</td>
                            <td>{{__('translations.price')}}</td>
                            <td>{{__('translations.refunded')}}</td>
                           
                          </tr>
                        </thead>

                        <tbody>

                        @foreach($value as $i => $g)
                        <tr>
                           <td> {{ $g->user_id }} </td>
                           <td> {{ $g->product_id }} </td>
                           <td> {{ $g->product_unique_id }}</td>
                           <td> {{ $g->order_status }}</td>
                           <td> {{ $g->price }} </td>
                           <td> {{ $g->quantity }} </td>
                           <td> {{ $g->refunded == null ? 0 : $g->refunded }} </td>
                        </tr>
                        @endforeach
                     
                  </tbody>
                </table>
                    @endif 
                    @endif
                    @endif 


              @if($key != 'apitoken')

              @if (is_array($value))

              @if ($key == 'products' && !strstr($item->url, 'checkProducts') && !strstr($item->url, 'products?') )
                
                     <table class="table table-bordered table-striped" id="vendors" style="font-size: 11px;">

                        <thead>
                          <tr>
                            <td>{{__('translations.name')}}</td>
                            <td>{{__('translations.unique_id')}}</td>
                            <td>{{__('translations.price')}}</td>
                            <td>{{__('translations.seller_quantity')}}</td>
                            <td>{{__('translations.product_total')}}</td>
                           
                          </tr>
                        </thead>

                        <tbody>

                        @foreach($value as $i => $g)
                        <tr>
                           <td> {{ $g->name }} </td>
                           <td> {{ $g->unique_id }}</td>
                           <td> {{ $g->price }} </td>
                           <td> {{ $g->seller_quantity }} </td>
                           <td> {{ $g->product_total }} </td>
                        </tr>
                        @endforeach
                     
                  </tbody>
                </table>
                    @endif 

                    @if ($key == 'products' && strstr($item->url, 'checkProducts') )
                
                     <table class="table table-bordered table-striped" id="vendors" style="font-size: 11px;">

                        <thead>
                          <tr>
                            <td>{{__('translations.product_name')}}</td>
                            <td>{{__('translations.unique_id')}}</td>
                            <td>{{__('translations.price')}}</td>
                            <td>{{__('translations.discount')}}</td>
                            <td>{{__('translations.price_after_discount')}}</td>
                            <td>{{__('translations.quantity')}}</td>
                           
                          </tr>
                        </thead>

                        <tbody>

                        @foreach($value as $i => $g)
                        <tr>
                           <td> {{ $g->name }} </td>
                           <td> {{ $g->unique_id }}</td>
                           <td> {{ $g->price }} </td>
                           <td> {{ $g->discount }} </td>
                           <td> {{ $g->price_after_discount }} </td>
                           <td> {{ $g->quantity }} </td>
                        </tr>
                        @endforeach
                     
                  </tbody>
                </table>
                    @endif 

                    @if ($key == 'products' && strstr($item->url, 'checkProducts/phone') )
                
                     <table class="table table-bordered table-striped" id="vendors" style="font-size: 11px;">

                        <thead>
                          <tr>
                            <td>{{__('translations.product_name')}}</td>
                            <td>{{__('translations.unique_id')}}</td>
                            <td>{{__('translations.price')}}</td>
                            <td>{{__('translations.discount')}}</td>
                            <td>{{__('translations.price_after_discount')}}</td>
                            <td>{{__('translations.quantity')}}</td>
                            <td>{{__('translations.user_type')}}</td>
                            <td>{{__('translations.user_price')}}</td>
                           
                          </tr>
                        </thead>

                        <tbody>

                        @foreach($value as $i => $g)
                        <tr>
                           <td> {{ $g->name }} </td>
                           <td> {{ $g->unique_id }}</td>
                           <td> {{ $g->price }} </td>
                           <td> {{ $g->discount }} </td>
                           <td> {{ $g->price_after_discount }} </td>
                           <td> {{ $g->quantity }} </td>
                           <td> {{ $g->user_type }} </td>
                           <td> {{ $g->user_price }} </td>
                        </tr>
                        @endforeach
                     
                  </tbody>
                </table>
                    @endif 
                  
                    @endif

              @endif
             @endforeach  
             @endif 
            </td>
            <td> {{ $item->created_at }} </td>
          </tr>
        @endforeach 
      
      </tbody>
    </table>
</div>

      </div>

    </div>

  </section>





  

@stop
