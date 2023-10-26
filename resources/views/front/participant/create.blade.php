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
            <form action="{{ route('participant.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="card">
                    <div class="card-header d-flex justify-content-center bg-light">
                        <h3 class="card-title text-bold">Apply As A Student</h3>
                    </div>
                    @if ($status == null)
                    <div class="card-body">
                        <div class="row">
                            <input type="hidden" name="event" >
                            <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6 form-group">
                                <input type="text" name="name_en" id="name_en" value="{{ old('name_en') }}" required class="form-control"
                                    placeholder="Name*">
                            </div>
                            <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6 form-group">
                                <input type="text" name="name_bn" id="name_bn" value="{{ old('name_bn') }}" class="form-control"
                                    placeholder="বাংলা নাম*" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6 form-group">
                                <input type="text" name="inst_name" id="inst_name" value="{{ old('inst_name') }}" class="form-control"
                                    placeholder="Institution Name*" required>
                            </div>
                            <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6 form-group">
                                <input type="text" name="inst_address" id="inst_address" value="{{ old('inst_address') }}" class="form-control"
                                    placeholder="Institution Address">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6 form-group">
                                <input type="text" name="phone" id="phone" value="{{ old('phone') }}" class="form-control" placeholder="Phone*"
                                    required>
                            </div>
                            <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6 form-group">
                                <input type="text" name="email" id="email" value="{{ old('email') }}" class="form-control" placeholder="Email">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6 form-group">
                                <input type="text" class="datetimepicker form-control" name="dob" id="dob" value="{{ old('dob') }}"
                                    placeholder="Date of Birth*" required>
                            </div>
                            <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6 form-group">
                                <label for="">Document Upload <span class="text-sm text-muted">Support:jpg,jpeg,png,gif
                                        file format</span></label>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" name="bcirtificate_photo"
                                        id="bcirtificate_photo" onchange="dobPhoto(this)">
                                    <label class="custom-file-label" for="bcirtificate_photo">Birth Cirtipicate
                                        Photo</label>
                                </div>
                            </div>

                        </div>
                        <div class="row">
                            <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6 form-group">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="participant_photo"
                                        name="participant_photo" onchange="participantPhoto(this)">
                                    <label class="custom-file-label" for="participant_photo">Participant Photo</label>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6 form-group">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="auth_photo" name="auth_photo"
                                        onchange="authPhoto(this)">
                                    <label class="custom-file-label" for="auth_photo">Institution Authorized
                                        Copy</label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6 form-group">
                                <select class="custom-select form-control-border" name="group_id" id="group_id">
                                    <option value="">Select Group</option>
                                    @forelse ($groups as $group )
                                    <option value={{ $group->id }}>{{ $group->name }}</option>
                                    @empty
                                    @endforelse
                                </select>
                            </div>
                            <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6 form-group">
                                <select class="custom-select form-control-border" name="class" id="class">
                                    <option value="">Select Class</option>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6 form-group" id="non_optional_category">
                                @foreach ($non_optional_categories as $non_optional_category ) <select
                                    class="custom-select form-control-border form-group" name="event_non_optional[]">
                                    <option value=""> Select {{$non_optional_category->name }}</option>
                                </select>
                                @endforeach
                            </div>
                            <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6 form-group">
                                <label for="">Optional Event</label>
                                @foreach ($optional_categories as $optional_category ) <select
                                    class="custom-select form-control-border form-group" name="event_optional[]">
                                    <option value="">Select {{ $optional_category->name }}</option>
                                    @forelse ($optional_category->unpublishedEvents as $event1 )
                                    <option value={{ $event1->id }} >{{ $event1->name }}</option>
                                    @empty
                                    @endforelse
                                </select>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer d-flex justify-content-center">
                        <button type="submit" class="btn btn-info">Submit</button>
                        {{-- <button type="submit" class="btn btn-default float-right">Cancel</button> --}}
                    </div>
                    @else
                    <div class="card-body">
                        <div class="row justify-content-center">
                            <div class="col-lg-6 col-xl-6 col-md-12 col-sm-12">
                                <div class="alert alert-danger">{{ $status }}</div>
                            </div>

                        </div>
                    </div>
                    @endif

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
                        $("#event_id").empty();
                        $("#class").empty();
                        $("#event_id").append('<option>Select Event</option>');
                        $("#class").append('<option>Select Class</option>');
                        $.each(res.data.classes,function(key,class1){
                        $("#class").append('<option value="'+class1.name+'">'+class1.name+'</option>');
                        });
                        $.each(res.data.events,function(key,event){
                            $("#event_id").append('<option value="'+event.id+'">'+event.name+'</option>');
                        });

                        let catgory_events ='';
                        $.each(res.data.non_optional_categories,function(key,category){
                            catgory_events += `<select
                                class="custom-select form-control-border form-group" name="event_non_optional[]" id="">
                                <option value=""> Select ${category.name}</option>`;
                                $.each(category.unpublished_events,function(key,event){
                                catgory_events += `<option value=${event.id}>${event.name}</option>`;
                                });
                                catgory_events +=`</select>`;
                                });
                        $('#non_optional_category').empty();
                        $("#non_optional_category").html(catgory_events);

                    }else{
                        $("#class").empty();
                        $("#event_id").empty();
                    }
                },
                error : function(error){
                    console.log(error.responseJSON);
                }
            });
        }else{
            $("#class").empty();
            $("#event_id").empty();
        }
    // });
});

function participantPhoto(input) {
const fileName = input.files[0].name;
const label = input.nextElementSibling; // Get the label element next to the input
label.innerHTML = fileName;
}
function dobPhoto(input) {
const fileName = input.files[0].name;
const label = input.nextElementSibling; // Get the label element next to the input
label.innerHTML = fileName;
}
function authPhoto(input) {
const fileName = input.files[0].name;
const label = input.nextElementSibling; // Get the label element next to the input
label.innerHTML = fileName;
}
</script>
@endsection
