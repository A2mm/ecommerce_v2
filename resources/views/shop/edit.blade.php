@extends('shop.master')
@section('body')
			<div class="container negative-margin mb-5">
				<div class="register col-md-7 all">
					<form class="form-vertical" role="form" method="post" action="{{ route('edit.user') }}">
						<div class="register-top-grid h2 text-center">
							<h3 class="mb-5">{{trans('layout.PERSONAL_INFORMATION')}}</h3>
							<div class="text-left mt-3">
								<span>{{trans('layout.User_Name')}}<label>*</label></span>
								<input type="text" name="name" value="{{Auth::user()->name}}" placeholder="{{trans('layout.User_Name')}}">
							</div>
							<div class="text-left mt-3">
								<span>{{trans('layout.Email')}}<label>*</label></span>
								<input type="text" name="email" value="{{Auth::user()->email}}">
							</div>
						</div>				
						<div class="register-but mt-3">
							<input class="btn btn-success" type="submit" value={{trans('layout.Submit')}}>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
@stop

