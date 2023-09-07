@extends('layouts.main')
@section('content')
<div class="p-3">
        <h2>Create Event</h2>
        <form method="POST" action="{{ url('/admin/events/store') }}">
            @csrf
            <div class="form-group">
                <label for="eventName">Event Name:</label>
                <input type="text" class="form-control" id="name" name="name" placeholder="Enter event name" required>
            </div>
            <div class="form-group">
                <label for="eventDescription">Event Description:</label>
                <textarea class="form-control" id="description" name="description" rows="4" placeholder="Enter event description"></textarea>
            </div>
            <div class="form-group">
                <label for="eventParticipants">Event Judges:</label>
                <select class="form-control select2" id="judges" name="judges[]" multiple="multiple">
                    @foreach($users as $user)
                        <option value="{{ $user->id }}">{{ $user->username }}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
@endsection