@extends('auth.admin.layouts.master')

@section('content')
<div class="card-body table-responsive p-0">
    <table class="table table-hover text-nowrap">
        <thead>
          <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Category</th>
            <th>Start Date</th>
            <th>End Date</th>
            <th>Rooms</th>
            <th>Status</th>
            <th>Agent Price</th>
            <th>User Price</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>{{ $offer->id }}</td>
            <td>{{ $offer->name }}</td>
            <td>
              @foreach($offer->categories as $category)
              {{$category->name}}
              @endforeach
            </td>
            <td>{{ date('l , F d , Y h:i A', strtotime($offer->start_date)) }}</td>
            <td>{{ date('l , F d , Y h:i A', strtotime($offer->end_date)) }}</td>
            <td>{{ $offer->rooms }}</td>
            @if($offer->status == 1)
            <td>
              Active
            </td>
            @else
            <td>
              Block
            </td>
            @endif
            <td>{{ $offer->agency_price }}</td>
            <td>{{ $offer->user_price }}</td>
            <td>
            <a href="details/{{ $offer->id }}">Details</a><br>
            </td>
          </tr>
        </tbody>
    </table>
</div>
@endsection
