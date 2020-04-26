@extends('auth.admin.layouts.master')

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
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          @foreach($agencies as $agency)
          @foreach ($agency->offers as $offer)
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
            <input type="checkbox" data-oid="{{$offer->id}}" name="status" class="js-switch" {{ $offer->status == 1 ? 'checked' : '' }}>
            </td>
            <td>
                <a href="offer/{{ $offer->id }}">Read</a><br>
                <a href="offer/{{ $offer->id }}/edit">Update</a><br>
                <a href="offer/{{ $offer->id }}/add">Add Details</a>  
               <form method="POST" action="offer/{{ $offer->id }}">
                    @csrf
                    @method('DELETE')
                    <input type="submit" class="btn btn-primary" value="Delete">
                </form>
               
            </td>
          </tr>
          @endforeach
          @endforeach
        </tbody>
    </table>
</div>
@endsection
