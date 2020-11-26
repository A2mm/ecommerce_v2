@extends('shop.master')
@section('body')
<div class="container">
 <div class="register">
	 <form class="form-vertical" role="form" method="post" action="{{ route('password.reset') }}">
		<div class="register-top-grid">
		 <h3>Reset Password</h3>
			
			<div>
				<span>New Password<label>*</label></span>
				<input id="password" type="password" name="new">
			</div>
			<div>
				<span>Confirm New Password<label>*</label></span>
				<input id="password_confirmation" type="password" name="new_confirmation">
			</div>
			</div>				
	 <div class="clearfix"> </div>
	 <div class="register-but">
				<input type="button" id="change_password" value="{{trans('layout.Submit')}}">
				<input id="user_uiid" type="hidden" value="{{$user->id}}" name="id">
				<div class="clearfix"> </div>
		</div>
		</form>
		</div>
		</div>
	 </div>
	</div>
	<div id="snackbar"></div>
	</div>
@stop

