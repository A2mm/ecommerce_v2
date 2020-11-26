@extends('owner_dashboard.master')
@section('body')
  <section class="content-header">
    <a href="{{route('roles.all')}}" class="btn btn-sm btn-info"> {{ __('translations.all_roles') }}</a> 
   <?php // <span class="pull-left" style="font-size: 25px;"> {{__('translations.all_roles')}} </span>?>
  
  </section>

  <!-- Main content -->
  <div class="row">
      <div class='col-lg-4 col-lg-offset-4'>

    <h3><i class='fa fa-key'></i> {{ __('translations.add_role') }} </h3>
    <hr>

    {{ Form::open(array('url' => '/owner/store/roles')) }}

    <div class="form-group">
        {{ Form::label('name', __('translations.name')) }}
        {{ Form::text('name', null, array('class' => 'form-control')) }}
    </div>

    <h5><b> {{ __('translations.assign_permissions') }}</b></h5>

    <div class='form-group'>
        @foreach ($permissions as $permission)
            {{ Form::checkbox('permissions[]',  $permission->id ) }}
            <?php // {{ Form::label($permission->name, ucfirst($permission->name)) }}<br> ?>
            {{ Form::label(__('translations.'.$permission->name), __('translations.'.$permission->name)) }}<br>

        @endforeach
    </div>

    {{ Form::submit(__('translations.submit'), array('class' => 'btn btn-primary')) }}

    {{ Form::close() }}

</div>
 </div>
@stop
