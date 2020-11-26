@extends('owner_dashboard.master')

@section('body')

  <section class="content-header">

    <h1>

      {{__('translations.add_client')}}

    </h1>

  </section>

  <!-- Main content -->

  <section class="content">

    <div class="row">

      <div class="col-xs-12">

        <div class="box box-primary">

                  <!-- form start -->

                  {!! Form::open(['route' => 'manage.customers.post', 'files' => true, 'enctype' => 'multipart/form-data']) !!}

                    <div class="box-body">

                      <div class="form-group">

                        <label for="name">* {{__('translations.name')}}</label>

                        <input class="form-control" id="name" type="text" name="name" value="{{old('name')}}">

                      </div>

                       <div class="form-group">
                        <label>* {{__('translations.email')}}</label>
                        <input class="form-control" name="email" type="text" value="{{old('email')}}">
                      </div>

                       <div class="form-group">
                        <label>* {{__('translations.password')}}</label>
                        <input class="form-control" name="password" type="password">
                      </div>


                       <div class="form-group">

                        <label for="email">* {{__('translations.phone')}}</label>

                        <input class="form-control" id="phone" name="phone" type="text" value="{{old('phone')}}" placeholder="{{__('translations.01.........')}}">

                      </div>

                      <div class="form-group">
                        <label> * {{__('translations.choose_user_type')}} </label>

                        <select class="form-control" name="usertype_id">
                          <option value="" disabled="disabled" selected="selected">{{__('translations.choose_user_type') }}
                          </option>
                          @foreach($usertypes as $type)
                          <option value="{{$type->id}}">{{$type->name}}</option>
                          @endforeach
                        </select>
                      </div>

                       <div class="form-group">
                        <div id="area" style="margin-right: 15px;">  </div>
                        <label for="iimage" class="select_file">
                          <a class="btn btn-warning"><i class="fa fa-upload"></i> {{__('translations.add_image')}} </a></label>

                        <input style="display: none;" class="form-control" id="iimage" name="image" type="file">

                      </div>



                    </div><!-- /.box-body -->

                    <div class="box-footer">

                      <button type="submit" class="btn btn-primary">{{__('translations.submit')}}</button>

                    </div>

                  {!! Form::close() !!}

                </div>

      </div>

    </div>

  </section>

 <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>

<script type="text/javascript">
  $(document).ready(function()
    {
      // alert('one');
     // $('.select_file').click(function(){
   // var _this = $(this);
   // $('#iimage').show().focus().click().hide();

    $('#iimage').change(function() {
        var filename = $(this).val();
        var newname = filename.replace(/C:\\fakepath\\/i, '');
        //$('#area').empty().html(newname);
        $('#area').empty().html(filename);
    });

   // $('.btn').attr('disabled', false);

    });
</script>




@stop
