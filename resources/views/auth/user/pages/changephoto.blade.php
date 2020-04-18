@extends('auth.user.layouts.master')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <img src="/uploads/avatars/{{ $auth_user->avatar }}" style="width:150px; height:150px; float:left; border-radius:50%; margin-right:25px;">
            <h2>{{ $auth_user->first_name }}'s Profile</h2>
            <form enctype="multipart/form-data" action="{{route('uploadphoto')}}" method="POST">
                @csrf
                <label>Update Profile Image</label>
                <input type="file" name="avatar">
                <input type="submit" class="pull-right btn btn-sm btn-primary">
            </form>
        </div>
    </div>
</div>
@endsection