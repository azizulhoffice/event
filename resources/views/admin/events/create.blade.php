@extends('layouts.main')
@section('content')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Create Event</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Create Event</li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>
<section class="content">
    <div class="row">
        <div class="col-md-12">
            @include('flash-message')

            <div class="card">
                <div class="card-header bg-primary">
                    <h3 class="card-title">Create Event</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
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
                            <label for="group_id">Event Group:</label>
                            <select class="form-control" name="group_id" id="group_id" required >
                                <option value="">Select Group</option>
                                @foreach(\App\Models\Group::all() as $group)
                                <option value="{{ $group->id }}">{{ $group->name }}</option>
                                @endforeach
                            </select>
                            @error('group_id')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="category_id">Event Category:</label>
                            <select class="form-control" name="category_id" id="category_id" required>
                                <option value="">Select Group</option>
                                @foreach(\App\Models\Category::all() as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}({{ $category->is_optional }})</option>
                                @endforeach
                            </select>
                            @error('category_id')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="event_dateTime">Event Time & Date:</label>
                            <input type="datetime-local" value="{{ old('event_dateTime') }}" class="form-control" id="event_dateTime" name="event_dateTime" placeholder="Enter event Time and Date" required>
                            @error('event_dateTime')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="eventName">Last Position</label>
                            <input type="number" value="{{ old('last_position') }}" title="Price will be given this Position pariticipant" class="form-control" id="last_position" name="last_position"
                                placeholder="Enter a rank number" required>
                            @error('last_position')
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
                                <option value="{{ $user->id }}">{{ $user->username }}({{ $user->name }})</option>
                                @endforeach
                            </select>
                            @error('judges')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
                <!-- /.card-body -->
            </div>
        </div>
    </div>

</section>
@endsection
