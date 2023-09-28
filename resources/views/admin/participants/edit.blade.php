@extends('layouts.main')
@section('content')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Edit Participant Info</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Edit Participant Info</li>
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
                    <h3 class="card-title">Update {{ $participant->name_bn }}</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <form method="POST" action="{{ route('participants.update',$participant->id) }}">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-6 form-group">
                                <label for="name_en">Serial:</label>
                                <input type="text" name="serial_no" class="form-control" value="{{ $participant->serial_no }}">

                            </div>
                            <div class="col-6 form-group">
                                <label for="name_en">Event:</label>
                                <input type="text" class="form-control" value="{{ $participant->event->name }}" disabled>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6 form-group">
                                <label for="name_en">Name (English):</label>
                                <input type="text" class="form-control" value="{{ $participant->name_en }}" id="name_en" name="name_en" placeholder="Participant Name">
                                @error('name_en')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-6 form-group">
                                <label for="name_bn">Name (Bangla):</label>
                                <input type="text" class="form-control" value="{{ $participant->name_bn }}" id="name_bn" name="name_bn" placeholder="Participant Name">
                                @error('name_bn')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6 form-group">
                                <label for="email">Email:</label>
                                <input type="text" class="form-control" value="{{ $participant->email }}" id="email" name="email" placeholder="Email">
                                @error('email')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-6 form-group">
                                <label for="phone">Phone:</label>
                                <input type="text" class="form-control" value="{{ $participant->phone }}" id="phone" name="phone" placeholder="Participant's phone">
                                @error('phone')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6 form-group">
                                <label for="class">Class:</label>
                                <input type="text" class="form-control" value="{{ $participant->class }}" id="class" name="class" placeholder="class" required>
                                @error('class')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-6 form-group">
                                <label for="dob">Date Of Birth:</label>
                                <input type="text" class="form-control" value="{{ $participant->dob }}" id="dob" name="dob" placeholder="Participant's DOB">
                                @error('dob')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inst_name">Institute Name:</label>
                            <input type="text" class="form-control" value="{{ $participant->inst_name }}" id="inst_name" name="inst_name" placeholder="Institue Name" required>
                            @error('inst_name')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="inst_address">Institute Address:</label>
                            <input type="text" class="form-control" value="{{ $participant->inst_address }}" id="inst_address" name="inst_address" placeholder="Institue Address" required>
                            @error('inst_address')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>


                        <button type="submit" class="btn btn-primary">Update</button>
                    </form>
                </div>
                <!-- /.card-body -->
            </div>
        </div>
    </div>
</section>
@endsection