<style>
    .header {
        display: none;
    }

    .cat {
        width: 100%;
        display: inline-block;
        margin: 0;
    }

    .cat ul {
        list-style: none;
        margin: 0;
        padding: 0;
        float: left;
        display: block;
        width: 100%;
    }

    .cat ul li {
        height: 285px;
        display: block;
        margin: 0;
        padding: 0;
        position: relative;
        overflow: hidden;
    }

    .cat ul li a {
        display: block;
        height: inherit;
        background-size: cover;
        background-repeat: no-repeat;
    }

    .cat ul li img {
        object-fit: cover;
        width: 100%;
        height: 100%;
        -webkit-transition: opacity 1s, -webkit-transform 1s;
        transition: opacity 1s, transform 1s;
    }

    .cat ul li a:hover img {
        -webkit-transform: scale3d(1.3, 1.3, 1);
        transform: scale3d(1.3, 1.3, 1);
    }

    .cat ul li a span {
        position: absolute;
        top: 0;
        left: 0;
        font-family: 'Raleway', sans-serif;
        font-size: 50pt;
        padding: 5px 15px 5px 15px;
        color: #FFF;
        display: inline-block;
        margin-top: 0;
        float: left;
        font-weight: 200;
        text-shadow: 2px 2px 0px rgba(0, 0, 0, 0.5);
        -webkit-text-shadow: 2px 2px 0px rgba(0, 0, 0, 0.5);
        -moz-text-shadow: 2px 2px 0px rgba(0, 0, 0, 0.5);
        -ms-text-shadow: 2px 2px 0px rgba(0, 0, 0, 0.5);
        -o-text-shadow: 2px 2px 0px rgba(0, 0, 0, 0.5);
        /*border: 1px solid #FFF;
        background-color: rgba(0, 0, 0, 0.5);*/
    }

    .footer {
        /*position: absolute;
        bottom: 0;*/
    }

    .container {
        width: 100% !important;
        padding: 0 !important;
    }

    .main {
        position: inherit;
        bottom: 95px;
        width: 100%;
    }

    .row {
        margin: 0 !important;
    }

    .header:after {
        content: "";
        display: none;
    }

</style>

@extends('shop.master') @section('body')
<div class="header" style="display:block; top:0; width: 100%; height: 100%;">
    <section class="slider">
        <div class="logo">
            <a href="{{url('/')}}{{(isset(request()->c)) ? '?c='.request()->c : ''}}"><img src="{{asset('logos_e/logo_2_m.png')}}" alt=""/></a>
        </div>
        <div class="flexslider">
            <ul class="slides">
                <li>
                    <img src="{{asset('images/header_bg.jpg')}}" />
                    <p class="flex-caption">The Fine art of Gemstones</p>
                </li>
                <li>
                    <img src="images/header_bg2.jpg" />
                    <p class="flex-caption">The Reliable source for everything Gemstones</p>
                </li>
            </ul>
        </div>
    </section>
</div>

<section>
    <div class="content_box" ng-controller="currency_converter" style="padding:0;">
        <div class="">
            <div class="row">
                <div class="cat">
                    <ul>
                        <li class="col-md-4">
                            <a href="{{url('/index')}}?g=Men{{(isset(request()->c)) ? '&c='.request()->c : ''}}">
                            @if($m_check==0)
                            <div style="opacity: 0.8;
                                        position: absolute;
                                        height: 100%;
                                        top: 0;
                                        z-index:1005;
                                        bottom: 0;
                                        right: 0;
                                        left: 0;
                                        background-color: black;">
                                        <p style="
                                        text-align:center; 
                                        font-family: 'Raleway', sans-serif;
                                        font-size: 50pt;
                                        margin-top:100px;
                                        color: #FFF;
                                        font-weight: 200;
                                        text-shadow: 2px 2px 0px rgba(0, 0, 0, 0.5);
                                        -webkit-text-shadow: 2px 2px 0px rgba(0, 0, 0, 0.5);
                                        -moz-text-shadow: 2px 2px 0px rgba(0, 0, 0, 0.5);
                                        -ms-text-shadow: 2px 2px 0px rgba(0, 0, 0, 0.5);
                                        -o-text-shadow: 2px 2px 0px rgba(0, 0, 0, 0.5);
                                        ">Soon</p>
                            </div>
                            @endif 
                              <img src="{{asset('images/men.png')}}" />
                               <span>{{trans('layout.Men')}}</span></a></li>

                        <li class="col-md-4">
                            <a href="{{url('/index')}}?g=Women{{(isset(request()->c)) ? '&c='.request()->c : ''}}">
                            @if($w_check==0)
                            <div style="opacity: 0.8;
                                        position: absolute;
                                        height: 100%;
                                        top: 0;
                                        z-index:1005;
                                        bottom: 0;
                                        right: 0;
                                        left: 0;
                                        background-color: black;">
                                        <p style="
                                        text-align:center; 
                                        font-family: 'Raleway', sans-serif;
                                        font-size: 50pt;
                                        margin-top:100px;
                                        color: #FFF;
                                        font-weight: 200;
                                        text-shadow: 2px 2px 0px rgba(0, 0, 0, 0.5);
                                        -webkit-text-shadow: 2px 2px 0px rgba(0, 0, 0, 0.5);
                                        -moz-text-shadow: 2px 2px 0px rgba(0, 0, 0, 0.5);
                                        -ms-text-shadow: 2px 2px 0px rgba(0, 0, 0, 0.5);
                                        -o-text-shadow: 2px 2px 0px rgba(0, 0, 0, 0.5);
                                        ">Soon</p>
                            </div>
                            @endif 
                              <img src="{{asset('images/women.jpg')}}" />
                               <span>{{trans('layout.Women')}}</span></a></li>

                        <li class="col-md-4">
                            <a href="{{url('/index')}}?g=Kids{{(isset(request()->c)) ? '&c='.request()->c : ''}}">
                            @if($k_check==0)
                            <div style="opacity: 0.8;
                                        position: absolute;
                                        height: 100%;
                                        top: 0;
                                        z-index:1005;
                                        bottom: 0;
                                        right: 0;
                                        left: 0;
                                        background-color: black;">
                                        <p style="
                                        text-align:center; 
                                        font-family: 'Raleway', sans-serif;
                                        font-size: 50pt;
                                        margin-top:100px;
                                        color: #FFF;
                                        font-weight: 200;
                                        text-shadow: 2px 2px 0px rgba(0, 0, 0, 0.5);
                                        -webkit-text-shadow: 2px 2px 0px rgba(0, 0, 0, 0.5);
                                        -moz-text-shadow: 2px 2px 0px rgba(0, 0, 0, 0.5);
                                        -ms-text-shadow: 2px 2px 0px rgba(0, 0, 0, 0.5);
                                        -o-text-shadow: 2px 2px 0px rgba(0, 0, 0, 0.5);
                                        ">Soon</p>
                            </div>
                            @endif
                              <img src="{{asset('images/kids.png')}}" />
                               <span>{{trans('layout.Kids')}}</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>
@stop
