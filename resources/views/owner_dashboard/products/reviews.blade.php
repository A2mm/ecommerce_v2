@extends('owner_dashboard.master')

@section('body')


<section class="content-header">

  <h1>

    تقييمات المنتج ({{$product->name}})

  </h1>

</section>

<!-- Main content -->

<section class="content">

  <div class="row">

    <div class="col-xs-12">

      <div class="box box-primary">
        <div id="dynamic_content">
          <table class="table table-bordered table-striped">
            <thead>
              <tr>
                <th style="text-align: right;"> {{ __('translations.user_name') }} </th>
                <th style="text-align: right;">{{ 'التقييم' }}</th>
                <th style="text-align: right;"> {{ __('translations.created_at') }} </th>
              </tr>
            </thead>
            <tbody id="table_body">


              @foreach($reviews as $review)
              <tr>
                <td>{{$review->user_name}}</td>
                <td>{{$review->body}}</td>
                <td>{{$review->created_at}}</td>
              </tr>
              @endforeach

            </tbody>
          </table>
        </div>

      </div>

    </div>

  </div>

</section>

@stop
