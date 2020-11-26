@extends('shop.master') 
@section('body')
<div class="container">
    <div class="register">
        {!! Form::open(['route' => 'forgot.user']) !!}
        <div class="register-top-grid">
            <h3>Reset Password</h3><br>
            <p>We can help you reset your password using your email address linked <br>to your account.</p>
            <div>
                <span>{{trans('layout.Email')}}<label>*</label></span>
                <input type="text" name="email" autocomplete="off">
            </div>
        </div>
        <div class="clearfix"> </div>
        <div class="register-but">

            <input type="submit" value="Reset Password" id="one_c">
            <div class="clearfix"> </div>
            {!! Form::close() !!}
        </div>
        
        

  
                 {{-- <!--  {!! Form::open(['route' => 'resetCode']) !!}
                    <div class="register-top-grid">
                        <div>
                        <span>Please enter your code <label>*</label></span>
                        <input type="text" name="code">   
                        </div>                   
                    </div>
                     <div class="clearfix"> </div>
        <div class="register-but">

            <input type="submit" value="Reset Password">
            <div class="clearfix"> </div>
            {!! Form::close() !!}
        </div> --> --}}
                </div>

</div>


<script type="text/javascript">
            $('#one_c').click(function() {
                $(this).prop('disabled', true);
                $('form').submit();
                
            });
        </script>


@stop
