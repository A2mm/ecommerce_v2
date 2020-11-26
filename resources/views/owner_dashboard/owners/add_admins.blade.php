@extends('owner_dashboard.master')

@section('body')

  <section class="content-header">
    <h1>
      {{__('translations.add_admins')}}
    </h1>
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-xs-12">
        <div class="box box-primary">
                  <!-- form start -->
                  {!! Form::open(['route' => 'admins.store', 'files' => true]) !!}

                    <div class="box-body">
                      <div class="form-group">
                        <label for="name">* {{__('translations.name')}}</label>
                        <input class="form-control" id="name" type="text" name="name" value="{{old('name')}}">
                      </div>

                       <div class="form-group">
                        <label for="phone"> {{__('translations.phone')}}</label>
                        <input class="form-control" id="phone" name="phone" type="text" value="{{old('phone')}}" placeholder="{{__('translations.01.........')}}">
                      </div>

                      <div class="form-group">
                        <label for="email">* {{__('translations.email')}}</label>
                        <input class="form-control" id="email" name="email" type="text" value="{{old('email')}}">
                      </div>

                      <div class="form-group">
                        <label for="password">* {{__('translations.password')}}</label>
                        <input class="form-control" id="password" name="password" type="password">
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
