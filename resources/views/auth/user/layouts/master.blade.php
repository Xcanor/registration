<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">

  <!-- Title of the page -->
    @include('auth.user.partial.title') 

  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
    @include('auth.user.partial.styles')
  <script src="{{asset('bower_components/admin-lte/plugins/jquery/jquery.min.js')}}"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/switchery/0.8.2/switchery.min.js"></script>
  {!! NoCaptcha::renderJs() !!}
  
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

    <!-- Navbar -->
    @include('auth.user.partial.navbar')

    <!-- Header -->
    @include('auth.user.partial.header')

    <!-- SideMenu -->
    @include('auth.user.partial.side_menu')
    
    <!-- Main Content -->
    <div class="content-wrapper">
        @yield('content')
    </div>
    

   
</div>

@include('auth.user.partial.footer')
<!-- Footer -->


<!-- Scripts -->
@include('auth.user.partial.scripts')

</body>
</html>
