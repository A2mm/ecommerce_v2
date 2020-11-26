@extends('owner_dashboard.master')
@section('body')
  <section class="content-header">
    <h1>
      <u> {{ __('translations.price_product')}}  : ({{ $product->name }}) </u>
    </h1>
  </section>

   <section class="content">
    <div class="row">
      <div class="col-xs-12">
        <div class="box box-primary">
                  
                    <div class="box-body">
                      <div class="form-group">
                        <h3>{{trans('layout.Name')}} : {{ $product->name }}</h3>

                        <table class="table table-bordered table-striped">
                        <thead>
                          @foreach($prices as $price)
                          <tr>
                             <th>{{__('translations.price')}} {{$price->usertype->name}} : {{ $price->price }} {{__('translations.pound')}}</th>
                          </tr>
                          @endforeach
                        </thead>
                        </table>

               <form class="form" method="post" action="{{route('manage.products.price.post')}}">
                {{ csrf_field() }}

                <input type="hidden" name="id" value="{{$product->id}}">

                @for($i = 0; $i < $count_usertypes; $i++)
                  <div class="row">
                    
                    <div class="col-md-4">
                      <div class="form-group">
                      <label>* {{__('translations.user_type')}} </label>
                      <select class="form-control" name="othertypes[]">
                        @foreach($usertypes as $key => $type)
                        @if($key == $i)
                        <option value="{{$type->id}}" selected="selected">{{$type->name}}</option>
                        @endif
                        @endforeach
                      </select>
                    </div>
                    </div>
                    
                     <div class="col-md-4">
                      <div class="form-group{$errors->has('otherprices.'.$i) ? 'error' : null}}">
                      <label>* {{__('translations.price')}} </label><br>
                      <?php $one = App\Usertypeprice::where(['usertype_id' => $i+1, 'product_id' => $product->id])->first(); ?>
                      <input type="text" class="form-control" name="otherprices[]" value="{{$one['price']}}">
                       @if($errors->has('otherprices.'.$i))
                        <span class="help-block" style="color:red;">{{$errors->first('otherprices.'.$i)}}</span>
                       @endif
                    </div>
                    </div>

                  </div>
                @endfor

                <div class="form-group">
                  <button type="submit" class="btn btn-primary">{{__('translations.submit')}}</button>
                </div>

               </form>
						
              </div>
                </div>
      </div>
    </div>
    </div>
    </div>
  </section>
  <div id="snackbar"></div>
@stop
