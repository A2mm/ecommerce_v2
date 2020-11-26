@extends('shop.master') @section('body')
<div class="container">
    <div class="register col-md-7 all">
        {!! Form::open(['route' => 'login.user']) !!}
        <div class="register-top-grid">
            <h3>{{trans('layout.PERSONAL_INFORMATION')}}</h3>
            <div class="col-md-12">
                <span>{{trans('layout.Email')}}<label>*</label></span>
                <input type="text" name="email" autocomplete="off">
            </div>

            <div class="col-md-12">
                <span>{{trans('layout.Password')}}<label>*</label></span>
                <input type="password" name="password" autocomplete="off">
            </div>
        </div>
        <div class="clearfix"> </div>
        <div class="register-but">
            <button type="submit" title="" id="one_c" class="btn btn-primary">{{trans( 'layout.login_submit')}}</button>
            <div class="clearfix"></div>
            <input type="hidden" value="{{request()->redirectTo}}" name="redirectTo">{!! Form::close() !!}
        </div>

        <a style="font-size: 12px;line-height: 64px;margin: auto;display: block; text-align: center;color: #003569;" href="{{route('shop.forgot').getRequest()}}">Forgot password?</a>

        <div class="social-auth-links text-center">

            <p style="margin:20px 0px 20px 0px;">- OR -</p>

            <a href="{{url('facebook')}}" class="fb-login-button">
          <img style="width: 200px;" src="{{asset('fb_logo.png')}}"></a> {{--



            <div class="fb-login-button" data-max-rows="1" data-size="medium" data-button-type="continue_with" data-show-faces="false" data-auto-logout-link="false" data-use-continue-as="true"></div>--}} {{-- <a href="#" class="btn btn-block btn-social btn-google btn-flat"><i class="fa fa-google-plus"></i> Sign up using Google+</a> --}}

        </div>
    </div>
    <!-- <a href="{{url('password/email')}}"> eee</a> -->
</div>

<script>
    window.fbAsyncInit = function() {
        FB.init({
            appId: '120202565206214',
            autoLogAppEvents: true,
            xfbml: true,
            version: 'v2.10'
        });
        FB.AppEvents.logPageView();
    };

    (function(d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) {
            return;
        }
        js = d.createElement(s);
        js.id = id;
        js.src = "//connect.facebook.net/en_US/sdk.js";
        fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));
</script>
@stop
