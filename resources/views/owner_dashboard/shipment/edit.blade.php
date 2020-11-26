@extends('owner_dashboard.master')
@section('body')


<section class="content-header">
  <h1>
    {{'تعديل الشحن'}}
  </h1>
</section>
<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-xs-12">
      <div class="box box-primary">
        <!-- form start -->
        <form class="" action="{{route('shipment.update' , $shipment->id)}}" method="post">
          {{ method_field('PATCH') }}
          {{ csrf_field() }}

          <div class="box-body">
            <div class="form-group">
              <label for="area">* {{ 'المنطقة' }}</label>
              <input class="form-control" id="area" type="text" name="area" value="{{ $shipment->area }}">
            </div>

            <div class="form-group" >
              <label for="price"> * {{__('translations.price')}}</label>
              <input class="form-control" id="price" type="number" name="price" value="{{ $shipment->price }}">
            </div>

          </div><!-- /.box-body -->

          <div class="box-footer">
            <button type="submit" class="btn btn-primary">{{__('translations.submit')}}</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</section>

@stop
