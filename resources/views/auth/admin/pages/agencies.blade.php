@extends('auth.admin.layouts.master')

@section('content')
<div class="card-body table-responsive p-0">
    <table class="table table-hover text-nowrap">
        <thead>
          <tr>
            <th>ID</th>
            <th>User</th>
            <th>Email</th>
            <th>Status</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($agencies as $agency)
          <tr>
            <td>{{ $agency->id }}</td>
            <td>{{ $agency->name }}</td>
            <td>{{ $agency->email }}</td>
            <td>
            <input type="checkbox" data-aid="{{ $agency->id }}" name="status" class="js-switch" {{ $agency->status == 1 ? 'checked' : '' }}>
            </td>
            <td>
                <a href="agencies/{{ $agency->id }}">Read</a> 
                <a href="agencies/{{ $agency->id }}/edit">Update</a>
               <form method="POST" action="agencies/{{ $agency->id }}">
                    @csrf
                    @method('DELETE')
                    <input type="submit" class="btn btn-primary" value="Delete">
                </form>
            </td>
          </tr>
          @endforeach
        </tbody>
    </table>
</div>

@endsection