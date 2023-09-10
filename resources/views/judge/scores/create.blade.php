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
</style>

@endsection
@section('content')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Add Score</h1>
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
                                    <tbody>
                                        <tr id="marked_1">
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

                                        </tr>
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
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr id="absent_1">
                                            <td>5</td>
                                            <td>Some Name</td>
                                            <td></td>
                                            <td>
                                                <button id="remark" data-participantID="" class="btn btn-sm btn-success">
                                                    Mark Present
                                                </button>
                                            </td>

                                        </tr>
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
    $(document).ready(function() {
        var eventId = "{{ $event->id }}";
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
                                    <td><input type="text" name="score-${participant.id}" class="form-control"></td>
                                    <td><button class="btn btn-sm btn-success">SAVE</button></td>
                                </tr>`;
                        }
                        $("#unmarked_tbody").html(unmarkedHtml);
                    }
                },
                error: function(error) {
                    console.error("Error:", error);
                }
            });
        }

        $(document).on("click", "#absentBtn", function() {
            var participantId = $(this).attr("data-participantID");

            var data = {
                "event_id": eventId,
                "participant_id": participantId,
                "absent": true,
            };
            $.ajax({
                type: "POST",
                url: "{{ route('judge.participant.absent') }}", // Replace with your API endpoint URL
                data: data,
                success: function(response) {
                    $("#unmark_" + participantId).remove();
                },
                error: function(error) {
                    console.error("Error:", error);
                }
            });
        });
    });
</script>
@endsection