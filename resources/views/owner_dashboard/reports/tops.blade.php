@extends('owner_dashboard.master')
@section('body')
<div class="row">
  <div class="col-md-12">
    <div class="col-md-4">
      <div class="box">
        <div class="box-header">
          <h3 class="box-title"><b>{{__('translations.top_products')}}</b></h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <table class="table">
            <tbody>
           @foreach ($best_products as $product)
            <tr>
              <td><a target="_blank" href="{{$product->path()}}?gen={{$product->category->name}}&sub=ALL&acc=ALL">{{$product->name}}</a> ({{$product->num_of_orders}})</td>
            </tr>
           @endforeach
          </tbody></table>
        </div>
        <!-- /.box-body -->
      </div>
    </div>

    <div class="col-md-4">
      <div class="box">
        <div class="box-header">
          <h3 class="box-title"><b>{{__('translations.top_vendors')}}</b></h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <table class="table">
            <tbody>
           @foreach ($best_vendors as $vendor)
            <tr>
              <td>{{$vendor->vendor_name}} <a style="float: right;" target="_blank" href="{{route('manage.vendors.details',['id' => $vendor->user_id])}}" class="btn btn-xs btn-info">{{__('translations.show_details')}}</a>
              </td>
            </tr>
           @endforeach
          </tbody></table>
        </div>
        <!-- /.box-body -->
      </div>
    </div>

    <div class="col-md-4">
      <div class="box">
        <div class="box-header">
          <h3 class="box-title"><b>{{__('translations.top_users')}}</b></h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <table class="table">
            <tbody>
           @foreach ($best_users as $user)
            <tr>
              <td>{{$user->name}}<a style="float: right;" target="_blank" href="{{route('manage.customers.details',['id' => $user->id])}}" class="btn btn-xs btn-info">{{__('translations.show_details')}}</a></td>
            </tr>
           @endforeach
          </tbody></table>
        </div>
        <!-- /.box-body -->
      </div>
    </div>


        <div class="col-md-4">
      <div class="box">
        <div class="box-header">
          <h3 class="box-title"><b>{{__('translations.top_links')}}</b> ({{__('translations.orders')}})</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <table class="table">
            <tbody>
           @foreach ($best_orders_links as $link)
            <tr>
              <td>{{$link->slug}} ({{$link->orders}})</td>
            </tr>
           @endforeach
          </tbody></table>
        </div>
        <!-- /.box-body -->
      </div>
    </div>

    <div class="col-md-4">
      <div class="box">
        <div class="box-header">
          <h3 class="box-title"><b>{{__('translations.top_links')}}</b> ({{__('translations.views')}})</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <table class="table">
            <tbody>
           @foreach ($best_visits_links as $link)
            <tr>
              <td>{{$link->slug}} ({{$link->visits}})</td>
            </tr>
           @endforeach
          </tbody></table>
        </div>
        <!-- /.box-body -->
      </div>
    </div>

    <div class="col-md-4">
      <div class="box">
        <div class="box-header">
          <h3 class="box-title"><b>{{__('translations.top_affiliates')}}</b></h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <table class="table">
            <tbody>
           @foreach ($best_affiliates as $affiliate)
            <tr>
              <td>{{$affiliate->name}}</td>
            </tr>
           @endforeach
          </tbody></table>
        </div>
        <!-- /.box-body -->
      </div>
    </div>
  </div>

</div>

@stop
