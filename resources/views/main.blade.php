<form method="POST" enctype="multipart/form-data" action="{{url('/main')}}">

{{csrf_field() }}
<div class="form-group">
	<div class="col-md-6">
		<input type="file" name="attachment" id="attachment" class="form-control">
	</div>	

	<button type="submit">
		submit
	</button>	
</div>

	
</form>