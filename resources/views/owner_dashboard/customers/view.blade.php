@extends('owner_dashboard.master')
@section('body')
  <section class="content-header">
    <h1>
      {{__('translations.view_customer')}}
    </h1>
  </section>
  <!-- Main content -->
  <section class="content">

        <div style="width: 350px; margin-right: 300px; background: white; border: 1px solid green; border-radius: 15px;">

             <div class="text-center">
              @if(strlen($customer->image) > 20)
               <img style="margin-top: -20px;" src="{{asset('clients/images/'.$customer->image)}}"  width="100px" height="100px" class="img img-circle" style="border: 3px solid black; margin-top: 25px;">
              @else
                  <h1> <i class="fa fa-user"></i> </h1>
              @endif

                <table class="table">
                  <tr>
                    <td><b> {{ __('translations.name') }} :</b></td>
                    <td> {{ $customer->name }} </td>
                  </tr>
                  <tr>
                    <td><b> {{ __('translations.email') }} :</b></td>
                    <td> {{ $customer->email }} </td>
                  </tr>
                  <tr>
                    <td><b> {{ __('translations.phone') }} : </b></td>
                    <td> 
                  @if($customer->phone != null)
                  {{ $customer->phone }}
                  @else
                  {{ 'لا يوجد رقم تليفون بعد' }}
                  @endif 
                </td>
                  </tr>
                  <tr>
                    <td><b> {{ __('translations.usertype') }} :</b></td>
                    <td> 
                      @if($customer->usertype_id == null)
                       {{ 'قطاعي' }}
                      @else
                      {{ $customer->usertype->name }}
                      @endif
                    </td>
                  </tr>
                </table>
                <h1>  </h1>
                <p class="title"><a href="{{url()->previous()}}" class="btn btn-primary">{{ __('translations.back') }}</a></p>
                <p></p>
              </div>

        </div>

</section>


@stop
