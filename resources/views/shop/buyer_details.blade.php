@extends('shop.master') @section('body')
<div class="container">
    <div class="register">
        {!! Form::open(['route' => 'buy.user']) !!}
        <div class="col-md-12 all">
            <h3>{{trans('layout.Delivery Info')}} </h3>

            <div class="row">
               <div class="col-md-6">
                   <span>{{trans('layout.Delivery address')}}<label>*</label></span>
                   <input autocomplete="off" type="text" name="delivery_address" value="{{isset($old_purchase) ?$old_purchase->delivery_address : '' }}">
               </div>

               <div class="col-md-6">
                   <span>{{trans('layout.Billing address')}}<label>*</label></span>
                   <input autocomplete="off" type="text" name="billing_address" value="{{isset($old_purchase) ?$old_purchase->billing_address : '' }}">
               </div>
            </div>

            <div class="row">
               <div class="col-md-6">
                   <span>{{trans('layout.Receptor mobile')}}<label>*</label></span>
                   <input autocomplete="off" type="text" name="receptor_mobile" value="{{isset($old_purchase) ?$old_purchase->receptor_mobile : '' }}">
               </div>

               <div class="col-md-6">
                   <span>{{trans('layout.Buyer mobile')}}<label>*</label></span>
                   <input autocomplete="off" type="text" name="buyer_mobile" value="{{isset($old_purchase) ?$old_purchase->buyer_mobile : '' }}">
               </div>
            </div>

            <div class="row">
               <div class="col-md-12">
                   <span>{{trans('layout.Receptor Name')}}<label>*</label></span>
                   <input autocomplete="off" type="text" name="receptor_name" value="{{isset($old_purchase) ?$old_purchase->receptor_name : '' }}">
               </div>

               <div class="col-md-12">
                   <span>{{trans('layout.Notes')}}<label>*</label></span>
                   <textarea class="md-textarea" type="textarea" name="note"></textarea>
               </div>

                {{--<div class="col-md-12">
                   <span>promocode</span>
                   <input autocomplete="off" type="text" name="code">
               </div>--}}
            </div>

            <input type="hidden" name="price" value="{{$checkout_amount}}">
            <input type="hidden" name="type" value="user">
        </div>
        <div class="clearfix"> </div>
        <div class="register-but">
            <input class="btn btn-primary" type="submit" value="{{trans('layout.Submit')}}">

            <div class="clearfix"> </div>
            {!! Form::close() !!}

        </div>
    </div>
</div>
@stop
