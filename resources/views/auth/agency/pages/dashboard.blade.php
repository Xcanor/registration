@extends('auth.agency.layouts.master')

@section('content')
<div class="card-body table-responsive p-0">
    <table class="table table-hover text-nowrap">
        <thead>
          <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Photos</th>
            <th>Status</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($agencies->offers as $offer)
          <tr>
            <td>{{ $offer->id }}</td>
            <td>{{ $offer->name }}</td>
            <td>
            @foreach($offer->images as $image)
            <img src="/uploads/images/{{ $image->imagename }}" width="100" height="100" alt="">
            @endforeach
            </td>
            <td>
            <input type="checkbox" data-oid="{{$offer->id}}" name="status" class="js-switch" {{ $offer->status == 1 ? 'checked' : '' }}>
            </td>
            <td>
                <a href="dashboard/{{ $offer->id }}">Read</a><br>
                <a href="dashboard/{{ $offer->id }}/edit">Update</a><br>
                <a href="dashboard/{{ $offer->id }}/add">Add Details</a>  
               <form method="POST" action="dashboard/{{ $offer->id }}">
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
