@extends('auth.admin.layouts.master')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Add Details') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{route('add_details',$offer->id)}}">
                        @csrf
                        <div class="form-group row">
                            <label for="from" class="col-md-4 col-form-label text-md-right">{{ __('From') }}</label>

                            <div class="col-md-6">
                                <input id="from" type="text" class="form-control @error('from') is-invalid @enderror" name="from" value="{{ old('from') }}" required autocomplete="from" autofocus>

                                @error('from')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <label for="to" class="col-md-4 col-form-label text-md-right">{{ __('To') }}</label>

                            <div class="col-md-6">
                                <input id="to" type="text" class="form-control @error('to') is-invalid @enderror" name="to" value="{{ old('to') }}" autocomplete="to">

                                @error('to')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="departial_time" class="col-md-4 col-form-label text-md-right">{{ __('Departial Time') }}</label>

                            <div class="col-md-6">
                                <input id="departial_time" type="datetime-local" class="form-control @error('departial_time') is-invalid @enderror" name="departial_time" value="{{ old('departial_time') }}" autocomplete="departial_time">

                                @error('departial_time')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="arrival_time" class="col-md-4 col-form-label text-md-right">{{ __('Arrival Time') }}</label>

                            <div class="col-md-6">
                                <input id="arrival_time" type="datetime-local" class="form-control @error('arrival_time') is-invalid @enderror" name="arrival_time" value="{{ old('arrival_time') }}" required autocomplete="arrival_time" autofocus>

                                @error('arrival_time')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="ticket_number" class="col-md-4 col-form-label text-md-right">{{ __('Ticket Number') }}</label>

                            <div class="col-md-6">
                                <input id="ticket_number" type="text" class="form-control @error('ticket_number') is-invalid @enderror" name="ticket_number" value="{{ old('ticket_number') }}" required autocomplete="ticket_number" autofocus>

                                @error('ticket_number')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="transportation" class="col-md-4 col-form-label text-md-right">{{ __('Transportation') }}</label>

                            <div class="col-md-6">
                                <select id="transportation" type="text" class="form-control @error('transportation') is-invalid @enderror" name="transportation" value="{{ old('transportation') }}" autocomplete="transportation">
                                    <option value="train">Train</option>
                                    <option value="bus">Bus</option>
                                </select>

                                @error('transportation')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Add Detail') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
