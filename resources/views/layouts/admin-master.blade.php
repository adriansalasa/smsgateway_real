<!DOCTYPE html>

<html lang="en">

<head>

  <meta charset="UTF-8">

  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">

  <!-- <meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> -->

  <title>@yield('title', 'Test Laravel') &mdash; SMS Bersama</title>

  <meta name="csrf-token" content="{{ csrf_token() }}">

  <!-- General CSS Files -->

  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">



  <!-- CSS Libraries -->

  <link rel="stylesheet" href="{{ asset('assets/css/daterangepicker.css') }}">

  <link rel="stylesheet" href="{{ asset('assets/css/bootstrap-colorpicker.min.css') }}">

  <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/combobox/select2.css') }}" />

  <link rel="stylesheet" href="{{ asset('assets/css/selectric.css') }}">

  <link rel="stylesheet" href="{{ asset('assets/css/bootstrap-timepicker.min.css') }}">

  <link rel="stylesheet" href="{{ asset('assets/css/bootstrap-tagsinput.css') }}">

  <link rel="stylesheet" href="{{ asset('assets/css/summernote-bs4.css') }}">



  <!-- Template CSS -->

  <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">

  <link rel="stylesheet" href="{{ asset('assets/css/components.css')}}">
  <link rel="icon" type="image/png" href="{{asset('assets/img/gmt/Icon-small.png')}}">


  <style>

    .progress {

            display: block;

            text-align: center;

            width: 0;

            height: 3px;

            background: red;

            transition: width .3s;

        }

        .progress.hide {

            opacity: 0;

            transition: opacity 1.3s;

        }

        #loading {
          background: url("{{asset('assets/img/gmt/SMS3.gif')}}") no-repeat center center;
          position: absolute;
          top: 0;
          left: 0;
          height: 100%;
          width: 100%;
          z-index: 9999999;
      }

  </style>

</head>



<body>
  
  <div id="loading"></div>
  <div id="app">

    <div class="main-wrapper">

      <div class="navbar-bg bg-info"></div>

      <nav class="navbar navbar-expand-lg main-navbar">

        @include('admin.partials.topnav')

      </nav>

      <div class="main-sidebar">

        @include('admin.partials.sidebar')

      </div>



      <!-- Main Content -->

      <div class="main-content">

        @yield('content')

      </div>

      <footer class="main-footer">

        @include('admin.partials.footer')

      </footer>

    </div>

  </div>



  <script src="{{ route('js.dynamic') }}"></script>

  <script src="{{ asset('js/app.js') }}?{{ uniqid() }}"></script>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.nicescroll/3.7.6/jquery.nicescroll.min.js"></script>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>

  <script src="{{ asset('assets/js/stisla.js') }}"></script>

  <script src="{{ asset('assets/js/scripts.js') }}"></script>

  <script src="{{ asset('assets/js/daterangepicker.js') }}"></script>

  <script src="{{ asset('assets/js/bootstrap-colorpicker.min.js') }}"></script>

  <script src="{{ asset('assets/js/bootstrap-timepicker.min.js') }}"></script>

  <script src="{{ asset('assets/js/bootstrap-tagsinput.min.js') }}"></script>

  <script src="{{ asset('assets/js/summernote-bs4.js') }}"></script>

  <script type="text/javascript">
    function hideLoader() {
    $('#loading').hide();
    }

    $(window).ready(hideLoader);

    // Strongly recommended: Hide loader after 20 seconds, even if the page hasn't finished loading
    setTimeout(hideLoader, 20 * 1000);
  </script>

  @yield('scripts')

</body>

</html>

