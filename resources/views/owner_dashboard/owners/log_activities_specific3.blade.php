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
     @if(strstr($activity->properties, 'attributes'))

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
     @endif
<?php 
// return $old;
 ?>

<?php /*

@foreach($old as $one => $two)
  @foreach($two as $o => $t)
     {{ $o }} {{ $t }}<br>
  @endforeach
@endforeach


<?php echo '<br><br>'; ?>

@foreach($new as $one => $two)
  @foreach($two as $o => $t)
     {{ $o }} {{ $t }}<br>
  @endforeach
@endforeach
*/ ?>
@if($activity->description == 'created' || $activity->description == 'deleted')
   <div class="text-center">
                <h3 style="color:green;"> {{ __('translations.by') }} <i class="fa fa-user"></i> {{ $auth_user->name }} <br><br> {{ $activity->created_at }}</h3>
              </div>
              <br>

@if($activity->subject_type == 'App\ProductStoreQuantity')

              <table class="table table-bordered">
      @foreach($activity->properties as $k => $property)
           @if($k == 'attributes')
             @foreach ($property as $keyy => $val)
              <tr>
               @if($keyy == 'user_id')
               <td> {{ __('translations.client_name') }}  </td>
                  <?php $user = App\User::where('id', $val)->first(); ?> 
                  <td>  {{ $user->name }} </td>

                  @elseif($keyy == 'purchase_id' || $keyy == 'type')
                   <?php continue; ?>

                    @elseif($keyy == 'usertype_id')
                   <td> {{ __('translations.usertype') }} </td>
                  <?php $usertype = App\Usertype::where('id', $val)->first(); ?> 
                   <td> {{ $usertype->name }}  </td>

                    @elseif($keyy == 'from_store')
                     @if(!empty($val))
                   <td> {{ __('translations.transfer_from_store') }} </td>
                  <?php $from_store = App\Store::where('id', $val)->select('name')->first(); ?>
                   <td> {{ $from_store->name }}  </td>
                    @endif

                   @elseif($keyy == 'to_store')
                   @if(!empty($val))
                   <td> {{ __('translations.transfer_to_store') }} </td>
                  <?php $to_store = App\Store::where('id', $val)->select('name')->first(); ?>
                   <td> {{ $to_store->name }}  </td>
                   @endif

                    @elseif($keyy == 'custom_status')
                    <?php continue; ?>

                   @elseif($keyy == 'refund_id')
                    @if(!empty($val))
                   <td> {{ __('translations.refund_number') }} </td>
                   <td> {{ $val }}  </td>
                   @endif

                    @elseif($keyy == 'transfer_id')
                    @if(!empty($val))
                   <td> {{ __('translations.transfer_number') }} </td>
                   <td> {{ $val }}  </td>
                   @endif
                   
                   <?php // added  ?>   
                    @elseif($keyy == 'shiporder_id')
                    @if($val != 1)
                   <td> {{ __('translations.transfer_number') }} </td>
                   <td> {{ $val }}  </td>
                   @endif


                   @elseif($keyy == 'settle_id')
                    @if(!empty($val))
                   <td> {{ __('translations.settle_number') }} </td>
                   <td> {{ $val }}  </td>
                   @endif

                   @elseif($keyy == 'status')
                  <?php continue; ?>
                 
                   <td>
                        @if($val == 'r')
                        {{ __('translations.subtract') }}
                        @endif
                        
                        @if($val == 'a')
                           {{ __('translations.add') }}
                        @endif
                   </td>
                
                 @elseif($keyy == 'store_id')
                 <td> {{ __('translations.store_name') }}</td>
                    <?php $store = App\Store::where('id', $val)->first(); ?> 
                   <td> {{ $store->name }} </td>

                  @elseif($keyy == 'category_id')
                 <td> {{ __('translations.category') }}</td>
                    <?php $category = App\Category::where('id', $val)->first(); ?> 
                   <td> {{ $category->name }} </td>

                    @elseif($keyy == 'subcategory_id')
                    <td> {{ __('translations.subcategory') }} </td>
                    <?php $subcategory = App\Subcategory::where('id', $val)->first(); ?> 
                    <td> {{ $subcategory->name }}  </td>
                 
                 @elseif($keyy == 'product_id')
                  @if($val > 0)
               <td>  {{ __('translations.product_name') }} </td>
                    <?php $product = App\Product::where('id', $val)->first(); ?> 
                  <td>  {{ $product->name }} </td> 
                 @endif

                 @elseif($keyy == 'seller_id')
                  @if($val > 0)
                  <td> {{ __('translations.seller_name') }} <td>
                    <?php $seller = App\Seller::where('id', $val)->first(); ?> 
                    <td> {{ $seller->name }}  <td>
                      @endif
                  @elseif($keyy == 'price')
                <td>   {{ __('translations.price') }} </td>
                  <td>   {{ $val }} {{ __('translations.egp') }} </td>   

                    @elseif($keyy == 'archive')
                    <td> {{ __('translations.archive') }}</td>
                   <td>  {{ $val == 1 ?  __('translations.yes') :  __('translations.not_archived') }} </td>

                     @elseif($keyy == 'discount')
                     <td> {{ __('translations.discount') }}</td>
                   <?php // <td> {{ ' % ' . ' '. $val }} </td> ?>
                    <td> {{ $val }} </td>

                    @elseif($keyy == 'weight')
                    <td> {{ __('translations.weight') }}</td>
                    <td> {{ $val }} {{ 'جرام' }} </td>   

                     @elseif($keyy == 'suspend')
                     <td> {{ __('translations.suspend') }}</td>
                   <td>  {{ $val == 0 ? __('translations.not_suspended') : __('translations.suspended') }} </td>

                     @elseif($keyy == 'phone')
                     <td> {{ __('translations.phone') }} </td>
                    <td> {{ $val == null ? __('translations.no_phone') : $val }} </td> 


                    @elseif($keyy == 'password')
                      <td> {{ __('translations.password') }} </td>
                    <td> 
                         @if($val == null)
                            <?php // {{ __('translations.no_pass') }}  ?> 
                            <label style="height: 15px; background: black; width:150px;"> </label>
                          @else
                            <label style="height: 15px; background: black; width:150px;"> </label>
                            <?php // {{ __('translations.cant') }} ?>
                          @endif   
                        </td>
                 
                 @else
                <td> {{ __('translations.'.$keyy) }}</td>  <td> {{ $val }} </td>
              
                @endif
</tr>
              @endforeach
           @endif
        @endforeach
        </table>
        <?php // image section ?>
              @elseif($activity->subject_type == 'App\Image')

              <table class="table table-bordered">
      @foreach($activity->properties as $k => $property)
           @if($k == 'attributes')
             @foreach ($property as $keyy => $val)
              <tr>

               @if($keyy == 'product_id')
                @if($val > 0)
                <?php $thisprod = App\Product::where('id', $val)->first(); ?> 
                  <td> {{ __('translations.product') }}  </td>
                  <td>  {{ $thisprod->name }} </td>
                  @endif 

                    @elseif($keyy == 'image')
                   <td> {{ __('translations.image') }} </td>
                   <td>  <img src="{{asset('storage/'.$val)}}" width="100" height="100"> </td>    
                 @else
                <td> {{ __('translations.'.$keyy) }}</td>  <td> {{ $val }} </td>
              
                @endif
</tr>
              @endforeach
           @endif
        @endforeach
        </table> 
        <?php // image section ?>
        <?php // coupon section  ?>
              @elseif($activity->subject_type == 'App\Coupon')
                  
                   @foreach($activity->properties as $k => $property)
                   @if($k == 'attributes')
                      @foreach ($property as $keyy => $coupval)
                        @if($keyy == 'code')
                         <?php $coupon = App\Coupon::withTrashed()->where('code', $coupval)->first() ?>
                         @endif     
                        @endforeach
                   @endif
                   @endforeach
          

              <table class="table table-bordered">
      @foreach($activity->properties as $k => $property)
           @if($k == 'attributes')
             @foreach ($property as $keyy => $val)
                @if($keyy != 'owner_id')
              <tr>

               @if($keyy == 'type')
               <td> {{ __('translations.type') }}  </td>
               <td> {{ __('translations.'.$val) }} </td>

               @elseif($keyy == 'restrict_price')
                @if(empty($val))
                <?php continue; ?>
                @endif

                 @elseif($keyy == 'flat_rate')
                @if(empty($val))
                <?php continue; ?>
                @endif

               @elseif($keyy == 'product_id')
               
                     @if(!empty($val))
                      <td> {{ __('translations.product') }} </td>
                      <?php $prod = App\Product::where('id', $val)->select('name')->first() ?> 
                       <td>  {{ $prod->name }} </td> 
                     @endif      
                   
                 @else
                <td> {{ __('translations.'.$keyy) }}</td>  <td> {{ $val }} </td>
              
                @endif
</tr>
@endif
              @endforeach
           @endif
        @endforeach
       
        </table>
        <?php // coupon section ?> 
<?php  // added role start ?>
      @elseif($activity->subject_type == 'Spatie\Permission\Models\Role')
      <?php $role = Spatie\Permission\Models\Role::withTrashed()->where('id', $activity->subject_id)->first(); ?>
      <h3 class="text-center"> {{ $role->name }}</h3>
      <br>
       @if($activity->old_permissions !== null)
        <table class="table table-bordered">
          
          <?php /* @if(count($role->permissions) > 0)
                 <tr><th style="text-align: right;"> {{ __('translations.permissions') }}  </th></tr>
                    @foreach($role->permissions as $permission)
                      <tr>
                          <td> {{ $permission->name  }}  </td>
                      </tr>          
                    @endforeach
          @endif */ ?>
          <tr><th style="text-align: right;"> {{ __('translations.permissions') }}  </th>
          <?php // <th style="text-align: right;"> {{ __('translations.created_at') }}  </th></tr> ?>
             
                    @foreach(json_decode($activity->old_permissions) as $created => $permission)
                    <?php // $thisperm_here = Spatie\Permission\Models\Permission::where('id', $permission)->first(); ?>
                      <tr>
                          <td> {{ __('translations.'.$permission)  }}  </td>
                         <?php // <td> {{ $created  }}  </td> ?>
                     @endforeach
             
          </tr>     
        </table> 
        @endif
<?php // added permission end ?>

<?php  // added role start ?>
      @elseif($activity->subject_type == 'Spatie\Permission\Models\Permission')
      <?php $permission = Spatie\Permission\Models\Permission::withTrashed()->where('id', $activity->subject_id)->first(); ?>
      <h3 class="text-center"> {{ __('translations.'.$permission->name) }}</h3>
      <br>
       @if($activity->old_permissions !== null)
        <table class="table table-bordered">
          
          <?php /* @if(count($role->permissions) > 0)
                 <tr><th style="text-align: right;"> {{ __('translations.permissions') }}  </th></tr>
                    @foreach($role->permissions as $permission)
                      <tr>
                          <td> {{ $permission->name  }}  </td>
                      </tr>          
                    @endforeach
          @endif */ ?>
          <tr><th style="text-align: right;"> {{ __('translations.roles') }}  </th>
          <?php // <th style="text-align: right;"> {{ __('translations.created_at') }}  </th></tr> ?>
             
                    @foreach(json_decode($activity->old_permissions) as $created => $permission)
                      <tr>
                         <?php $role = Spatie\Permission\Models\Role::withTrashed()
                                                                          ->where('id', $permission)
                                                                          ->first(); ?>
                          <td> {{ $role->name  }}  </td>
                         <?php // <td> {{ $created  }}  </td> ?>
                     @endforeach
             
          </tr>     
        </table> 
        @endif
<?php // added permission end ?>

@else

<table class="table table-bordered">
      @foreach($activity->properties as $k => $property)
           @if($k == 'attributes')
             @foreach ($property as $keyy => $val)
             @if($keyy != 'owner_id')
              <tr>
               @if($keyy == 'user_id')
               <td> {{ __('translations.client_name') }}  </td>
                  <?php $user = App\User::where('id', $val)->first(); ?> 
                  <td>  {{ $user->name }} </td>

                    @elseif($keyy == 'usertype_id')
                   <td> {{ __('translations.usertype') }} </td>
                   <td> @if($val == null)
                              {{ __('translations.admin') }}
                        @else
                         <?php $usertype = App\Usertype::where('id', $val)->first(); ?> 
                         {{ $usertype->name }}
                        @endif
                          </td>

                          @elseif($keyy == 'role')
                   <td> {{ __('translations.role') }} </td>
                   <td> @if($val == 'owner')
                              {{ __('translations.admin') }}
                        @else
                         {{ $val }}
                        @endif
                          </td>

                   @elseif($keyy == 'discount')
                   <td> {{ __('translations.discount') }} </td>
                   <td> {{ $val > 0 ? $val : __('translations.no_discount') }}  </td>
                
                 @elseif($keyy == 'store_id')
                 <td> {{ __('translations.store_name') }}</td>
                    <?php $store = App\Store::where('id', $val)->first(); ?> 
                   <td> {{ $store->name }} </td>

                    @elseif($keyy == 'description')
                    <td>  {{ __('translations.description') }} </td>
                    <td> {!! $val !!}</td>

                  @elseif($keyy == 'category_id')
                 <td> {{ __('translations.category') }}</td>
                    <?php $category = App\Category::withTrashed()->where('id', $val)->first(); ?> 
                   <td> {{ $category->name }} </td>

                   @elseif($keyy == 'full_image')
                   <td>  {{ __('translations.image') }} </td>
                    <td> 
                      <img style="margin-top: 1px;" src="{{asset('shop_images/banners/'.$val)}}"  width="100px" height="50px" class="img img-circle" style="border: 3px solid black; margin-top: 25px;">  
                    </td>   

                   @elseif($keyy == 'bannering_type_id')
                   <td>  {{ __('translations.bannering_type') }} </td>
                    <td> 
                      <?php $bannering_type = App\BanneringType::where('id', $val)->select('name')->first(); ?>
                        {{ $bannering_type->name }}
                    </td> 

                    @elseif($keyy == 'banner_link')
                   <td>  {{ __('translations.banner_link') }} </td>
                    <td> 
                      {{ $val }}
                    </td>   

                    @elseif($keyy == 'title')
                   <td>  {{ __('translations.banner_title') }} </td>
                    <td> 
                      {{ $val }}
                    </td>   

                  <?php /* @elseif($keyy == 'slug')
                   <?php continue; ?> 
                   */ ?>

                    @elseif($keyy == 'subcategory_id')
                    <td> {{ __('translations.subcategory') }} </td>
                    <?php $subcategory = App\Subcategory::where('id', $val)->first(); ?> 
                    <td> {{ $subcategory->name }}  </td>
                 
                 @elseif($keyy == 'product_id')
                  @if($val > 0)
                     <td>  {{ __('translations.product_name') }} </td>
                    <?php $product = App\Product::where('id', $val)->first(); 
                     $prod_name = $product->name ?> 
                     <td>  {{ $prod_name }} </td> 
                  @endif
                 
                 
                 @elseif($keyy == 'seller_id')
                   @if($val > 0)
                  <td> {{ __('translations.seller_name') }} <td>
                    <?php $seller = App\Seller::where('id', $val)->first(); ?> 
                    <td> {{ $seller->name }}  <td>
                      @endif

                     @elseif($keyy == 'available_online')
                  <td> {{ __('translations.available_online') }} </td>
                    <td> 
                      @if($val == 1)
                         {{ __('translations.available') }}
                      @else
                         {{ __('translations.unavailable') }}
                      @endif
                    </td>

                @elseif($keyy == 'category_online_id')
                @if(!empty($val))
                  <td> {{ __('translations.category_online') }} </td>
                    <?php $categoryon = App\CategoryOnline::where('id', $val)->first(); ?> 
                    <td> {{ $categoryon->name }}  </td>
                @endif

                  @elseif($keyy == 'price')
                <td>   {{ __('translations.price') }} </td>
                  <td>   {{ $val }} {{ __('translations.egp') }} </td>   

                    @elseif($keyy == 'archive')
                    <td> {{ __('translations.archive') }}</td>
                    <td>  {{ $val == 1 ?  __('translations.yes') :  __('translations.not_archived') }} </td>

                    @elseif($keyy == 'num_of_orders' || $keyy == 'quantity' || $keyy == 'status')
                    <?php continue; ?>

                    @elseif($keyy == 'weight')
                    <td> {{ __('translations.weight') }}</td>
                    <td> {{ $val }} {{ 'جرام' }}</td>   

                    @elseif($keyy == 'image')
                     <td>  {{ __('translations.image') }} </td>
                   <td>  @if(strlen($val) > 20)
                     <img style="margin-top: -20px;" src="{{asset('clients/images/'.$val)}}"  width="100px" height="100px" class="img img-circle" style="border: 3px solid black; margin-top: 25px;">  </td>  
                     @else
                     {{ __('translations.no_image') }}
                     @endif  </td>

                     @elseif($keyy == 'suspend')
                     <td> {{ __('translations.suspend') }}</td>
                   <td>  {{ $val == 0 ? __('translations.not_suspended') : __('translations.suspended') }} </td>


                     @elseif($keyy == 'phone')
                     <td> {{ __('translations.phone') }} </td>
                    <td> {{ $val == null ? __('translations.no_phone') : $val }} </td> 

                     @elseif($keyy == 'password')
                      <td> {{ __('translations.password') }} </td>
                    <td> @if($val == null)
                          <?php // {{ __('translations.no_pass') }}  ?> 
                            <label style="height: 15px; background: black; width:150px;"> </label>
                          @else
                          <label style="height: 15px; background: black; width:150px;"> </label>
                         <?php // {{ __('translations.cant') }} ?>
                          @endif   
                    </td>
                    <?php // continue; ?>
                 
                 @else
                <td> {{ __('translations.'.$keyy) }}</td>  <td> {{ $val }} </td>
              
                @endif
</tr>
@endif
              @endforeach
           @endif
        @endforeach
        </table>
@endif
@endif

<?php // case updated ?>

@if($activity->description == 'updated')

@if($activity->subject_type == 'App\Usertypeprice')
<div class="text-center">
                <h3 style="color:green;"> {{ __('translations.by') }} <i class="fa fa-user"></i> {{ $auth_user->name }} <br><br> {{ $activity->created_at }} 
                </h3>
              </div>
    <table class="table table-bordered"> 
<?php /* $count = 0; 
@foreach($old as $one => $two)
  @foreach($two as $o => $t)
   <?php //  {{ $o }} {{ $t }}<br> ?> */ ?>
        
        @foreach($activity->properties as $k => $property)
           @if($k == 'attributes')
           <h4> {{ __('translations.after_update') }}</h4>

             @foreach ($property as $keyy => $val)
             
             <?php // $count++; ?>
             
              @if($keyy == 'usertype_id')
              <tr>
                    <td> {{ __('translations.usertype') }}</td>
                  <?php $usertype = App\Usertype::where('id', $val)->first(); ?> 
                    <td> {{ $usertype->name }} </td>
                  </tr>
                @endif

                @if($keyy == 'product_id')
                 @if($val > 0)
                <tr>
                    <td> {{ __('translations.product_name') }}</td>
                  <?php $prod = App\Product::where('id', $val)->first(); ?> 
                    <td> {{ $prod->name }} </td>
                  </tr>
                  @endif
                @endif

                  @if($keyy == 'price')
                  <tr>
                  <td>{{ __('translations.price') }} </td>
                   <td> {{ $val }} {{ __('translations.egp') }} </td>  
                   </tr> 
                @endif

              @endforeach
           @endif

           @if($k == 'old')
         </table>
         <table class="table table-bordered">
           <h4> {{ __('translations.before_update') }}</h4>

             @foreach ($property as $keyy => $val)
             
             <?php // $count++; ?>
             
              @if($keyy == 'usertype_id')
              <tr>
                    <td> {{ __('translations.usertype') }}</td>
                  <?php $usertype = App\Usertype::where('id', $val)->first(); ?> 
                    <td> {{ $usertype->name }} </td>
                  </tr>
                @endif

                @if($keyy == 'product_id')
                 @if($val > 0)
                <tr>
                    <td> {{ __('translations.product_name') }}</td>
                  <?php $prod = App\Product::where('id', $val)->first(); ?> 
                    <td> {{ $prod->name }} </td>
                  </tr>
                  @endif
                @endif

                  @if($keyy == 'price')
                  <tr>
                  <td>{{ __('translations.price') }} </td>
                   <td> {{ $val }} {{ __('translations.egp') }} </td>  
                   </tr> 
                @endif

              @endforeach
           @endif
        @endforeach
        
</table>
 <?php // image section ?>
  
@elseif($activity->subject_type == 'App\Image')
<div class="text-center">
                <h3 style="color:green;"> {{ __('translations.by') }} <i class="fa fa-user"></i> {{ $auth_user->name }} <br><br> {{ $activity->created_at }}</h3>
              </div>

<h4> {{ __('translations.after_update') }}</h4>

<table class="table table-bordered"> 

@foreach($old as $one => $two)
  @foreach($two as $o => $t)
   <?php //  {{ $o }} {{ $t }}<br> ?>
        
        @foreach($activity->properties as $k => $property)
           @if($k == 'attributes')
             @foreach ($property as $keyy => $val)

               @if($o == $keyy && $t != $val)
              <tr>
               @if($keyy == 'product_id')
                @if($val > 0)
                <?php $thisprod = App\Product::where('id', $val)->first(); ?> 
                  <td> {{ __('translations.product') }}  </td>
                  <td>  {{ $thisprod->name }} </td>
                   @endif

                    @elseif($keyy == 'image')
                   <td> {{ __('translations.image') }} </td>
                   <td>  <img src="{{asset('storage/'.$val)}}" width="100" height="100"> </td>    
                 @else
                <td> {{ __('translations.'.$keyy) }}</td>  <td> {{ $val }} </td>
              
                @endif
              </tr>
              @endif

              @endforeach
           @endif
        @endforeach

  @endforeach
@endforeach
</table>

<h4 class=""> {{ __('translations.before_update') }}</h4>

<table class="table table-bordered">
@foreach($new as $one => $two)
  @foreach($two as $o => $t)
   <?php //  {{ $o }} {{ $t }}<br> ?>
        
        @foreach($activity->properties as $k => $property)
           @if($k == 'old')
             @foreach ($property as $keyy => $val)

               @if($o == $keyy && $t != $val)
              <tr>
               @if($keyy == 'product_id')
                @if($val > 0)
                <?php $thisprod = App\Product::where('id', $val)->first(); ?> 
                  <td> {{ __('translations.product') }}  </td>
                  <td>  {{ $thisprod->name }} </td>
                   @endif
                   
                    @elseif($keyy == 'image')
                   <td> {{ __('translations.image') }} </td>
                   <td>  <img src="{{asset('storage/'.$val)}}" width="100" height="100"> </td>    
                 @else
                <td> {{ __('translations.'.$keyy) }}</td>  <td> {{ $val }} </td>
              
                @endif
              </tr>
                       
               @endif

              @endforeach
           @endif
        @endforeach

  @endforeach
@endforeach
</table>
        <?php // image section ?>
<?php // seller ?>

@elseif($activity->subject_type == 'App\Seller')
<div class="text-center">
                <h3 style="color:green;"> {{ __('translations.by') }} <i class="fa fa-user"></i> {{ $auth_user->name }} <br><br> {{ $activity->created_at }}</h3>
              </div>
       @foreach($activity->properties as $k => $property)
           @if($k == 'attributes')
             @foreach ($property as $keyy => $val)
             @if($keyy == 'name')
             <table class="table table-bordered">
               <tr>
                 <td> {{ __('translations.seller_name') }}</td>
                 <td> {{ $val }}</td>
               </tr>
             </table>
             @endif
             @endforeach
             @endif
             @endforeach

<h4> {{ __('translations.after_update') }}</h4>

<table class="table table-bordered"> 

@foreach($old as $one => $two)
  @foreach($two as $o => $t)
   <?php //  {{ $o }} {{ $t }}<br> ?>
        
        @foreach($activity->properties as $k => $property)
           @if($k == 'attributes')
             @foreach ($property as $keyy => $val)

               @if($o == $keyy && $t != $val)
              <tr>
             
               @if($keyy == 'user_id')
                <td> {{ __('translations.client_name') }} </td>
                  <?php $user = App\User::where('id', $val)->first(); ?> 
                    <td> {{ $user->name }} </td>

                    @elseif($keyy == 'usertype_id')
                    <td> {{ __('translations.usertype') }}</td>
                  <?php $usertype = App\Usertype::where('id', $val)->first(); ?> 
                    <td> {{ $usertype->name }} </td>
                
                 @elseif($keyy == 'store_id')
                 <td> {{ __('translations.store_name') }} </td>
                    <?php $store = App\Store::where('id', $val)->first(); ?> 
                   <td> {{ $store->name }}  </td>

                  @elseif($keyy == 'category_id')
                   <td> {{ __('translations.category') }} </td>
                    <?php $category = App\Category::where('id', $val)->first(); ?> 
                    <td> {{ $category->name }}  </td>

                    @elseif($keyy == 'subcategory_id')
                     <td> {{ __('translations.subcategory') }} </td>
                    <?php $subcategory = App\Subcategory::where('id', $val)->first(); ?> 
                    <td> {{ $subcategory->name }}  </td>
                 
                 @elseif($keyy == 'product_id')
                  @if($val > 0)
                  <td> {{ __('translations.product_name') }} </td>
                    <?php $product = App\Product::where('id', $val)->first(); ?> 
                    <td> {{ $product->name }}  </td>
                    @endif
                 
                 @elseif($keyy == 'seller_id')
                  @if($val > 0)
                  <td> {{ __('translations.seller_name') }} <td>
                    <?php $seller = App\Seller::where('id', $val)->first(); ?> 
                    <td> {{ $seller->name }}  <td>
                      @endif

                  @elseif($keyy == 'price')
                  <td>{{ __('translations.price') }} </td>
                   <td> {{ $val }} {{ __('translations.egp') }} </td>   

                    @elseif($keyy == 'archive')
                   <td> {{ __('translations.archive') }} </td>
                   <td> {{ $val == 1 ?  __('translations.yes') :  __('translations.not_archived') }}  </td>

                     @elseif($keyy == 'discount')
                     <td> {{ __('translations.discount') }}</td>
                    <td>  {{  $val > 0 ? $val : __('translations.no_discount') }} </td>
                    <?php // <td>  {{  $val > 0 ? $val. ' '. '%' : __('translations.no_discount') }} </td> ?>

                    @elseif($keyy == 'weight')
                   <td>  {{ __('translations.weight') }} </td>
                    <td> {{ $val }} {{ 'جرام' }}  </td>  

                     @elseif($keyy == 'suspend')
                    <td>  {{ __('translations.suspend') }} </td>
                    <td> {{ $val == 0 ? __('translations.not_suspended') : __('translations.suspended') }}  </td>

                     @elseif($keyy == 'phone')
                    <td>  {{ __('translations.phone') }} </td>
                   <td>  {{ $val == null ? __('translations.no_phone') : $val }}  </td>

                   @elseif($keyy == 'password')
                    <td> {{ __('translations.password') }}</td>
                    <td> <input class="form-control" type="password" name="pass" value="{{str_random(30)}}"> </td>
                 
                 @else
               <td> {{ __('translations.'.$keyy) }}</td> <td> {{ $val }} </td>
              
                @endif
              </tr>
               @endif

              @endforeach
           @endif
        @endforeach

  @endforeach
@endforeach
</table>

<h4 class=""> {{ __('translations.before_update') }}</h4>

<table class="table table-bordered">
@foreach($new as $one => $two)
  @foreach($two as $o => $t)
   <?php //  {{ $o }} {{ $t }}<br> ?>
        
        @foreach($activity->properties as $k => $property)
           @if($k == 'old')
             @foreach ($property as $keyy => $val)

               @if($o == $keyy && $t != $val)
               <tr>
                       @if($keyy == 'user_id')
                   <td> {{ __('translations.client_name') }}  </td>
                  <?php $user = App\User::where('id', $val)->first(); ?> 
                     <td> {{ $user->name }}  </td>

                    @elseif($keyy == 'usertype_id')
                    <td>  {{ __('translations.usertype') }} </td>
                  <?php $usertype = App\Usertype::where('id', $val)->first(); ?> 
                    <td>  {{ $usertype->name }}  </td>
                
                 @elseif($keyy == 'store_id')
                  <td>  {{ __('translations.store_name') }} </td>
                    <?php $store = App\Store::where('id', $val)->first(); ?> 
                     <td> {{ $store->name }}  </td>

                  @elseif($keyy == 'category_id')
                  <td>  {{ __('translations.category') }} </td>
                    <?php $category = App\Category::where('id', $val)->first(); ?> 
                     <td> {{ $category->name }} </td> 

                    @elseif($keyy == 'subcategory_id')
                    <td>  {{ __('translations.subcategory') }} </td>
                    <?php $subcategory = App\Subcategory::where('id', $val)->first(); ?> 
                    <td>  {{ $subcategory->name }}  </td>
                 
                 @elseif($keyy == 'product_id')
                  @if($val > 0)
                 <td> {{ __('translations.product') }} </td>
                    <?php $product = App\Product::where('id', $val)->first(); ?> 
                    <td> {{ $product->name }}  </td>
                 @endif

                 @elseif($keyy == 'seller_id')
                 @if($val > 0)
                  <td> {{ __('translations.seller_name') }} <td>
                    <?php $seller = App\Seller::where('id', $val)->first(); ?> 
                    <td> {{ $seller->name }}  <td>
                      @endif

                  @elseif($keyy == 'price')
                  <td>  {{ __('translations.price') }} </td>
                   <td>  {{ $val }} {{ __('translations.egp') }}   </td> 

                    @elseif($keyy == 'archive')
                    <td>  {{ __('translations.archive') }} </td>
                    <td> {{ $val == 1 ?  __('translations.yes') :  __('translations.not_archived') }}  </td>

                     @elseif($keyy == 'discount')
                    <td>   {{ __('translations.discount') }} </td>
                    <td> {{  $val > 0 ? $val : __('translations.no_discount') }}  </td>
                   <?php // <td> {{  $val > 0 ? $val. ' '. '%' : __('translations.no_discount') }}  </td> ?>

                    @elseif($keyy == 'weight')
                    <td>  {{ __('translations.weight') }} </td>
                   <td>  {{ $val }} {{ 'جرام' }}   </td> 

                     @elseif($keyy == 'suspend')
                     <td>  {{ __('translations.suspend') }} </td>
                   <td>  {{ $val == 0 ? __('translations.not_suspended') : __('translations.suspended') }}  </td>

                     @elseif($keyy == 'phone')
                     <td> {{ __('translations.phone') }}</td>
                    <td> {{ $val == null ? __('translations.no_phone') : $val }} </td>

                     @elseif($keyy == 'password')
                    <td> {{ __('translations.password') }}</td>
                    <td> <input class="form-control" type="password" name="pass" value="{{str_random(30)}}"> </td>
                 
                 @else
                <td> {{ __('translations.'.$keyy) }}</td> <td> {{ $val }} </td>
              
                @endif
              </tr>
               @endif

              @endforeach
           @endif
        @endforeach

  @endforeach
@endforeach
</table>

<?php // start new permission role ?>

     @elseif($activity->subject_type == 'Spatie\Permission\Models\Role')
<div class="text-center">
                <h3 style="color:green;"> {{ __('translations.by') }} <i class="fa fa-user"></i> {{ $auth_user->name }} <br><br> {{ $activity->created_at }}</h3>
              </div>
  <?php $role = Spatie\Permission\Models\Role::withTrashed()->where('id', $activity->subject_id)->first(); ?>
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
      
       <h4 class=""> {{ __('translations.after_update') }}</h4>
       <table class="table table-bordered">
         <h3 class="text-center"> {{  $naming  }}</h3>
         <?php /* @if(count($role->permissions) > 0)
                 <tr><th style="text-align: right;"> {{ __('translations.permissions') }}  </th></tr>
                    @foreach($role->permissions as $permission)
                      <tr>
                          <td> {{ $permission->name  }}  </td>
                      </tr>          
                    @endforeach
          @endif */ ?>
          <tr><th style="text-align: right;"> {{ __('translations.permissions') }}  </th>
          <?php // <th style="text-align: right;"> {{ __('translations.created_at') }}  </th></tr> ?>
                    @foreach(json_decode($activity->new_permissions) as $created => $permission)
                      <tr>
                          <td> {{ __('translations.'.$permission)  }} </td>
                         <?php // <td> {{ $created  }}  </td> ?>
                     @endforeach
          </tr>     
        </table>      
<br>
   <h4 class=""> {{ __('translations.before_update') }}</h4>
        <table class="table table-bordered">
         <?php 
                      if(!strstr($activity->properties, 'attributes'))
                      {
                        $naming = $activity->properties;
                      }
                      else{
                          foreach($activity->properties as $key => $property){
                                      if($key == 'old'){
                                          foreach($property as $ikey => $ival){
                                             if($ikey == 'name'){
                                                $naming =  $ival;
                                             }
                                          }
                                      }
                                  }
                       }
                       ?>
          <h3 class="text-center"> {{  $naming  }}</h3>
          <tr><th style="text-align: right;"> {{ __('translations.permissions') }}  </th>
          <?php // <th style="text-align: right;"> {{ __('translations.created_at') }}  </th></tr> ?>
                    @foreach(json_decode($activity->old_permissions) as $created => $permission)
                      <tr>
                          <td>{{ __('translations.'.$permission)  }}  </td>
                      <?php //    <td> {{ $created  }}  </td> ?>
                     @endforeach
          </tr>     
        </table>         

<?php // end new permission role ?>
@else
 <div class="text-center">
                <h3 style="color:green;"> {{ __('translations.by') }} <i class="fa fa-user"></i> {{ $auth_user->name }} <br><br> {{ $activity->created_at }} </h3>
              </div>
<h4> {{ __('translations.after_update') }}</h4>

<table class="table table-bordered"> 

@foreach($old as $one => $two)
  @foreach($two as $o => $t)
   <?php //  {{ $o }} {{ $t }}<br> ?>
        
        @foreach($activity->properties as $k => $property)
           @if($k == 'attributes')
             @foreach ($property as $keyy => $val)

               @if($o == $keyy && $t != $val)
              <tr>
             
               @if($keyy == 'user_id')
                <td> {{ __('translations.client_name') }} </td>
                  <?php $user = App\User::where('id', $val)->first(); ?> 
                    <td> {{ $user->name }} </td>

                    @elseif($keyy == 'usertype_id')
                    <td> {{ __('translations.usertype') }}</td>
                  <?php $usertype = App\Usertype::where('id', $val)->first(); ?> 
                    <td> {{ $usertype->name }} </td>
                
                 @elseif($keyy == 'store_id')
                 <td> {{ __('translations.store_name') }} </td>
                    <?php $store = App\Store::where('id', $val)->first(); ?> 
                   <td> {{ $store->name }}  </td>

                  @elseif($keyy == 'category_id')
                   <td> {{ __('translations.category') }} </td>
                    <?php $category = App\Category::where('id', $val)->first(); ?> 
                    <td> {{ $category->name }}  </td>

                    @elseif($keyy == 'subcategory_id')
                     <td> {{ __('translations.subcategory') }} </td>
                    <?php $subcategory = App\Subcategory::where('id', $val)->first(); ?> 
                    <td> {{ $subcategory->name }}  </td>
                 
                 @elseif($keyy == 'product_id')
                  @if($val > 0)
                  <td> {{ __('translations.product_name') }} </td>
                    <?php $product = App\Product::where('id', $val)->first(); ?> 
                    <td> {{ $product->name }}  </td>
                 @endif 
                 @elseif($keyy == 'seller_id')
                  @if($val > 0)
                  <td> {{ __('translations.seller_name') }} <td>
                    <?php $seller = App\Seller::where('id', $val)->first(); ?> 
                    <td> {{ $seller->name }}  <td>
                      @endif

                  @elseif($keyy == 'price')
                  <td>{{ __('translations.price') }} </td>
                   <td> {{ $val }} {{ __('translations.egp') }} </td>   

                    @elseif($keyy == 'archive')
                   <td> {{ __('translations.archive') }} </td>
                   <td> {{ $val == 1 ?  __('translations.yes') :  __('translations.not_archived') }}  </td>

                     @elseif($keyy == 'discount')
                     <td> {{ __('translations.discount') }}</td>
                    <td>  {{  $val > 0 ? $val : __('translations.no_discount') }} </td>
                    <?php // <td>  {{  $val > 0 ? $val. ' '. '%' : __('translations.no_discount') }} </td> ?>

                    @elseif($keyy == 'weight')
                   <td>  {{ __('translations.weight') }} </td>
                    <td> {{ $val }} {{ 'جرام' }}  </td>  

                     @elseif($keyy == 'description')
                    <td>  {{ __('translations.description') }} </td>
                    <td> {!! $val !!}</td>

                    @elseif($keyy == 'full_image')
                   <td>  {{ __('translations.image') }} </td>
                    <td> 
                      <img style="margin-top: 1px;" src="{{asset('shop_images/banners/'.$val)}}"  width="100px" height="50px" class="img img-circle" style="border: 3px solid black; margin-top: 25px;">  
                    </td>   

                    @elseif($keyy == 'bannering_type_id')
                   <td>  {{ __('translations.bannering_type') }} </td>
                    <td> 
                      <?php $bannering_type = App\BanneringType::where('id', $val)->select('name')->first(); ?>
                        {{ $bannering_type->name }}
                    </td>   

                    @elseif($keyy == 'banner_link')
                   <td>  {{ __('translations.banner_link') }} </td>
                    <td> 
                      {{ $val }}
                    </td>   

                    @elseif($keyy == 'title')
                   <td>  {{ __('translations.banner_title') }} </td>
                    <td> 
                      {{ $val }}
                    </td>   


                    @elseif($keyy == 'image')
                   <td>  {{ __('translations.image') }} </td>
                    <td> 
                    @if(strlen($val) > 20)
                     <img style="margin-top: -20px;" src="{{asset('clients/images/'.$val)}}"  width="100px" height="100px" class="img img-circle" style="border: 3px solid black; margin-top: 25px;">  </td>  
                     @else
                     {{ $val }}
                     @endif
                     @elseif($keyy == 'suspend')
                    <td>  {{ __('translations.suspend') }} </td>
                    <td> {{ $val == 0 ? __('translations.not_suspended') : __('translations.suspended') }}  </td>

                     @elseif($keyy == 'phone')
                    <td>  {{ __('translations.phone') }} </td>
                   <td>  {{ $val == null ? __('translations.no_phone') : $val }}  </td>

                   @elseif($keyy == 'order_status')
                    <td>  {{ __('translations.order_status') }} </td>
                   <td> @if($val == 'pending')
                    {{ __('translations.pending') }} 
                       @elseif($val == 'in progress')
                       {{ __('translations.in progress') }}
                       @elseif($val == 'canceled')
                       {{ __('translations.canceled') }}
                       @else
                       {{ __('translations.delivered') }}
                       @endif 
                         </td>

                          @elseif($keyy == 'transfer_id')
                    @if(!empty($val))
                   <td> {{ __('translations.transfer_number') }} </td>
                   <td> {{ $val }}  </td>
                   @endif

                   @elseif($keyy == 'from_store')
                     @if(!empty($val))
                   <td> {{ __('translations.transfer_from_store') }} </td>
                  <?php $from_store = App\Store::where('id', $val)->select('name')->first(); ?>
                   <td> {{ $from_store->name }}  </td>
                    @endif

                   @elseif($keyy == 'to_store')
                   @if(!empty($val))
                   <td> {{ __('translations.transfer_to_store') }} </td>
                  <?php $to_store = App\Store::where('id', $val)->select('name')->first(); ?>
                   <td> {{ $to_store->name }}  </td>
                   @endif

                   @elseif($keyy == 'settle_id')
                    @if(!empty($val))
                   <td> {{ __('translations.settle_number') }} </td>
                   <td> {{ $val }}  </td>
                   @endif

                         @elseif($keyy == 'refund_id')
                    @if(!empty($val))
                   <td> {{ __('translations.refund_number') }} </td>
                   <td> {{ $val }}  </td>
                   @endif

                @elseif($keyy == 'category_online_id')
                @if(!empty($val))
                  <td> {{ __('translations.category_online') }} </td>
                    <?php $categoryon = App\CategoryOnline::where('id', $val)->first(); ?> 
                    <td> {{ $categoryon->name }}  </td>
                  @else
                   <td> {{ __('translations.category_online') }} </td>
                    <?php $categoryon = App\CategoryOnline::where('id', $val)->first(); ?> 
                    <td> {{ __('translations.no_category_online') }}  </td>
                @endif

                @elseif($keyy == 'available_online')
                  <td> {{ __('translations.available_online') }} </td>
                    <td> 
                      @if($val == 1)
                         {{ __('translations.available') }}
                      @else
                         {{ __('translations.unavailable') }}
                      @endif
                    </td>

                      @elseif($keyy == 'type')
                 <td> {{ __('translations.type') }}</td>
                   <td> {{ __('translations.'.$val) }} </td>

                    @elseif($keyy == 'password')
                      <td> {{ __('translations.password') }} </td>
                    <td> 
                         @if($val == null)
                          <?php //  {{ __('translations.no_pass') }} ?>
                             <label style="height: 15px; background: black; width:150px;"> </label>
                          @else
                            <label style="height: 15px; background: black; width:150px;"> </label>
                            <?php // {{ __('translations.cant') }} ?>
                          @endif   
                        </td>
                 
                 @else
               <td> {{ __('translations.'.$keyy) }}</td> <td> {{ $val }} </td>
              
                @endif
              </tr>
               @endif

              @endforeach
           @endif
        @endforeach

  @endforeach
@endforeach
</table>

<h4 class=""> {{ __('translations.before_update') }}</h4>

<table class="table table-bordered">
@foreach($new as $one => $two)
  @foreach($two as $o => $t)
   <?php //  {{ $o }} {{ $t }}<br> ?>
        
        @foreach($activity->properties as $k => $property)
           @if($k == 'old')
             @foreach ($property as $keyy => $val)

               @if($o == $keyy && $t != $val)
               <tr>
                       @if($keyy == 'user_id')
                   <td> {{ __('translations.client_name') }}  </td>
                  <?php $user = App\User::where('id', $val)->first(); ?> 
                     <td> {{ $user->name }}  </td>

                    @elseif($keyy == 'usertype_id')
                    <td>  {{ __('translations.usertype') }} </td>
                  <?php $usertype = App\Usertype::where('id', $val)->first(); ?> 
                    <td>  {{ $usertype->name }}  </td>
                
                 @elseif($keyy == 'store_id')
                  <td>  {{ __('translations.store_name') }} </td>
                    <?php $store = App\Store::where('id', $val)->first(); ?> 
                     <td> {{ $store->name }}  </td>

                  @elseif($keyy == 'category_id')
                  <td>  {{ __('translations.category') }} </td>
                    <?php $category = App\Category::where('id', $val)->first(); ?> 
                     <td> {{ $category->name }} </td> 

                    @elseif($keyy == 'subcategory_id')
                    <td>  {{ __('translations.subcategory') }} </td>
                    <?php $subcategory = App\Subcategory::where('id', $val)->first(); ?> 
                    <td>  {{ $subcategory->name }}  </td>

                    @elseif($keyy == 'category_online_id')
                @if(!empty($val))
                  <td> {{ __('translations.category_online') }} </td>
                    <?php $categoryon = App\CategoryOnline::where('id', $val)->first(); ?> 
                    <td> {{ $categoryon->name }}  </td>
                @else
                   <td> {{ __('translations.category_online') }} </td>
                    <?php $categoryon = App\CategoryOnline::where('id', $val)->first(); ?> 
                    <td> {{ __('translations.no_category_online') }}  </td>
                @endif
                 
                 @elseif($keyy == 'product_id')
                  @if($val > 0)
                 <td> {{ __('translations.product_name') }} </td>
                    <?php $product = App\Product::where('id', $val)->first(); ?> 
                    <td> {{ $product->name }}  </td>
                 @endif 

                 @elseif($keyy == 'seller_id')
                 @if($val > 0)
                  <td> {{ __('translations.seller_name') }} <td>
                    <?php $seller = App\Seller::where('id', $val)->first(); ?> 
                    <td> {{ $seller->name }}  <td>
                      @endif

                  @elseif($keyy == 'price')
                  <td>  {{ __('translations.price') }} </td>
                   <td>  {{ $val }} {{ __('translations.egp') }}   </td> 

                    @elseif($keyy == 'archive')
                    <td>  {{ __('translations.archive') }} </td>
                    <td> {{ $val == 1 ?  __('translations.yes') :  __('translations.not_archived') }}  </td>

                     @elseif($keyy == 'description')
                    <td>  {{ __('translations.description') }} </td>
                    <td> {!! $val !!}</td>

                     @elseif($keyy == 'discount')
                    <td>   {{ __('translations.discount') }} </td>
                    <td> {{  $val > 0 ? $val : __('translations.no_discount') }}  </td>
                    <?php //<td> {{  $val > 0 ? $val. ' '. '%' : __('translations.no_discount') }}  </td> ?>

                    @elseif($keyy == 'weight')
                    <td>  {{ __('translations.weight') }} </td>
                   <td>  {{ $val }} {{ 'جرام' }}   </td> 

                   @elseif($keyy == 'full_image')
                   <td>  {{ __('translations.image') }} </td>
                    <td> 
                      <img style="margin-top: 1px;" src="{{asset('shop_images/banners/'.$val)}}"  width="100px" height="50px" class="img img-circle" style="border: 3px solid black; margin-top: 25px;">  
                    </td>   

                    @elseif($keyy == 'bannering_type_id')
                   <td>  {{ __('translations.bannering_type') }} </td>
                    <td> 
                      <?php $bannering_type = App\BanneringType::where('id', $val)->select('name')->first(); ?>
                        {{ $bannering_type->name }}
                    </td>   

                    @elseif($keyy == 'banner_link')
                   <td>  {{ __('translations.banner_link') }} </td>
                    <td> 
                      {{ $val }}
                    </td>   

                    @elseif($keyy == 'title')
                   <td>  {{ __('translations.banner_title') }} </td>
                    <td> 
                      {{ $val }}
                    </td>   

                     @elseif($keyy == 'suspend')
                     <td>  {{ __('translations.suspend') }} </td>
                   <td>  {{ $val == 0 ? __('translations.not_suspended') : __('translations.suspended') }}  </td>

                   @elseif($keyy == 'image')
                     <td>  {{ __('translations.image') }} </td>
                   <td>  @if(strlen($val) > 20)
                     <img style="margin-top: -20px;" src="{{asset('clients/images/'.$val)}}"  width="100px" height="100px" class="img img-circle" style="border: 3px solid black; margin-top: 25px;">  </td>  
                     @else
                     {{ $val }}
                     @endif  </td>

                     @elseif($keyy == 'order_status')
                    <td>  {{ __('translations.order_status') }} </td>
                   <td> @if($val == 'pending')
                    {{ __('translations.pending') }} 
                       @elseif($val == 'in progress')
                       {{ __('translations.in progress') }}
                       @elseif($val == 'canceled')
                       {{ __('translations.canceled') }}
                       @else
                       {{ __('translations.delivered') }}
                       @endif 
                         </td>

                         @elseif($keyy == 'refund_id')
                    @if(!empty($val))
                   <td> {{ __('translations.refund_number') }} </td>
                   <td> {{ $val }}  </td>
                   @endif

                    @elseif($keyy == 'transfer_id')
                    @if(!empty($val))
                   <td> {{ __('translations.transfer_number') }} </td>
                   <td> {{ $val }}  </td>
                   @endif

                   @elseif($keyy == 'settle_id')
                    @if(!empty($val))
                   <td> {{ __('translations.settle_number') }} </td>
                   <td> {{ $val }}  </td>
                   @endif

                         @elseif($keyy == 'available_online')
                  <td> {{ __('translations.available_online') }} </td>
                    <td> 
                      @if($val == 1)
                         {{ __('translations.available') }}
                      @else
                         {{ __('translations.unavailable') }}
                      @endif
                    </td>

                    @elseif($keyy == 'from_store')
                     @if(!empty($val))
                   <td> {{ __('translations.transfer_from_store') }} </td>
                  <?php $from_store = App\Store::where('id', $val)->select('name')->first(); ?>
                   <td> {{ $from_store->name }}  </td>
                    @endif

                   @elseif($keyy == 'to_store')
                   @if(!empty($val))
                   <td> {{ __('translations.transfer_to_store') }} </td>
                  <?php $to_store = App\Store::where('id', $val)->select('name')->first(); ?>
                   <td> {{ $to_store->name }}  </td>
                   @endif

                     @elseif($keyy == 'phone')
                     <td> {{ __('translations.phone') }}</td>
                    <td> {{ $val == null ? __('translations.no_phone') : $val }} </td>

                      @elseif($keyy == 'type')
                 <td> {{ __('translations.type') }}</td>
                   <td> {{ __('translations.'.$val) }} </td>

                    @elseif($keyy == 'password')
                      <td> {{ __('translations.password') }} </td>
                    <td> 
                         @if($val == null)
                           <?php // {{ __('translations.no_pass') }}  ?> 
                            <label style="height: 15px; background: black; width:150px;"> </label>
                          @else
                            <label style="height: 15px; background: black; width:150px;"> </label>
                            <?php // {{ __('translations.cant') }} ?>
                          @endif   
                        </td>
                 
                 @else
                <td> {{ __('translations.'.$keyy) }}</td> <td> {{ $val }} </td>
              
                @endif
              </tr>
               @endif

              @endforeach
           @endif
        @endforeach

  @endforeach
@endforeach
</table>
@endif
@endif

@stop













