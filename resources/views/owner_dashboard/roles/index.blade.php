@extends('owner_dashboard.master')
@section('body')
  <section class="content-header">
    <h1>
    {{__('translations.all_roles')}}
    </h1><br>
  </section>

  <?php $logged_user = Auth::user(); ?>

  <!-- Main content -->
  <div class="row">
      <div class="col-lg-10 col-lg-offset-1">

    @if($logged_user->can('all admins') || $logged_user->can('Administer'))
    <a href="{{ route('users.all.roles.assign') }}" class="btn btn-default pull-right">
    {{ __('translations.all_admins') }} </a>
    @endif

    @if($logged_user->can('view all permissions') || $logged_user->can('Administer'))
    <a href="{{ route('permissions.all') }}" class="btn btn-default pull-right">
    {{ __('translations.all_permissions') }}</a>
    @endif

    <br><hr>
    <div class="table-responsive">
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th style="text-align: right;">{{ __('translations.role') }}</th>
                    <th style="text-align: right;">{{ __('translations.permissions') }} </th>
                    <th style="text-align: right;"> {{ __('translations.actions') }} </th>
                </tr>
            </thead>

            <tbody>
                @foreach ($roles as $role)
                <tr>

                    <td>{{ $role->name }}</td>

                    <td>
                        <?php // str_replace(array('[',']','"'),'  ', $role->permissions()->pluck('name')) }} ?>
                        @foreach($role->permissions as $fff)
                         {{ __('translations.'.$fff->name) }} {{ ' / ' }}
                        @endforeach
                    </td>{{-- Retrieve array of permissions associated to a role and convert to string --}}
                    <td>

                    @if($logged_user->can('edit role') || $logged_user->can('Administer'))
                    
                    @if($role->name == 'Administrator')
                    <a href="{{ URL::to('/owner/edit/roles/'.$role->id) }}" class="btn disabled btn-xs btn-info" style="margin-right: 3px;"> {{ __('translations.edit') }}</a>

                    @else
                        <a href="{{ URL::to('/owner/edit/roles/'.$role->id) }}" class="btn btn-xs btn-info" style="margin-right: 3px;"> {{ __('translations.edit') }}</a>
                    @endif  
                    @endif

                    @if($logged_user->can('delete role') || $logged_user->can('Administer'))
                     @if($role->name == 'Administrator')
                    <a href="{{ URL::to('/owner/delete/roles/'.$role->id) }}" data-href="{{route('roles.destroy',['id' => $role->id])}}" class="btn disabled btn-xs btn-danger delete" style="margin-right: 3px;"> {{ __('translations.delete') }}</a>
                    @else
                     <a href="{{ URL::to('/owner/delete/roles/'.$role->id) }}" data-href="{{route('roles.destroy',['id' => $role->id])}}" class="btn btn-xs btn-danger delete" style="margin-right: 3px;"> {{ __('translations.delete') }}</a>
                    @endif
                    @endif

                    </td>
                </tr>
                @endforeach
            </tbody>

        </table>
    </div>

    @if($logged_user->can('add role') || $logged_user->can('Administer'))
    <a href="{{ URL::to('/owner/create/roles') }}" class="btn btn-success">
    {{ __('translations.add_role') }} </a>
    @endif

</div>
</div>
@stop
