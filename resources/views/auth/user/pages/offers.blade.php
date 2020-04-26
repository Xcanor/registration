@extends('auth.user.layouts.master')

@section('content')
<div class="card-body table-responsive p-0">
    <table class="table table-hover text-nowrap">
        <thead>
          <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Categories</th>
            <th>Photos</th>
            <th>Status</th>
            <th>Details</th>
          </tr>
        </thead>
        <tbody>
          @foreach($agencies as $agency)
          @foreach ($agency->offers as $offer)
          @if($offer->status == 1)
          <tr>
            <td>{{ $offer->id }}</td>
            <td>{{ $offer->name }}</td>
            <td>
            @foreach($offer->categories as $category)
            {{ $category->name }}
            @endforeach
            </td>
            <td>
            @foreach($offer->images as $image)
            <img src="/uploads/images/{{ $image->imagename }}" width="100" height="100" alt="">
            @endforeach
            </td>
            
            <td>
            Active
            </td>
            <td><a href="details/{{ $offer->id }}">Details</a><br></td>
          </tr>
          @endif
          @endforeach
          @endforeach
        </tbody>
    </table>
</div>
@endsection
