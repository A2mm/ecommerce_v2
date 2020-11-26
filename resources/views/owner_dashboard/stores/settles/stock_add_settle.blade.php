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
      {{ __('translations.add_settle') }} {{ __('translations.for_store') }} (( {{ $order->store->name }} ))

      <h3 style="color: blue;"> </h3>
    </h1>
  </section>
  <!-- Main content -->
  <section class="content flex-row-reverse">
    <div class="row">
      <div class="col-md-12">
        <div class="box box-primary" style="padding-right: 10px;">
                  <!-- form start -->
                  {!! Form::open(['route' => 'stock.add.settle.save', 'files' => true, 'enctype' =>'multipart/form-data']) !!}

              <input class="form-control" value="{{$order->id}}" type="hidden" name="ship_id">  
              <input class="form-control" value="{{$order->store_id}}" type="hidden" name="store_id">
              <input class="form-control" value="{{$order->settle_id}}" type="hidden" name="settle_id">             

              <div class="form-group{{$errors->has('store_id') ? 'error' : null}}">
                         <label for="Store"> * {{__('translations.store')}}</label>
                        <input style="width: 250px;" disabled="disabled" type="text" class="form-control" id="" name="store_name" value="       {{$order->store->name}}">
                    </div>

                    <div class="form-group">
                        <label for="name"> * {{__('translations.settle_number')}}</label>
                          <input style="width: 250px;" disabled="disabled" class="form-control" value="{{$order->settle_id}}" type="number" name="settle_id">
                    </div>

                    <div class="form-group">
                        <label > * {{__('translations.reason')}}</label>
                        <input class="form-control" value="{{old('reason')}}" type="text" name="reason">
                      </div>


                      <div id="store_area">
</div>
<div>

<div class="row">
<div class="col-md-12">
 <div class="col-md-2">
   <br>
  <?php /* <label>{{__('translations.add_shiporder')}}</label> */ ?>
   <a href="#" class="btn btn-success" id="add_more" style="margin-bottom: 15px;">{{__('translations.add_shiporder_details')}}</a>
 </div>
 
</div>
</div>
</div>


                    <div class="form-group">
                      <button type="submit" class="btn btn-primary" id="submit-form">{{__('translations.submit')}}</button>
                    </div>
                    <br>

                  {!! Form::close() !!}
                <!-- </form> -->
                </div>
      </div><!-- /.box-body -->
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

  <?php /* var stores = new Array();
      <?php foreach ($stores as $key => $value) { ?>
        stores.push({
          id : <?php echo $value->id ;?> ,
          name: '<?php echo $value->name ;?>'
        });
      <?php } */ ?>
      var products = new Array();
      <?php foreach ($products as $key => $value) { ?>
        products.push({
          id : <?php echo $value->id ;?> ,
          name: '<?php echo $value->name ;?>'
        });
      <?php }?>


      var maxrows = <?php echo $count_products; ?>;
      var x = 1;

      $('#add_more').on('click', function(e)
        {
          var html = '<div class="row">';
              html +='<div class="col-md-12">';
              html +='<div class="col-md-4">';
             html +='<div class="form-group{{$errors->has('product_id') ? 'error' : null}}">';
              html +='<label for="Store"> * {{__('translations.choose_product')}}</label>';
               html +='<select class="form-control" id="forstores" name="product_id[]">';
              html +='<option selected="selected" value="">{{__('translations.choose_product')}}</option>';
               for (var i = 0; i < products.length; i++) {;
               html += '<option value="'+products[i].id+'">'+products[i].name+'</option>';
                } ;
              html +='</select>';
              html += '<?php  if($errors->has('product_id')){?>
                        <span class="help-block" style="color:red;">{{$errors->first('product_id')}}</span> <?php } ?>';
              html +='</div>';
              html +='</div>';

              


              html +='<div class="col-md-2">';
              html +='<div class="form-group">';
              html +='<label for="store">* {{__('translations.quantity_in_store')}}</label><br>';
              html +='<input type="number" min="1" class="form-control" name="store_quantities[]" id="store_quantity">';
              html += '<?php  if($errors->has('store_quantities')){?>
                        <span class="help-block" style="color:red;">{{$errors->first('store_quantities')}}</span> <?php } ?>';
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
              for (var i = 0; i < products.length; i++) {
                if (products[i].id == selectedStore ) {
                   products.splice(i, 1);
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
       
        });
  </script>


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

  

@stop
