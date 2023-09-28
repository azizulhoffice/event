@extends('layouts.main')
@section('styles')
<style>
    .btn {
        font-size: 15px;
        font-weight: bold;
    }

    .card-title {
        font-size: 20px;
        font-weight: bold;
    }

    .header th {
        /* border-color: white !important; */
        border-style: solid !important;
        border-top-color: #fff !important;
        border-left-color: #fff !important;
        border-right-color: #fff !important;
        padding-bottom: 30px !important;
    }

    @media print {

        .p-heading th {
            font-size: 22px !important;
        }

        td {
            font-size: 22px !important;
        }

        @page {
            size: legal;
        }
    }
</style>

@endsection
@section('content')
<section class="content-header">
    <div class="container-fluid">
        {{-- <div class="row mb-2">
            <div class="col-sm-6">
                <h1</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">All Events</li>
                </ol>
            </div>
        </div> --}}
    </div><!-- /.container-fluid -->
</section>
<section class="content">
    <div class="row">
        <div class="col-md-12">
            @include('flash-message')

            <div class="card">
                <div class="card-header bg-primary">
                    {{-- <h3 class="card-title">All Events</h3> --}}
                </div>
                <!-- /.card-header -->
                <div class="card-body">

                    <table class="table table-bordered table-striped text-center">
                        <thead>
                            <tr class="header">
                                <th colspan="7">
                                    <div class="d-flex justify-content-center">
                                        <img src="{{ asset('images/ittehad_logo.jpeg')}}" height="90px" width="90px"
                                            alt="">
                                        <h1 style="font-size: 24px;font-weight:bold;">বায়তুশ শরফ আনজুমনে ইত্তেহাদ
                                            বাংলাদেশ কর্তৃক <br>
                                            পবিত্র মিলাদুন্নবী (সা.) উদযাপন উপলক্ষে তামাদ্দুনিক প্রতিযোগিতা ২০২৩
                                            <br><br>
                                           প্রতিযোগির সংখ্যা</h1>
                                    </div> <br>
                                    <div class="row">
                                        <h2 class="col-6 card-title text-left" style="font-size: 22px;font-weight:bold;">
                                            <br>
                                        </h2>
                                        <h2 class="col-6 card-title text-right" style="font-size: 20px;font-weight:bold;"> সর্বমোট প্রতিযোগি:
                                            {{$totalparticpant
                                            }}</h2>
                                    </div>
                                </th>
                            </tr>
                            <tr class="p-heading">
                                <th style="border: 2px solid black !important;">SL</th>
                                <th style="border: 2px solid black !important;">Event Name</th>
                                <th style="border: 2px solid black !important;">Description</th>
                                <th style="border: 2px solid black !important;">Total Participants</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($events as $k => $event)
                            <tr>
                                <td scope="row" style="border: 2px solid black !important;">{{ $k + 1 }}</td>
                                <td style="border: 2px solid black !important;">{{ $event->name }} @if($event->event_dateTime != null) <br> <small class="text-muted">{{ $event->event_dateTime->format('d/m/Y h:i A') }}</small> @endif</td>
                                <td style="border: 2px solid black !important;">{{ $event->description }}</td>
                                <td style="border: 2px solid black !important;">
                                    {{$event->participants_count}}
                                </td>
                            </tr>
                            @endforeach
                            <!-- Add more rows as needed -->
                        </tbody>
                    </table>
                </div>
                <!-- /.card-body -->
            </div>
        </div>
    </div>

</section>
@endSection
@section('js')
<script>
</script>
@endsection
