@extends('auth.agency.layouts.master')

@section('content')
<div class="card-body table-responsive p-0">
    <table class="table table-hover text-nowrap">
        <thead>
          <tr>
            <th>From</th>
            <th>To</th>
            <th>Departial Time</th>
            <th>Arrival Time</th>
            <th>Ticket Number</th>
            <th>Transportation</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($offer->details as $detail)
          <tr>
            <td>{{ $detail->from }}</td>
            <td>{{ $detail->to }}</td>
            <td>{{ date('l , F d , Y h:i A', strtotime($detail->departial_time)) }}</td>
            <td>{{ date('l , F d , Y h:i A', strtotime($detail->arrival_time)) }}</td>
            <td>{{ $detail->ticket_number }}</td>
            <td>{{ $detail->transportation }}</td>
            <td>
            <a href="{{ $detail->id }}/edit">Edit</a><br>
            <form method="POST" action="{{ $detail->id }}">
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
