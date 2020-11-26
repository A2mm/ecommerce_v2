@extends('owner_dashboard.master')
@section('body')


<section class="content-header">
  <h1>
    {{'اضافة شحن'}}
  </h1>
</section>
<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-xs-12">
      <div class="box box-primary">
        <!-- form start -->
        {!! Form::open(['route' => 'shipment.store', 'files' => true]) !!}
        <div class="box-body">
          <div class="form-group">
            <label for="area">* {{ 'المنطقة' }}</label>
            <input class="form-control" id="area" type="text" name="area" value="{{old('area')}}">
          </div>

          <div class="form-group" >
            <label for="price"> * {{__('translations.price')}}</label>
            <input class="form-control" id="price" type="number" name="price" value="{{old('price')}}">
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

@stop
