<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>ROYAL POS <?php // {{__('translations.luxgems_owner_dashboard')}} ?></title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="{{asset("bootstrap/css/bootstrap.min.css")}}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{asset("dist/css/AdminLTE.min.css")}}">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="{{asset("dist/css/skins/_all-skins.min.css")}}">
    <!-- iCheck -->
    <link rel="stylesheet" href="{{asset("plugins/iCheck/flat/blue.css")}}">
    <!-- Morris chart -->
    <link rel="stylesheet" href="{{asset("plugins/morris/morris.css")}}">
    <!-- jvectormap -->
    <link rel="stylesheet" href="{{asset("plugins/jvectormap/jquery-jvectormap-1.2.2.css")}}">
    <!-- Date Picker -->
    <link rel="stylesheet" href="{{asset("plugins/datepicker/datepicker3.css")}}">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="{{asset("plugins/daterangepicker/daterangepicker-bs3.css")}}">
    <!-- bootstrap wysihtml5 - text editor -->
    <link rel="stylesheet" href="{{asset("plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css")}}">

    <link rel="stylesheet" href="{{asset("plugins/datatables/dataTables.bootstrap.css")}}">
    <link href="{{asset('css/sweetalert.min.css')}}" rel="stylesheet" type="text/css">
    <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"> -->
    <link  href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.9/css/select2.min.css" rel="stylesheet" />

    <?php // added tiny  ?>

     <script src="{{asset('tinymce/js/tinymce/tinymce.min.js')}}"></script> 
    <script src="{{asset('tinymce/js/tinymce/jquery.tinymce.min.js')}}"></script>

    <style media="screen">
    .colorPlatte {
    display:none;
    height: 20px;
    width: 20px;
    top: 0;
    left: 0;
    z-index: 2;
    }

    .colorPlatte + label{
    height: 20px;
    width: 20px;
    display:inline-block;
    padding: 0 0 0 0px;
    top: 0;
    left: 0;
    z-index: 1;
    border-radius: 100%;
    border: 1px solid #999;
    box-sizing: border-box;
    }

    .colorPlatte:checked + label{
    height: 20px;
    width: 20px;
    display:inline-block;
    padding: 0 0 0 0px;
    border: 5px solid #999;
    box-sizing: border-box;
    border-radius: 100%;
    }

            /* The snackbar - position it at the bottom and in the middle of the screen */
#snackbar {
    visibility: hidden;
    min-width: 250px;
    border-radius: 10px;
    margin-left: -125px;
    background-color: #33735e;
    color: #f1f1f1;
    box-shadow: 0px 0px 7px 3px #8c8c8c8a;
    /* border: 1px solid #716767; */
    text-align: center;
    /* border-radius: 2px; */
    padding: 16px;
    position: fixed;
    z-index: 1;
    left: 50%;
    bottom: 30px;
}

/* Show the snackbar when clicking on a button (class added with JavaScript) */
#snackbar.show {
    visibility: visible; /* Show the snackbar */

/* Add animation: Take 0.5 seconds to fade in and out the snackbar.
However, delay the fade out process for 2.5 seconds */
    -webkit-animation: fadein 0.2s, fadeout 0.5s 2.5s;
    animation: fadein 0.2s, fadeout 0.5s 2.5s;
}

/* Animations to fade the snackbar in and out */
@-webkit-keyframes fadein {
    from {bottom: 0; opacity: 0;}
    to {bottom: 30px; opacity: 1;}
}

@keyframes fadein {
    from {bottom: 0; opacity: 0;}
    to {bottom: 30px; opacity: 1;}
}

@-webkit-keyframes fadeout {
    from {bottom: 30px; opacity: 1;}
    to {bottom: 0; opacity: 0;}
}

@keyframes fadeout {
    from {bottom: 30px; opacity: 1;}
    to {bottom: 0; opacity: 0;}
}


    </style>


    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body class="hold-transition skin-red sidebar-mini layout-boxed">
    <div class="">
