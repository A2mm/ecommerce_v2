@extends('owner_dashboard.master')
@section('body')
  <section class="content-header">
    <h1>
      {{__('translations.edit_subcategory')}}
    </h1>
  </section>
  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-xs-12">
        <div class="box box-primary">
                  <!-- form start -->

                  <form method="POST" action="{{url('/owner/manage/subcategories/edit/'.$subcategory->id)}}" enctype="multipart/form-data" >
                    <div class="box-body">
                      <div class="form-group">
                        <label for="name">{{__('translations.name')}}</label>
                        <input class="form-control" id="name" type="text" name="name" value="{{$subcategory->name}}" maxlength="30">
                      </div>
                      
                      <div class="form-group">
                         <label for="name">* {{__('translations.select_category')}}</label>
                        <select class="form-control" name="category_id">
                        @foreach($categories as $category)
                        <option value="{{$category->id}}" {{$category->id == $subcategory->category_id ? 'selected' : ''}}>{{$category->name}}</option>
                        @endforeach
                      </select>
                      </div>
                      
                    </div><!-- /.box-body -->
                    <div class="box-footer">
                      <button type="submit" class="btn btn-primary">{{__('translations.submit')}}</button>
                    </div>
                  {!! Form::close() !!}
                </div>
      </div>
    </div>
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.3.1.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.9/js/select2.min.js"></script>
    
  </section>
@stop
