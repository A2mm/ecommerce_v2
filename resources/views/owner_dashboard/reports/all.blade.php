@extends('owner_dashboard.master')
@section('body')
  <section class="content-header">
    <h1>
      {{__('translations.all')}}
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
        <th>{{__('translations.num_of_products')}}</th>
        <th>{{__('translations.num_of_users')}}</th>
        <th>{{__('translations.num_of_customers')}}</th>
        <th>{{__('translations.num_of_categories')}}</th>
        <th>{{__('translations.num_of_subcategories')}}</th>
        <th>{{__('translations.num_of_vendors')}}</th>
        <th>{{__('translations.num_of_stores')}}</th>
        <th>{{__('translations.num_of_affiliates')}}</th>
        <th>{{__('translations.num_of_orders')}}</th>
        <th>{{__('translations.today_orders')}}</th>
      </tr>
      <tr>
        <th>{{$products_count}}</th>
        <th>{{$users_count}}</th>
        <th>{{$customers_count}}</th>
        <th>{{$categories_count}}</th>
        <th>{{$subcategories_count}}</th>
        <th>{{$vendors_count}}</th>
        <th>{{$stores_count}}</th>
        <th>{{$affiliates_count}}</th>
        <th>{{$orders_count}}</th>
        <th>{{$today_orders}}</th>
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
