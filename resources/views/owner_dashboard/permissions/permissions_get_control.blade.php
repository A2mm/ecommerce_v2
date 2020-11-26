@extends('owner_dashboard.master')
@section('body')
  <section class="content-header">
    <h1>
    {{__('translations.permissions_get_control')}}
    </h1>
  </section>

  <?php $logged_user = Auth::user(); ?>

  <!-- Main content -->
<div class="col-lg-10 col-lg-offset-1">
    <h3><i class="fa fa-key"></i>  </h3>

    @if($logged_user->can('create used permissions') || $logged_user->can('Administer'))
    <a href="{{ route('permissions.used.create') }}" class="btn btn-success"> 
    {{ __('translations.create_used_permissions') }} </a>
    @endif

    @if($all_used_permissions > 1)
    @if($logged_user->can('delete used permissions') || $logged_user->can('Administer'))
    <a href="{{ route('permissions.used.delete') }}" data-href="{{route('permissions.used.delete')}}" class="delete btn btn-danger"> 
    {{ __('translations.delete_used_permissions') }} </a>
    @endif
    @endif
    
<?php /*
    @if($logged_user->can('add new used permission') || $logged_user->can('Administer'))
    <a href="{{ route('permissions.used.add.new') }}" class="btn btn-primary"> 
    {{ __('translations.add_permission') }} </a>
    @endif
*/ ?>

    <div class="text-center">
      <h3> {{ __('translations.all_permissions') }} 
                  @if($all_used_permissions > 1)
                     <span class="badge" style="padding: 8px; font-size: 25px; width:80px; height:40px; background:skyblue;"> {{ $all_used_permissions }} </span>
                  @else
                     <span class="badge" style="padding: 8px; font-size: 25px; width:80px; height:40px;">  {{ $all_used_permissions }} </span>
                  @endif
      </h3>
    </div>

     
</div>
@stop
