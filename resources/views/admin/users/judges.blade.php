@extends('layouts.main')
@section('content')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>All Judges</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">All Judges</li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>
<section class="content">
    <div class="row">
        <div class="col-md-12">
            @include('flash-message')
            <div class="card">
                <!-- /.card-header -->
                <div class="card-body">
                    <table id="" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Sl</th>
                                <th>Name</th>
                                <th>UserName</th>
                                <th>Pass</th>
                                <th>Role</th>
                                <th>Email <br>
                                <small>phone</small>
                                </th>
                            </tr>
                        </thead>
                        <tbody>

                            @php
                            $i = 0;
                            @endphp
                            @forelse ( $users as $user )
                            <tr>
                                <td>{{++$i}}</td>
                                <td>{{$user->name ?? '-'}}</td>
                                <td>{{ $user->username??'' }}</td>
                                <td></td>
                                <td>{{$user->role??'-'}}</td>
                                <td>{{$user->email?? '-'}} <br>
                               <small>{{$user->phone_number ?? '-'}}</small>
                            </tr>
                            @empty
                            <tr class="">
                                <td colspan="5" class="text-center">No Data Available</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <!-- /.card-body -->
            </div>
        </div>
    </div>

</section>
@stop
@section('js')
<script type="text/javascript">
        $("#del_btn").on("click",function(){
            var id=$(this).data("submit");
            $("#form_"+id).submit();
        });
        $('#myModal').on('show.bs.modal', function(e) {
            var id = e.relatedTarget.dataset.id;
            $("#del_btn").attr("data-submit",id);
        });
</script>
@stop
