</div>

<!-- jQuery 2.1.4 -->

<script src="{{asset("plugins/jQuery/jQuery-2.1.4.min.js")}}"></script>

<!-- jQuery UI 1.11.4 -->

<script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>

<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->

<script>

  $.widget.bridge('uibutton', $.ui.button);

</script>

<!-- Bootstrap 3.3.5 -->

<script src="{{asset("bootstrap/js/bootstrap.min.js")}}"></script>

<!-- Morris.js charts -->







<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/chartist/0.10.1/chartist.min.css">

<script type="text/javascript" charset="utf8" src="https://cdnjs.cloudflare.com/ajax/libs/chartist/0.10.1/chartist.js"></script>

<link rel="stylesheet" href="{{asset("css/chartist-tool.css")}}">

<script src="{{asset("js/chartist-tool.js")}}"></script>









<script src="{{asset("https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js")}}"></script>

<script src="{{asset("plugins/morris/morris.min.js")}}"></script>

<!-- Sparkline -->

<script src="{{asset("plugins/sparkline/jquery.sparkline.min.js")}}"></script>

<!-- jvectormap -->

<script src="{{asset("plugins/jvectormap/jquery-jvectormap-1.2.2.min.js")}}"></script>

<script src="{{asset("plugins/jvectormap/jquery-jvectormap-world-mill-en.js")}}"></script>

<!-- jQuery Knob Chart -->

<script src="{{asset("plugins/knob/jquery.knob.js")}}"></script>

<!-- daterangepicker -->

<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.2/moment.min.js"></script>

<script src="{{asset("plugins/daterangepicker/daterangepicker.js")}}"></script>

<!-- datepicker -->

<script src="{{asset("plugins/datepicker/bootstrap-datepicker.js")}}"></script>

<!-- Bootstrap WYSIHTML5 -->

<script src="{{asset("plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js")}}"></script>

<!-- Slimscroll -->

<script src="{{asset("plugins/slimScroll/jquery.slimscroll.min.js")}}"></script>

<!-- FastClick -->

<script src="{{asset("plugins/fastclick/fastclick.min.js")}}"></script>

<!-- AdminLTE App -->

<script src="{{asset("dist/js/app.min.js")}}"></script>

<!-- AdminLTE dashboard demo (This is only for demo purposes) -->

<script src="{{asset("dist/js/pages/dashboard.js")}}"></script>

<!-- AdminLTE for demo purposes -->

<script src="{{asset("dist/js/demo.js")}}"></script>

<script src="{{asset("plugins/datatables/jquery.dataTables.min.js")}}"></script>

<script src="{{asset("plugins/datatables/dataTables.bootstrap.min.js")}}"></script>

<script src="{{asset('js/sweetalert.min.js')}}" type="text/javascript"></script>

<script src="{{asset('plugins/knob/jquery.knob.js')}}"></script>

<!-- Sparkline -->

<script src="{{asset('plugins/sparkline/jquery.sparkline.min.js')}}"></script>

  <script type="text/javascript">
  $('#expire_date').datepicker({
    startDate:new Date(),
    clearBtn: true,
    autoclose: true,
  });


</script>


</body>

</html>

