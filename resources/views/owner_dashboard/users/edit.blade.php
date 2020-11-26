@extends('owner_dashboard.master')
@section('body')
  <section class="content-header">
    <h1>
    {{__('translations.all_users')}}
    </h1>
  </section>

  <!-- Main content -->
  <div class="row">
        <div class='col-lg-4 col-lg-offset-4'>

    <h3><i class='fa fa-user-plus'></i> {{ __('translations.edit') }}  {{$user->name}}</h3>
    <hr>

    {{ Form::model($user, array('route' => array('users.roles.store', $user->id), 'method' => 'POST')) }}
    {{-- Form model binding to automatically populate our fields with user data --}}

    <div class="form-group">
        {{ Form::label('name', 'Name') }}
       <?php // {{ Form::text('name', null, array('class' => 'form-control')) }} ?>
      <input type="hidden" name="admin_id" value="{{$user->id}}">

      <input style="background: pink;" disabled="disabled" type="text" name="name" class="form-control" value="{{$user->name}}">

    </div>

    <div class="form-group">
        {{ Form::label('email', 'Email') }}
       <?php // {{ Form::email('email', null, array('class' => 'form-control')) }} ?>
        <input style="background: pink;" disabled="disabled" type="email" name="email" class="form-control" value="{{$user->email}}">
    </div>

    <h5><b>,<u>  {{ __('translations.assign_role') }} </u></b></h5> 

    <div class='form-group'>
        @foreach ($roles as $role)
            {{ Form::checkbox('roles[]',  $role->id, $user->roles ) }}
            {{ Form::label($role->name, ucfirst($role->name)) }}<br>

        @endforeach
    </div>

    {{ Form::submit(__('translations.submit'), array('class' => 'btn btn-sm btn-primary')) }}

    {{ Form::close() }}

</div>
</div>
@stop
