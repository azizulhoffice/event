@extends('layouts.main')
@section('content')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>All Users</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">All Users</li>
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
                <div class="card-header bg-primary d-flex justify-content-end">
                   <a href="{{route('users.create')}}" class="btn btn-success"> <i class="fa fa-plus"> Add User</i></a>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Sl</th>
                                <th>User</th>
                                <th>Role</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Action</th>
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
                                <td>{{$user->role??'-'}}</td>
                                <td>{{$user->email?? '-'}}</td>
                                <td>{{$user->phone_number ?? '-'}}</td>
                                <td class="d-flex">
                                    <a class="btn btn-primary" href={{route('users.edit',$user->id)}}>Edit</a>&nbsp;
                                    <form action="{{url('admin/users/'.$user->id)}}" method="POST"
                                        enctype="multipart/form-data">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger ml-auto"
                                            onclick="return confirm('Are you sure?')">DELETE</button>
                                    </form>


                                </td>
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
