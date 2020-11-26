@include('affiliate_dashboard.header')
@include('errors')
@include('message')

<h1 style="text-align:center;">BEING AN AFFILIATE</h1>

<div class="register-box">
      <div class="register-logo">
        <h1>Register</h1>
      </div>
      <div class="register-box-body">
        <p class="login-box-msg">Become an affiliate</p>
        <form method="POST" action="{{route('shop.affiliate.register.post')}}">
        @if(!Auth::check())
          <div class="form-group has-feedback">
            <input type="text" class="form-control" placeholder="Full name" value="{{old('name')}}" name="name">
            <span class="glyphicon glyphicon-user form-control-feedback"></span>
          </div>

          <div class="form-group has-feedback">
            <input type="text" class="form-control" placeholder="Slug" value="{{old('slug')}}" name="slug">
            <span class="glyphicon glyphicon-user form-control-feedback"></span>
          </div>

          <div class="form-group has-feedback">
            <input type="email" class="form-control" placeholder="Email" value="{{old('email')}}" name="email">
            <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
          </div>

          <div class="form-group has-feedback">
            <input type="password" class="form-control" placeholder="Password" name="password">
            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
          </div>
          @endif
          <!--<div class="form-group has-feedback">
            <input type="password" class="form-control" placeholder="Retype password" name="password_confirmation">
            <span class="glyphicon glyphicon-log-in form-control-feedback"></span>
          </div>-->       
          <div class="row text-center">          
            <div class="col-xs-12">
              <button type="submit" class="btn btn-primary btn-block btn-flat">Being an affiliate</button>
            </div>
          </div>
        </form>
        </div>
      </div>

@include('affiliate_dashboard.footer')

