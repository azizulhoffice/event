@extends('layouts.main')
@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Dashboard</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Dashboard</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-info">
                    <div class="inner">
                        <h3>{{ \App\Models\User::count()??'' }}</h3>

                        <p>Users</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-person"></i>
                    </div>
                    <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-success">
                    <div class="inner">
                        <h3>{{ \App\Models\User::where('role','judge')->count()??'' }}</h3>

                        <p>Judge</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-gavel"></i>
                    </div>
                    <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-warning">
                    <div class="inner">
                        <h3>{{ \App\Models\Participant::count()??'' }}</h3>

                        <p>Participants</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-users"></i>
                    </div>
                    <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-danger">
                    <div class="inner">
                        <h3>{{ \App\Models\Event::count()??'' }}</h3>

                        <p>Event</p>
                    </div>
                    <div class="icon">
                        <i class="far fa-calendar"></i>
                    </div>
                    <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->

            <!-- ./col -->
            <div class="col-lg-3 col-6">
                <!-- Bootstrap Switch -->

                @php
                use App\Models\Setting;
                $registration = Setting::where('key', 'registration')->first();
                $active = "";
                $color = "card-danger";
                if($registration->value == "open"){
                $active = "checked";
                $color = "card-success";

                }
                @endphp
                <style>
                    .alert {
                    font-size: 14px !important; /* Adjust the font size to your preference */
                    }
                </style>
                <div class="card {{ $color }}">
                    <div class="card-header">
                        <h3 class="card-title">Online Registration <small>({{ $registration->value }})</small> </h3>
                    </div>
                    <div class="card-body">
                        <div class="col d-flex justify-content-center">
                            <form method="POST" action="{{ route('regstatus.update') }}">
                                @csrf
                                @method('PUT')
                                <input type="checkbox" data-toggle="toggle" data-on="Open" data-off="Closed"
                                    data-onstyle="success" name="status" data-offstyle="danger" {{ $active }}
                                    onchange="this.form.submit()">
                                </form>
                        </div>
                       @include('flash-message')
                    </div>
                </div>
            </div>

        </div><!-- /.container-fluid -->
</section>
<!-- /.content -->
@stop
