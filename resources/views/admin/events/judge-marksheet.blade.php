@extends('layouts.main')
@section('title', str_replace(' ', '_', $event->name).'_Judge_Marksheet')
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
        .timestamp {
            position: fixed;
            bottom: 0;
        }

        .timestamp small {
            text-align: center !important;
        }

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
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Event Judge Mark List</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Event Judge Result</li>
                </ol>
            </div>
        </div>
        <div class="row">
            <button class="btn btn-primary" onclick="print1()">Print</button>
        </div>
    </div><!-- /.container-fluid -->
</section>
<section class="content" id="result">
    <div class="row">
        <div class="col-md-12">
            {{-- @include('flash-message') --}}
            <div class="card">
                <!-- /.card-header -->
                <div class="card-body">
                    <table id="" class="table table-bordered table-striped text-center">
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
                                            বিচারক মার্কশীট</h1>
                                    </div> <br>
                                    <div class="row">
                                        <h2 class="col-6 card-title text-left"
                                            style="font-size: 18px;font-weight:bold;">বিষয়:
                                            {{ $event->name
                                            }}</h2>
                                        <h2 class="col-6 card-title text-right"
                                            style="font-size: 18px;font-weight:bold;">তারিখ:
                                            {{ $event->event_dateTime==null?"":$event->event_dateTime->format('d/m/Y h:i
                                            A')
                                            }}</h2>
                                    </div>
                                </th>
                            </tr>
                            <tr class="p-heading" style="border: 2px solid black !important;">
                                <th style="border: 2px solid black !important;">ক্রমিক নং</th>
                                <th style="border: 2px solid black !important;">প্রতিযোগীর নাম</th>
                                @forelse ($judges as $judge )
                                <th style="border: 2px solid black !important;">{{ $judge->user->name }}</th>
                                @empty
                                <th style="border: 2px solid black !important;"></th>
                                @endforelse
                                <th style="border: 2px solid black !important;">প্রাপ্ত নম্বর</th>
                                <th style="border: 2px solid black !important;">স্থান</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                            $i = 0;
                            @endphp
                            @forelse ($participants as $participant)
                            <tr style="border: 2px solid black !important;">
                                <td style="border: 2px solid black !important;">{{ $participant->serial_no }}</td>
                                <td style="border: 2px solid black !important;">{{ $participant->name_bn??$participant->name_bn }}</td>
                                @forelse($judges as $judge)
                                @if ($participant->scores->where('user_id',$judge->user_id)->first())
                                <td style="border: 2px solid black !important;">{{$participant->scores->where('user_id',$judge->user_id)->first()->absent?'A':removeTrailingZeros($participant->scores->where('user_id',$judge->user_id)->first()->score)
                                    ?? "N/A" }}</td>
                                @else
                                <td style="border: 2px solid black !important;"></td>
                                @endif

                                @empty
                                <td style="border: 2px solid black !important;"></td>
                                @endforelse
                                <td style="border: 2px solid black !important;">{{
                                    $participant->scores->first()->absent?'A':removeTrailingZeros($participant->total_earn_score)
                                    }}</td>
                                <td>{{ $participant->scores->first()->absent?'A':$participant->rank }}</td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="8" class="text-center">No Data Available</td>
                            </tr>
                            @endforelse
                        </tbody>

                    </table>

                    <div class="text-left timestamp" style="font-size: 14px;">Printed on <small id="timestamp"
                            style="font-size: 14px;"></small>. Powered by Marsa Technologies.
                    </div>
                    <!-- /.card-body -->
                </div>
            </div>
        </div>

</section>
@endSection
@section('js')
<script>
    $("#timestamp").html(getFormatedTimeStamp());

    function print1() {
       let print_content = document.getElementById('result').innerHTML;
       let original_content = document.body.innerHTML;
       document.body.innerHTML = print_content;
       window.print();
       document.body.innerHTML = original_content;
    }
</script>
@endsection
