@extends('shop.master') @section('body')
<div class="container">
    <div class="register col-md-7 all">
        {!! Form::open(['route' => 'register.user']) !!}
        <div class="register-top-grid">
            <h3>{{trans('layout.PERSONAL_INFORMATION')}}</h3>
            <div>
                <span>{{trans('layout.User_Name')}}<label>*</label></span>
                <input type="text" id="register_username" name="name" autocomplete="off">
            </div>
            <div>
                <span>{{trans('layout.Email')}}<label>*</label></span>
                <input type="text" id="register_email" name="email" autocomplete="off">
            </div>
            <div>
                <span>{{trans('layout.Password')}}<label>*</label></span>
                <input id="register_password" type="password" name="password" autocomplete="off">
            </div>
            <div>
                <span>{{trans('layout.Confirm_Password')}}<label>*</label></span>
                <input  type="password" name="password_confirmation" id="register_password-confirmation">
            </div>
        </div>
        <div class="clearfix"> </div>
        <div class="register-but">
            <input class="btn btn-primary" id="shop_register_btn" type="button" value={{trans( 'layout.signUp_submit')}}>
            <div class="clearfix"> </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>
<div id="snackbar"></div>
@stop
