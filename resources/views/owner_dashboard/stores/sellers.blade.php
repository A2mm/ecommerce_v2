@extends('owner_dashboard.master')

@section('body')

<section class="content-header">
  <h1>
    {{__('translations.store_sellers')}}
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
          <!-- Main content -->
          <table class="table table-bordered table-striped">
            <thead>
              <tr>
                <th style="text-align:center;">{{__('translations.seller_name')}}</th>
                <th style="text-align:center;">{{__('translations.seller_email')}}</th>
              </tr>
            </thead>
            <tbody>
              @foreach($sellers as $seller)
              <tr>
                <th style="text-align:center;">{{$seller->name}}</th>
                <td style="text-align:center;"> {{$seller->email}}</td>
              </tr>
              @endforeach
            </tbody>
          </table>

          {{ $sellers->links() }}
        </div>
      </div>
    </div>
  </section>
  @stop
