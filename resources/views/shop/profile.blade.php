@extends('shop.master') @section('body')

<div class="content_box negative-margin mb-5">
    <div class="container">
        <div class="row">
            <div class="register col-md-7 all">
                <!--<div class="dreamcrub">
                    <ul class="breadcrumbs">
                        <li class="home">
                            @if($x == 1)
                            <a href="{{url('/index').getRequest()}}" title="Go to Home Page">{{trans('layout.Home')}}</a> @else
                            <a href="{{url('/')}}" title="Go to Home Page">{{trans('layout.Home')}}</a> @endif &nbsp;
                            <span>&gt;</span>
                        </li>
                        <li class="women">Profile</li>
                    </ul>
                    <div class="clearfix"></div>
                </div>-->
                <!--INFO-->
                <div class="account_grid">
                    <div class="col-md-12 login-left text-center h1">
                        <h3>Personal Info</h3>
                    </div>
                    <div class="col-md-12 login-left" style="clear:left;">
                        <h4>Name: <span style="font-size:20px;" class="ml-3">{{$user->name}}</span></h4>
                        <h4>E-mail: <span style="font-size:20px;" class="ml-3">{{$user->email}}</span></h4>
                        <h4>Points: <span style="font-size:20px;" class="ml-3">{{$user->points}}</span></h4>
                        <div class="mt-4">
                            <a href="{{route('edit.user').getRequest()}}" class="btn btn-info mx-2 mb-2 rounded">Update profile</a>
                            <a href="{{ route('password.user').getRequest()}}" class="btn btn-danger mx-2 mb-2 rounded">Change Password</a>
                            @if(count($history))
                            <a href="{{ route('history.user').getRequest()}}" class="btn btn-success mx-2 mb-2 rounded">Show your history</a>
                            @else
                            @endif @if(count($wish))
                            
                            <a href="{{ route('wishlist.user').getRequest()}}" class="btn btn-success mx-2 mb-2 rounded">Show your Wish List</a> @endif @if(Auth::user()->role('affiliate'))
                            <a href="{{ route('affiliate.dashboard')}}" target="_blank"> Your Affiliate Profile </a>
                        </div>
                        @endif
                    </div>
                </div>
                <!--END INFO-->
            </div>
        </div>
    </div>
</div>
@stop