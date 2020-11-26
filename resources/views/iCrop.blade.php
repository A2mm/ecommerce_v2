<html lang="en">
<head>
  <title>PHP - jquery ajax crop image before upload using croppie plugins</title>
  <script src="http://demo.itsolutionstuff.com/plugin/jquery.js"></script>
  <script src="http://demo.itsolutionstuff.com/plugin/croppie.js"></script>
  <link rel="stylesheet" href="http://demo.itsolutionstuff.com/plugin/bootstrap-3.min.css">
  <link rel="stylesheet" href="http://demo.itsolutionstuff.com/plugin/croppie.css">

  <meta name="csrf-token" content="{{ csrf_token() }}">

</head>
<body>
<div class="container">
	<div class="panel panel-default">

	  <div class="panel-heading">Image Upluad</div>
	  <div class="panel-body">
	  	<div class="row">
	  		<div class="col-md-4 text-center">
				<div id="upload-demo" style="width:350px"></div>
	  		</div>

	  		<div class="col-md-4" style="padding-top:30px;">
				<strong>Select Image:</strong>
				<br/>
				<input type="file" id="upload">
				<br/>
	  		</div>
        
	  	</div>


      <div class="row">
        <div class="col-md-4 text-center">
        <div id="upload-demo-1" style="width:350px"></div>
        </div>
        <div class="col-md-4" style="padding-top:30px;">
        <strong>Select Image:</strong>
        <br/>
        <input type="file" id="upload-1">
        <br/>

        </div>
        
      </div>


      <div class="row">
        <div class="col-md-4 text-center">
        <div id="upload-demo-2" style="width:350px"></div>
        </div>
        <div class="col-md-4" style="padding-top:30px;">
        <strong>Select Image:</strong>
        <br/>
        <input type="file" id="upload-2">
        <br/>

        </div>
        
      </div>


        <button class="btn btn-success upload-result">Submit</button>

      <form method="POST" action="{{url('/ic')}}" id="form_save">
        <input type="hidden" name="mm" id="mm">
        <input type="hidden" name="m1" id="m1">
        <input type="hidden" name="m2" id="m2">
      </form>
	  </div>
	</div>
</div>

<script type="text/javascript">
$uploadCrop = $('#upload-demo').croppie({
    enableExif: true,
    viewport: {
        width: 200,
        height: 200,
        type: 'square'
    },
    boundary: {
        width: 300,
        height: 300
    }
});

$uploadCrop2 = $('#upload-demo-1').croppie({
    enableExif: true,
    viewport: {
        width: 200,
        height: 200,
        type: 'square'
    },
    boundary: {
        width: 300,
        height: 300
    }
});

$uploadCrop3 = $('#upload-demo-2').croppie({
    enableExif: true,
    viewport: {
        width: 200,
        height: 200,
        type: 'square'
    },
    boundary: {
        width: 300,
        height: 300
    }
});


$('#upload').on('change', function () {
	var reader = new FileReader();
    reader.onload = function (e) {
    	$uploadCrop.croppie('bind', {
    		url: e.target.result
    	}).then(function(){
          $uploadCrop.croppie('result', {
            type: 'canvas',
            size: 'viewport'
            }).then(function (resp) {

              $('#mm').val(resp);
          });
    		console.log('jQuery bind complete');
    	});
    }
    reader.readAsDataURL(this.files[0]);
});

$('#upload-1').on('change', function () {
	var reader = new FileReader();
    reader.onload = function (e) {
    	$uploadCrop2.croppie('bind', {
    		url: e.target.result
    	}).then(function(){
          $uploadCrop2.croppie('result', {
    type: 'canvas',
    size: 'viewport'
    }).then(function (resp) {
      $('#m1').val(resp);

  });
    		console.log('jQuery bind complete');
    	});
    }
    reader.readAsDataURL(this.files[0]);
});

$('#upload-2').on('change', function () {
  var reader = new FileReader();
    reader.onload = function (e) {
      $uploadCrop3.croppie('bind', {
        url: e.target.result
      }).then(function(){
          $uploadCrop3.croppie('result', {
    type: 'canvas',
    size: 'viewport'
    }).then(function (resp) {
      $('#m2').val(resp);

  });
        console.log('jQuery bind complete');
      });
    }
    reader.readAsDataURL(this.files[0]);
});


$('.upload-result').on('click', function (ev) {
  $('#form_save').submit();
});


</script>


</body>

</html>
