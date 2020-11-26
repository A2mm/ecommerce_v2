@extends('owner_dashboard.master')
@section('body')
  <section class="content-header">
    <h1>
    {{__('translations.all_permissions')}}
    </h1>
  </section>

  <!-- Main content -->
       <div class='col-lg-4 col-lg-offset-4'>

    <h3><i class='fa fa-key'></i> {{ __('translations.edit') }} {{$permission->name}}</h3>
    <br>
    {{ Form::model($permission, array('route' => array('permissions.update', $permission->id), 'method' => 'POST')) }}{{-- Form model binding to automatically populate our fields with permission data --}}

    <div class="form-group">
        {{ Form::label('name', 'Permission Name') }}
        {{ Form::text('name', null, array('class' => 'form-control')) }}
    </div>
    <br>
    {{ Form::submit(__('translations.submit'), array('class' => 'btn btn-primary')) }}

    {{ Form::close() }}

</div>
@stop
