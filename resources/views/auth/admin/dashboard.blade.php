@extends('layouts.app')
    @section('content')
    
    <h1>Number Of Admin users :{{ $admins->count() }} </h1>
    
    <h1>Number Of Total users in this system : {{ $users->count() }} </h1>
    
        <div>
            <div class="col-md-6 col-md-offset-4">
                <button type="submit" onclick="location.href='{{ url('admin/changepassword') }}'">
                    Change Password
                </button>
            </div>
        </div>
    @endsection