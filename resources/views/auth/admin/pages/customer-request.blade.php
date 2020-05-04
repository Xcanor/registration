@extends('auth.admin.layouts.master')

@section('content')
<div class="card-body table-responsive p-0">
    <table class="table table-hover text-nowrap">
        <thead>
          <tr>
            <th>Name</th>
            <th>Email</th>
            <th>Status</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          @foreach($user_requests as $user_request)
          <tr>
           <td>{{ $user_request->first_name . " " . $user_request->last_name }}</td>
           <td>{{ $user_request->email }}</td>

           @if($user_request->status == 1)
           <td>
              <i class="fas fa-envelope-open fa-2x"></i>
            </td>
            @else
            <td>
            <i class="fas fa-envelope fa-2x"></i>
            </td>
            @endif
           <td>
            <a href="details/{{ $user_request->id }}" class="target" data-mid="{{$user_request->id}}">Details</a><br>
            </td>
          </tr>
          @endforeach
        </tbody>
    </table>
</div>
@endsection
