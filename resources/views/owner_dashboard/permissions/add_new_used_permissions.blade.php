@extends('owner_dashboard.master')
@section('body')
  <section class="content-header">
    <h1>
    {{__('translations.add_permission')}}
    </h1>
  </section>

  <!-- Main content -->
       <div class='col-lg-4 col-lg-offset-4'>

    <h3><i class='fa fa-key'></i></h3>
    <br>
  <?php /*  {{ Form::model($permission, array('route' => array('permissions.store.new.used'), 'method' => 'POST')) }}{{-- Form model binding to automatically populate our fields with permission data --}} */ ?>

     {!! Form::open(['route' => 'permissions.store.new.used', 'files' => true]) !!}

    <div class="form-group">
        <?php /* {{ Form::label('name', 'Permission Name') }}
        {{ Form::text('name', null, array('class' => 'form-control')) }} */ ?>
        <label> {{ __('translations.name') }}</label>
        <input type="text" name="name" class="form-control" value="{{old('name')}}">
    </div>
    <br>
    {{ Form::submit(__('translations.submit'), array('class' => 'btn btn-primary')) }}

    {{ Form::close() }}

</div>
@stop
