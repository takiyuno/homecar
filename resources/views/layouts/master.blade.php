<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Chookiat Krabi</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="shortcut icon" sizes="16x16 24x24 32x32 48x48 64x64" href="{{ asset('dist/img/homecarlogo2.jpg') }}">
<link rel="apple-touch-icon" sizes="57x57" href="{{ asset('dist/img/ios/homecarlogo2.png') }}">
<link rel="apple-touch-icon-precomposed" sizes="57x57" href="{{ asset('dist/img/ios/homecarlogo2.png') }}">
<link rel="apple-touch-icon" sizes="72x72" href="{{ asset('dist/img/ios/homecarlogo2.png') }}">
<link rel="apple-touch-icon" sizes="114x114" href="{{ asset('dist/img/ios/homecarlogo2.png') }}">
<link rel="apple-touch-icon" sizes="120x120" href="{{ asset('dist/img/ios/homecarlogo2.png') }}">
<link rel="apple-touch-icon" sizes="144x144" href="{{ asset('dist/img/ios/homecarlogo2.png') }}">
<link rel="apple-touch-icon" sizes="152x152" href="{{ asset('dist/img/ios/homecarlogo2.png') }}">
<meta name="application-name" content="Scotch Scotch scotch">
  <link rel="icon" href="{{ asset('dist/img/homecarlogo2.jpg') }}" type="image/ico" />
  <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
  <link rel="stylesheet" href="{{ asset('plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">
  <link rel="stylesheet" href="{{ asset('plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
  <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css') }}">
  <link rel="stylesheet" href="{{ asset('plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
  <link rel="stylesheet" href="{{ asset('plugins/daterangepicker/daterangepicker.css') }}">
  <link rel="stylesheet" href="{{ asset('plugins/summernote/summernote-bs4.css') }}">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">

  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">

  <link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
  <link rel="stylesheet" href="{{ asset('plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
  <link rel="stylesheet" href="{{ asset('plugins/toastr/toastr.min.css') }}">
  <link rel="stylesheet" href="{{ asset('plugins/ekko-lightbox/ekko-lightbox.css') }}">
  <link rel="stylesheet" href="{{ asset('plugins/toastr/toastr.min.css') }}">
 <!--Button Export Datatable-->
  <link rel="stylesheet" href="//cdn.datatables.net/buttons/1.4.1/css/buttons.dataTables.min.css"> 
  <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />
  <style>
    /* Hide scrollbar for Chrome, Safari and Opera */
    body::-webkit-scrollbar {
      display: none;
    }
    /* Hide scrollbar for IE and Edge */
    body {
      -ms-overflow-style: none;
    }
  </style>

  <style>
    #button {
      display: inline-block;
      background-color: #FF9800;
      width: 50px;
      height: 50px;
      text-align: center;
      border-radius: 4px;
      position: fixed;
      bottom: 30px;
      right: 30px;
      transition: background-color .3s, 
        opacity .5s, visibility .5s;
      opacity: 0;
      visibility: hidden;
      z-index: 1000;
    }
    #button::after {
      content: "\f077";
      font-family: FontAwesome;
      font-weight: normal;
      font-style: normal;
      font-size: 2em;
      line-height: 50px;
      color: #fff;
    }
    #button:hover {
      cursor: pointer;
      background-color: #333;
    }
    #button:active {
      background-color: #555;
    }
    #button.show {
      opacity: 1;
      visibility: visible;
    }

    /* Styles for the content section */
  </style>

  <script src="{{ asset('plugins/chart.js/Chart.min.js') }}"></script>
  <script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
  <script src="{{ asset('plugins/jquery-ui/jquery-ui.min.js') }}"></script>
  <script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ asset('plugins/moment/moment.min.js') }}"></script>
  <script src="{{ asset('plugins/daterangepicker/daterangepicker.js') }}"></script>
  <script src="{{ asset('plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script>
  <script src="{{ asset('plugins/summernote/summernote-bs4.min.js') }}"></script>
  <script src="{{ asset('plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
  <script src="{{ asset('dist/js/adminlte.js') }}"></script>
  <script src="{{ asset('plugins/input-mask/jquery.inputmask.js') }}"></script>

  <script src="{{ asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>
  <script src="{{ asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
  <script src="{{ asset('plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
  <script src="{{ asset('plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
  <script src="{{ asset('plugins/toastr/toastr.min.js') }}"></script>
  <script src="{{ asset('plugins/ekko-lightbox/ekko-lightbox.min.js') }}"></script>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
  <script src="{{asset('js/sweetAlert.js')}}"></script>
<script src="https://cdn.datatables.net/plug-ins/1.10.19/sorting/datetime-moment.js"></script>
<script src="//cdn.datatables.net/buttons/1.4.1/js/dataTables.buttons.min.js"></script>
  <!--Button Export Datatable-->
  <script src="//cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
  <script src="//cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/pdfmake.min.js"></script>
  <script src="//cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/vfs_fonts.js"></script>
  <script src="//cdn.datatables.net/buttons/1.4.1/js/buttons.html5.min.js"></script>
  <script src="//cdn.datatables.net/buttons/1.4.1/js/buttons.print.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
  <script>
    $.widget.bridge('uibutton', $.ui.button)
  </script>
</head>

<body  class="sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed sidebar-collapse" style="height: auto;">

  <!-- Site wrapper -->
  <div class="wrapper">

    <!-- =============================================== -->

    @include('layouts.header')
    @include('layouts.sidebar')

    <!-- =============================================== -->

    <div class="content-wrapper">
      @yield('content')
    </div>
    
    <div class="control-sidebar-bg"></div>

  </div>
</body>
</html>
