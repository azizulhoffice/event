@extends('layouts.main')
@section('content')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Add Committee Member</a></li>
                    <li class="breadcrumb-item active">Committee</li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>

<section class="content">

    <div class="row">
        <!-- left column -->
        <div class="col-md-12">
            <div class="card card-primary">
                <div class="card-header bg-info">
                    <h3 class="card-title">Add New Participants</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form action="{{route('participants.store')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="card card-secondary">
                                    <div class="card-header">
                                        <h5 class="card-title">Event</h5>
                                    </div>
                                    <div class="card-body">
                                        <div class="form-row">
                                            <div class="form-group col-md-12">
                                                <label for="event_id" class="required">Select Events</label>
                                                <select required name="event_id" id="event_id"
                                                    class="form-control select2">
                                                    @foreach($events as $event)
                                                    <option value="{{$event->id}}">
                                                        {{$event->name}}
                                                    </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="excel_file" class="required">Participants Excel File</label>
                                                <input type="file" required class="form-control" name="excel_file">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- /.card -->
                            </div>

                        </div>
                    </div>
                    <!-- /.card-body -->

                    <div class="card-footer">
                        <button class="btn btn-success">SAVE</button>
                        <a href="{{route('participants.index')}}" class="btn btn-primary">Back</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection
@section('js')
<script>
</script>
@endsection
