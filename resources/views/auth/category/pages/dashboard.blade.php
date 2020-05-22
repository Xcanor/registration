@extends('auth.category.layouts.master')

@section('content')
<div class="card-body table-responsive p-0">
    <table class="table table-hover text-nowrap">
        <thead>
          <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($categories as $category)
          <tr>
          <td>{{ $category->id }}</td>
          <td>{{ $category->name }}</td>
          <td>
              <a href="category/{{ $category->id }}">Read</a><br>
              <a href="category/{{ $category->id }}/edit">Update</a><br>
              <button data-id="{{ $category->id }}" class="btn btn-primary delete" value="Delete">Delete</button>
          </td>
          </tr>
          @endforeach
        </tbody>
    </table>
</div>
@endsection


