<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css')}} ">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Tempusdominus Bbootstrap 4 -->
    <link rel="stylesheet" href="{{ asset('plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css')}}">
    <!-- iCheck -->
    <link rel="stylesheet" href="{{ asset('plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
    <!-- JQVMap -->
    <link rel="stylesheet" href="{{ asset('plugins/jqvmap/jqvmap.min.css')}}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css')}}">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="{{ asset('plugins/overlayScrollbars/css/OverlayScrollbars.min.css')}}">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="{{ asset('plugins/daterangepicker/daterangepicker.css')}}">
    <!-- Select2 -->
    <link rel="stylesheet" href="{{ asset('plugins/select2/css/select2.min.css')}}">
    <!-- SweetAlert2 -->
    <link rel="stylesheet" href="{{ asset('plugins/sweetalert2/sweetalert2.min.css')}}">
    <!-- Toastr -->
    <link rel="stylesheet" href="{{ asset('plugins/toastr/toastr.min.css')}}">
    <!-- summernote -->
    <link rel="stylesheet" href="{{ asset('plugins/summernote/summernote-bs4.css')}}">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    <!-- Datatables -->
    <link rel="stylesheet" href="{{ asset('plugins/datatables/dataTables.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="//cdn.datatables.net/v/bs/dt-1.10.18/datatables.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
    <!-- Scripts -->
    <!--<script src="{{ asset('js/app.js') }}" defer></script>-->
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.4/toastr.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.4/toastr.min.js"></script>
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    @stack('css')
    @yield('css')
</head>
<body class="hold-transition sidebar-collapse">
    <div id="">
        @auth()
        <div class="wrapper">
          @if(Auth::user()->rolename=='SuperAdmin')
          @include('layouts.navbars.superadminsidebar')
          @elseif(Auth::user()->rolename=='Admin')
          @include('layouts.navbars.adminsidebar')
          @else
          @include('layouts.navbars.sidebar')
          @endif
          <div class="main-panel">
            @include('layouts.navbars.navbar')

            <div class="content">
                @yield('content')
            </div>

            @include('layouts.footer')
        </div>
    </div>
    @else
    @include('layouts.navbars.navbar')
    <div class="wrapper wrapper-full-page">
        <div class="full-page {{ $contentClass ?? '' }}">
            <div class="content">
                <div class="container">
                    @yield('content')
                </div>
            </div>
            @include('layouts.footer')
        </div>
    </div>
    @endauth

</div>

@stack('js')
@yield('js')
<!-- jQuery -->
<script src="{{ asset('plugins/jquery/jquery.min.js')}}"></script>
<!-- jQuery UI 1.11.4 -->
<script src="{{ asset('plugins/jquery-ui/jquery-ui.min.js')}}"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- ChartJS -->
<script src="{{ asset('plugins/chart.js/Chart.min.js')}} "></script>
<!-- Sparkline -->
<script src="{{ asset('plugins/sparklines/sparkline.js')}} "></script>
<!-- JQVMap -->
<script src="{{ asset('plugins/jqvmap/jquery.vmap.min.js')}} "></script>
<script src="{{ asset('plugins/jqvmap/maps/jquery.vmap.world.js')}} "></script>
<!-- jQuery Knob Chart -->
<script src="{{ asset('plugins/jquery-knob/jquery.knob.min.js')}} "></script>
<!-- daterangepicker -->
<script src="{{ asset('plugins/moment/moment.min.js')}} "></script>
<script src="{{ asset('plugins/daterangepicker/daterangepicker.js')}} "></script>
<!-- SweetAlert2 -->
<script src="{{ asset('plugins/sweetalert2/sweetalert2.min.js')}}"></script>
<!-- Toastr -->
<script src="{{ asset('plugins/toastr/toastr.min.js')}}"></script>

<!-- Tempusdominus Bootstrap 4 -->
<script src="{{ asset('plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js')}} "></script>
<!-- Summernote -->
<script src="{{ asset('plugins/summernote/summernote-bs4.min.js')}} "></script>
<!-- overlayScrollbars -->
<script src="{{ asset('plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js')}} "></script>

<!-- FastClick -->
<script src="{{ asset('plugins/fastclick/fastclick.js')}} "></script>
<!-- AdminLTE App -->
<script src="{{ asset('dist/js/adminlte.js')}} "></script>

<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<!--<script src="{{ asset('dist/js/pages/dashboard.js')}} "></script>-->
<!-- AdminLTE for demo purposes -->
<script src="{{ asset('plugins/chart.js/Chart.min.js')}}"></script>
<script src="{{ asset('dist/js/demo.js')}}"></script>
<script src="{{ asset('dist/js/pages/dashboard3.js')}}"></script>

<!-- DataTables -->
<script src="{{ asset('plugins/datatables/jquery.dataTables.js')}}"></script>
<script src="{{ asset('plugins/datatables/dataTables.bootstrap4.js')}}"></script>
<script>
  $(function () {
    //Add text editor
    //$('#compose-textarea').wysihtml5()
})

  $(function () {
    $("#example1").DataTable();
    $("#example4").DataTable();
    $("#example5").DataTable();
    $("#example6").DataTable();
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
  });


});
</script>
<!-- AdminLTE App -->
<!-- <script src="{{ asset('dist/js/adminlte.min.js')}} "></script>-->
<!-- Bootstrap WYSIHTML5 -->
<!--<script src="{{ asset('js/bootstrap3-wysihtml5.all.min.js')}}"></script>-->
<!-- Page Script -->
<!-- fullCalendar 2.2.5 -->
<script src="{{ asset('plugins/moment/moment.min.js')}} "></script>
<script src="{{ asset('plugins/fullcalendar/main.min.js')}}"></script>
<script src="{{ asset('plugins/fullcalendar-daygrid/main.min.js')}}"></script>
<script src="{{ asset('plugins/fullcalendar-timegrid/main.min.js')}}"></script>
<script src="{{ asset('plugins/fullcalendar-interaction/main.min.js')}}"></script>
<script src="{{ asset('plugins/fullcalendar-bootstrap/main.min.js')}}"></script>
<script type="text/javascript">

    $(document).ready(function(){



       $("#site_id").change(function() {
        console.log(this.value);
        $.ajax({
            type: "GET",
            url: 'http://127.0.0.1:8000/kullanicilar/'+this.value+'/blok',
            data: this.value,
            success: function(data){
                console.log(data);
                $('#blok_id').empty();
                $("#blok_id").append('<option>--Blok --</option>');
                if(data)
                {
                    $.each(data.siteblok,function(key,value){
                            //console.log(value.id);
                            //console.log(key);
                            $('#blok_id').append($("<option/>", {
                             value: value.id,
                             text: value.blok_adi
                         }));
                        });
                }
            }
        });
    });

   });


    $('#blok_id').change(function() {
        console.log(this.value);
    });

</script>
</body>
</html>
