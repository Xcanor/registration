@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    
                    You are logged in!
                </div>
                <div>
                    <div class="col-md-6 col-md-offset-4 mt-4">
                        <button type="submit" onclick="location.href='{{ url('user/changepassword') }}'">
                            Change Password
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
