@extends('owner_dashboard.master')

@section('body')

  <section class="content-header">

    <h1>

    {{__('translations.daily_sales_reports')}}

    </h1>

  </section>



  <!-- Main content -->

  <section class="content">

    <div class="row">
<!-- start loop -->
@foreach($stores as $store)
      <div class="col-xs-12">

        <div class="box">

    <div class="box-header">

      <h3 class="box-title">{{__('translations.store_name')}} ({{$store->name}})</h3>




    </div><!-- /.box-header -->

  <table class="table table-bordered table-striped" id="subcategories">

    <thead>

      <tr>

        <th>{{__('translations.name')}}</th>

        <th>{{__('translations.email')}}</th>

        <th>{{__('translations.store')}}</th>

        <th>{{__('translations.actions')}}</th>

      </tr>

    </thead>

    <tbody>
            <tr>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
            </tr>
    </tbody>

  </table>

</div>

      </div>
@endforeach
      <!-- End Loop -->

    </div>

  </section>

@stop
