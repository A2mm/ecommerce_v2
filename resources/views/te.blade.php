<style>
.cat{
	margin-top: 2em;
}
.cat ul{
	list-style: none;
    margin: 0;
    padding: 0;
    float: left;
    display: block;
    width: 100%;
}
.cat ul li{
	width: 31%;
    height: 245px;
    float: left;
    display: block;
    margin: 1% 1% 1% 1%;
}
.cat ul li a{
	display: block;
    height: inherit;
    background-size: cover;
    background-repeat: no-repeat;
}
.cat ul li a span{
	font-size:15pt;
	padding: 5px 15px 5px 15px;
    color: #FFF;
    display: inline-block;
    border: 1px solid #FFF;
    margin-top: 30%;
	background-color:rgba(0, 0, 0, 0.5);
}
</style>
@extends('shop.master')
@section('body')
<div class="main">
<div class="content_box" ng-controller= "currency_converter">
<div class="container">
<div class="row">
<div class="cat">
<ul class="text-center">
<li><a href="{{url('/index')}}?gen=Men" style="background-image:url('images/men.jpg');"><span>Men</span></a></li>
<li><a href="{{url('/index')}}?gen=Women" style="background-image:url('images/women.jpg');"><span>Women</span></a></li>
<li><a href="{{url('/index')}}?gen=Both" style="background-image:url('images/kids.jpg');"><span>Kids</span></a></li>
</ul>
</div>
</div>
</div>
</div>
</div>


@stop