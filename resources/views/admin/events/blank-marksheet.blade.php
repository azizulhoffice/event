@extends('layouts.main')
@section('title', str_replace(' ', '_', $event->name).'_Blank_Marksheet')
@section('styles')
<style>
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

        td {
            font-size: 18px !important;
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
                <h1>Event Blank Marksheet</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Event Blank Sheet</li>
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
                    <table id="" class="table table-bordered text-center">
                        <thead>
                            <tr class="header">
                                <th colspan="4">
                                    <div class="d-flex justify-content-center">
                                        <img src="{{ asset('images/ittehad_logo.jpeg')}}" height="90px" width="90px"
                                            alt="">
                                        <h1 style="font-size: 24px;font-weight:bold;">বায়তুশ শরফ আনজুমনে ইত্তেহাদ
                                            বাংলাদেশ কর্তৃক <br>
                                            পবিত্র মিলাদুন্নবী (সা.) উদযাপন উপলক্ষে তামাদ্দুনিক প্রতিযোগিতা ২০২৩
                                            <br><br>
                                            মার্কশীট</h1>
                                    </div> <br>
                                    <div class="row">
                                        <h2 class="col-6 card-title text-left"
                                            style="font-size: 16px;font-weight:bold;">বিষয়:
                                            {{ $event->name
                                            }}</h2>
                                        <h2 class="col-6 card-title text-right"
                                            style="font-size: 16px;font-weight:bold;">তারিখ:
                                            {{ $event->event_dateTime==null?"":$event->event_dateTime->format('d/m/Y H:i
                                            A')
                                            }}</h2>
                                    </div>
                                </th>
                            </tr>
                            <tr class="p-heading">
                                <th>ক্রমিক নং</th>
                                <th>প্রতিযোগীর নাম</th>
                                {{-- <th>শিক্ষা প্রতিষ্ঠানের নাম <br>ও ঠিকানা</th> --}}
                                <th>প্রাপ্ত নম্বর</th>
                                <th>মন্তব্য</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                            $i = 0;
                            @endphp
                            @forelse ( $participants as $participant)
                            <tr>
                                <td>{{ $participant->serial_no}}</td>
                                <td>{{ $participant->name_bn??$participant->name_en }}</td>
                                {{-- <td>{{ $participant->inst_name }} <br>
                                    {{ $participant->inst_address }}
                                </td> --}}
                                <td></td>
                                <td></td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" class="text-center">No Data Available</td>
                            </tr>
                            @endforelse

                        </tbody>
                    </table>
                    <br>
                    <div class="text-right">
                        <p>বিচারকের স্বাক্ষর________________</p>
                        <p>তারিখ:________________</p>
                    </div>
                    <div class="text-left timestamp" style="font-size: 14px;">Printed on <small id="timestamp"
                            style="font-size: 14px;"></small>. Powered by Marsa Technologies.
                    </div>
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
