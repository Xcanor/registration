@extends('auth.admin.layouts.master')

@section('content')
<div class="card-body table-responsive p-0">
    <table class="table table-hover text-nowrap">
        <thead>
          <tr>
            <th>Type</th>
            <th>Message</th>
          </tr>
        </thead>
        <tbody>
          <tr>
           <td>{{ $user_request->type }}</td>
           <td>{{ $user_request->description }}</td>
          </tr>
        </tbody>
    </table>
</div>
@endsection
