@extends('owner_dashboard.master')
@section('body')
  <section class="content-header">
    <h1>
     {{__('translations.edit_sellers')}}
    </h1>
  </section>
  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-xs-12">
        <div class="box box-primary">
                  <!-- form start -->
                  {!! Form::open(['route' => ['manage.sellers.edit.post', $seller->id], 'files' => true]) !!}
                    <div class="box-body">
                      <div class="form-group">
                        <label for="name">{{__('translations.name')}}</label>
                        <input class="form-control" id="name" value="{{$seller->name}}" type="text" name="name">
                      </div>
                     
                      <div class="form-group">
                        <label for="arabic_name">{{__('translations.email')}}</label>
                        <input class="form-control" name="email" value="{{$seller->email}}"  type="text">
                      </div>

                      <div class="form-group">
                        <label for="arabic_name">{{__('translations.password')}}</label>
                        <input class="form-control" name="password" type="password">
                      </div>

                      <div class="form-group">
                        <label for="arabic_name">{{__('translations.discount')}} %</label>
                        <input class="form-control" name="discount" type="text" value="{{$seller->discount}}">
                      </div>
<?php
/*
                    <div class="form-group">
                       <label for="Store">{{__('translations.choose_a_vendor')}}</label>
                        <select class="form-control" id="forVendors" name="vendor_id">
                            <option disabled selected>{{__('translations.choose_vendor')}}</option>
                            @foreach ($vendors as $vendor)
                            <option value="{{$vendor->id}}" {{$vendor->id==$seller->store->vendor_id ? 'selected':''}}>{{$vendor->vendor_name}}</option>
                            @endforeach
                        </select>
                    </div>
*/
?>
                    <div class="form-group">
                       <label for="Store">{{__('translations.choose_a_store')}}</label>
                        <select class="form-control" id="forstores" name="store_id">
                            @foreach ($stores as $store)
                                <option value="{{$store->id}}" {{$store->id==$seller->store_id ? 'selected':''}}>{{$store->name}}</option>
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
  <script src="https://code.jquery.com/jquery-3.2.1.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous"></script>
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.16.2/axios.js"></script>
  <script type="text/javascript">

    $('#forVendors').on('change',function(){
        var SelectedId=$('#forVendors').val();
        if(SelectedId!='choose vendor'){
        axios.get('/owner/manage/sellers/stores/'+ SelectedId)
        .then(function(response) {
            if(response.data.response!=""){
                $('#forstores').html(response.data.response);
                $('#stores_holder').show();
            }else{
                $('#stores_holder').hide();
                $('#forstores').html('');
                alert({{__('translations.no_stores_for_this_vendor')}});
            }
        })
        .catch(function(error) {
            $('#stores_holder').hide();
            $('#forstores').html('');
            alert({{__('translations.something_went_wrong')}});
        });
        }
    })

  </script>
@stop
