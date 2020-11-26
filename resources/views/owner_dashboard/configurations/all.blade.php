@extends('owner_dashboard.master')
@section('body')
  <section class="content-header">
    <h1>
      {{__('translations.configurations')}}
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
  <table class="table table-bordered table-striped" id="configurations">
    <thead>
      <tr>
        <th>{{__('translations.name')}}</th>
        <th>{{__('translations.value')}}</th>
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
