@extends('shop.master')
@section('body')
<div class="container">
 <div class="register">
	 {!! Form::open(['route' => 'register.user']) !!}
   <div class="row">

   </div>
    <div class="row">
      <div class="col-md-6">
        <h3>PERSONAL INFORMATION</h3>
        <div class="input-group">
  			 <span>User Name<label>*</label></span>
  			 <input type="text" name="name" class="form-control">
  			</div>
  			<div class="input-group">
  				<span>Email Address<label>*</label></span>
  				<input type="text" name="email" class="form-control">
  			</div>
  			<div class="input-group">
  			 <span>Password<label>*</label></span>
  			 <input type="password" name="password" class="form-control">
  			</div>
        <div class="input-group">
         <span>Confirm Password<label>*</label></span>
         <input type="password" name="password_confirmation" class="form-control">
        </div>
      </div>
      <div class="col-md-6">
        <h3>VENDOR INFORMATION</h3>
        <div class="input-group">
         <span>Vendor Name<label>*</label></span>
         <input type="text" name="vendor_name" class="form-control">
        </div>
        <div class="input-group">
         <span>Vendor Address<label>*</label></span>
         <input type="text" name="address" class="form-control">
        </div>
        <div class="input-group">
         <span>Vendor Phone<label>*</label></span>
         <input type="text" name="phone" class="form-control">
        </div>
        <br>
        <input type="hidden" name="type" value="vendor">
        <div class="">
         <button type="submit" name="button" class="btn-primary btn-lg">Submit</button>
        </div>
      </div>

    </div>
	 <div class="clearfix"> </div>
	 <div class="register-but">
				<div class="clearfix"> </div>
			{!! Form::close() !!}
	 </div>
	</div>
	</div>
@stop
