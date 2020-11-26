@extends('owner_dashboard.master')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/croppie/2.6.2/croppie.css">
@section('body')
  <section class="content-header">
    <h1>
     {{__('translations.add_banner')}}
    </h1>
  </section>
  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-xs-12">
        <div class="box box-primary">
                  <!-- form start -->
                  {!! Form::open(['route' => ['manage.banner.edit','id' => $banner->id], 'files' => true , 'id' => "banner_form"]) !!}
                    <div class="box-body">
                      <div class="form-group">
                        <label>* {{__('translations.banner_type')}}</label>
                        <select class="js-example-basic-single form-control" id="banner_type" name="bannering_type_id">
                          @foreach($bannerTypes as $bannerType)
                          <?php /* <option value="{{$bannerType->id}} {{$bannerType->id == $banner->bannering_type_id ? 'selected' : ''}}">{{$bannerType->name}}</option>
                           */ ?>
                           <option value="{{$bannerType->id}}" {{$bannerType->id == $banner->bannering_type_id ? 'selected' : ''}}>{{$bannerType->name}}</option>

                          @endforeach
                          </select>

                        </div>
                      <div class="form-group">
                        <label > * {{__('translations.title')}}</label>
                        <input class="form-control" type="text" name="title" value="{{$banner->title}}">
                      </div>
                      <div class="form-group">
                        <label >{{__('translations.banner_link')}}</label>
                        <input class="form-control" type="text" name="banner_link" value="{{$banner->banner_link}}">
                      </div>
                      <div class="form-group">
                        <img src="{{asset($banner->full_image_path())}}" alt="">
                      </div>
                      <div id="page_image">
                        <div class="form-group"> * 
                          {{ Form::label('Banner') }}
                          <input type="file"  id="view_image" name="full_image">
                          <input type="hidden" name="image" value="" id="input_image">
                          <!-- input hidden required , you can't put a value into input type="file" via js
                           , the input will be a base64 format for the image then we handle it in the controller-->
                       </div>
                      </div><!-- /.box-body -->
                    </div>

                    <div class="box-footer">
                      <button type="submit" class="btn btn-primary crop_image">{{__('translations.update')}}</button>
                    </div>

                  {!! Form::close() !!}
                </div>
      </div>
    </div>
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.3.1.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.9/js/select2.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/croppie/2.6.2/croppie.js"></script>

    <script>
    var image_flag = false;
    $uploadCrop = $('#page_image').croppie({
    enableExif: true,
    enableResize : false,
    enableZoom : true,
    mouseWheelZoom: true,
    viewport: {
    width: 400,
    height: 400,
    type: 'sqaure'
    },
    boundary: {
      width: 500,
      height: 500
    }
    });
    $('#view_image').on('change', function () {
    var reader = new FileReader();
      reader.onload = function (e) {
      $uploadCrop.croppie('bind', {
        url: e.target.result
      }).then(function(){
        image_flag=true;
        console.log('jQuery bind complete');
      });
      }
      reader.readAsDataURL(this.files[0]);
    });

	$('.crop_image').click(function(event){
		if(image_flag==true){
      console.log(image_flag);
		$uploadCrop.croppie('result', {
			type: 'canvas',
			size: 'viewport'
			}).then(function (resp) {
			$('#input_image').val(resp);
      $("#banner_form").submit();
		});
		}
    else {
      $("#banner_form").submit();
    }
	});

    $(document).ready(function() {

      $("#banner_type").select2({
        placeholder : "{{ $banner->btype_name() }}",
      });
    });
</script>
  </section>

@stop
