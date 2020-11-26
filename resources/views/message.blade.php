

@if (Session::has('message'))
        <li class="alert alert-success" role="alert" id="message" style="text-align: center; list-style: none;" >{{Session::get('message')}}</li>
        <?php Session::put('message', null); ?>
@endif


<script type="text/javascript">
	setTimeout(function() {
  $('#message').hide()
}, 4000);
</script>
