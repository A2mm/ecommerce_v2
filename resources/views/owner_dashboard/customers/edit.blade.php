@extends('owner_dashboard.master')

@section('body')

  <section class="content-header">

    <h1>

      {{__('translations.edit_customer')}}

    </h1>

  </section>

  <!-- Main content -->

  <section class="content">

    <div class="row">

      <div class="col-xs-12">

        <div class="box box-primary">

                  <!-- form start -->

                  {!! Form::model($customer, ['route' => ['manage.customers.edit.post', $customer->id], 'files' => true, 'enctype' => 'multipart/form-data']) !!}

                    <div class="box-body">

                      <div class="form-group">

                        <label for="name">* {{__('translations.name')}}</label>

                        <input class="form-control" id="name" type="text" name="name" value="{{$customer->name}}">

                      </div>

                      <div class="form-group">

                        <label for="email">* {{__('translations.email')}}</label>

                        <input class="form-control" id="email" type="email" name="email" value="{{$customer->email}}">

                      </div>

                      <div class="form-group">

                        <label for="password">* {{__('translations.password')}}</label>

                        <input class="form-control" id="password" type="password" name="password">

                      </div>


                      <div class="form-group">

                        <label for="email">* {{__('translations.phone')}}</label>

                        <input class="form-control" id="phone" name="phone" type="text" value="{{$customer->phone}}">

                      </div>

                      <div class="form-group">
                        <label>* {{__('translations.choose_user_type')}}</label>
                        <select class="form-control" name="usertype_id">
                          @foreach($usertypes as $type)
                          <option value="{{$type->id}}" {{ $customer->usertype_id == $type->id ? 'selected' : ''}}>{{$type->name}}</option>
                          @endforeach
                        </select>
                      </div>

                      <div>
                         @if(strlen($customer->image) > 20)<br>
                         <img style="margin-top: -20px;" src="{{asset('clients/images/'.$customer->image)}}"  width="100px" height="100px" class="img img-circle" style="border: 3px solid black; margin-top: 25px;">
                        @else
                            <h1> <i class="fa fa-user"></i> </h1>
                        @endif
                      </div><br>
                      <div class="form-group">
                         <div id="area" style="margin-right: 15px;">  </div>
                        <label for="iimage">
                          <a class="btn btn-warning"><i class="fa fa-upload"></i> {{__('translations.add_image')}} </a></label>

                        <input style="display: none;" class="form-control" id="iimage" name="image" type="file" value="{{old('image')}}">

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
        $('#area').empty().html(newname);
    });

   // $('.btn').attr('disabled', false);
    });
</script>


@stop
