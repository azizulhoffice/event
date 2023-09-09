@extends('layouts.main')
@section('content')
    
    <div class="p-3">
        <h2>Event List</h2>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">SL</th>
                    <th scope="col">Name</th>
                    <th scope="col">Description</th>
                    <th scope="col">Judges</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($events as $k => $event)
                <tr>
                    <th scope="row">{{ $k + 1 }}</th>
                    <td>{{ $event->name }}</td>
                    <td>{{ $event->description }}</td>
                    <td>
                        @foreach($event->users as $judge)
                            <span class="badge badge-info">{{ ucfirst($judge->username) }}</span>
                        @endforeach
                    </td>
                    <td>
                        <!-- Add action buttons here, e.g., edit and delete -->
                        <a href="{{ route('events.edit',$event->id) }}" class="btn btn-primary">Edit</a>
                        <a href="#" class="btn btn-danger">Delete</a>
                    </td>
                </tr>
                @endforeach
                <!-- Add more rows as needed -->
            </tbody>
        </table>
    </div>
@endSection