@extends('shop.master')
@section('body')
<div class="container">
 <div class="register">
	 {!! Form::open(['route' => 'register.user']) !!}

		<div class="register-top-grid">
		 <h3>PERSONAL INFORMATION</h3>
			<div>
			 <span>User Name<label>*</label></span>
			 <input type="text" name="name">
			</div>
			<div>
				<span>Email Address<label>*</label></span>
				<input type="text" name="email">
			</div>
			<div>
			 <span>Password<label>*</label></span>
			 <input type="password" name="password">
			</div>
      <div>
       <span>Confirm Password<label>*</label></span>
       <input type="password" name="password_confirmation">
      </div>
			<input type="hidden" name="type" value="affiliate">
			</div>
	 <div class="clearfix"> </div>
	 <div class="register-but">

				<input type="submit" value="submit">
				<div class="clearfix"> </div>
			{!! Form::close() !!}
	 </div>
	</div>
	</div>
@stop
