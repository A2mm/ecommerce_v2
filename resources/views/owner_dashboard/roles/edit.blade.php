@extends('owner_dashboard.master')
@section('body')
  <section class="content-header">
   
  </section>

  <!-- Main content -->
  <div class="row">
      <div class='col-lg-4 col-lg-offset-4'>
    <h3><i class='fa fa-key'></i> تعديل الدور : {{$role->name}}</h3>
    <hr>

    {{ Form::model($role, array('route' => array('roles.update', $role->id), 'method' => 'POST')) }}

    <div class="form-group">
        {{ Form::label('name', __('translations.name')) }}
        {{ Form::text('name', null, array('class' => 'form-control')) }}
    </div>

    <h5><b><u>تحديث صلاحيات   </u></b></h5>
    @foreach ($permissions as $permission)

        {{Form::checkbox('permissions[]',  $permission->id, $role->permissions ) }}
        
        {{ Form::label(__('translations.'.$permission->name), __('translations.'.$permission->name)) }}<br>

    @endforeach
    <br>
    {{ Form::submit(__('translations.submit'), array('class' => 'btn btn-primary')) }}

    {{ Form::close() }}    
</div>
 </div>
@stop
