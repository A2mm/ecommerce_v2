@extends('owner_dashboard.master')
@section('styles')
<style>
/* The switch - the box around the slider */
.switch {
  position: relative;
  display: inline-block;
  width: 60px;
  height: 34px;
}

/* Hide default HTML checkbox */
.switch input {display:none;}

/* The slider */
.slider {
  position: absolute;
  cursor: pointer;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background-color: #ccc;
  -webkit-transition: .4s;
  transition: .4s;
}

.slider:before {
  position: absolute;
  content: "";
  height: 26px;
  width: 26px;
  left: 4px;
  bottom: 4px;
  background-color: white;
  -webkit-transition: .4s;
  transition: .4s;
}

input:checked + .slider {
  background-color: #2196F3;
}

input:focus + .slider {
  box-shadow: 0 0 1px #2196F3;
}

input:checked + .slider:before {
  -webkit-transform: translateX(26px);
  -ms-transform: translateX(26px);
  transform: translateX(26px);
}

/* Rounded sliders */
.slider.round {
  border-radius: 34px;
}

.slider.round:before {
  border-radius: 50%;
}
</style>
@endsection
@section('body')
  <section class="content-header">
    <h1>
        {{__('translations.add_discount_to')}} {{$product->name}}
    </h1>
  </section>

   <section class="content">
    <div class="row">
        <div class="col-xs-12">
        <div class="box box-primary">

                  <!-- form start -->

                  {!! Form::model(['route' => ['manage.products.discount.post', $product->id]]) !!}

                    <div class="box-body">
                       <h4 style="color:red" class="area" id="area"></h4><br>
                    <!-- Rounded switch -->
                      <label class="switch">
                        <input {{ $product->discount!= 0 ? 'checked' : '' }} type="checkbox" id="fire_discount" name="fire_discount">
                        <span class="slider round"></span> 

                      </label>
                        <p>{{__('translations.price_before_discount')}} : {{$product->pricing($product->id)}}</p>
                         <p>{{__('translations.price_after_discount')}} : {{ $product->priceafterdiscount($product->id) }}</p>
                       
                       <p>{{__('translations.percentage')}} : {{$product->discount_percentage}}</p>
                      <div class="form-group" id="discount_holder">

                        <label for="name">* {{__('translations.price_after_discount')}}</label>

                        <input class="form-control" id="discount" type="text" name="discount">

                      </div>
                      

                    <div class="form-group" id="price_holder" style="display:none;">
                      <p style="color:red;">{{__('translations.if_there_is_discount_product_remove')}}</p>
                    </div>
                    <!-- /.box-body -->

                    <div class="box-footer">

                      <button type="submit" class="btn btn-primary" id="submit">{{__('translations.submit')}}</button>

                    </div>

                  {!! Form::close() !!}

                </div>
        </div>
    </div>
  </section>
  <div id="snackbar"></div>
@stop
@section('scripts')
<script type="text/javascript">
$('#fire_discount').change(function(){
  if($('#fire_discount').is(':checked')){
     //$('#area').hide(3000);
    console.log('checked');
    $('#price_holder').hide();
    $('#discount_holder').show();
  }else{
    console.log('unchecked');
    $('#price_holder').show();
    $('#discount_holder').hide();
  }
}); 

/*$('#submit').on('click', function(e)
  {
    var act = $('#fire_discount').attr('checked');
    if (!act) 
    {
      e.preventDefault();
      $('#area').text("{{ __('translations.activate_switcher') }}");
       //$('#area').hide(3000);
      // window.location.reload();
    }
  });*/

</script>
@endsection
