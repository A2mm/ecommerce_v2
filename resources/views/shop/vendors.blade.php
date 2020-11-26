@extends('shop.master')

@section('body')

  <div class="content_box">

  <div class="container">

    <div class="row">

     

        

              <h3>All Vendors</h3>



              <ul>

                @foreach ($vendors as $vendor)

                  <li><a href="{{url('/vendor/'.$vendor->id).getRequest()}}">{{$vendor->vendor_name}}</a></li>


              @endforeach

             </ul>


     
      </div>
      </div>
      </div>


      @stop
