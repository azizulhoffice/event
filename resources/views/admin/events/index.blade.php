@extends('layouts.main')
@section('styles')
<style>
    .event-btn {
        /* font-size: 10px; */
        font-weight: bold;
        /* width: 80px;
        height: 40px; */
        text-align: center;
        color: white;
    }

    .result-btn {
        font-size: 11px;
        font-weight: bold;
        /* width: 80px;
        height: 40px; */
        text-align: center;
        color: white;
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
                                <th scope="col">Group <br> Type</th>
                                <th scope="col">Judges</th>
                                <th scope="col">Action</th>
                                <th scope="col">Result</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($events as $k => $event)
                            <tr>
                                <th scope="row">{{ $k + 1 }}</th>
                                <td>{{ $event->name }} @if($event->event_dateTime != null) <br> <small
                                        class="text-muted">{{ $event->event_dateTime->format('d/m/Y h:i A') }}</small>
                                    @endif</td>
                                <td>
                                    @if ($event->group)
                                    <span class="badge badge-success">{{ $event->group->name }}</span>
                                    @endif
                                    <br>
                                    @if ($event->category)
                                    <span class="badge badge-primary">{{ $event->category->name }}</span>
                                    @endif
                                </td>
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
                                            <button class="btn event-btn btn-warning" title="Event Hide From Judge"><i
                                                    class="fa fa-eye-slash"></i></button>
                                            @else
                                            <button class="btn event-btn btn-success" title="Event Show in Judge"><i
                                                    class="fa fa-eye"></i></button>
                                            @endif
                                        </form>&nbsp;
                                        <a href="{{ route('events.edit',$event->id) }}"
                                            class="btn event-btn btn-primary" title="Update Event"><i
                                                class="fa fa-edit"></i></a>&nbsp;
                                        @if (Auth::user()->role == "admin")
                                        <form action="{{ route('events.destroy',$event->id) }}" method="POST"
                                            onsubmit="return confirm('Are you sure you want to delete this event?');">
                                            @method('DELETE')
                                            @csrf
                                            <button class="btn event-btn btn-danger" title="Delete Event"><i
                                                    class="fa fa-trash"></i></button>
                                        </form> &nbsp;
                                        @endif
                                        {{-- --}}
                                        <a href="{{ route('events.marksheet',$event->id) }}" title="Blank Marksheet"
                                            class="btn event-btn btn-success"><i class="fa fa-print"></i></a>&nbsp;
                                        <a href="{{ route('events.participant',$event->id) }}"
                                            class="btn event-btn btn-primary" title="Participants List"><i
                                                class="fa fa-list"></i></a>

                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex">
                                        @if ($event->result_published)
                                        @if (Auth::user()->role == "admin")
                                        <a href="{{ route('events.result-unpublish',$event->id) }}"
                                            class="btn result-btn btn-danger"
                                            title="Result Unpublish For Score Update">Unpublish</a>&nbsp;
                                        @endif
                                        <a href="{{ route('events.result',$event->id) }}"
                                            class="btn result-btn btn-primary" title="Total Marks With Ranking">Final
                                            Result</a> &nbsp;
                                        <a href="{{ route('events.judge.marksheet',$event) }}"
                                            class="btn result-btn btn-info" title="Judge,Total Marks,Rank">Final
                                            Marksheet</a> &nbsp;
                                        @else
                                        {{-- @if (Auth::user()->role == "admin") --}}
                                        <a href="{{ route('events.result-publish',$event->id) }}"
                                            class="btn result-btn btn-success" title="Result Publish">Publish</a>&nbsp;
                                        {{-- @endif --}}
                                        @endif
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
                            {{$events->links('pagination::bootstrap-4')}}
                        </li>
                    </ul>
                </div>
                <!-- /.card-body -->
            </div>
        </div>
    </div>

</section>
@endSection
@section('js')
<script>
</script>
@endsection
