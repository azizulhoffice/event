@extends('front.master')
@section('title','Participant Registration')
@section('content')
<section class="content">
    <br>
    <div class="container-fluid">
        <div class="row d-flex justify-content-center"">
            <div class=" col-md-8">
            @include('flash-message')
            <div>
                @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="list-unstyled">
                        @foreach ($errors->all() as $message)
                        <li>{{ $message }}</li>
                        @endforeach
                    </ul>
                </div>

                @endif
            </div>
            <!-- /.card -->
            <form action="{{ route('participant.store') }}" method="POST">
                @csrf
                <div class="card">
                    <div class="card-header d-flex justify-content-center bg-light">
                        <h3 class="card-title text-bold">Apply As A Student</h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6 form-group">
                                <input type="text" name="name_en" id="name_en" required class="form-control"
                                    placeholder="Name*">
                            </div>
                            <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6 form-group">
                                <select class="custom-select form-control-border" name="group" id="">
                                    <option>Select Event 1</option>
                                    <option>Select Event 2</option>
                                    <option>Select Event 3</option>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6 form-group">
                                <input type="text" name="name_bn" id="name_bn" class="form-control"
                                    placeholder="বাংলা নাম*" required>
                            </div>
                            <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6 form-group">
                                <select class="custom-select form-control-border" name="group" id="">
                                    <option>Select Event 2</option>
                                    <option>Select Event 1</option>
                                    <option>Select Event 3</option>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6 form-group">
                                <input type="text" name="inst_name" id="inst_name" class="form-control"
                                    placeholder="Institution Name*" required>
                            </div>
                            <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6 form-group">
                                <select class="custom-select form-control-border" name="" id="">
                                    <option>Select Event 3</option>
                                    <option>Select Event 1</option>
                                    <option>Select Event 2</option>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6 form-group">
                                <input type="text" name="inst_address" id="inst_address" class="form-control"
                                    placeholder="Institution Address">
                            </div>
                            <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6 form-group">
                                <select class="custom-select form-control-border" name="event_id" id="event_id">
                                    <option> Select Hifz Event</option>
                                    <option value=1>Value 2</option>
                                    <option value=2>Value 3</option>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6 form-group">
                                <select class="custom-select form-control-border" name="group_id" id="group_id">
                                    <option value="">Select Group</option>
                                    <option value=1 >Junior</option>
                                    <option value=2 >Senior</option>
                                </select>
                            </div>
                            <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6 form-group">
                                <select class="custom-select form-control-border" name="group" id="">
                                    <option> Select Essay Event</option>
                                    <option>Value 2</option>
                                    <option>Value 3</option>
                                </select>
                            </div>
                        </div>
                        <div class="row d-flex">
                            <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6 form-group">
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
                            <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6 form-group">
                                <label for="">Document Upload <span class="text-sm text-muted">Support:jpg,jpeg,png,gif
                                        file format</span></label>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="participant_photo"
                                        name="participant_photo">
                                    <label class="custom-file-label" for="participant_photo">Participant Photo</label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6 form-group">
                                <input type="text" class="datetimepicker form-control" name="dob" id="dob"
                                    placeholder="Date of Birth*" required>
                            </div>
                            <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6 form-group">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" name="bcirtificate_photo"
                                        id="bcirtificate_photo">
                                    <label class="custom-file-label" for="bcirtificate_photo">Birth Cirtipicate
                                        Photo</label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6 form-group">
                                <input type="text" name="phone" id="phone" class="form-control" placeholder="Phone*"
                                    required>
                            </div>
                            <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6 form-group">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="auth_photo" name="auth_photo">
                                    <label class="custom-file-label" for="auth_photo">Institution Authorized
                                        Copy</label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6 form-group">
                                <input type="text" name="email" id="email" class="form-control" placeholder="Email">
                            </div>
                            <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6 form-group">

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
    // $('.select2').select2()

    // //Initialize Select2 Elements
    // $('.select2bs4').select2({
    //   theme: 'bootstrap4'
    // })
    //flatpickr date
    $(".datetimepicker").flatpickr({
    maxDate: "today",
    // maxDate: new Date().fp_incr(14), // 14 days from now
    dateFormat: "Y-m-d",
    });
//    $(document).ready(function(){
    $('#group_id').on('change',function(){
        var group_id = $(this).val();
        if(group_id){
            $.ajax({
                type:"GET",
                url:"{{url('get-event-list')}}?group_id="+group_id,
                success:function(res){
                    if(res){
                        console.log(res);return;
                        $("#class").empty();
                        $("#class").append('<option>Select Class</option>');
                        $.each(res,function(key,value){
                            $("#class").append('<option value="'+key+'">'+value+'</option>');
                        });
                    }else{
                        $("#class").empty();
                    }
                },
                error : function(error){
                    console.log(error.responseJSON);
                }
            });
        }else{
            $("#class").empty();
        }
    // });
});


</script>
@endsection
