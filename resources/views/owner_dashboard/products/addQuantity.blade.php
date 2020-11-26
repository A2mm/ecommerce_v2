@extends('owner_dashboard.master')
@section('body')
  <section class="content-header">
    <h1>
      {{trans('layout.Edit Quantity')}}
    </h1>
  </section>

   <section class="content">
    <div class="row">
      <div class="col-xs-12">
        <div class="box box-primary">
                  <!-- form start -->
                  {!! Form::model($product, ['route' => ['manage.products.addQuantity.post', $product->id], 'files' => true]) !!}
                    <div class="box-body">
                      <div class="form-group">
                        <h3>{{trans('layout.Name')}}:{{$product->name}}</h3>

                        <div class="form-group">
                        <label for="quantity">{{__('translations.add_quantity')}}</i></label>
                        <input class="form-control" id="quantity" type="number" min="1" name="quantity">
                      </div>

                      <div class="form-group">
                         <label for="Store">{{__('translations.choose_a_store')}}</label>
                          <select class="form-control" name="store_id">
                              <option disabled selected>{{__('translations.choose_store')}}</option>
                              @foreach($stores as $key => $value)
                              <option value="{{ $key }}" >{{ $value }}</option>
                              @endforeach
                          </select>
                      </div>


						<div class="box-footer">
                     		 <button type="submit" class="btn btn-primary">{{trans('layout.Submit')}}</button>
                    	</div>



                        {!! Form::close() !!}
                </div>
      </div>
    </div>
    </div>
    </div>
  </section>
@stop
