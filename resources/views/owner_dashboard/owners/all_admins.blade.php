@extends('owner_dashboard.master')
@section('body')
  <section class="content-header">
    <h1>
    <h3><i class="fa fa-users"></i>  {{__('translations.all_admins')}} </h3><br>
    </h1>
  </section>
  <?php $logged_user = Auth::user(); ?>
  <!-- Main content -->
        <div class="col-lg-10 col-lg-offset-1">
   

    <div class="table-responsive">
        <table class="table table-bordered table-striped">

            <thead>
                <tr style="background: grey;">
                    <th style="text-align: right;">{{ __('translations.name') }} </th>
                    <th style="text-align: right;">{{ __('translations.email') }} </th>
                    <th style="text-align: right;">{{ __('translations.phone') }} </th>
                    <th style="text-align: right;">{{ __('translations.created_at') }} </th>
                    <th style="text-align: right;">{{ __('translations.actions') }}</th> 
                </tr>
            </thead>

            <tbody>
                @foreach ($admins as $user)
                <tr>
                    <td>{{  $user->name }}</td>
                    <td>{{  $user->email == null ? __('translations.no_mail') : $user->email }}</td>
                    <td>{{  $user->phone }}</td>
                    <td>{{  $user->created_at->format('F d, Y h:ia') }}</td>  
                    <td>
                         @if($logged_user->can('edit admin') || $logged_user->can('Administer'))
                        <a href="{{route('alladmins.edit', ['id' => $user->id])}}" class="btn btn-primary"> {{ __('translations.edit') }}</a>
                       @endif

                        @if($user->suspend == null)
                         @if($logged_user->can('suspend admin') || $logged_user->can('Administer'))
                            <a href="{{route('alladmins.suspend', ['id' => $user->id])}}" data-href="{{route('alladmins.suspend',['id' => $user->id])}}" class="suspend btn btn-danger"> {{ __('translations.suspend') }}</a>
                            @endif
                        @else
                         @if($logged_user->can('suspend admin') || $logged_user->can('Administer'))
                           <a href="{{route('alladmins.suspend', ['id' => $user->id])}}" data-href="{{route('alladmins.suspend',['id' => $user->id])}}" class="btn btn-warning"> {{ __('translations.un_suspend') }}</a>
                           @endif
                        @endif
                    </td>                  
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <?php // <a href="{{ route('users.all') }}" class="btn btn-success">Add User</a> ?>

</div>
@stop
