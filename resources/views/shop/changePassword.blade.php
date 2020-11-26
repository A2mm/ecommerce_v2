@extends('shop.master')
@section('body')
<div class="container negative-margin mb-5">
 <div class="register col-md-7 all">
	 <form class="form-vertical" role="form" method="post" action="{{ route('password.user') }}">
		<div class="h2 register-top-grid text-center">
		 <h3 class="my-3">Change Password</h3>
			<div>
			 <input type="password" name="current" required placeholder="Current Password*">
			</div>
			<div>
				<input type="password" name="new" required placeholder="New Password*">
			</div>
			<div>
				<input type="password" name="new_confirmation" required placeholder="Confirm New Password*">
			</div>
			</div>
	 		<div class="register-but">
				<input class="btn btn-success" type="submit" value={{trans('layout.Submit')}}>
			</div>
			</form>
			</div>
			</div>
	 </div>
	</div>
	</div>
@stop
