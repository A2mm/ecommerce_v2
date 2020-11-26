@extends('owner_dashboard.master')
@section('body')
  <section class="content-header">
    <a href="{{ route('manage.banners')}}" ><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i>{{__('translations.back')}}</button></a>

  </section>
  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-xs-12">
        <div class="box box-primary">
                  <!-- form start -->

                    <div class="box-body">
                      <div class="form-group">
                        <h3>{{__('translations.banner_type')}}: </h3>
                        <h4>{{ $banner->btype_name() }}</h4>
                        <h3>{{__('translations.banner_title')}}: </h3>
                        <h4>{{$banner->title}}</h4>
                        <h3>{{__('translations.banner_link')}}: </h3>
                        <h4>{{ $banner->banner_link }}</h4>

                      </div>
                      <img src="{{asset($banner->image_path())}}" alt="{{$banner->title}}">
                    </div>



                </div>
      </div>
    </div>
  </section>

@stop
