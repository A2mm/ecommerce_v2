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
      
      @foreach($activity->properties as $keyy => $item) 
      
      @if($keyy == 'old')
         <?php continue; ?>
      
      @else
            
            @foreach($item as $index => $value)
               <tr>
                 @if(!empty($value))

                <th> 

                 @if($index == 'user_id')
                    {{ __('translations.client_name') }} 
                
                 @elseif($index == 'store_id')
                    {{ __('translations.store_name') }} 
                 
                 @elseif($index == 'product_id')
                    {{ __('translations.product_name') }} 
                 
                 @elseif($index == 'seller_id')
                    {{ __('translations.seller_name') }} 
                 
                 @else
                    {{ __('translations.'.$index) }} 
                 @endif
            </th>
                <th> 
                  @if($index == 'user_id')
                  <?php $user = App\User::where('id', $value)->first(); ?> 
                    {{ $user->name }} 
                
                 @elseif($index == 'store_id')
                    <?php $store = App\Store::where('id', $value)->first(); ?> 
                    {{ $store->name }} 
                 
                 @elseif($index == 'product_id')
                    <?php $product = App\Product::where('id', $value)->first(); ?> 
                    {{ $product->name }} 
                 
                 @elseif($index == 'seller_id')
                    <?php $seller = App\Seller::where('id', $value)->first(); ?> 
                    {{ $seller->name }} 

                  @elseif($index == 'price')
                    {{ $value }} {{ __('translations.egp') }} 
                 
                 @else
                {{ $value }} 
              
                @endif

            </th>
            @endif
              </tr>
            @endforeach 

      @endif  
      
      @endforeach
      </thead>
    </table>
</div>

      </div>

    </div>

  </section>





  

@stop
