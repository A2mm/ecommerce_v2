@extends('owner_dashboard.master')
@section('body')


  <section class="content-header">
    <h1>
      {{__('translations.create_store')}}
    </h1>
  </section>
  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-xs-12">
        <div class="box box-primary">
                  {!! Form::open(['route' => 'manage.store.store', 'files' => true]) !!}
                    <div class="box-body">
                      <div class="form-group">
                        <label for="name">* {{__('translations.name')}}</label>
                        <input class="form-control" id="name" type="text" name="name" value="{{old('name')}}">
                      </div>
                      <div class="form-group">
                        <label for="address">* {{__('translations.address')}}</label>
                        <input class="form-control" id="address" name="address" type="text" value="{{old('address')}}">
                      </div>


                       <div class="form-group">

                        <label for="email">* {{__('translations.phone')}}</label>

                        <input class="form-control" id="phone" name="phone" type="text" value="{{old('phone')}}" placeholder="{{__('translations.01.........')}}">

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
