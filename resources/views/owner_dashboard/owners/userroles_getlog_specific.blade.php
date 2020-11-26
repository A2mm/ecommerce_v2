@extends('owner_dashboard.master')

@section('body')

  <section class="content-header">
    <h1>
      {{__('translations.log')}}
    </h1>
  </section>

  <!-- Main content -->

  <section class="content">

    <div class="row">
      <div class="col-xs-12">
        <div class="box">
    <div class="box-header">
      <h3 class="box-title"></h3>
    </div><!-- /.box-header -->
     
<div class="text-center">
                <h3 style="color:green;"> {{ __('translations.by') }} <i class="fa fa-user"></i> {{ $auth_user_name }} <br><br> {{ $specified_request->created_at }} 
                </h3>
              </div>
<div class="text-center">
   <?php   $item = json_decode($specified_request->request); ?>
       @foreach ($item as $key => $value)
                                @if($key == 'admin_id') 
                                 <?php $admin = App\User::withTrashed()->where('id', $value)->first(); ?>
                                 <h3> {{ __('translations.admin') }}( {{  $admin->name }} ) </h3>
                                @endif
                            @endforeach
</div><br>
     <table class="table table-bordered">
       <thead>
         <tr>
            <td> {{ __('translations.roles') }}</td>
            <td> {{ __('translations.permissions') }} </td>
         </tr>
       </thead>
       <tbody>
       <?php   $item = json_decode($specified_request->request); ?>
@if(strstr($specified_request->request, 'roles'))

               @foreach ($item as $key => $value)
                    @if ($key == 'roles') 
                   
                       @foreach ($value as $key => $roleval) 
                        <?php $this_role = Spatie\Permission\Models\Role::withTrashed()
                                                                  ->where('id', $roleval)
                                                                  ->first(); ?>
                       <tr>
                         <td> {{ $this_role->name }}</td>
                         <td>
                 
                           @foreach($this_role->permissions as $perm)
                           {{ __('translations.'.$perm->name) }} / 
                            @endforeach
                         </td>
                       </tr>
                      @endforeach
                     
                    @endif
                @endforeach

 @else
                      <tr><td> {{ __('translations.no_roles_assigned') }} </td>
                       <td> {{ __('translations.no_permissions_assigned') }} </td></tr>
@endif

       </tbody>
     </table>

@stop













