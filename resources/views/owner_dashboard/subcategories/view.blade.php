@extends('owner_dashboard.master')

@section('body')

  <section class="content-header">
    <h1>
    {{__('translations.subcategory')}}
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
        <th>{{__('translations.subcategory_name')}}</th>
        <th>{{$subcategory->name}}</th>
      </tr>
      <!-- <tr>
        <th>{{__('translations.arabic_name')}}</th>
        <th>{{$subcategory->arabic_name}}</th>
      </tr>
      <tr>
        <th>{{__('translations.description')}}</th>
        <th>{{$subcategory->description}}</th>
      </tr>
      <tr>
        <th>{{__('translations.arabic_description')}}</th>
        <th>{{$subcategory->arabic_description}}</th>
      </tr> -->
      <tr>
        <th>{{__('translations.category')}}</th>
        <th>{{$subcategory->category->name}}</th>
      </tr>
      <!-- <tr>
        <th>{{__('translations.attributes')}}</th>

      </tr> -->
      <!-- <tr>

      </tr> -->
    </thead>
     <tbody>
    </tbody>
    </table>

    </div>
      </div>
    </div>
  </section>

@stop
