@extends('owner_dashboard.master')

  <meta name="csrf-token" content="{{ csrf_token() }}">

<link rel="stylesheet" type="text/css" href="{{asset('css/croppie.css')}}">
  <style type="text/css">
    #demo-basic{
      width:900px;
      height: 900px;
    }
  </style>

@section('body')
  <section class="content-header">
    <h1>
      {{ 'تعديل تاج ' }}
    </h1>
  </section>

  
  <!-- Main content -->
  <section class="content flex-row-reverse">
    <div class="row">
      <div class="col-md-12">
        <div class="box box-primary">
                  <!-- form start -->
                  {!! Form::open(['route' => 'product.edittag.save', 'files' => true, 'enctype' =>'multipart/form-data']) !!}

                    <div class="box-body">
                     <input type="hidden" name="product_id" value="{{$tag->product->id}}"><br>
                      <input type="hidden" name="tag_id" value="{{$tag->id}}"><br>
                     <label>* {{ __('translations.product') }} </label>
                    <input class="form-control" type="text" disabled="disabled" name="product" value="{{$tag->product->name}}">

<div class="form-group">
                       <label>* {{ __('translations.tag') }} </label>

                      <input class="form-control" type="text" name="tag" value="{{$tag->tag}}">
</div>

<div class="form-group">
   <button type="submit" class="btn btn-primary" id="submit-form">{{__('translations.submit')}}</button>
</div>
                    </div><!-- /.box-body -->


                  {!! Form::close() !!}
                <!-- </form> -->
                </div>
      </div>
    </div>

    <script
        src="https://code.jquery.com/jquery-3.2.1.min.js"
        integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4="
        crossorigin="anonymous"></script>
    <script type="text/javascript" src="{{asset('js/croppie.js')}}"></script>


  </section>

  <script>
    $(document).ready(function() {

      var maxrows = 25;
      var x = 1;

         $('#add_tag').on('click', function(e)
          {
            var html = '<div class="row">';
                html +='<div class="col-md-12">';
                html +='<div class="col-md-8">';
                html +='<div class="form-group{{$errors->has('tags') ? 'error' : null}}">';
                html +='<label>اضف تاج  </label>';
                html +='<input type="test" class="form-control" name="tags[]">';
                html += '<?php if($errors->has('tags')){?>
                          <span class="help-block" style="color:red;">{{$errors->first('tags')}}</span> <?php } ?>';
                html +='</div>';
                html +='</div>';
                html +='<div class="col-md-2"><br><a href="#" class="btn btn-danger" id="remove_tag">X</a></div>';
                html +='</div>';
                html +='</div>';
            // console.log(stores);
            e.preventDefault();
            if (x <= maxrows)
            {
              $('#store_tag').append(html);
              x++;
            }

            $('#store_tag').on('click', '#remove_tag', function(e)
              {
                e.preventDefault();
                $(this).parent('div').parent().remove();
                x--;
              });
          });
           
    });
  </script>


<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.16.2/axios.js"></script>

@stop
