<div class="container">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Administration Panel</h1>

            <button class="btn btn-success" type="submit" onclick="location.href='{{ url('admin/createUser') }}'">Create User</button>
            <button class="btn btn-success" type="submit" onclick="location.href='{{ url('admin/createoffer') }}'">Create Offer</button>
            <button class="btn btn-success" type="submit" onclick="location.href='{{ url('admin/addagency') }}'">Create Agency User</button>
            <a href="{{route('Adminlogout')}}">Logout</a>
          </div><!-- /.col -->
        </div><!-- /.row -->
</div><!-- /.container-fluid -->      
