@extends('layouts.main')
@section('content')
<div class="p-3">
    <h2>Edit {{ $event->name }}</h2>
    <form method="POST" action="{{ route('events.update',$event->id) }}">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="eventName">Event Name:</label>
            <input type="text" class="form-control" value="{{ $event->name }}" id="name" name="name" placeholder="Enter event name" required>
            @error('name')
            <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
        <div class="form-group">
            <label for="eventDescription">Event Description:</label>
            <textarea class="form-control" id="description" value="{{ $event->description }}" name="description" rows="4" placeholder="Enter event description"></textarea>
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

@section('js')
<script>
    var currentJudges = "{{ implode(',',$event->users->pluck('id')->toArray() ?? []) }}".split(',');
    $(document).ready(function() {
        $('#judges').val(currentJudges);
        $('#judges').trigger("change");
    });
</script>
@endsection