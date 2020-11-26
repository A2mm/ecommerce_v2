@extends('owner_dashboard.master')
@section('body')
  <section class="content-header">
    <h1>
     {{__('translations.add_sellers')}}
    </h1>
  </section>
  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-xs-12">
        <div class="box box-primary">
                  <!-- form start -->
                  {!! Form::open(['route' => 'manage.sellers.store', 'files' => true]) !!}
                    <div class="box-body">
                      <div class="form-group">
                        <label for="name">* {{__('translations.name')}}</label>
                        <input class="form-control" id="name" type="text" name="name" value="{{old('name')}}">
                      </div>
                      
                      <div class="form-group">
                        <label for="arabic_name">* {{__('translations.email')}}</label>
                        <input class="form-control" name="email" type="text" value="{{old('email')}}">
                      </div>

                      <div class="form-group">
                        <label for="arabic_name">* {{__('translations.password')}}</label>
                        <input class="form-control" name="password" type="password">
                      </div>

                       <div class="form-group">
                        <label for="arabic_name">* {{__('translations.discount')}} %</label>
                        <input class="form-control" name="discount" type="text" value="{{old('discount')}}">
                      </div>
<?php 
/*
                    <div class="form-group">
                       <label for="Store">{{__('translations.choose_a_vendor')}}</label>
                        <select class="form-control" id="forVendors" name="vendor_id">
                            <option disabled selected>{{__('translations.choose_vendor')}}</option>
                            @foreach ($vendors as $vendor)
                            <option value="{{$vendor->id}}">{{$vendor->vendor_name}}</option>
                            @endforeach
                        </select>
                    </div>
*/
?>
                    <div class="form-group">
                       <label for="Store">* {{__('translations.choose_a_store')}}</label>
                        <select class="form-control" id="forstores" name="store_id">
                            <option disabled selected>{{__('translations.choose_store')}}</option>
                            @foreach($stores as $store)
                            <option value="{{$store->id}}">{{$store->name}}</option>
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
  </section>
  @stop
  @section('scripts')
<?php /*  <script src="https://code.jquery.com/jquery-3.2.1.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous"></script> */ ?>
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.16.2/axios.js"></script>
  <!-- <script type="text/javascript">
    $('#stores_holder').hide();

    $('#forVendors').on('change',function(){
        var SelectedId = $('#forVendors').val();
        if(SelectedId!='choose vendor'){
          var urlRoute = "{{route('manage.sellers.stores',':vendor_id')}}";
          url1 = urlRoute.replace(':vendor_id',SelectedId);
        axios.get(url1)
        .then(function(response) {
            if(response.data.response!=""){
                $('#forstores').html(response.data.response);
                $('#stores_holder').show();
            }else{
                $('#stores_holder').hide();
                $('#forstores').html('');
                alert("{{__('translations.no_stores_for_this_vendor')}}");
            }
        })
        .catch(function(error) {
            $('#stores_holder').hide();
            $('#forstores').html('');
            alert("{{__('translations.something_went_wrong')}}");
            // alert('someting went wrong');
        });
        }
    })

  </script> -->
@endsection
