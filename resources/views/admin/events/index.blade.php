@extends('layouts.main')
@section('styles')
<style>
    .btn {
        font-size: 10px;
        font-weight: bold;
    }
</style>

@endsection
@section('content')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>All Events</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">All Events</li>
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
                    <h3 class="card-title">All Events</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">

                    <table class="table table-bordered table-striped text-center">
                        <thead>
                            <tr>
                                <th scope="col">SL</th>
                                <th scope="col">Name</th>
                                <th scope="col">Description</th>
                                <th scope="col">Judges</th>
                                <th scope="col">Action</th>
                                <th scope="col">Result</th>
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
                                    <div class="d-flex">
                                        <form action="{{ route('events.toggle-visibility',$event->id) }}" method="POST"
                                            @if($event->is_published) onsubmit="return confirm('Are you sure you want to
                                            hide this event?');" @else onsubmit="return confirm('Are you sure you want
                                            to publish this event?');" @endif>
                                            @csrf
                                            @if($event->is_published)
                                            <button class="btn btn-warning">Hide</button>
                                            @else
                                            <button class="btn btn-success">Publish</button>
                                            @endif
                                        </form>&nbsp;
                                        <a href="{{ route('events.edit',$event->id) }}" class="btn btn-primary">Edit</a>&nbsp;
                                        @if (Auth::user()->role == "admin")
                                        <form action="{{ route('events.destroy',$event->id) }}" method="POST"
                                            onsubmit="return confirm('Are you sure you want to delete this event?');">
                                            @method('DELETE')
                                            @csrf
                                            <button class="btn btn-danger">Delete</button>
                                        </form> &nbsp;
                                        @endif
                                        {{--  --}}
                                        <a href="{{ route('events.participant',$event->id) }}" class="btn btn-primary">Participants</a>&nbsp;
                                        <a href="{{ route('events.marksheet',$event->id) }}" class="btn btn-success">Blank Marksheet</a>
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex">
                                        <a href="{{ route('events.result-publish',$event->id) }}" class="btn btn-warning">Publish</a>&nbsp;
                                        <a href="{{ route('events.result',$event->id) }}" class="btn btn-success">Final Marksheet</a> &nbsp;
                                        <a href="{{ route('events.judge.marksheet',$event) }}" class="btn btn-info">J Marksheet</a> &nbsp;
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                            <!-- Add more rows as needed -->
                        </tbody>
                    </table>
                    <ul class="pagination pagination-month justify-content-center">
                        <li class="page-item">
                            <p class="text-center">Showing {{ $events->firstItem() }} to {{
                                $events->lastItem()
                                }} of {{ $events->total() }} entries</p>
                            {{$events->links()}}
                        </li>
                    </ul>
                </div>
                <!-- /.card-body -->
            </div>
        </div>
    </div>

</section>
@endSection
