@extends('owner_dashboard.master')
@section('scripts')

<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.9/dist/css/bootstrap-select.min.css">

<!-- Latest compiled and minified JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.9/dist/js/bootstrap-select.min.js"></script>
@stop
@section('body')
  <section class="content-header">
    <h1>
      {{__('translations.edit_category')}}
    </h1>
  </section>
  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-xs-12">
        <div class="box box-primary">
                  <!-- form start -->
                  {!! Form::model($category, ['route' => ['manage.category.edit.post', $category->id], 'files' => true]) !!}
                    <div class="box-body">
                      
                      <div class="form-group">
                        <label for="category_name">{{__('translations.name')}}</label>
                        <input class="form-control" id="category_name" type="text" name="category_name" maxlength="30" value="{{$category->name}}">
                      </div>
                     
                    </div>
                    <div class="box-footer">
                      <button type="submit" class="btn btn-primary">{{__('translations.submit')}}</button>
                    </div>
                  {!! Form::close() !!}
                </div>
      </div>
    </div>
  </section>
@stop
