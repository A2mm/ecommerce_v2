@include('owner_dashboard.header')

@include('errors')

@include('message')

<div class="login-box">

  <div class="login-box-body">

    <p class="lead text-center text-uppercase">{{__('translations.sign_in')}}</p>

    {!! Form::open(['route' => 'owner.login.post']) !!}

      <div class="form-group has-feedback">

        <input type="email" class="form-control" placeholder="Email" name="email" value="{{old('email')}}">

        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>

      </div>

      <div class="form-group has-feedback">

        <input type="password" class="form-control" placeholder="Password" name="password">

        <span class="glyphicon glyphicon-lock form-control-feedback"></span>

      </div>

      <div class="">

        <button type="submit" class="btn btn-primary btn-block btn-flat text-uppercase">{{__('translations.sign_in')}}</button>

      </div><!-- /.col -->

    {!! Form::close() !!}

  </div><!-- /.login-box-body -->

</div><!-- /.login-box -->
<script src="https://code.jquery.com/jquery-3.1.0.js"></script>
<script>
$.ajax({
 url: 'https://luxgems.co.uk/admin/public/api/product/search',
 method: 'post',
 data: {
   word: 'ring'
 },
 success: function () {
   console.log("hhhhhhh");
 }
});
</script>

@include('owner_dashboard.footer')
