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
      {{trans('layout.Add Product')}}
    </h1>
  </section>
  <!-- Main content -->
  <section class="content flex-row-reverse">
    <div class="row">
      <div class="col-md-12">
        <div class="box box-primary">
                  <!-- form start -->
                  {!! Form::open(['route' => 'manage.products.store', 'files' => true, 'enctype' =>'multipart/form-data']) !!}

                    <div class="box-body">
                    <div class="col-md-4">

                      <div class="form-group {{$errors->has('name') ? 'error' : null}}" style="display:inline-block; width:40%; margin:10px 20px;">
                        <label for="name">*{{trans('layout.Name')}}</label>
                        <input class="form-control" id="name" value="{{old('name')}}" type="text" name="name">
                        @if($errors->has('name'))
                        <span class="help-block" style="color:red;">{{$errors->first('name')}}</span>
                        @endif
                      </div>
</div>
<div class="col-md-4">

                      <div class="form-group{{$errors->has('unique_id') ? 'error' : null}}" style="width:50%; margin:10px 20px;">
                        <label for="name">* {{__('translations.unique_id')}}</label>
                        <input class="form-control" id="unique_id" value="{{old('unique_id')}}" type="text" name="unique_id">
                        @if($errors->has('unique_id'))
                        <span class="help-block" style="color:red;">{{$errors->first('unique_id')}}</span>
                        @endif
                      </div>
</div>

<div class="col-md-4">

                      <div class="form-group{{$errors->has('weight') ? 'error' : null}}" style="width:40%; margin:10px 20px;">
                        <label for="name">* {{__('translations.weight')}}</label>
                        <input class="form-control" id="weight" value="{{old('weight')}}" type="text" name="weight">
                        @if($errors->has('weight'))
                        <span class="help-block" style="color:red;">{{$errors->first('weight')}}</span>
                        @endif
                      </div>

</div>

<div class="form-group {{$errors->has('description') ? 'error' : null}}" style="width:80%">
                        <label for="description"> * {{ __('translations.description')}}</label>
  <textarea rows="5" name="description" class="form-control" id="description">{{old('description')}}</textarea>
                        @if($errors->has('description'))
                        <span class="help-block" style="color:red;">{{$errors->first('description')}}</span>
                        @endif
</div>


<div id="store_area"></div>
<div>

<div class="row">
<div class="col-md-12">
 <div class="col-md-2">
   <br>
   <label>{{__('translations.add_store')}}</label>
   <a href="#" class="btn btn-success" id="add_more">{{__('translations.add_store')}}</a>
 </div>

</div>
</div>
<div class="row">
<div class="col-md-12">
  <div id="store_image" style="margin-top:20px;"></div>
</div>
 <div class="col-md-2" style="padding-right:25px;">
   <br>
   <label>اضافة صورة</label>
   <a href="#" class="btn btn-primary bt-sm" id="add_image">اضافة صورة</a>
 </div>

</div>
</div>


<div class="row">
 <div class="col-md-12">
<div class="col-md-6">
<div class="form-group{{$errors->has('category_id') ? 'error' : null}}" style="width:40%;display: inline-block; margin: 10px 30px;">
                      <label class="control-label" for="category_id">*{{__('translations.categories')}}</label>
                      <select name="category_id" class="form-control" id="category_id">
                        <option disabled selected>{{__('translations.select_category')}}</option>
                      @foreach($categories as $category)
                      <option value="{{$category->id}}" >{{$category->name}}</option>
                      @endforeach
                      @if($errors->has('category_id'))
                        <span class="help-block" style="color:red;">{{$errors->first('category_id')}}</span>
                        @endif
                      </select>
</div>
</div>

<div class="col-md-6">
<div class="form-group{{$errors->has('subcategory_id') ? 'error' : null}}" style="width:40%;display: inline-block; margin: 0px 30px;" id="subcategory_id_div">
                        <label class="control-label" for="subcategory_id">*{{__('translations.subcategories')}}</label>
                        <select name="subcategory_id" class="form-control" id="subcategory_id" disabled>

                        {{-- @foreach($subcategories as $subcategory)
                        <option value="{{$subcategory->id}}" >{{$subcategory->name}}</option>
                        @endforeach --}}
                        @if($errors->has('subcategory_id'))
                        <span class="help-block" style="color:red;">{{$errors->first('subcategory_id')}}</span>
                        @endif
                        </select>
</div>
</div>

                       {{--<div class="form-group" style="width:20%;display: inline-block; margin: 10px 15px;">
                        <label for="gram_price">Gram Price</label>
                        <input class="form-control" id="gram_price" type="number" step=".01" min='0.1' value="{{old('gram_price')}}" name="gram_price">
                      </div>--}}

</div>
</div>




<div class="row">
 <div class="col-md-12">
                 <?php $i = 0; ?>
  @for($i = 0; $i<$count; $i++)

                            <div class="col-md-6">
                              <div class="form-group {{$errors->has('othertypes.'.$i) ? 'error' : ''}}">
                       <label for="forstores"> * {{__('translations.choose_type')}}</label>
                        <select class="form-control" name="othertypes[]">
                   @foreach($usertypes as $key => $type)
                       @if($key == $i)
                        <option value="{{$type->id}}" selected="selected">{{$type->name}}</option>
                        @endif
                    @endforeach
                    @if($errors->has('othertypes.'.$i))
                        <span class="help-block" style="color:red;">{{$errors->first('othertypes.'.$i)}}</span>
                        @endif
                        </select>

                  </div>
                </div>

              <div class="col-md-6">
                <div class="form-group{{$errors->has('otherprices.'.$i) ? 'error' : null}}">
                  <label for="store">* {{__('translations.price')}}</label><br>
                  <input type="text"  class="form-control" name="otherprices[]" value="{{old('otherprices.'.$i)}}">
                  @if($errors->has('otherprices.'.$i))
                        <span class="help-block" style="color:red;">{{$errors->first('otherprices.'.$i)}}</span>
                  @endif
                </div>
              </div>


@endfor
 </div>
</div>

<div class="form-group" style="margin-right: 15px;">
    <input style="display: inline-block;" class="checkbox" type="checkbox" name="available_online"> &nbsp; &nbsp;
    <label style="display: inline-block;"><b> {{ __('translations.available_online') }} </b> </label>
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

      $('#enable_wholesale_block').hide();
    $('#enable_wholesale_price').click(function(){
      if($(this).is(':checked')){
        $('#enable_wholesale_block').show();
      }else{
        $('#enable_wholesale_block').hide();
       // $('#country_code').val(null);
        //$('#local_price').val(null);
      }
    })
    var stores = new Array();
      <?php foreach ($stores as $key => $value) { ?>
        stores.push({
          id : <?php echo $value->id ;?> ,
          name: '<?php echo $value->name ;?>'
        });
      <?php }?>


      var maxrows = <?php echo $count_stores; ?>;
      var x = 1;

      $('#add_more').on('click', function(e)
        {
          var html = '<div class="row">';
              html +='<div class="col-md-12">';
              html +='<div class="col-md-6">';
              html +='<div class="form-group{{$errors->has('store_id') ? 'error' : null}}">';
              html +='<label for="Store">{{__('translations.choose_a_store')}}</label>';
              html +='<select class="form-control" id="forstores" name="store_id[]">';
              html +='<option selected="selected">{{__('translations.choose_store')}}</option>';
              for (var i = 0; i < stores.length; i++) {;
               html += '<option value="'+stores[i].id+'">'+stores[i].name+'</option>';
                } ;
              html +='</select>';
              html += '<?php if($errors->has('otherprices')){?>
                        <span class="help-block" style="color:red;">{{$errors->first('store_id')}}</span> <?php } ?>';
              html +='</div>';
              html +='</div>';
              html +='<div class="col-md-4">';
              html +='<div class="form-group">';
              html +='<label for="store">{{__('translations.quantity_in_store')}}</label><br>';
              html +='<input type="number" class="form-control" name="store_quantities[]" id="store_quantity">';
              html +='</div>';
              html +='</div>';
              html +='<div class="col-md-2"><br><a href="#" class="btn btn-danger" id="remove">X</a></div>';
              html +='</div>';
              html +='</div>';
          // console.log(stores);
          e.preventDefault();
          if (x <= maxrows)
          {
            $('#store_area').append(html);
            x++;
          }

          $("select#forstores").change(function(){
              var selectedStore = $(this).children("option:selected").val();
              console.log(selectedStore);
              for (var i = 0; i < stores.length; i++) {
                if (stores[i].id == selectedStore ) {
                     stores.splice(selectedStore, 1);    // done ahmed 
                }
              }
          });

          $('#store_area').on('click', '#remove', function(e)
            {
              e.preventDefault();
              $(this).parent('div').parent().remove();
              x--;
            });
        });
        $('#add_image').on('click', function(e)
          {
            var html = '<div class="row">';
                html +='<div class="col-md-12">';
                html +='<div class="col-md-6">';
                html +='<div class="form-group{{$errors->has('images') ? 'error' : null}}">';
                html +='<input type="file" name="images[]" style="padding-top:27px;">';
                html += '<?php if($errors->has('images')){?>
                          <span class="help-block" style="color:red;">{{$errors->first('images')}}</span> <?php } ?>';
                html +='</div>';
                html +='</div>';
                html +='<div class="col-md-2"><br><a href="#" class="btn btn-danger" id="remove_image">X</a></div>';
                html +='</div>';
                html +='</div>';
            // console.log(stores);
            e.preventDefault();
            if (x <= maxrows)
            {
              $('#store_image').append(html);
              x++;
            }

            $('#store_image').on('click', '#remove_image', function(e)
              {
                e.preventDefault();
                $(this).parent('div').parent().remove();
                x--;
              });
          });
        $('#category_id').change(function (e) {
          var flag = 0;
            // .attr("value", value.id)
          $.get("{{ route('categoryTreeNothide') }}",
          {
            category_id: $('#category_id').val(),
          },
          function(data, status){
            // console.log(data);
            if (data.length <= 0){
              $('#subcategory_id')
                .find('option')
                .remove()
                .end();
              $('#subcategory_id').attr("disabled", true)
              return ;
            }
            $('#subcategory_id').attr("disabled", false)
            $('#subcategory_id')
              .find('option')
              .remove()
              .end();

            $.each(data, function( index, value ) {
              if(flag == 0){
                $('#subcategory_id').append($("<option></option>").attr('selected',true).attr('disabled',true).text("{{ __('translations.select_subcategory') }}"));
                flag++;
              }
              $('#subcategory_id')
                .append($("<option></option>")
                .attr("value", value.id)
                .text(value.name));
            });
          });
        });
    });
  </script>
<!--
  <script type="text/javascript">
  $('#enable_local_block').hide();
    $('#enable_local').click(function(){
      if($(this).is(':checked')){
        $('#enable_local_block').show();
      }else{
        $('#enable_local_block').hide();
        $('#country_code').val(null);
        $('#local_price').val(null);
      }
    })

  var main_image=false;
  var small_image=false;
  var image_1=false;
  var image_2=false;
  var image_3=false;
$uploadCrop = $('#upload-demo').croppie({
  enableExif: true,
  enableResize : true,
  enableZoom : true,
  mouseWheelZoom: true,
  viewport: {
      width:'55%',
      height:'55%',
      type: 'square'
  },
  boundary: {
      width: '100%',
      height: '100%'
  }
});

$uploadCropSmall = $('#upload-demo-small').croppie({
  enableExif: true,
  enableResize : true,
  enableZoom : true,
  mouseWheelZoom: true,
  viewport: {
      width:'50%',
      height:'50%',
      type: 'square'
  },
  boundary: {
      width: '55%',
      height: '55%'
  }
});


$uploadCrop1 = $('#upload-demo-1').croppie({
  enableExif: true,
  enableResize : true,
  enableZoom : true,
  mouseWheelZoom: true,
  viewport: {
      width:'55%',
      height:'55%',
      type: 'square'
  },
  boundary: {
      width: '100%',
      height: '100%'
  }
});

$uploadCrop2 = $('#upload-demo-2').croppie({
  enableExif: true,
  enableResize : true,
  enableZoom : true,
  mouseWheelZoom: true,
  viewport: {
      width:'55%',
      height:'55%',
      type: 'square'
  },
  boundary: {
      width: '100%',
      height: '100%'
  }
});

$uploadCrop3 = $('#upload-demo-3').croppie({
  enableExif: true,
  enableResize : true,
  enableZoom : true,
  mouseWheelZoom: true,
  viewport: {
      width:'55%',
      height:'55%',
      type: 'square'
  },
  boundary: {
      width: '100%',
      height: '100%'
  }
});


$('#upload').on('change', function () {
  var reader = new FileReader();
    reader.onload = function (e) {
      $uploadCrop.croppie('bind', {
        url: e.target.result
      }).then(function(){
        main_image=true;
        console.log('jQuery bind complete');
      });
    }
    reader.readAsDataURL(this.files[0]);
    var reader = new FileReader();
    reader.onload = function (e) {
      $uploadCropSmall.croppie('bind', {
        url: e.target.result
      }).then(function(){
        small_image=true;
        console.log('jQuery bind complete');
      });
    }
    reader.readAsDataURL(this.files[0]);
});

$('#upload-small').on('change', function () {
  var reader = new FileReader();
    reader.onload = function (e) {
      $uploadCropSmall.croppie('bind', {
        url: e.target.result
      }).then(function(){
          $uploadCropSmall.croppie('result', {
            type: 'canvas',
            size: 'viewport',

            }).then(function (resp) {

              $('#small_image').val(resp);
          });
        console.log('jQuery bind complete');
      });
    }
    reader.readAsDataURL(this.files[0]);
});

$('#upload-1').on('change', function () {
  var reader = new FileReader();
    reader.onload = function (e) {
      $uploadCrop1.croppie('bind', {
        url: e.target.result
      }).then(function(){
        image_1=true;
        console.log('jQuery bind complete');
      });
    }
    reader.readAsDataURL(this.files[0]);
});

$('#upload-2').on('change', function () {
  var reader = new FileReader();
    reader.onload = function (e) {
      $uploadCrop2.croppie('bind', {
        url: e.target.result
      }).then(function(){
        image_2=true;
        console.log('jQuery bind complete');
      });
    }
    reader.readAsDataURL(this.files[0]);
});

$('#upload-3').on('change', function () {
  var reader = new FileReader();
    reader.onload = function (e) {
      $uploadCrop3.croppie('bind', {
        url: e.target.result
      }).then(function(){
        image_3=true;
        console.log('jQuery bind complete');
      });
    }
    reader.readAsDataURL(this.files[0]);
});

  $('.crop_image').click(function(event){
    if(main_image==true){
      $uploadCrop.croppie('result', {
        type: 'canvas',
        size: 'viewport'
        }).then(function (resp) {
          $('#main_image').val(resp);
      });
    }
    if(small_image==true){
      $uploadCropSmall.croppie('result', {
        type: 'canvas',
        size: 'viewport',
        }).then(function (resp) {
          $('#small_image').val(resp);
      });
    }
    if(image_1==true){
      $uploadCrop1.croppie('result', {
              type: 'canvas',
              size: 'viewport',
        }).then(function (resp) {
          $('#image_1').val(resp);
      });
    }
    if(image_2==true){
      $uploadCrop2.croppie('result', {
            type: 'canvas',
            size: 'viewport',
        }).then(function (resp) {
          $('#image_2').val(resp);
      });
    }
    if(image_3==true){
      $uploadCrop3.croppie('result', {
            type: 'canvas',
            size: 'viewport',
        }).then(function (resp) {
          $('#image_3').val(resp);
      });
    }
    $('#submit-form').prop("disabled", false);
  });

</script> -->

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.16.2/axios.js"></script>
<script type="text/javascript">
    /*function getStores(){

      var SelectedId = $('#venforstore').find(":selected").val();
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
  var old_stores = [];
    $('#stores_holder').hide();

    $('#forVendors').on('change',function(){
        var SelectedId=$('#forVendors').val();
        if(SelectedId!='choose vendor'){
        axios.get( '{{ url('/owner/manage/sellers/stores') }}/'+ SelectedId )
        //'/admin/public/owner/manage/sellers/stores/'
        .then(function(response) {
            if(response.data.response!=""){
                $('#forstores').html(response.data.response);
                $('#stores_holder').show();
            }else{
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
        $('#quantities_area').html('');
        old_stores = [];
    });

    $('#add_store').on('click',function(){

      var SelectedId=$('#forstores').val();
      if(old_stores.includes(SelectedId)) {
        return ;
      }
      var SelectedText=$('#forstores').find(":selected").text();


      var data = `
      <div class='form-group'>
        <label>*`+SelectedText+`</label>
        <input class="form-control" type="number" step="1" min='0' required name="store_quantities[quantity][]" placeholder="Quantity" onKeyDown="if(this.value.length==8 && event.keyCode!=8) return false;">
        <input type="hidden" value="`+SelectedId+`" name="store_quantities[id][]">
        <button class="btn btn-danger remove_quantity" type="button">Remove quntity</button>
      </div>`;

      $('#quantities_area').append(data);
      old_stores.push(SelectedId);
    });

    setInterval(function () {
      $('.remove_quantity').on('click',function(){
        var index = old_stores.indexOf($(this).prev().val());

          if (index > -1) {
             old_stores.splice(index, 1);
          }
          $( this).parent().hide();
      });
    }, 300);


  </script>

@stop
