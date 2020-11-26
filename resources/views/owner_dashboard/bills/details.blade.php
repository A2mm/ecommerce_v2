@extends('owner_dashboard.master')
<script type="text/javascript" src="https://rawgit.com/schmich/instascan-builds/master/instascan.min.js"></script>
@section('body')

  <section class="content-header">

    <h1>

     {{__('translations.unfinished_bill')}}

    </h1>

  </section>



  <!-- Main content -->

  <section class="content">

    <div class="row">

      <div class="col-xs-12">

        <div class="box">

    <div class="box-header">

      <h3 class="box-title"></h3>

    </div><!-- /.box-header -->


<table class="table table-bordered table-striped">
<thead>
      <tr>
        <th>{{__('translations.product_name')}}</th>
        <th>{{$bill->product->name}}</th>
      </tr>
      <tr>
        <th>{{__('translations.quantity')}}</th>
        <th>{{abs($bill->quantity)}}</th>
      </tr>
      <tr>
        <th>{{__('translations.remaining')}}</th>
        <th>{{$bill->remaining}}</th>
      </tr>
      <tr>
        <th>{{__('translations.created_at')}}</th>
        <th>{{$bill->created_at}}</th>
      </tr>
      <tr>
        <th>{{__('translations.store')}}</th>
        <th>{{$bill->store->name}}</th>
      </tr>
    </thead>
     <tbody>
    </tbody>
    </table>
    </div>
      </div>
    </div>
  </section>

  <section class="content">
    <p id="code_error" style="color: #ff0000de;position: absolute;top: 20%;left: 50%;font-size: 20px;"></p>
    <div style="text-align: center;">
    <video id="preview"></video>
    </div>
    <div>
      <h2>
        {{__('translations.scanned_products')}} <span id="products_number" class="badge badge-dark">0</span>
        <div id="products_pills">

        </div>
      </h2>
    </div>
    <div class="form-group">
      <input class="form-conrol" type="text" id="manual_addition" value="">
      <button type="button" id="manual_addition_btn">{{__('translations.add')}}</button>
    </div>
    <button id="finish_button" type="button" class="btn btn-primary">{{__('translations.finish')}}</button>
  </section>
  <script
      src="https://code.jquery.com/jquery-3.2.1.min.js"
      integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4="
      crossorigin="anonymous"></script>
  <script type="text/javascript">
  var barcodes = [];

  let scanner = new Instascan.Scanner(
      {
          video: document.getElementById('preview')
      }
  );
  scanner.addListener('scan', function (content) {
    if(barcodes.includes(content)){
      alert('Already scanned!');
      return;
    }
    barcodes.push(content);

    $("#products_pills").append('<span class="badge badge-secondary" barcode="'+content+'">'+content+'</span>');
    var old_number = parseInt($("#products_number").html());
    old_number++;
    $("#products_number").html(old_number);
  });

  Instascan.Camera.getCameras().then(cameras => {
      if (cameras.length > 0) {
          scanner.start(cameras[0]);
      } else {
          console.log('error in camera');
      }
  }).catch(error => {
      console.log(error);
  })



  $("#finish_button").click(function(){
      $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
      });
      $.ajax({
          url: "{{ route('manage.purchase.bill.post.settle') }}",
          type: 'POST',
          data: {
              _token: "{{ csrf_token() }}",
              barcodes: barcodes,
              bill_id: "{{ $bill->id }}",
          },
          success: function (data) {
            // alert(data);
              if (data.code == 201) {
                  // alert(data.message);
              } else if (data.code == 200) {
                  window.location.assign("{{ route('manage.purchase.bills', $bill->store->vendor_id) }}");
              } else {
                  alert('something went wrong');
              }
          }, error: function (error) {
              // alert(console.error());
              console.log(error);
          }
      });

});

$("#manual_addition_btn").click(function(){
    var code = $('#manual_addition').val();
    if(barcodes.includes(code)){
      alert('Already scanned!');
      return;
    }
    barcodes.push(code);

    $("#products_pills").append('<span class="badge badge-secondary rem" barcode="'+code+'">'+code+'</span>');
    var old_number = parseInt($("#products_number").html());
    old_number++;
    $("#products_number").html(old_number);

});

  setInterval( function(){

  $(".rem").click(function(){
    // alert('hi');
      var code = $(this).attr("barcode");

      for (var i = 0; i < barcodes.length; i++) {
        if (barcodes[i] == code) {
          // barcodes = barcodes.splice(i, 1);
          // var index = barcodes.indexOf(code);
          // barcodes.splice(index, 1);
          return;
        }
      }

      return;

  });
},100);

</script>
@stop
