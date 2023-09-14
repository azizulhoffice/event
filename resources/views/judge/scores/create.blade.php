@extends('layouts.main')
@section('styles')
<style>
    .score-tab {
        width: 33.33% !important;
        text-align: center;
        font-weight: bold;
        color: white !important;
        text-transform: uppercase;
    }

    .absent.active {
        background-color: red !important;
    }

    .unmarked.active {
        background-color: yellow !important;
        color: black !important;
    }

    .marked.active {
        background-color: green !important;
    }

    .updatescore {
        width: 70px;
        background-color: green !important;
        color: white;
        font-weight: bold;
        /* text-align: center; */
    }
    input[type=number]::-webkit-inner-spin-button,
    input[type=number]::-webkit-outer-spin-button {
    -webkit-appearance: none;
    margin: 0;
    }
</style>

@endsection
@section('content')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>{{ $event->name }}</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Add Score</li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header p-2">
                        <ul class="nav nav-pills">
                            <li class="nav-item score-tab">
                                <a class="nav-link unmarked active" href="#unmarked" data-toggle="tab">UnMarked</a>
                            </li>
                            <li class="nav-item score-tab">
                                <a class="nav-link marked" href="#marked" data-toggle="tab">Marked</a>
                            </li>
                            <li class="nav-item score-tab">
                                <a class="nav-link absent" href="#absent" data-toggle="tab">Absent</a>
                            </li>
                        </ul>
                    </div>
                    <div class="card-body">
                        <div class="tab-content">
                            <div class="tab-pane" id="marked">
                                <table class="table table-bordered table-stripped text-center">
                                    <thead>
                                        <tr>
                                            <th>SN</th>
                                            <th>Name</th>
                                            <th>Score</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody id="marked_tbody">
                                        {{-- <tr id="marked_1">
                                            <td>5</td>
                                            <td>Some Name</td>
                                            <td>
                                                9
                                            </td>
                                            <td>
                                                <button id="remark" data-participantID="" class="btn btn-sm btn-warning">
                                                    Delete Current Score
                                                </button>
                                            </td>

                                        </tr> --}}
                                    </tbody>
                                </table>
                            </div>
                            <div class="active tab-pane" id="unmarked">
                                <table class="table table-bordered table-stripped text-center">
                                    <thead>
                                        <tr>
                                            <th>SN</th>
                                            <th>Name</th>
                                            <th>Absent</th>
                                            <th>Score</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody id="unmarked_tbody">

                                    </tbody>
                                </table>
                            </div>
                            <div class="tab-pane" id="absent">
                                <table class="table table-bordered table-stripped text-center">
                                    <thead>
                                        <tr>
                                            <th>SN</th>
                                            <th>Name</th>
                                            <th>Absent</th>
                                            <th>Score</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody id="absent_tbody">
                                        {{-- <tr id="absent_1">
                                            <td>5</td>
                                            <td>Some Name</td>
                                            <td></td>
                                            <td>
                                                <button id="remark" data-participantID="" class="btn btn-sm btn-success">
                                                    Mark Present
                                                </button>
                                            </td>

                                        </tr> --}}
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
@section('js')
<script>

    function removeLeadingZero(input) {
    // Get the input value
    let value = input.value;

    // Check if the input starts with '0.' and remove the leading '0'
    if (value.startsWith('0.') && value.length > 2) {
    input.value = value.substring(1); // Remove the leading '0'
    }
    }
    $(document).ready(function() {
        var eventId = "{{ $event->id }}";
        var userId = '{{ auth()->user()->id }}';
        getData();

        function getData() {
            $.ajax({
                type: "GET",
                url: "{{ route('judge.event.score-data',$event->id) }}", // Replace with your API endpoint URL
                success: function(response) {
                    let unmarked = response["unmarked"];
                    let marked = response["marked"];
                    let absent = response["absent"];
                    if (unmarked.length > 0) {
                        var unmarkedHtml = "";
                        for (var i = 0; i < unmarked.length; i++) {
                            var participant = unmarked[i];
                            unmarkedHtml += `
                                <tr id="unmark_${participant.id}">
                                    <td>${participant.serial_no}</td>
                                    <td>${participant.name_bn ?? participant.name_en}</td>
                                    <td><button class="btn btn-sm btn-danger" id="absentBtn" data-participantID="${participant.id}">A</button></td>
                                    <td><input type="number" oninput="removeLeadingZero(this)" name="score-${participant.id}" class="form-control"></td>
                                    <td><button class="btn btn-sm btn-success save" data-participantID="${participant.id}">SAVE</button></td>
                                </tr>`;
                        }
                        $("#unmarked_tbody").html(unmarkedHtml);
                    }
                    if (marked.length > 0) {
                    var markedHtml = "";
                    for (var i = 0; i < marked.length; i++) {
                        var participant= marked[i];
                        markedHtml +=`
                            <tr id="marked_${participant.score.id}">
                                <td>${participant.serial_no}</td>
                                <td>${participant.name_bn ?? participant.name_en}</td>
                                <td class="jsutify-content-center">
                                    <input type="number" oninput="removeLeadingZero(this)" required name="updatescore-${participant.score.id}" disabled class="updatescore btn" value="${participant.score.score??'0.00'}">
                                </td>
                                <td>
                                    <button id="remark" data-scoreID="${participant.score.id}" disabled name="update-${participant.score.id}" class="btn btn-sm btn-warning update">
                                        Update
                                    </button>
                                    <button data-scoreID="${participant.score.id}" class="editBtn btn btn-sm btn-danger">
                                        Edit
                                    </button>
                                </td>

                            </tr>`;
                        }
                        $("#marked_tbody").html(markedHtml);
                    }
                    if (absent.length > 0) {
                    var absentHtml = "";
                    for (var i = 0; i < absent.length; i++) {
                        var participant=absent[i];
                        absentHtml +=`
                        <tr id="absent_${participant.score.id}">
                        <td>${participant.serial_no}</td>
                        <td>${participant.name_bn ?? participant.name_en}</td>
                        <td>
                            Absent
                        </td>
                        <td><input type="number" oninput="removeLeadingZero(this)" required name="updatescore-${participant.score.id}" disabled class="updatescore btn" value="0.00"></td>
                        <td>
                            <button id="remark" data-scoreID="${participant.score.id}" disabled name="update-${participant.score.id}" class="btn btn-sm btn-warning update">
                                Update
                            </button>
                            <button data-scoreID="${participant.score.id}" class="editBtn btn btn-sm btn-danger">
                                Edit
                            </button>
                        </td>
                        </tr>`;
                        }
                        $("#absent_tbody").html(absentHtml);
                    }

                },
                error: function(error) {
                    console.error("Error:", error);
                }
            });
        }
        // save score as absent for unmarked participant
        $(document).on("click", "#absentBtn", function() {
            var participantId = $(this).attr("data-participantID");
            var csrfToken = $('meta[name="csrf-token"]').attr('content');
            var data = {
                "event_id": eventId,
                "user_id": userId,
                "participant_id": participantId,
                "absent": 1,
            };
            $.ajax({
                type: "POST",
                url: "{{ route('judge.participant.absent') }}", // Replace with your API endpoint URL
                headers: {
                    'X-CSRF-TOKEN': csrfToken, // Include the CSRF token in the headers
                },
                data: data,
                success: function(response) {
                    $("#unmark_" + participantId).remove();
                    getData();
                },
                error: function(error) {
                    console.error("Error:", error);
                }
            });
        });

        // save score for unmarked participant
        $('table').on("click", ".save", function() {
            var participantId = $(this).attr("data-participantID");
            var score = $("input[name='score-" + participantId + "']").val();
            var csrfToken = $('meta[name="csrf-token"]').attr('content');
            var data = {
                "event_id": eventId,
                "user_id": userId,
                "participant_id": participantId,
                "score": score,
            };
            $.ajax({
                type: "POST",
                url: "{{ route('judge.scores.store') }}", // Replace with your API endpoint URL
                headers: {
                    'X-CSRF-TOKEN': csrfToken, // Include the CSRF token in the headers
                },
                data: data,
                success: function(response) {
                    $("#unmark_" + participantId).remove();
                    getData();
                },
                error: function(error) {
                    console.error("Error:", error);
                }
            });
        });
        //update score enable
        $('table').on("click", ".editBtn", function() {
            var scoreId = $(this).attr("data-scoreID");
            $("input[name='updatescore-" + scoreId + "']").prop('disabled', false);
            $("button[name='update-" + scoreId + "']").prop('disabled', false);
        });


        // Update score for marked participant
        $('table').on("click", ".update", function() {
            var scoreId = $(this).attr("data-scoreID");
            var score = $("input[name='updatescore-" + scoreId + "']").val();
            var csrfToken = $('meta[name="csrf-token"]').attr('content');
            var data = {
                "event_id": eventId,
                "user_id": userId,
                "score": score,
            };
            let url = `{{url('judge/scores/${scoreId}')}}`;
            $.ajax({
                type: "PUT",
                url: url,
                headers: {
                    'X-CSRF-TOKEN': csrfToken, // Include the CSRF token in the headers
                },
                data: data,
                success: function(response) {
                    getData();
                },
                error: function(error) {
                    console.error("Error:", error);
                }
            });
        });

    });
</script>
@endsection
