@extends('layouts.main')
@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Bulk Score Update</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Score Update</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<!-- Main content -->
<section class="content">
    @include('flash-message')
    @if($event == null)
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header bg-warning">
                    <h3 class="card-title">Select Event</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <form action="{{ route('events.bulk-score') }}" method="GET">
                        <div class="form-group">
                            <label for="eventSelect">Select an Event:</label>
                            <select class="form-control" id="eventSelect" name="event">
                                <option value="">Select an event</option>
                                @foreach ($events as $item)
                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <button class="btn btn-block btn-success">Search</button>
                    </form>
                </div>
                <!-- /.card-body -->
            </div>
        </div>
    </div>
    @endif
    @if($event != null)
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header bg-primary">
                    <h3 class="card-title">{{$event->name}}</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body table-responsive">
                    <form action="{{route('events.bulk-score.update')}}" method="POST">
                        @csrf
                        <input type="hidden" name="event_id" value="{{ $event->id }}">
                        <table class="table table-striped table-bordered text-center">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Absent</th>
                                    @foreach($event->users as $judge)
                                    <th>{{ $judge->name }}</th>
                                    @endforeach
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($event->participants as $p)
                                @php
                                $scores = $event->allScores->where('participant_id',$p->id);
                                $isAbsent = $scores->where('absent', true)->count() > 0 ? true : false;
                                @endphp
                                <tr>
                                    <td>{{ $p->serial_no }}</td>
                                    <td>{{ $p->name_bn ?? $p->name_en }}</td>
                                    <td><input type="checkbox" name="absent[{{ $p->id }}]" @if($isAbsent)
                                            checked="checked" @endif></td>
                                    @foreach($event->users as $judge)
                                    <th><input type="text" class="form-control" name="score[{{$judge->id}}][]"
                                            value="{{ removeTrailingZeros($event->allScores->where('participant_id',$p->id)->where('user_id',$judge->id)->first()->score ?? '')  }}">
                                    </th>
                                    @endforeach
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <button class="btn btn-md btn-success">Update</button>
                    </form>

                </div>
                <!-- /.card-body -->
            </div>
        </div>
    </div>
    @endif
</section>
<!-- /.content -->
@stop
@section('js')
<script>
    @if ($event != null)
       let judges = {{ $event->users->count()}};
       $("input").keypress(function(e) {
       if (e.which == 13) {
       var index = $("input[type='number']").index(this);
       $("input[type='number']").eq(index + judges).focus();
       e.preventDefault();
        }
      });
    @endif
</script>

@endsection
