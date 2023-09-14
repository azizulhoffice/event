@extends('layouts.main')

@section('content')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Events</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Events</li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                @include('flash-message')
                <div class="card">
                    <div class="card-header bg-primary">
                        <h3 class="card-title">All Events</h3>
                    </div>
                    <div class="card-body">

                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th scope="col">SL</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Description</th>
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
                                        <!-- Add action buttons here, e.g., edit and delete -->
                                        <a href="{{ route('judge.event.score',$event->id) }}" class="btn btn-primary"><i class="fa fa-eye"> View</i></a>

                                    </td>
                                </tr>
                                @endforeach
                                <!-- Add more rows as needed -->
                            </tbody>
                        </table>
                        <ul class="pagination pagination-month justify-content-center">
                            <li class="page-item">
                                <p class="text-center">Showing {{ $events->firstItem() }} to {{ $events->lastItem() }} of {{ $events->total() }} entries</p>
                                {{$events->links()}}
                            </li>
                        </ul>
                    </div>
                </div>

            </div>

        </div>

    </div>
</section>
@endsection
@section('js')

@endsection
