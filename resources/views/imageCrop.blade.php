<html lang="en">
<head>
  <script src="http://demo.itsolutionstuff.com/plugin/jquery.js"></script>
  <script src="http://demo.itsolutionstuff.com/plugin/croppie.js"></script>
  <link rel="stylesheet" href="http://demo.itsolutionstuff.com/plugin/bootstrap-3.min.css">
  <link rel="stylesheet" href="http://demo.itsolutionstuff.com/plugin/croppie.css">
  <meta name="csrf-token" content="{{ csrf_token() }}">
</head>


<body>
<div class="container">
	<div class="panel panel-default">
	  <div class="panel-body">

	  	<div class="row">
	  		<div class="col-md-4 text-center" style="margin-left: -35px">
				<div id="upload-demo" style="width:330px"></div>
	  		</div>
	  		<div class="col-md-4" style="padding-top:30px;margin-left: 70px">
				<strong>Select Image:</strong>
				<br/>
				<input type="file" id="upload">
				<br/>
				<button id="x" class="btn btn-success upload-result">Upload Image</button>
	  		</div>

	  	</div>


	  	<div class="row">
	  		<div class="col-md-4 text-center" style="margin-left: -35px">
				<div id="upload-demo-2" style="width:330px"></div>
	  		</div>
	  		<div class="col-md-4" style="padding-top:30px;margin-left: 70px">
				<strong>Select Image:</strong>
				<br/>
				<input type="file" id="upload-2">
				<br/>
				<button id="x-2" class="btn btn-success upload-result">Upload Image</button>
	  		</div>

	  	</div>


	  </div>
	</div>
</div>


<script type="text/javascript">

$uploadCrop = $('#upload-demo').croppie({
    enableExif: true,
    viewport: {
        width: 375,
        height: 203,
        type: 'square'
    },
    boundary: {
        width: 400,
        height: 400
    }
});

$('#upload').on('change', function () { 
	var reader = new FileReader();
    reader.onload = function (e) {
    	$uploadCrop.croppie('bind', {
    		url: e.target.result
    	});
    }
    reader.readAsDataURL(this.files[0]);
});

$('#x').on('click', function (ev) {
	$uploadCrop.croppie('result', {
		type: 'canvas',
		size: 'viewport'
	}).then(function (resp) {
		
		$.ajax({
			url: "/luxgems/public/icrop",
			type: "POST",
			data: {"image":resp}
		});
	});
});


</script>



<script type="text/javascript">
	
$uploadCrop2 = $('#upload-demo-2').croppie({
    enableExif: true,
    viewport: {
        width: 375,
        height: 203,
        type: 'square'
    },
    boundary: {
        width: 400,
        height: 400
    }
});

$('#upload-2').on('change', function () { 
	var reader = new FileReader();
    reader.onload = function (e) {
    	$uploadCrop2.croppie('bind', {
    		url: e.target.result
    	});
    }
    reader.readAsDataURL(this.files[0]);
});

$('#x-2').on('click', function (ev) {
	
		$uploadCrop.croppie('result', {
		type: 'canvas',
		size: 'viewport'
	}).then(function (resp) {
		
		$.ajax({
			url: "/luxgems/public/icrop",
			type: "POST",
			data: {"image":resp}
		});
	});
 
	$uploadCrop2.croppie('result', {
		type: 'canvas',
		size: 'viewport'
	}).then(function (resp) {
		
		$.ajax({
			url: "/luxgems/public/icrop",
			type: "POST",
			data: {"image2":resp}
		});
	});
});


</script>


</body>
</html>