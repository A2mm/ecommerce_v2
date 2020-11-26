@extends('owner_dashboard.master')

@section('body')

  <section class="content-header">
    <h1>
      {{__('translations.log')}}
    </h1>
  </section>

  <br>
  <div class="row">
  <div class="col-md-9">

              <form class="form form-horizontal" method="get" action="{{route('owner.log')}}">
  <div class="row">
  
  <div class="col-md-3"> 
  &nbsp; <b> {{__('translations.day')}} </b>
 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
 ( {{ 'سنة/يوم/شهر' }} )
  <input type="date" class="form-control" name="search_day" value="{{$search_day}}" style="display: inline-block;"> 
  </div>

 <div class="col-md-3"> 
  &nbsp; <b> {{ __('translations.from_hour') }} </b>
 <input type="time" class="form-control" name="from_hour" value="{{$from_hour}}" style="display: inline-block;"> 
 </div>
 
 <div class="col-md-3"> 
  &nbsp; <b> {{ __('translations.to_hour') }} </b>
  <input type="time" class="form-control" name="to_hour" value="{{$to_hour}}" style="display: inline-block;"> 
 </div>
 
 <div class="col-md-3"> <br>
  <button style="height: 33px;" type="submit" class="btn btn-sm btn-primary"> <i class="fa fa-search"></i> {{ __('translations.search') }}</button> 
 </div>

</div>
</form>
</div>
 
<div class="col-md-2 sub">
  <br>
   <a style="height: 33px;" class="btn btn-sm btn-danger back_home" href="{{ route('owner.log') }}"> 
     {{ __('translations.back_home') }} <i class="fa fa-arrow-left"></i> </a> 
</div>

</div>

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
        <tr>
          <th style="text-align: right;"> {{__('translations.description')}}</th>
         <?php //  <th>{{__('translations.subject_id')}}</th> ?>
         <?php //  <th>{{__('translations.subject_type')}}</th> ?>
         <td> {{ __('translations.ip') }}</td>
         <th style="text-align: right">  {{ __('translations.created_at') }} </th>
          <th style="text-align: right"> {{__('translations.actions')}}</th>
        </tr>
      </thead>

      <tbody>
      @foreach($records as $key => $activity)
              
               <?php $subj = substr($activity->subject_type, 4); ?>
                
                @if($subj == 'ProductStoreQuantity')                    
                       @if($activity->causer_id != null)
                        <tr> 
                            <td>
                             <?php /*{{ __('translations.'.$activity->description) }}  */ ?>
                             {{ __('translations.in_product_store_quantities_table') }}
                            </td> 
                            <td> {{ $activity->ip }}</td>
                            <td> {{ $activity->created_at }} 
                              <u> {{ $activity->created_at->diffForHumans() }} </u>
                            </td>
                            <td> 
          <a class="btn bt-xs btn-info" href="{{route('manage.activities.specific', ['id' => $activity->id])}}"> 
            <i class="fa fa-eye"></i> {{ __('translations.view') }}</a>
        </td>
                        </tr>
                      
                     @endif

               @elseif($subj == 'User')
            
                      @if($activity->causer_id != null)
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
                            <td> 
          <a class="btn bt-xs btn-info" href="{{route('manage.activities.specific', ['id' => $activity->id])}}"> 
            <i class="fa fa-eye"></i> {{ __('translations.view') }}</a>
        </td>
                        </tr>
                      @endif
            @else
      <tr>
        
        <td>
          {{ __('translations.'.$activity->description) }}
            <?php $subj = substr($activity->subject_type, 4); ?>
           
            @if($subj == 'Product')
            {{ __('translations.in_products_table') }}
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
                                ( {{ $prod->name }} )
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
        <td> 
          <a class="btn bt-xs btn-info" href="{{route('manage.activities.specific', ['id' => $activity->id])}}"> 
            <i class="fa fa-eye"></i> {{ __('translations.view') }}</a>
        </td>

     </tr>
     @endif
      @endforeach
      </tbody>
    </table>

   {!! $records->appends(['search_day' => $search_day, 'from_hour' => $from_hour, 'to_hour' => $to_hour])->render() !!} 
</div>

      </div>

    </div>

  </section>

@stop
