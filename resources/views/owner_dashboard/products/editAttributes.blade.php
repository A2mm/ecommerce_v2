@extends('owner_dashboard.master')

<script src="http://demo.itsolutionstuff.com/plugin/jquery.js"></script>
  <script src="http://demo.itsolutionstuff.com/plugin/croppie.js"></script>
  <link rel="stylesheet" href="http://demo.itsolutionstuff.com/plugin/bootstrap-3.min.css">
  <link rel="stylesheet" href="http://demo.itsolutionstuff.com/plugin/croppie.css">
  <meta name="csrf-token" content="{{ csrf_token() }}">

<link rel="stylesheet" type="text/css" href="{{asset('css/croppie.css')}}">

@section('body')
  <section class="content-header">
    <h1>
      {{trans('layout.Product Attributes')}}
    </h1>
  </section>
  <!-- Main content -->
  <section class="content">
    <table class="table table-bordered table-striped">
    <thead>
          <tr>
            <th>{{__('translations.product_name')}}</th>
            <th>{{$product->name}}</th>
          </tr>
          <tr>
            <th>{{__('translations.arabic_name')}}</th>
            <th>{{$product->arabic_name}}</th>
          </tr>
          <tr>
            <th>{{__('translations.description')}}</th>
            <th>{{$product->description}}</th>
          </tr>
          <tr>
            <th>{{__('translations.arabic_description')}}</th>
            <th>{{$product->arabic_description}}</th>
          </tr>
          <tr>
            <th>{{__('translations.code')}}</th>
            <th>{{$product->unique_id}}</th>
          </tr>
          <tr>
        </thead>
         <tbody>
        </tbody>
        </table>
    <div class="row">
      <div class="col-xs-12">
        <div class="box box-primary">
                  <!-- form start -->
                    {!! Form::model($product, ['route' => ['manage.products.edit.attributes.post', $product->id], 'files' => true,'method' => 'post']) !!}


                    @foreach($attributes_arrays as $key => $attributes)
                    <div class="box-body">
                      <div class="form-group">
                        <label for="name">{{ $key }}</label>
                        <!-- multi-select -->
                        <select name="attributes[]" class="multi-select form-control">
                          <option value="" disabled selected>{{__('translations.select_value')}}</option>
                          @foreach($attributes as $attribute)
                          <option value="{{ $attribute['id'] }}" @if(in_array($attribute['id'], $selected_attributes)) {{ 'selected' }} @endif>
                          {{ $attribute['name'] }}
                          </option>
                          @endforeach
                        </select>
                      </div>
                    </div>
                    @endforeach
                    @if(count($attributes_arrays) > 0)
                    <div class="box-footer">
                      <button type="submit" class="btn btn-primary">{{trans('layout.Submit')}}</button>
                    </div>
                    @endif
                    {!! Form::close() !!}
                </div>
      </div>
    </div>




     <script
        src="https://code.jquery.com/jquery-3.2.1.min.js"
        integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4="
        crossorigin="anonymous"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.10/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.10/js/select2.min.js"></script>

    <script>

    // data =
    // [
    //   @foreach($attributes_arrays as $key => $attributes)
    //   {
    //     "text": "{{ $key }}",
    //     "children" : [
    //       @foreach($attributes as $attribute)
    //       {
    //           "id": "{{ $attribute['id'] }}",
    //           "text": "{{ $attribute['name'] }}",
    //           "selected":@if(in_array($attribute['id'], $selected_attributes)) true @else false @endif
    //       },
    //       @endforeach
    //     ]
    //   },
    //   @endforeach
    // ];
    //
    // console.log(data);
    //
    // $(document).ready(function() {
    //   $('.multi-select').select2({
    //     placeholder : "Select Attribute",
    //     data: data
    //   });
    // });

    $(document).ready(function() {
      $('.multi-select').select2({
        placeholder : "{{__('translations.selected_attribute')}}"
      });
    });
    </script>


  </section>
@stop
