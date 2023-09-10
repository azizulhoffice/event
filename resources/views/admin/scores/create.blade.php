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
                                <p class="">Marked Particpants</p>
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
                                    <tbody>
                                        @foreach (\App\Models\Participant::where('event_id',2)->get() as $participant)
                                        <tr>

                                            <td>{{ $participant->serial_no }}</td>
                                            <td>{{ $participant->name_bn??$participant->name_en }}</td>
                                            <td>
                                                <button class="btn btn-sm btn-danger">A</button>
                                            </td>
                                            <td>
                                                <input type="text" name="score-{{ $participant->id}}"
                                                    class="form-control">
                                            </td>
                                            <td>
                                                <button class="btn btn-sm btn-success">
                                                    SAVE
                                                </button>
                                            </td>

                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="tab-pane" id="absent">
                                <p class="">Absent Particpants</p>
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

@endsection
