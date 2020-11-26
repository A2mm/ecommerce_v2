@extends('owner_dashboard.master')

@section('body')

  <section class="content-header">
    <h1>
      {{__('translations.log')}}
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
    <table class="table table-bordered table-striped" id="vendors">
      <thead>
        <tr>
          <th>{{__('translations.description')}}</th>
          <th>{{__('translations.subject_id')}}</th>
          <th>{{__('translations.subject_type')}}</th>
          <th>{{__('translations.actions')}}</th>
        </tr>
      </thead>

      <tbody>
      @foreach($records as $key => $activity)
      <tr>
        
        <td>{{$activity->description}}</td> 
        <td>{{$activity->subject_id}}</td>
        <td>{{$activity->subject_type}}</td>
        <td> 
          <a class="btn bt-xs btn-primary" href="{{route('manage.sellers.specificlog.activities', ['id' => $activity->id])}}"> {{ __('translations.view') }}</a>
        </td>

     </tr>
      @endforeach
      </tbody>
    </table>
</div>

      </div>

    </div>

  </section>





  

@stop
