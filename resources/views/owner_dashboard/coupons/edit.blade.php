@extends('owner_dashboard.master')
@section('styles')
<link href="{{asset('assets/plugins/clockpicker/assets/css/bootstrap.min.css')}}" rel="stylesheet">
<link href="{{asset('assets/plugins/clockpicker/dist/bootstrap-clockpicker.min.css')}}" rel="stylesheet">
@endsection
@section('body')
<section class="content-header">
  <h1>
    {{__('translations.edit_copoun')}}
  </h1>
</section>
<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-xs-12">
      <div class="box box-primary">

        <!-- form start -->
        {!! Form::model($coupon, ['route' => ['coupon.update', $coupon->id, 'files' => true]]) !!}
        <div class="box-body">
          <div class="form-group">
            <label for="name">* {{__('translations.code')}}</label>
            <input disabled="disabled" class="form-control" id="code" type="text" name="code" value="{{$coupon->code}}">
          </div>

          <div class="form-group">
            <label for="store_id">* {{__('translations.choose_copoun_type')}} </label>
            <select class="form-control" id="forTypes" name="type" disabled="disabled">
              <option disabled selected>{{'اختر النوع'}}</option>
              @foreach ($types as $type)
              <option value="{{$type}}" {{ $coupon->type == $type ? 'selected' : ''}}>
                    {{__('translations.'.$type)}} 
              </option>
              @endforeach
            </select>
          </div>
          <div class="form-group" id="products_holder" style="display:none;">
            <label for="store_id"> {{__('translations.choose_a_product')}} </label>
            <select class="form-control" id="forProducts" name="product_id" disabled="disabled">
              <option disabled selected>{{__('translations.select_your_product')}}</option>
              @foreach ($products as $product)
              <option value="{{$product->id}}" {{($coupon->product_id == $product->id) ? 'selected' : ''}}>{{$product->name}} - {{$product->unique_id}}</option>
              @endforeach
            </select>
          </div>
          <div class="form-group" id="precentge_holder" style="display:none;">
            <label for="name"> {{__('translations.discount')}} %</label>
            <input disabled="disabled" class="form-control" id="precentge" type="number" name="precentge" value="{{$coupon->discount}}">
          </div>
          <div class="form-group" id="flat_rate_holder" style="display:none;">
            <label for="name"> {{'سعر الخصم'}}</label>
            <input disabled="disabled" class="form-control" id="flat_rate" type="number" name="flat_rate" value="{{$coupon->flat_rate}}">
          </div>
          <div class="form-group" id="restrict_price_holder" style="display:none;">
            <label for="name"> {{'سعر مقيد'}}</label>
            <input disabled="disabled" class="form-control" value="{{$coupon->restrict_price}}" id="restrict_price" type="number" name="restrict_price">
          </div>
          <div class="form-group">
            <label class="col-sm-2 col-sm-2 control-label">* {{__('translations.expiration_date')}}</label>
            <input type="text" value="{{$coupon->expire_date}}" style="background: white; display: inline-block; width: 70%;" class="form-control" name="expire_date" id="expire_date" readonly>
          </div>

          <label class="col-sm-2 col-sm-2 control-label">* {{__('translations.expire_time')}}</label>
          <div class="input-group opened_at" style="margin:10px 0px;">
            <input type="text" value="{{$coupon->expire_time}}" class="form-control" readonly name="expire_time" id="expire_time" style="background: white;">
            <span class="input-group-addon">
              <span class="glyphicon glyphicon-time"></span>
            </span>
          </div>
        </div><!-- /.box-body -->
        <div class="box-footer">
          <button type="submit" class="btn btn-primary">{{__('translations.submit')}}</button>
        </div>
        {!! Form::close() !!}
      </div>
    </div>
  </div>
</section>
@section('scripts')
<script type="text/javascript" src="{{asset('assets/plugins/clockpicker/dist/bootstrap-clockpicker.min.js')}}"></script>
<script type="text/javascript">
  $('#flat_rate_holder').hide();
  $('#products_holder').hide();
  $('#precentge_holder').hide();
  $('#forTypes').on('change', function() {
    var type = this.value;
    if (type === 'flat_rate') {
      $('#flat_rate_holder').show();
      $('#products_holder').hide();
      $('#precentge_holder').hide();
      $('#restrict_price_holder').show();
      $('#forProducts').val(null);
      $('#precentge').val(null);
    } else if (type === 'total_price') {
      $('#flat_rate_holder').hide();
      $('#products_holder').hide();
      $('#flat_rate').val(null);
      $('#forProducts').val(null);
      $('#restrict_price').val(null);
      $('#restrict_price_holder').hide();
      $('#precentge_holder').show();
    } else if (type === 'product_discount') {
      $('#flat_rate_holder').hide();
      $('#flat_rate').val(null);
      $('#restrict_price').val(null);
      $('#restrict_price_holder').hide();
      $('#products_holder').show();
      $('#precentge_holder').show();
    }
  })

  $('#expire_time').clockpicker({
      autoclose: true,
      'default': 'now'
    })
    .find('input').change(function() {
      $('#expire_time').val(this.value);
    });

  var type = $('#forTypes').val();
  if (type === 'total_price') {
    $('#precentge_holder').show();
  } else if (type === 'product_discount') {
    $('#products_holder').show();
    $('#precentge_holder').show();
  } else if (type === 'flat_rate') {
    $('#flat_rate_holder').show();
    $('#restrict_price_holder').show();
  }
</script>

@endsection
@stop
