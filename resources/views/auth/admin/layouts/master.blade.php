<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">

  <!-- Title of the page -->
  @include('auth.admin.partial.title') 

  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Styles -->
  @include('auth.admin.partial.styles')

  <script src="{{asset('bower_components/admin-lte/plugins/jquery/jquery.min.js')}}"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/switchery/0.8.2/switchery.min.js"></script>
  
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">
    <!-- Navbar -->
    @include('auth.admin.partial.navbar')
    <!-- Header -->
    @include('auth.admin.partial.header')
    <!-- SideMenu -->
    @include('auth.admin.partial.side_menu')
    
    <div class="content-wrapper">
        @yield('content')
    </div>
    

   
</div>

@include('auth.admin.partial.footer')
<!-- Footer -->

<script>
  let elems = Array.prototype.slice.call(document.querySelectorAll('.js-switch'));

  elems.forEach(function(html) {
    let switchery = new Switchery(html,  { size: 'small' });
      });

      $(document).ready(function(){
        $('.js-switch').change(function () {
          let status = $(this).prop('checked') === true ? 1 : 0; // checked property in the input toggle button
          let userId = $(this).data('id');   // 
          $.ajax({
            type: "GET",
            dataType: "json",
            url: '{{ route('users.update.status') }}',
            data: {'status': status, 'user_id': userId},
            success: function (data) {
              console.log(data.message);
              }
          });
        });
      });
</script>

<!-- jQuery UI 1.11.4 -->

@include('auth.admin.partial.scripts')

</body>
</html>
