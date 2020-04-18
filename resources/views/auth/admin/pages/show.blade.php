@extends('auth.admin.layouts.master')

@section('content')
<div class="card-body table-responsive p-0">
    <table class="table table-hover text-nowrap">
        <thead>
          <tr>
            <th>ID</th>
            <th>User</th>
            <th>Email</th>
            <th>Telephone</th>
            <th>gender</th>
            <th>Date of Birth</th>
            <th>Status</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>{{ $user->id }}</td>
            <td>{{ $user->first_name }}</td>
            <td>{{ $user->email }}</td>
            <td>{{ $user->telephone }}</td>
            <td>{{ $user->gender }}</td>
            <td>{{ $user->date_of_birth }}</td>
            @if($user->status == 1)
            <td>
              Active
            </td>
            @else
            <td>
              Block
            </td>
            @endif
          </tr>
        </tbody>
    </table>
</div>
@endsection
