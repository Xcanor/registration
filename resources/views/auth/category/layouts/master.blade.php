<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">

  <!-- Title of the page -->
  @include('auth.category.partial.title') 

  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <!-- Styles -->
  @include('auth.category.partial.styles')

  <script src="{{asset('bower_components/admin-lte/plugins/jquery/jquery.min.js')}}"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/switchery/0.8.2/switchery.min.js"></script>
  
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">
    <!-- Navbar -->
    @include('auth.category.partial.navbar')
    <!-- Header -->
    @include('auth.category.partial.header')
    <!-- SideMenu -->
    @include('auth.category.partial.side_menu')
    
    <div class="content-wrapper">
        @yield('content')
    </div>
    

   
</div>

@include('auth.agency.partial.footer')
<!-- Footer -->

<script>
      $(document).ready(function(){

        $('.delete').click(function () {
          let categoryId = $(this).data('id');   
          var token = $("meta[name='csrf-token']").attr("content");
          var element = this;
          $.ajax({
            type: "DELETE",
            dataType: "json",
            url: 'category/'+categoryId,
            data: {'category_id': categoryId ,"_token": token},
            success: function () {
              $(element).closest("tr").remove();
              alert("Record Deleted");
              },
              error:function()
              {
                alert("You must delete childs first !! ");
              }
          });
        });
      });
</script>


<!-- jQuery UI 1.11.4 -->

@include('auth.agency.partial.scripts')

</body>
</html>
