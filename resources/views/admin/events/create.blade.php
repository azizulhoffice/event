@extends('layouts.main')
@section('content')
<div class="p-3">
    <h2>Create Event</h2>
    <form method="POST" action="{{ route('events.store') }}">
        @csrf
        <div class="form-group">
            <label for="eventName">Event Name:</label>
            <input type="text" value="{{ old('name') }}" class="form-control" id="name" name="name" placeholder="Enter event name" required>
            @error('name')
            <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
        <div class="form-group">
            <label for="eventDescription">Event Description:</label>
            <textarea class="form-control" id="description" name="description" rows="4" placeholder="Enter event description">{{ old('description') }}</textarea>
            @error('description')
            <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
        <div class="form-group">
            <label for="eventParticipants">Event Judges:</label>
            <select class="form-control select2" id="judges" name="judges[]" multiple="multiple">
                @foreach($users as $user)
                <option value="{{ $user->id }}">{{ $user->username }}</option>
                @endforeach
            </select>
            @error('judges')
            <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
@endsection