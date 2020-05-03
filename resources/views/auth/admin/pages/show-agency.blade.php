@extends('auth.admin.layouts.master')

@section('content')
<div class="card-body table-responsive p-0">
    <table class="table table-hover text-nowrap">
        <thead>
          <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Address</th>
            <th>Status</th>
            <th>Photo</th>
            <th>Country</th>

          </tr>
        </thead>
        <tbody>
          <tr>
            <td>{{ $agency->id }}</td>
            <td>{{ $agency->name }}</td>
            <td>{{ $agency->email }}</td>
            <td>{{ $agency->phone }}</td>
            <td>{{ $agency->address }}</td>
            @if($agency->status == 1)
            <td>
              Active
            </td>
            @else
            <td>
              Block
            </td>
            @endif
            <td>
              <img src="uploads/photos/{{ $agency->photo }}" alt="profile">
            </td>
            <td>{{ $agency->country }}</td>
          </tr>
        </tbody>
    </table>
</div>
@endsection
