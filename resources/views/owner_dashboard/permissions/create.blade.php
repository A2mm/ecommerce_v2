@extends('owner_dashboard.master')
@section('body')
  <section class="content-header">
    <?php // <h1> {{__('translations.all_permissions')} </h1> ?>
        <a href="{{route('permissions.all')}}" class="btn btn-sm btn-info"> {{ __('translations.all_permissions') }}</a> 

  </section>

  <!-- Main content -->
        <div class='col-lg-4 col-lg-offset-4'>

    <h3><i class='fa fa-key'></i>  {{__('translations.add_permission')}} </h3>
    <br>

    {{ Form::open(array('url' => '/owner/store/permissions')) }}

    <div class="form-group">
        {{ Form::label('name', __('translations.name')) }}
        {{ Form::text('name', '', array('class' => 'form-control')) }}
    </div><br>
    @if(!$roles->isEmpty()) <?php //If no roles exist yet ?>
        <h4>{{ __('translations.assign_permissions_roles') }} </h4>

        @foreach ($roles as $role) 
            {{ Form::checkbox('roles[]',  $role->id ) }}
            {{ Form::label($role->name, ucfirst($role->name)) }}<br>

        @endforeach
    @endif
    <br>
    {{ Form::submit(__('translations.submit'), array('class' => 'btn btn-primary')) }}

    {{ Form::close() }}

</div>
@stop
