@extends('owner_dashboard.master')

@section('body')

  <section class="content-header">
    <h1>
      {{__('translations.seller')}}
    </h1>
  </section>
  <!-- Main content -->

  <section class="content">

    <div class="row">

      <div class="col-xs-12">

        <div class="box">

    <div class="box-header">

      <h3 class="box-title"></h3>

    </div><!-- /.box-header -->


<table class="table table-bordered table-striped">
<thead>
      <tr>
        <th>{{__('translations.seller_name')}}</th>
        <th>{{$seller->name}}</th>
      </tr>
      <tr>
        <th>{{__('translations.seller_email')}}</th>
        <th>{{$seller->email}}</th>
      </tr>
      <tr>
        <th>{{__('translations.seller_store')}}</th>
        <th>{{$seller->store->name}}</th>
      </tr>

      <tr>
        <th>{{__('translations.discount')}}</th>
        <th>{{$seller->discount}} %</th>
      </tr>
    </thead>
     <tbody>
    </tbody>
    </table>

    </div>
      </div>
    </div>
  </section>

@stop
