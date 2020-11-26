@extends('owner_dashboard.master')

@section('body')

  <section class="content-header">

    <h1>

{{__('translations.stores_items_quantities')}}

    </h1>
    <div class="">
      <a href="{{route('manage.store.reports.pdf')}}" class="btn btn-xs btn-danger">{{__('translations.generate_to_pdf')}}</a>
    </div>
  </section>
  <!-- Main content -->

@stop
