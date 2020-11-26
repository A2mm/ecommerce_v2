@extends('shop.master') 
@section('body')
<div class="container">
    <div class="register">
        {!! Form::open(['route' => 'resetCode']) !!}
        <div class="register-top-grid">
            <div>
                <span>Enter your code<label>*</label></span>
                <input type="text" name="code">
                <input type="hidden" value="{{$user->id}}" name="id">

            </div>
        </div>
        <div class="clearfix"> </div>
        <div class="register-but">

            <input type="submit" value="Reset Password">
            <div class="clearfix"> </div>
            {!! Form::close() !!}
        </div>
        
    </div>
</div>


@stop
