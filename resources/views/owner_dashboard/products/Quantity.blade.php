@extends('owner_dashboard.master')
@section('body')
  <section class="content-header">
    <h1>
      {{__('translations.edit_quantity')}}
    </h1>
  </section>
  
  <style type="text/css">
    
    .reason{
      display: none;
    }
     .subtracting{
      display: none;
    }

  </style>

   <section class="content">
    <div class="row">
      <div class="col-xs-12">
        <div class="box box-primary">
                  <!-- form start -->
            
                    <div class="box-body">
                      <div class="form-group">
                        <h3>{{trans('layout.Name')}} : {{$product->name}}</h3>
                        <h3>{{trans('layout.Quantity')}} : {{$product_quantity}}</h3>
                    
                        <table class="table table-bordered table-striped">
                        <thead>
                          @foreach($product->stores as $key => $store)
                          <tr>
                            <th>{{__('translations.quantity_at_store')}}{{ $store->name }}</th>
                            <th>{{ $store->quantity_of_product($product->id) }}</th>
                          </tr>
                          @endforeach
                        </thead>
                         <tbody>
                        </tbody>
                        </table>
                   {!! Form::open(['route' => 'manage.products.editQuantity.post', 'files' => true])  !!}

                  <input type="hidden" name="id" value="{{$product->id}}">

                  <div class="form-group">
                      <label for="shiporder_id"> * {{__('translations.shiporder')}}</i></label>
                      <input class="form-control" id="shiporder_id" type="number" name="shiporder_id" min="2" value="{{old('shiporder_id')}}">
                    </div>

                    <div class="form-group">
                       <label for="Store"> * {{__('translations.choose_a_store')}}</label>
                        <select class="form-control" id="store" name="store_id">
                            <option disabled selected>{{__('translations.choose_store')}}</option>
                            @foreach($stores as $key => $store)
                            <option value="{{ $store->id }}" {{ old("store_id") == $store->id ? "selected":"" }}>{{ $store->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                      <label for="quantity"> * {{__('translations.quantity')}}</i></label>
                      <input class="form-control" id="quantity" type="number" min="1" max="999999" name="quantity" value="{{old('quantity')}}">
                    </div>

                    <div class="form-group reason" id="reso">
                      <label for="reason"> * {{__('translations.reason')}}</label>
                          <input class="form-control" id="reasonInput" type="text" name="reason" min="3" max="250" value="{{old('reason')}}">
                    </div>


						<div class="box-footer">
              <label> {{ __('translations.add') }}</label>
                     		<input type="checkbox" name="addCheck" class="checkbox-inline"> 
              <label> {{ __('translations.subtraction') }}</label>
                        <input type="checkbox" name="subCheck" class="checkbox-inline"  id="subtractQuantity">
                        <br><br>

              <button type="submit" class="btn btn-primary"> {{__('translations.submit')}} </button>
                      </div>
                       
                       {!! Form::close() !!}
                </div>
      </div>
    </div>
    </div>
    </div>
  </section>
  
  @section('scripts')
     <script type="text/javascript">
       $('#subtractQuantity').on('click', function()
        {
             $('#reso').toggleClass('reason');
        });

       /*if($('#subtractQuantity').attr('checked')){
        $('#reasonInput').addAttr('required');
       }*/
     </script>
  @endsection
 
@stop
