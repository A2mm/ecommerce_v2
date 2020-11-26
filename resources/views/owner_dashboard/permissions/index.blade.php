@extends('owner_dashboard.master')
@section('body')
  <section class="content-header">
    <h4>
    {{__('translations.all_permissions')}} 
    <span style="border: 1px solid pink; border-radius: 100px; background: pink;">{{ $countpermissions }}</span>
    </h4>
  </section>

  <?php $logged_user = Auth::user(); ?>

  <!-- Main content -->
  <div class="row">
        <div class="col-lg-10 col-lg-offset-1">

     @if($logged_user->can('all admins') || $logged_user->can('Administer'))
    <a href="{{ route('users.all.roles.assign') }}" class="btn btn-default pull-right"> 
    {{ __('translations.all_admins') }} </a>
    @endif

     @if($logged_user->can('view all roles') || $logged_user->can('Administer'))
     <a href="{{ route('roles.all') }}" class="btn btn-default pull-right">
      {{ __('translations.roles') }} </a>
    <br><br>@endif
    <hr>
    <div class="table-responsive">
        <table class="table table-bordered table-striped">

            <thead>
                <tr>
                    <th style="text-align: right;"> {{ __('translations.permissions') }}</th>
                    <th style="text-align: right;"> {{ __('translations.created_at') }}</th>
                    <th style="text-align: right;"> {{ __('translations.updated_at') }}</th> 
                   <?php //  <th style="text-align: right;">{{ __('translations.actions') }}</th> ?>
                </tr>
            </thead>
            <tbody>
               @foreach ($permissions as $key => $permission)
                @if($key % 2 == 0)
                <tr style="background: black; color: white;">
                    <td>{{ __('translations.'.$permission->name) }} </td> 
                    <td>{{ $permission->created_at == null ? 'Stable' : $permission->created_at }}</td> 
                    <td>{{ $permission->updated_at == null ? 'Stable' : $permission->updated_at }}</td> 
                    <td>
                    <?php /*
                    @if($logged_user->can('edit permission') || $logged_user->can('Administer'))
                    <a href="{{ URL::to('/owner/edit/permissions/'.$permission->id) }}" class="btn btn-sm btn-primary" style="margin-right: 3px;"> {{ __('translations.edit') }}</a>
                    @endif
*/ ?>
<?php /*
                     <a href="{{ URL::to('/owner/delete/permissions/'.$permission->id) }}" class="btn btn-sm btn-danger" style="margin-right: 3px;"> {{ __('translations.delete') }}</a>

                    */ ?>
                    

                    </td>
                </tr>
                @else
                <tr style="background: green; color: white;">
                    <td>{{ __('translations.'.$permission->name) }}</td> 
                    <td>{{ $permission->created_at == null ? 'Stable' : $permission->created_at }}</td> 
                    <td>{{ $permission->updated_at == null ? 'Stable' : $permission->updated_at }}</td> 
                    <td>
                    <?php /*
                    @if($logged_user->can('edit permission') || $logged_user->can('Administer'))
                    <a href="{{ URL::to('/owner/edit/permissions/'.$permission->id) }}" class="btn btn-sm btn-primary" style="margin-right: 3px;"> {{ __('translations.edit') }}</a>
                    @endif
*/ ?>
<?php /*
                     <a href="{{ URL::to('/owner/delete/permissions/'.$permission->id) }}" class="btn btn-sm btn-danger" style="margin-right: 3px;"> {{ __('translations.delete') }}</a>

                    */ ?>
                    

                    </td>
                </tr>
                @endif
                @endforeach
            </tbody>
        </table>

         {{ $permissions->links() }} 
    </div>
<?php /*
   @if($logged_user->can('add permission') || $logged_user->can('Administer'))
    <a href="{{ URL::to('/owner/create/permissions') }}" class="btn btn-success">
    {{ __('translations.add_permission') }}</a>
    @endif
*/ ?>
</div>
</div>
@stop
