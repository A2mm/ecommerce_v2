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
    {{trans('layout.Edit Product')}}  : ({{ $product->name }})
  </h1>
</section>

<script type="text/javascript">

   tinymce.init({
            selector: '#mycontent',
            height: 200,
            setup: function (editor) {
                editor.on('init change', function () {
                    editor.save();
                });
            },
            plugins: [
                "advlist autolink lists link image charmap print preview anchor",
                "searchreplace visualblocks code fullscreen",
                "insertdatetime media table contextmenu paste imagetools"
            ],
            toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image media video",
            content_css: [
                '//fonts.googleapis.com/css?family=Lato:300,300i,400,400i',
                '//www.tinymce.com/css/codepen.min.css'
            ],
            image_title: true,
            automatic_uploads: true,
            images_upload_url: '/upload',
            file_picker_types: 'image',
            file_picker_callback: function(cb, value, meta) {
                var input = document.createElement('input');
                input.setAttribute('type', 'file');
                input.setAttribute('accept', 'image/*');
                input.onchange = function() {
                    var file = this.files[0];

                    var reader = new FileReader();
                    reader.readAsDataURL(file);
                    reader.onload = function () {
                        var id = 'blobid' + (new Date()).getTime();
                        var blobCache =  tinymce.activeEditor.editorUpload.blobCache;
                        var base64 = reader.result.split(',')[1];
                        var blobInfo = blobCache.create(id, file, base64);
                        blobCache.add(blobInfo);
                        cb(blobInfo.blobUri(), { title: file.name });
                    };
                };
                input.click();
            }
        });

   tinymce.init({
            selector: '#mycontent2',
            height: 200,
            setup: function (editor) {
                editor.on('init change', function () {
                    editor.save();
                });
            },
            plugins: [
                "advlist autolink lists link image charmap print preview anchor",
                "searchreplace visualblocks code fullscreen",
                "insertdatetime media table contextmenu paste imagetools"
            ],
            toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image media video",
            content_css: [
                '//fonts.googleapis.com/css?family=Lato:300,300i,400,400i',
                '//www.tinymce.com/css/codepen.min.css'
            ],
            image_title: true,
            automatic_uploads: true,
            images_upload_url: '/upload',
            file_picker_types: 'image',
            file_picker_callback: function(cb, value, meta) {
                var input = document.createElement('input');
                input.setAttribute('type', 'file');
                input.setAttribute('accept', 'image/*');
                input.onchange = function() {
                    var file = this.files[0];

                    var reader = new FileReader();
                    reader.readAsDataURL(file);
                    reader.onload = function () {
                        var id = 'blobid' + (new Date()).getTime();
                        var blobCache =  tinymce.activeEditor.editorUpload.blobCache;
                        var base64 = reader.result.split(',')[1];
                        var blobInfo = blobCache.create(id, file, base64);
                        blobCache.add(blobInfo);
                        cb(blobInfo.blobUri(), { title: file.name });
                    };
                };
                input.click();
            }
        });
</script>


<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-xs-12">
      <div class="box box-primary">
        <!-- form start -->
        {!! Form::model($product, ['route' => ['manage.products.edit.post', $product->id], 'files' => true]) !!}
        <div class="box-body">
          <div class="form-group">
            <label for="name">{{trans('layout.Name')}}</label>
            <input class="form-control" id="name" type="text" name="name" value="{{$product->name}}">
          </div>

          <div class="form-group">
            <label for="name">{{__('translations.unique_id')}}</label>
            <input class="form-control" id="unique_id" type="text" name="unique_id" value="{{$product->unique_id}}">
          </div>

          <div class="form-group">
            <label for="name">{{__('translations.weight')}}</label>
            <input class="form-control" id="weight" value="{{$product->weight}}" type="text" name="weight">
          </div>

            <div class="form-group">
            <label for="slug">{{__('translations.slug')}}</label>
            <input class="form-control" id="slug" type="text" name="slug" value="{{str_replace('-', ' ', $product->slug)}}">
          </div>

          <div class="form-group {{$errors->has('description') ? 'error' : null}}" style="width:80%">
                        <label for="description"> * {{ __('translations.description')}}</label>
  <textarea id="mycontent" rows="5" name="description" class="form-control" id="description">{{$product->description}}</textarea>
                        @if($errors->has('description'))
                        <span class="help-block" style="color:red;">{{$errors->first('description')}}</span>
                        @endif
          </div>


  <div class="form-group {{$errors->has('seo_description') ? 'error' : null}}" style="width:80%">
                        <label for="seo_description"> * {{ __('translations.seo_description')}}</label>
<textarea rows="5" name="seo_description" class="form-control" id="seo_description">{{$product->seo_description}}</textarea>
                        @if($errors->has('seo_description'))
                        <span class="help-block" style="color:red;">{{$errors->first('seo_description')}}</span>
                        @endif
</div>

 <div class="form-group {{$errors->has('product_benefits') ? 'error' : null}}" style="width:80%">
                        <label for="product_benefits">  {{ __('translations.product_benefits')}}</label>
  <textarea id="mycontent2" rows="5" name="product_benefits" class="form-control" id="product_benefits">{{$product->product_benefits}}</textarea>
                        @if($errors->has('product_benefits'))
                        <span class="help-block" style="color:red;">{{$errors->first('product_benefits')}}</span>
                        @endif
          </div>

          <div class="form-group">
            {!! Form::label('category_id', __('translations.category'), ['class' => 'control-label']) !!}
            {!! Form::select('category_id',$categories,$product->subcategory->category->id, ['class' => 'form-control']) !!}
          </div>

          <div class="form-group">
            {!! Form::label('subcategory_id', __('translations.subcategories'), ['class' => 'control-label']) !!}
            {!! Form::select('subcategory_id',$subcategories,$product->subcategory_id, ['class' => 'form-control']) !!}
          </div>
          <div class="form-group">
            <label for="category_online_id">الفئات الاونلاين</label>
            <select class="form-control" name="category_online_id" id="category_online_id">
              <option  disabled {{is_null($product->category_online_id) ? 'selected' : ''}}>{{'اختر فئة'}}</option>
              @foreach ($categoriesOnline as $key => $value)
                <option value="{{$value->id}}" {{$value->id == $product->category_online_id ? 'selected' : ''}}>{{$value->name}}</option>
              @endforeach
            </select>
          </div>
          @foreach ($images as $key => $image)
            <div class="form-group">
              <label for="">صورة {{$key + 1}}</label>
              <input type="file" name="images[]" style="display:inline">
              <input type="hidden" name="selections[]" value="{{$image->id}}">
              <img src="{{asset('storage/' . $image->image)}}" style="width:70px; height:65px; display:inline">
              <label style="margin-right: 25px;" for=""> {{ __('translations.deactivate_image') }} </label>
              <input type="checkbox" class="checkbox-inline" name="activations[]" value="{{$image->id}}">
            </div>
          @endforeach
          <div class="form-group">
            <div id="store_image">

            </div>
            <label>اضافة صورة</label>
            <a href="#" class="btn btn-primary bt-sm" id="add_image">اضافة صورة</a>
          </div>
<?php /*
           @foreach ($tags as $tagkey => $tag)
            <div class="form-group" style="background: grey; padding: 8px; border-radius: 5px;">
              <label for="">تاج   {{$tagkey + 1}}</label>
              <input type="hidden" name="tagselections[]" value="{{$tag->id}}">
              <span class="label label-success"> {{ $tag->tag }}</span>
              <label style="margin-right: 25px;" for=""> حذف التاج 
               <?php // {{ __('translations.deactivate_tag') }} ?> </label> 
              <input type="checkbox" class="checkbox-inline" name="tagactivations[]" value="{{$tag->id}}">
            </div>
          @endforeach
          <div class="form-group">
            <div id="store_tag">

            </div>
            <label>اضافة تاج </label>
            <a href="#" class="btn btn-warning bt-sm" id="add_tag">اضافة تاج </a>
          </div>
*/ ?>
          <div class="form-group" style="margin-right: 15px;">
    <input style="display: inline-block;" class="checkbox" type="checkbox" name="available_online" {{$product->available_online == 1 ? 'checked' : ''}}> &nbsp; &nbsp;
    <label style="display: inline-block;"><b> {{ __('translations.available_online') }} </b> </label>
   </div>

          <div class="form-group">
            <button type="submit" class="btn btn-primary">{{ __('translations.submit') }}</button>
          </div>

        </div><!-- /.box-body -->

        {!! Form::close() !!}
      </div>
    </div>
  </div>




  <script src="https://code.jquery.com/jquery-3.2.1.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous"></script>
  <script type="text/javascript" src="{{asset('js/croppie.js')}}"></script>

</section>


<script>
  function refreshLocalFields() {
    if ($('#toggle_local_block').is(':checked') == false) {
      $('#country_code').prop('disabled', true);
      $('#local_price').prop('disabled', true);
      $('#null_local').prop('disabled', false);
    } else {
      $('#country_code').prop('disabled', false);
      $('#local_price').prop('disabled', false);
      $('#null_local').prop('disabled', true);

    }
  }

  $(document).ready(function() {
    refreshLocalFields();
    $('#toggle_local_block').change(function() {
      refreshLocalFields();
    });
  });
</script>

<script>
  $(document).ready(function() {
    var x = 1 ;
    $('#add_image').on('click', function(e)
      {
        var html = '<div class="row">';
            html +='<div class="col-md-12">';
            html +='<div class="col-md-6">';
            html +='<div class="form-group{{$errors->has('images') ? 'error' : null}}">';
            html +='<input type="file" name="images2[]" style="padding-top:27px;">';
            html += '<?php if($errors->has('images2')){?>
                      <span class="help-block" style="color:red;">{{$errors->first('images2')}}</span> <?php } ?>';
            html +='</div>';
            html +='</div>';
            html +='<div class="col-md-2"><br><a href="#" class="btn btn-danger" id="remove_image">X</a></div>';
            html +='</div>';
            html +='</div>';
        // console.log(stores);
        e.preventDefault();
          $('#store_image').append(html);
          x++;

        $('#store_image').on('click', '#remove_image', function(e)
          {
            e.preventDefault();
            $(this).parent('div').parent().remove();
            x--;
          });
      });

    $('#add_tag').on('click', function(e)
      {
        var html = '<div class="row">';
            html +='<div class="col-md-12">';
            html +='<div class="col-md-6">';
            html +='<div class="form-group{{$errors->has('tags2') ? 'error' : null}}">';
            html +='<label> اضف تاج  </label>';
            html +='<input type="text" name="tags2[]" class="form-control">';
            html += '<?php if($errors->has('tags2')){?>
                      <span class="help-block" style="color:red;">{{$errors->first('tags2')}}</span> <?php } ?>';
            html +='</div>';
            html +='</div>';
            html +='<div class="col-md-2"><br><a href="#" class="btn btn-danger" id="remove_tag">X</a></div>';
            html +='</div>';
            html +='</div>';
        // console.log(stores);
        e.preventDefault();
          $('#store_tag').append(html);
          x++;

        $('#store_tag').on('click', '#remove_tag', function(e)
          {
            e.preventDefault();
            $(this).parent('div').parent().remove();
            x--;
          });
      });
    $('#category_id').change(function(e) {
      $.get("{{ route('categoryTreeNothide') }}", {
          category_id: $('#category_id').val(),
        },
        function(data, status) {
          // console.log(data);
          if (data.length <= 0) {
            $('#subcategory_id')
              .find('option')
              .remove()
              .end();
            $('#subcategory_id').attr("disabled", true)
            return;
          }
          $('#subcategory_id').attr("disabled", false)
          $('#subcategory_id')
            .find('option')
            .remove()
            .end();

          $.each(data, function(index, value) {
            $('#subcategory_id')
              .append($("<option></option>")
                .attr("value", value.id)
                .text(value.name));
          });
        });
    });
  });
</script>

<script type="text/javascript">
  var main_image = false;
  var small_image = false;
  var image_1 = false;
  var image_2 = false;
  var image_3 = false;
  $uploadCrop = $('#upload-demo').croppie({
    enableExif: true,
    enableResize: true,
    enableZoom: true,
    mouseWheelZoom: true,
    viewport: {
      width: '55%',
      height: '55%',
      type: 'square'
    },
    boundary: {
      width: '100%',
      height: '100%'
    }
  });

  $uploadCropSmall = $('#upload-demo-small').croppie({
    enableExif: true,
    enableResize: true,
    enableZoom: true,
    mouseWheelZoom: true,
    viewport: {
      width: '50%',
      height: '50%',
      type: 'square'
    },
    boundary: {
      width: '55%',
      height: '55%'
    }
  });


  $uploadCrop1 = $('#upload-demo-1').croppie({
    enableExif: true,
    enableResize: true,
    enableZoom: true,
    mouseWheelZoom: true,
    viewport: {
      width: '55%',
      height: '55%',
      type: 'square'
    },
    boundary: {
      width: '100%',
      height: '100%'
    }
  });

  $uploadCrop2 = $('#upload-demo-2').croppie({
    enableExif: true,
    enableResize: true,
    enableZoom: true,
    mouseWheelZoom: true,
    viewport: {
      width: '55%',
      height: '55%',
      type: 'square'
    },
    boundary: {
      width: '100%',
      height: '100%'
    }
  });

  $uploadCrop3 = $('#upload-demo-3').croppie({
    enableExif: true,
    enableResize: true,
    enableZoom: true,
    mouseWheelZoom: true,
    viewport: {
      width: '55%',
      height: '55%',
      type: 'square'
    },
    boundary: {
      width: '100%',
      height: '100%'
    }
  });


  $('#upload').on('change', function() {
    var reader = new FileReader();
    reader.onload = function(e) {
      $uploadCrop.croppie('bind', {
        url: e.target.result
      }).then(function() {
        main_image = true;
        console.log('jQuery bind complete');
      });
    }
    reader.readAsDataURL(this.files[0]);

    var reader = new FileReader();
    reader.onload = function(e) {
      $uploadCropSmall.croppie('bind', {
        url: e.target.result
      }).then(function() {
        small_image = true;
        console.log('jQuery bind complete');
      });
    }
    reader.readAsDataURL(this.files[0]);
  });

  $('#upload-small').on('change', function() {
    var reader = new FileReader();
    reader.onload = function(e) {
      $uploadCropSmall.croppie('bind', {
        url: e.target.result
      }).then(function() {
        $uploadCropSmall.croppie('result', {
          type: 'canvas',
          size: 'viewport',
        }).then(function(resp) {
          $('#small_image').val(resp);
        });
        console.log('jQuery bind complete');
      });
    }
    reader.readAsDataURL(this.files[0]);
  });

  $('#upload-1').on('change', function() {
    var reader = new FileReader();
    reader.onload = function(e) {
      $uploadCrop1.croppie('bind', {
        url: e.target.result
      }).then(function() {
        image_1 = true;
        console.log('jQuery bind complete');
      });
    }
    reader.readAsDataURL(this.files[0]);
  });

  $('#upload-2').on('change', function() {
    var reader = new FileReader();
    reader.onload = function(e) {
      $uploadCrop2.croppie('bind', {
        url: e.target.result
      }).then(function() {
        image_2 = true;
        console.log('jQuery bind complete');
      });
    }
    reader.readAsDataURL(this.files[0]);
  });

  $('#upload-3').on('change', function() {
    var reader = new FileReader();
    reader.onload = function(e) {
      $uploadCrop3.croppie('bind', {
        url: e.target.result
      }).then(function() {
        image_3 = true;
        console.log('jQuery bind complete');
      });
    }
    reader.readAsDataURL(this.files[0]);
  });

  $('.crop_image').click(function(event) {
    if (main_image == true) {
      $uploadCrop.croppie('result', {
        type: 'canvas',
        size: 'viewport'
      }).then(function(resp) {
        $('#main_image').val(resp);
      });
    }
    if (small_image == true) {
      $uploadCropSmall.croppie('result', {
        type: 'canvas',
        size: 'viewport',
      }).then(function(resp) {
        $('#small_image').val(resp);
      });
    }
    if (image_1 == true) {
      $uploadCrop1.croppie('result', {
        type: 'canvas',
        size: 'viewport',
      }).then(function(resp) {
        $('#image_1').val(resp);
      });
    }
    if (image_2 == true) {
      $uploadCrop2.croppie('result', {
        type: 'canvas',
        size: 'viewport',
      }).then(function(resp) {
        $('#image_2').val(resp);
      });
    }
    if (image_3 == true) {
      $uploadCrop3.croppie('result', {
        type: 'canvas',
        size: 'viewport',
      }).then(function(resp) {
        $('#image_3').val(resp);
      });
    }
  });
</script>


<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.16.2/axios.js"></script>
<script type="text/javascript">
  /*function getStores(){

      var SelectedId = $('#venforstore').find(":selected").val();
      // alert(SelectedId);
      if(SelectedId == "NOT"){
        $('#forstores').html('');
      }

      else{
      //alert(SelectedId);
      //console.log($(this).find(":selected").val());
      var toHtml = '';
      axios.get('{{url("/venstores/")}}' + '/'+ SelectedId)
            .then(function(response) {
                $('#forstores').html(response.data);
            })
            .catch(function(error) {
                console.log(error);
            });
    }
  }
    getStores();
    $('#venforstore').on('change', getStores);*/
</script>
<script type="text/javascript">
  $('#forVendors').on('change', function() {
    var SelectedId = $('#forVendors').val();
    if (SelectedId != 'choose vendor') {
      axios.get('{{ url(' / owner / manage / sellers / stores ') }}/' + SelectedId)
        .then(function(response) {
          if (response.data.response != "") {
            $('#forstores').html(response.data.response);
            $('#stores_holder').show();
          } else {
            $('#stores_holder').hide();
            $('#forstores').html('');
            alert('no stores for this vendor');
          }
        })
        .catch(function(error) {
          $('#stores_holder').hide();
          $('#forstores').html('');
          alert('something went wrong');
        });
    }
  })
</script>
@stop
