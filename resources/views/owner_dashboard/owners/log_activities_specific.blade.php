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
      
      <?php $old = array(); ?> 
      <?php $new = array(); ?> 
     
     @foreach ($activity->properties as $index => $value)
           @if($index == 'old')
              @foreach ($value as $keyy => $val)
               <?php  array_push($old, [$keyy => $val]); ?>
              @endforeach
            @endif
      @endforeach

      @foreach ($activity->properties as $index => $value)
           @if($index == 'attributes')
              @foreach ($value as $keyy => $val)
               @if($keyy != 'status' && $keyy != 'customerOrNot')
               <?php  array_push($new, [$keyy => $val]); ?>
               @endif
              @endforeach
          @endif
        @endforeach

<?php 
// return $old;
 ?>

      @foreach($activity->properties as $keyy => $item) 
      
      @if($keyy == 'old')
          <table class="table table-bordered table-striped" id="vendors">
      
              <div class="text-center">
                <h3 style="color:green;"> {{ __('translations.by') }} <i class="fa fa-user"></i> {{ $auth_user->name }}</h3>
              </div>
              
                <h3 class="text-center">  {{ __('translations.before_update') }}</h3> 
              <thead>
          
          @foreach($item as $index => $value)
               <tr>
               <?php //  @if(!empty($value) && $index != 'country_id') ?>
               <?php /*
               @if($index == 'suspend')
                 @if($value == 0)
                    <?php $value = 'not'; ?>
                 @endif
               @endif */ ?>
                  @if(!in_array($value, $new) && $index != 'status' && $index != 'customerOrNot')
                <th> 

                 @if($index == 'user_id')
                    {{ __('translations.client_name') }} 
                
                 @elseif($index == 'store_id')
                    {{ __('translations.store_name') }} 
                 
                 @elseif($index == 'product_id')
                    {{ __('translations.product_name') }} 
                 
                 @elseif($index == 'seller_id')
                    {{ __('translations.seller_name') }}

                @elseif($index == 'country_id')
                 <?php continue; ?>

                 @else
                    {{ __('translations.'.$index) }} 
                 @endif
            </th>
                <th> 
                  <?php // $auth_user = App\User::where('id', $item->causer_id)->first(); ?>
                  @if($index == 'user_id')
                  <?php $user = App\User::where('id', $value)->first(); ?> 
                    {{ $user->name }} 

                    @elseif($index == 'usertype_id')
                  <?php $usertype = App\Usertype::where('id', $value)->first(); ?> 
                    {{ $usertype->name }} 
                
                 @elseif($index == 'store_id')
                    <?php $store = App\Store::where('id', $value)->first(); ?> 
                    {{ $store->name }} 

                  @elseif($index == 'category_id')
                    <?php $category = App\Category::where('id', $value)->first(); ?> 
                    {{ $category->name }} 

                    @elseif($index == 'subcategory_id')
                    <?php $subcategory = App\Subcategory::where('id', $value)->first(); ?> 
                    {{ $subcategory->name }} 
                 
                 @elseif($index == 'product_id')
                    <?php $product = App\Product::where('id', $value)->first(); ?> 
                    {{ $product->name }} 
                 
                 @elseif($index == 'seller_id')
                    <?php $seller = App\Seller::where('id', $value)->first(); ?> 
                    {{ $seller->name }} 

                  @elseif($index == 'price')
                    {{ $value }} {{ __('translations.egp') }}   

                    @elseif($index == 'archive')
                    {{ $value == 1 ?  __('translations.yes') :  __('translations.no') }} 

                     @elseif($index == 'discount')
                    {{ ' % ' . ' '. $value }} 

                    @elseif($index == 'weight')
                    {{ $value }} {{ __('translations.kg') }}   

                     @elseif($index == 'suspend')
                    {{ $value == 0 ? __('translations.not_suspended') : __('translations.suspended') }} 

                     @elseif($index == 'phone')
                    {{ $value == null ? __('translations.no_phone') : $value }} 
                 
                 @else
                {{ $value }} 
              
                @endif

            </th>
            @endif
            
              </tr>
              @endforeach
            </thead>
          </table>

              @endif

      @if($keyy == 'attributes')
      <br>
            <table class="table table-bordered table-striped" id="vendors">
      
              <div class="text-center">
                <h3 style="color:green;"> {{ __('translations.by') }} <i class="fa fa-user"></i> {{ $auth_user->name }}</h3>
              </div>
              
               <h3 class="text-center"> {{ __('translations.after_update') }}</h3>
              <thead>
           

            @foreach($item as $index => $value)
             @if($index != 'new_email' && $index != 'new_name'  && $index != 'prev_privillige'  && $index != 'payee_name'  && $index != 'bank_account'  && $index != 'language'  && $index != 'hoppy'  && $index != 'sex'  && $index != 'job'  && $index != 'birthdate' && $index != 'facebook_id' && $index != 'customerOrNot' && $index != 'email' && $index != 'password' && $index != 'code' && $index != 'address' && $index != 'slug')
                
               <tr>
                 <?php // @if(!empty($value) && $index != 'country_id') ?>
                 @if(!in_array($value, $old))
                <th> 
                 @if($index == 'user_id')
                    {{ __('translations.client_name') }} 
                
                 @elseif($index == 'store_id')
                    {{ __('translations.store_name') }} 
                 
                 @elseif($index == 'product_id')
                    {{ __('translations.product_name') }} 
                 
                 @elseif($index == 'seller_id')
                    {{ __('translations.seller_name') }} 

                @elseif($index == 'country_id')
                 <?php continue; ?>
                 @else
                    {{ __('translations.'.$index) }} 
                 @endif
            </th>
                <th> 
                  <?php // $auth_user = App\User::where('id', $item->causer_id)->first(); ?>
                  @if($index == 'user_id')
                  <?php $user = App\User::where('id', $value)->first(); ?> 
                    {{ $user->name }} 

                   

                    @elseif($index == 'usertype_id')
                  <?php $usertype = App\Usertype::where('id', $value)->first(); ?> 
                    {{ $usertype->name }} 
                
                 @elseif($index == 'store_id')
                    <?php $store = App\Store::where('id', $value)->first(); ?> 
                    {{ $store->name }} 

                  @elseif($index == 'category_id')
                    <?php $category = App\Category::where('id', $value)->first(); ?> 
                    {{ $category->name }} 

                    @elseif($index == 'subcategory_id')
                    <?php $subcategory = App\Subcategory::where('id', $value)->first(); ?> 
                    {{ $subcategory->name }} 
                 
                 @elseif($index == 'product_id')
                    <?php $product = App\Product::where('id', $value)->first(); ?> 
                    {{ $product->name }} 
                 
                 @elseif($index == 'seller_id')
                    <?php $seller = App\Seller::where('id', $value)->first(); ?> 
                    {{ $seller->name }} 

                  @elseif($index == 'price')
                    {{ $value }} {{ __('translations.egp') }}   

                    @elseif($index == 'archive')
                    {{ $value = 1 ?  __('translations.yes') : ''  }}   

                     @elseif($index == 'discount')
                    {{ ' % ' . ' '. $value }} 

                     @elseif($index == 'weight')
                    {{ $value }} {{ __('translations.kg') }} 

                     @elseif($index == 'suspend')
                     {{ $value == 0 ? __('translations.not_suspended') : __('translations.suspended') }} 
                 
                 @else
                {{ $value }} 
              
                @endif

            </th>
            @endif

            
              </tr> @endif
            @endforeach 
</thead>
</table>
      @endif  
      
      @endforeach

      @if($activity->subject_type == 'App\ProductStoreQuantity')
                      <th style="vertical-align: middle;"> {{ __('translations.created_at') }}   </th> 
                      <th> {{ $activity->created_at }} <br> 
                        {{ $activity->created_at->diffForHumans() }}   </th>
      @endif
      </thead>
    </table>
</div>

      </div>

    </div>

  </section>





  

@stop
