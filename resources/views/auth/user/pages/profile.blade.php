@extends('auth.user.layouts.master')

@section('content')
<section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-3">

            <!-- Profile Image -->
            <div class="card card-primary card-outline">
              <div class="card-body box-profile">
                <div class="text-center">
                  <img class="profile-user-img img-fluid img-circle"
                       src="/uploads/avatars/{{ Auth::user()->avatar }}"
                       alt="User profile picture">
                </div>

                <h3 class="profile-username text-center">{{$auth_user->first_name}}</h3>
                <a href="/user/profile/{{$auth_user->id}}/edit">Edit</a><br>
                <a href="/user/profile/photo">Change Photo</a>

                

                <ul class="list-group list-group-unbordered mb-3">
                  <li class="list-group-item">
                    <b>Email</b> <a class="float-right">{{$auth_user->email}}</a>
                  </li>
                  <li class="list-group-item">
                    <b>Telephone</b> <a class="float-right">{{$auth_user->telephone}}</a>
                  </li>
                  <li class="list-group-item">
                    <b>Gender</b> <a class="float-right">{{$auth_user->gender}}</a>
                  </li>
                  <li class="list-group-item">
                    <b>Date of Birth</b> <a class="float-right">{{$auth_user->date_of_birth}}</a>
                  </li>
                </ul>

                <a href="#" class="btn btn-primary btn-block"><b>Follow</b></a>
              </div>
              <!-- /.card-body -->
            </div>
        </div>
    </div>
</div>
</section>
@endsection