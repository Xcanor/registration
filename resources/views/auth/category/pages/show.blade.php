@extends('auth.category.layouts.master')

@section('content')
<div class="card-body table-responsive p-0">
    <table class="table table-hover text-nowrap">
        <thead>
          <tr>
            <th>ID</th>
            <th>Name</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>{{ $category->id }}</td>
            <td>{{ $category->name }}</td>
          </tr>
        </tbody>
    </table>
</div>
@endsection
