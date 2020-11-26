@extends('owner_dashboard.master')
@section('body')
  <section class="content-header">
    <h1>
    {{__('translations.all_users')}}
    </h1>
  </section>

   <?php $logged_user = Auth::user(); ?>

  <!-- Main content -->
  <div class="row">
        <div class="col-lg-10 col-lg-offset-1">
    <h3><i class="fa fa-users"></i> {{ __('translations.assign_users_roles') }} </h3>

    @if($logged_user->can('view all roles') || $logged_user->can('Administer'))
        <a href="{{ route('roles.all') }}" class="btn btn-default pull-right">  
        {{ __('translations.roles') }}</a>
    @endif 

    @if($logged_user->can('view all permissions') || $logged_user->can('Administer'))
    <a href="{{ route('permissions.all') }}" class="btn btn-default pull-right">  
    {{ __('translations.permissions') }}</a>
    @endif

    <br><hr>
    <div class="table-responsive">
        <table class="table table-bordered table-striped">

            <thead>
                <tr style="background: grey;">
                    <th style="text-align: right;"> {{ __('translations.name') }} </th>
                    <th style="text-align: right;"> {{ __('translations.email') }} </th>
                    <th style="text-align: right;"> {{ __('translations.created_at') }} </th>
                    <th style="text-align: right;">{{ __('translations.roles') }}</th>
                    <th style="text-align: right;">{{ __('translations.permissions') }}</th> 
                    <th style="text-align: right;">{{ __('translations.actions') }}</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($users as $user)
                <tr>

                    <td>{{  $user->name }}</td>
                    <td>{{  $user->email == null ? __('translations.no_mail') : $user->email }}</td>
                    <td>{{  $user->created_at->format('F d, Y h:ia') }}</td>
                    <td>{{  $user->roles()->pluck('name')->implode(' / ') }}</td>
                    <td>@foreach($user->roles as $role)
                        @foreach($role->permissions as $fff)
                         {{ __('translations.'.$fff->name) }} {{ ' / ' }}
                        @endforeach
                        @endforeach
                    </td>
                    {{-- Retrieve array of roles associated to a user and convert to string --}}
                    <td>

                    @if($logged_user->can('give admins roles') || $logged_user->can('Administer'))
                    <a href="{{ route('users.roles.some', $user->id) }}" class="btn btn-sm btn-info" style="margin-right: 3px;"> {{ __('translations.assign') }} </a>
                    @endif
                    </td>
                </tr>
                @endforeach
            </tbody>

        </table>
    </div>

    <?php // <a href="{{ route('users.all') }}" class="btn btn-success">Add User</a> ?>
</div>
</div>
@stop
