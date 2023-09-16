@extends('layouts.main')
@section('style')
<style>
    .pagination {
        font-size: 10px !important;
    }
</style>
@endsection
@section('content')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>All Participants</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">All Participants</li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                @include('flash-message')

                <div class="card">
                    <div class="card-header bg-primary">
                        <h3 class="card-title">All Participants</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Sl NO</th>
                                    <th>Name</th>
                                    <th>Event</th>
                                    <th>Class</th>
                                    <th>Inst Name</th>
                                    <th>Inst Address</th>
                                    <th>Phone</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                $i = 0;
                                @endphp
                                @forelse ( $participants as $participant)
                                <tr>
                                    <td>{{ $startNumber++ }}</td>
                                    <td>{{ $participant->serial_no }}</td>
                                    <td>{{ $participant->name_bn??$participant->name_en }}</td>
                                    <td>{{ $participant->event->name }}</td>
                                    <td>{{ $participant->class }}</td>
                                    <td>{{ $participant->inst_name }}</td>
                                    <td> {{ $participant->inst_address }}</td>
                                    <td>{{ $participant->phone }}</td>
                                    <td class="d-flex">
                                        <a class="btn btn-primary" href="{{ route('participants.edit', $participant->id) }}">Edit</a>&nbsp;
                                        <form action="{{ url('admin/participants/' . $participant->id) }}" method="POST" enctype="multipart/form-data">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger ml-auto" onclick="return confirm('Are you sure?')">DELETE</button>
                                        </form>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="8" class="text-center">No Data Available</td>
                                </tr>
                                @endforelse
                            </tbody>

                        </table>
                        <ul class="pagination pagination-month justify-content-center">
                            <li class="page-item">
                                <p class="text-center">Showing {{ $participants->firstItem() }} to {{
                                $participants->lastItem()
                                }} of {{ $participants->total() }} entries</p>
                                {{$participants->links('pagination::bootstrap-4')}}

                            </li>
                        </ul>
                    </div>
                    <!-- /.card-body -->
                </div>
            </div>
        </div>
    </div>

</section>
@stop
@section('js')
<script type="text/javascript">
    $('#example1').DataTable({
        "paging": false,
        "info": false,
    });
    $("#del_btn").on("click", function() {
        var id = $(this).data("submit");
        $("#form_" + id).submit();
    });
    $('#myModal').on('show.bs.modal', function(e) {
        var id = e.relatedTarget.dataset.id;
        $("#del_btn").attr("data-submit", id);
    });
</script>
@stop