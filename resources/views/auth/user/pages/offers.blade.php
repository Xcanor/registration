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
          <tr>
            <td>{{ $offer->id }}</td>
            <td>{{ $offer->name }}</td>
            @foreach($offer->categories as $category)
            <td>{{ $category->name }}</td>
            @endforeach
            @foreach($offer->images as $image)
            <td>
            <img src="/uploads/images/{{ $image->imagename }}" width="100" height="100" alt="">
            </td>
            @endforeach
            @if($offer->status == 1)
            <td>
            {{$offer->status}}
            </td>
            @endif
            <td><a href="details/{{ $offer->id }}">Details</a><br></td>
          </tr>
          @endforeach
          @endforeach
        </tbody>
    </table>
</div>
@endsection
