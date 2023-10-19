@extends('front.master')
@section('title','Participant Registration')
@section('content')
<section class="content">
    <br>
    <div class="container-fluid">
        <div class="row d-flex justify-content-center"">
            <div class=" col-md-8">
            <!-- /.card -->
            <form action="{{ route('participant.store') }}" method="POST">
                @csrf
                <div class="card">
                    <div class="card-header d-flex justify-content-center bg-light">
                        <h3 class="card-title text-bold">Apply As A Student</h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-6">
                                <input type="text" name="name_en" id="name_en" class="form-control" placeholder="Name*">
                            </div>
                            <div class="col-6">
                                <select class="custom-select form-control-border" name="group" id="">
                                    <option>Select Event 1</option>
                                    <option>Select Event 2</option>
                                    <option>Select Event 3</option>
                                </select>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-6">
                                <input type="text" name="name_bn" id="name_bn" class="form-control"
                                    placeholder="বাংলা নাম*">
                            </div>
                            <div class="col-6">
                                <select class="custom-select form-control-border" name="group" id="">
                                    <option>Select Event 2</option>
                                    <option>Select Event 1</option>
                                    <option>Select Event 3</option>
                                </select>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-6">
                                <input type="text" name="inst_name" id="inst_name" class="form-control"
                                    placeholder="Institution Name*">
                            </div>
                            <div class="col-6">
                                <select class="custom-select form-control-border" name="group" id="">
                                    <option>Select Event 3</option>
                                    <option>Select Event 1</option>
                                    <option>Select Event 2</option>
                                </select>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-6">
                                <input type="text" name="inst_address" id="inst_address" class="form-control"
                                    placeholder="Institution Address">
                            </div>
                            <div class="col-6">
                                <select class="custom-select form-control-border" name="" id="">
                                    <option> Select Hifz Event</option>
                                    <option>Value 2</option>
                                    <option>Value 3</option>
                                </select>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-6">
                                <select class="custom-select form-control-border" name="group" id="">
                                    <option>Select Group</option>
                                    <option>Value 1</option>
                                    <option>Value 2</option>
                                    <option>Value 3</option>
                                </select>
                            </div>
                            <div class="col-6">
                                <select class="custom-select form-control-border" name="group" id="">
                                    <option> Select Hifz Event</option>
                                    <option>Value 2</option>
                                    <option>Value 3</option>
                                </select>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-6">
                                <select class="custom-select form-control-border" name="class" id="class">
                                    <option>Select Class</option>
                                    <option>Class 1</option>
                                    <option>Class 2</option>
                                    <option>Class 3</option>
                                    <option>Class 4</option>
                                    <option>Class 5</option>
                                    <option>Class 6</option>
                                    <option>Class 7</option>
                                    <option>Class 8</option>
                                    <option>Class 9</option>
                                    <option>Class 10</option>
                                    <option>Class 11</option>
                                    <option>Class 12</option>
                                </select>
                            </div>
                            <div class="col-6">
                                <label for="">Document Upload</label>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="participant_photo"
                                        name="participant_photo">
                                    <label class="custom-file-label" for="participant_photo">Participant Photo</label>
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-6">
                                <input type="text" class="datetimepicker form-control" name="dob" id="dob"
                                    placeholder="Date of Birth*">
                            </div>
                            <div class="col-6">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" name="bcirtificate_photo"
                                        id="bcirtificate_photo">
                                    <label class="custom-file-label" for="bcirtificate_photo">Birth Cirtipicate
                                        Paper</label>
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-6">
                                <input type="text" name="phone" id="phone" class="form-control" placeholder="Phone*">
                            </div>
                            <div class="col-6">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="auth_photo" name="auth_photo">
                                    <label class="custom-file-label" for="auth_photo">Institution Authorized
                                        Paper</label>
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-6">
                                <input type="text" name="email" id="email" class="form-control" placeholder="Email">
                            </div>
                            <div class="col-6">

                            </div>
                        </div>
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer d-flex justify-content-center">
                        <button type="submit" class="btn btn-info">Submit</button>
                        {{-- <button type="submit" class="btn btn-default float-right">Cancel</button> --}}
                    </div>
                </div>
            </form>
            <!-- /.card -->
        </div>
    </div>
    <!-- /.row -->
    </div><!-- /.container-fluid -->
</section>
<!-- /.login-box -->
@endsection
@section('js')
<script>
    //Initialize Select2 Elements
    $('.select2').select2()

    //Initialize Select2 Elements
    $('.select2bs4').select2({
      theme: 'bootstrap4'
    })
    //flatpickr date
    $(".datetimepicker").flatpickr({
    maxDate: "today",
    // maxDate: new Date().fp_incr(14), // 14 days from now
    dateFormat: "Y-m-d",
    });
</script>
@endsection
