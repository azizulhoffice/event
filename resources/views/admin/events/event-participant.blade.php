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

    @media print {

        .header th{
            /* border-color: white !important; */
            border-style: solid !important;
            border-top-color: #fff !important;
            border-left-color: #fff !important;
            border-right-color: #fff !important;
            padding-bottom: 30px !important;
        }
        .info-heading {
            position: fixed;
            top: 0;
        }

        .timestamp {
            position: fixed;
            bottom: 0;
        }
        .timestamp small {
            text-align: center !important;
        }

        .card-body {
            page-break-after: always;
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
                <h1>Event Participant List</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Event Participantlist</li>
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
            <div class="card page-break">
                
                <!-- /.card-header -->
                <div class="card-body">
                    <table id="" class="table table-bordered text-center">
                        <thead>
                            <tr class="header">
                                <th colspan="4">
                                    <div class="d-flex justify-content-center">
                                        <img src="{{ asset('images/ittehad_logo.jpeg')}}" height="90px" width="90px" alt="">
                                        <h1 style="font-size: 24px;font-weight:bold;">বায়তুশ শরফ আনজুমনে ইত্তেহাদ বাংলাদেশ কর্তৃক <br>
                                            পবিত্র মিলাদুন্নবী (সা.) উদযাপন উপলক্ষে তামাদ্দুনিক প্রতিযোগিতা ২০২৩ <br>
                                            প্রতিযোগীদের নামের তালিকা</h1>
                                    </div>
                                    <h2 class="card-title text-center" style="font-size: 16px;font-weight:bold;">বিষয়: {{ $event->name
                        }}</h2>
                                </th>
                            </tr>
                            <tr>
                                <th>ক্রমিক নং</th>
                                <th>প্রতিযোগীর নাম</th>
                                <th>শিক্ষা প্রতিষ্ঠানের নাম <br>ও ঠিকানা</th>
                                <th>শ্রেণী</th>
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
                                <td>{{ $participant->inst_name }} <br>
                                    {{ $participant->inst_address }}
                                </td>
                                <td>{{ $participant->class}}</td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="8" class="text-center">No Data Available</td>
                            </tr>
                            @endforelse
                        </tbody>

                    </table>

                    <div class="text-center mt-4 timestamp"><small id="timestamp"></small></div>
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