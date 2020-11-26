
    <table class="table table-bordered table-striped" id="vendors">
      <thead>
        <tr>
          <th style="text-align: right;"> {{__('translations.description')}}</th>
         <?php //  <th>{{__('translations.subject_id')}}</th> ?>
         <?php //  <th>{{__('translations.subject_type')}}</th> ?>
         <th style="text-align: right"> {{ __('translations.ip') }}</th>
         <th style="text-align: right">  {{ __('translations.created_at') }} </th>
          <th style="text-align: right"> {{__('translations.actions')}}</th>
        </tr>
      </thead>

      <tbody>
      @foreach($records as $key => $activity)
              
               <?php $subj = substr($activity->subject_type, 4); ?>
                
                @if($subj == 'ProductStoreQuantity')                    
                       @if($activity->causer_id != null)

                        @foreach($activity->properties as $key => $property)
                              @if($key == 'attributes')
                                  @foreach($property as $i => $vl)
                                    
                                    @if($i == 'quantity')
                                   <?php  /*    @if($vl == 0 && $activity->description == 'created')
                                         @if($activity->description == 'created') 
                                          <?php // continue; ?>
                                         @else */ ?>
                                         <?php // added  start ?>
                                            <tr> 
                            <td>
                             {{ __('translations.'.$activity->description) }} 
                             {{ __('translations.in_product_store_quantities_table') }}
                             @foreach($activity->properties as $key => $property)
                              @if($key == 'attributes')
                                  @foreach($property as $i => $vl)
                                     @if($i == 'product_id')
                                     <?php $prod = App\Product::where('id', $vl)->select('name')->first() ?> 
                                          ( {{ $prod->name }} )
                                     @endif
                                  @endforeach
                              @endif
                            @endforeach

                            <?php // shiporder_id ?> 

                            @foreach($activity->properties as $key => $property)
                              @if($key == 'attributes')
                                  @foreach($property as $i => $vl)
                                     @if($i == 'shiporder_id')
                                     @if($vl != 1)
                                       (   {{ __('translations.shiporder_id') }} {{ $vl }} )
                                     @endif
                                     @endif
                                  @endforeach
                              @endif
                            @endforeach

                             <?php // settle_id ?> 

                            @foreach($activity->properties as $key => $property)
                              @if($key == 'attributes')
                                  @foreach($property as $i => $vl)
                                     @if($i == 'settle_id')
                                     @if($vl != null)
                                       (   {{ __('translations.settle_number') }} {{ $vl }} )
                                     @endif
                                     @endif
                                  @endforeach
                              @endif
                            @endforeach

                            <?php // transfer_id ?> 

                            @foreach($activity->properties as $key => $property)
                              @if($key == 'attributes')
                                  @foreach($property as $i => $vl)
                                     @if($i == 'transfer_id')
                                     @if($vl != null)
                                       (   {{ __('translations.transfer_number') }} {{ $vl }} )
                                     @endif
                                     @endif
                                  @endforeach
                              @endif
                            @endforeach

                            <?php // refund_id ?> 

                            @foreach($activity->properties as $key => $property)
                              @if($key == 'attributes')
                                  @foreach($property as $i => $vl)
                                     @if($i == 'refund_id')
                                     @if($vl != null)
                                       (   {{ __('translations.refund_number') }} {{ $vl }} )
                                     @endif
                                     @endif
                                  @endforeach
                              @endif
                            @endforeach

                            </td> 
                            <td> {{ $activity->ip }}</td>
                            <td> {{ $activity->created_at }} 
                              <u> {{ $activity->created_at->diffForHumans() }} </u>
                            </td>
                            
                        </tr>
                        <?php  // added end ?> 
                                 <?php  //      @endif ?>
                                  <?php  //    @endif  ?>
                                     @endif 
                                  @endforeach
                              @endif
                            @endforeach
                      
                     @endif

               @elseif($subj == 'User')
            
                      @if($activity->causer_id != null)
                      <?php // case created deleted ?>
                      @if($activity->description == 'created' || $activity->description == 'deleted')
                             @foreach($activity->properties as $key => $property)
                                 <tr> 
                                    <td>
                                     {{ __('translations.'.$activity->description) }} 
                                     {{ __('translations.in_users_table') }}

                                       @foreach($activity->properties as $key => $property)
                                          @if($key == 'attributes')
                                              @foreach($property as $i => $vl)
                                                 @if($i == 'name')
                                                      ( {{ $vl }} )
                                                 @endif
                                              @endforeach
                                          @endif
                                        @endforeach

                                    </td> 
                                    <td> {{ $activity->ip }}</td>
                                    <td> {{ $activity->created_at }} 
                                      <u> {{ $activity->created_at->diffForHumans() }} </u>
                                    </td>
                                   
                                </tr>
                             @endforeach
                 @endif

                       @if($activity->description == 'updated')
                      @foreach($activity->properties as $key => $property)
                     
                      @if($key == 'attributes')
                        <?php $attr_val =  $property; ?>
                      @endif

                   <?php /*   @if(!array_key_exists('old', $activity->properties))
                        <?php $old_val = 'not found'; ?> 
                      @endif  */ ?>

                      @if($key == 'old')
                        <?php $old_val = $property; ?>
                      @endif

                      @endforeach

                      @if($attr_val !== $old_val)
                        <tr> 
                            <td>
                             {{ __('translations.'.$activity->description) }} 
                             {{ __('translations.in_users_table') }}

                               @foreach($activity->properties as $key => $property)
                                  @if($key == 'attributes')
                                      @foreach($property as $i => $vl)
                                         @if($i == 'name')
                                              ( {{ $vl }} )
                                         @endif
                                      @endforeach
                                  @endif
                                @endforeach

                            </td> 
                            <td> {{ $activity->ip }}</td>
                            <td> {{ $activity->created_at }} 
                              <u> {{ $activity->created_at->diffForHumans() }} </u>
                            </td>
                         
                        </tr>
                    @endif
                    @endif
                    @endif

                    <?php // added new permission start ?>
                   @elseif($subj == 'ie\Permission\Models\Permission')
            
                      @if($activity->causer_id != null)
                        <tr> 
                            <td>
                             {{ __('translations.'.$activity->description) }} 
                             {{ __('translations.in_permissions_table') }}

                               @foreach($activity->properties as $key => $property)
                                  @if($key == 'attributes')
                                      @foreach($property as $i => $vl)
                                         @if($i == 'name')
                                              ( {{ $vl }} )
                                         @endif
                                      @endforeach
                                  @endif
                              @endforeach

                            </td> 
                            <td> {{ $activity->ip }}</td>
                            <td> {{ $activity->created_at }} 
                            <u> {{ $activity->created_at->diffForHumans() }} </u>
                            </td>
                           
                        </tr>
                      @endif

                    <?php // added new permission end ?>

                    <?php // added new role start ?>

                    @elseif($subj == 'ie\Permission\Models\Role')
                      @if($activity->causer_id != null)

                      <?php 
                      if(!strstr($activity->properties, 'attributes'))
                      {
                        $naming = $activity->properties;
                      }
                      else{
                          foreach($activity->properties as $key => $property){
                                      if($key == 'attributes'){
                                          foreach($property as $ikey => $ival){
                                             if($ikey == 'name'){
                                                $naming =  $ival;
                                             }
                                          }
                                      }
                                  }
                       }
                       ?>
                       @if(!empty($naming))
                        <tr> 
                            <td>
                             {{ __('translations.'.$activity->description) }} 
                             {{ __('translations.in_roles_table') }}
                             <?php
                                $naming = trim($naming, '[');
                                $naming = rtrim($naming, ']');
                                $naming = trim($naming, '"');
                              ?>
                             ( {{ $naming }} )

                            <?php /*   @foreach($activity->properties as $key => $property)
                                  @if($key == 'attributes')
                                      @foreach($property as $i => $vl)
                                         @if($i == 'name')
                                              ( {{ $vl }} )
                                         @endif
                                      @endforeach
                                  @endif
                              @endforeach */ ?>

                            </td> 
                            <td> {{ $activity->ip }}</td>
                            <td> {{ $activity->created_at }} 
                            <u> {{ $activity->created_at->diffForHumans() }} </u>
                            </td>
                           
                        </tr>
                      @endif
                    @endif
                    <?php // added new role end ?>

                    @elseif($subj == 'ie\Permission\Models\Permission')
                      @if($activity->causer_id != null)

                        <tr> 
                            <td>
                             {{ __('translations.'.$activity->description) }} 
                             {{ __('translations.in_permissions_table') }}
                            
                                @foreach($activity->properties as $key => $property)
                                  @if($key == 'attributes')
                                      @foreach($property as $i => $vl)
                                         @if($i == 'name')
                                              ( {{ $vl }} )
                                         @endif
                                      @endforeach
                                  @endif
                              @endforeach 

                            </td> 
                            <td> {{ $activity->ip }}</td>
                            <td> {{ $activity->created_at }} 
                            <u> {{ $activity->created_at->diffForHumans() }} </u>
                            </td>
                        </tr>
                      @endif
                   
                    <?php // added new role end ?>
            @else
      <tr>
        
        <td>
          {{ __('translations.'.$activity->description) }}
            <?php $subj = substr($activity->subject_type, 4); ?>
           
            @if($subj == 'Product')
            {{ __('translations.in_products_table') }}
            @endif

             @if($subj == 'Bannering')
            {{ __('translations.in_bannerings_table') }}
            @endif

            @if($subj == 'History')
            {{ __('translations.in_histories_table') }}
            @endif

            @if($subj == 'OnlineDiscount')
            {{ __('translations.in_onlinediscount_table') }}
            @endif

            @if($subj == 'CategoryOnline')
            {{ __('translations.in_categoryonlines_table') }}
            @endif

             @if($subj == 'User')
            {{ __('translations.in_users_table') }}
            @endif   

            @if($subj == 'Usertypeprice')
            {{ __('translations.in_users_type_prices_table') }}
            @endif

             @if($subj == 'Category')
            {{ __('translations.in_categories_table') }}
            @endif

             @if($subj == 'Subcategory')
            {{ __('translations.in_subcategories_table') }}
            @endif

            @if($subj == 'Shipment')
            {{ __('translations.in_shipments_table') }}
            @endif

            @if($subj == 'Image')
            {{ __('translations.in_images_table') }}
            @endif

            @if($subj == 'Coupon')
            {{ __('translations.in_coupons_table') }}
            @endif

             @if($subj == 'Store')
            {{ __('translations.in_stores_table') }}
            @endif

             @if($subj == 'Seller')
            {{ __('translations.in_sellers_table') }}
            @endif

            <?php $subj = substr($activity->subject_type, 4); ?> 
                 
                  @if($subj == 'Seller')
                  @foreach($activity->properties as $key => $property)
                    @if($key == 'attributes')
                        @foreach($property as $i => $vl)
                           @if($i == 'name')
                                ( {{ $vl }} )
                           @endif
                        @endforeach
                    @endif
                  @endforeach
                @endif   

                @if($subj == 'CategoryOnline')
                  @foreach($activity->properties as $key => $property)
                    @if($key == 'attributes')
                        @foreach($property as $i => $vl)
                           @if($i == 'name')
                                ( {{ $vl }} )
                           @endif
                        @endforeach
                    @endif
                  @endforeach
                @endif

                @if($subj == 'Store')
                  @foreach($activity->properties as $key => $property)
                    @if($key == 'attributes')
                        @foreach($property as $i => $vl)
                           @if($i == 'name')
                                ( {{ $vl }} )
                           @endif
                        @endforeach
                    @endif
                  @endforeach
                @endif

                @if($subj == 'History')
                  @foreach($activity->properties as $key => $property)
                    @if($key == 'attributes')
                        @foreach($property as $i => $vl)
                           @if($i == 'bill_id')
                                ( {{ $vl }} )
                           @endif
                        @endforeach
                    @endif
                  @endforeach
                @endif

                @if($subj == 'Bannering')
                  @foreach($activity->properties as $key => $property)
                    @if($key == 'attributes')
                        @foreach($property as $i => $vl)
                           @if($i == 'title')
                                ( {{ $vl }} )
                           @endif
                        @endforeach
                    @endif
                  @endforeach
                @endif

                @if($subj == 'User')
                  @foreach($activity->properties as $key => $property)
                    @if($key == 'attributes')
                        @foreach($property as $i => $vl)
                           @if($i == 'name')
                                ( {{ $vl }} )
                           @endif
                        @endforeach
                    @endif
                  @endforeach
                @endif

                 @if($subj == 'Product')
                  @foreach($activity->properties as $key => $property)
                    @if($key == 'attributes')
                        @foreach($property as $i => $vl)
                           @if($i == 'name')
                                ( {{ $vl }} )
                           @endif
                        @endforeach
                    @endif
                  @endforeach
                @endif

                @if($subj == 'Category')
                  @foreach($activity->properties as $key => $property)
                    @if($key == 'attributes')
                        @foreach($property as $i => $vl)
                           @if($i == 'name')
                                ( {{ $vl }} )
                           @endif
                        @endforeach
                    @endif
                  @endforeach
                @endif

                @if($subj == 'OnlineDiscount')
                  @foreach($activity->properties as $key => $property)
                    @if($key == 'attributes')
                        @foreach($property as $i => $vl)
                           @if($i == 'product_id')
                           <?php $prod = App\Product::where('id', $vl)->select('name')->first() ?> 
                                ( {{ $prod->name }} )
                           @endif
                        @endforeach
                    @endif
                  @endforeach
                @endif

                @if($subj == 'Coupon')
                  @foreach($activity->properties as $key => $property)
                    @if($key == 'attributes')
                        @foreach($property as $i => $vl)
                           @if($i == 'code')
                           ( {{ $vl }} ) 
                           @endif
                        @endforeach
                    @endif
                  @endforeach
                @endif

                @if($subj == 'Shipment')
                  @foreach($activity->properties as $key => $property)
                    @if($key == 'attributes')
                        @foreach($property as $i => $vl)
                           @if($i == 'area')
                                ( {{ $vl }} )
                           @endif
                        @endforeach
                    @endif
                  @endforeach
                @endif

                @if($subj == 'Image')
                  @foreach($activity->properties as $key => $property)
                    @if($key == 'attributes')
                        @foreach($property as $i => $vl)
                           @if($i == 'product_id')
                               <?php $prod = App\Product::where('id', $vl)->select('name')->first(); ?>
                                ( {{ $prod->name }} )
                           @endif
                        @endforeach
                    @endif
                  @endforeach
                @endif

                @if($subj == 'Subcategory')
                  @foreach($activity->properties as $key => $property)
                    @if($key == 'attributes')
                        @foreach($property as $i => $vl)
                           @if($i == 'name')
                                ( {{ $vl }} )
                           @endif
                        @endforeach
                    @endif
                  @endforeach
                @endif

                @if($subj == 'Usertypeprice')
                  @foreach($activity->properties as $key => $property)
                    @if($key == 'attributes')
                        @foreach($property as $i => $vl)
                           @if($i == 'product_id')
                           <?php $prod = App\Product::where('id', $vl)->first(); ?> 
                                ( {{ $prod->name }} )  ( {{ $prod->subcategory->name }} )
                           @endif
                        @endforeach
                    @endif
                  @endforeach
                @endif


            
        </td> 

        <?php // <td>{{$activity->subject_id}}</td> ?>
       <?php /*  <td> <?php $subj = substr($activity->subject_type, 4); ?> 
          {{  __('translations.'.$subj) }} */ ?>
        <td> {{ $activity->ip }}</td>
        <td> {{  $activity->created_at }}  
          <u> {{ $activity->created_at->diffForHumans() }} </u> </td>
       
     </tr>
     @endif
      @endforeach
      </tbody>
    </table>
