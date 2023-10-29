@extends('layouts.main')
@section('content')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Add Groups</a></li>
                    <li class="breadcrumb-item active">Groups</li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>

<section class="content">

    <div class="row">
        <!-- left column -->
        <div class="col-md-12">
            @include('flash-message')
        </div>
        <div class="col-md-4">
            <div class="card card-primary">
                <div class="card-header bg-info">
                    <h3 class="card-title">Add New Group</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form action="{{route('groups.store')}}" method="POST">
                    @csrf
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-10">
                                <div class="form-group {{$errors->has('name') ? 'has-error' : '' }}">
                                    <label for="exampleFormControlFile1" class="required">Group Name:</label>
                                    <input type="text" name="name" class="form-control" value="{{ old('name') }}">
                                    @if($errors->has('name'))
                                    <span class="help-block text-danger">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                <div class="form-group {{$errors->has('classes') ? 'has-error' : '' }}">
                                    <label for="exampleFormControlFile1" class="required">Group Classes:</label>
                                    <select name="classes[]" id="classes" class="form-control select2"
                                        multiple="multiple">
                                        <option value="">Select Class</option>
                                        @foreach($classes as $class)
                                        <option value="{{$class->id}}">{{$class->name}}</option>
                                        @endforeach
                                    </select>
                                    @if($errors->has('classes'))
                                    <span class="help-block text-danger">
                                        <strong>{{ $errors->first('classes') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                        </div>
                    </div>
                    <!-- /.card-body -->

                    <div class="card-footer">
                        <button class="btn btn-success">SAVE</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="col-md-8">
            <div class="card">
                <div class="card-header bg-primary">
                    <h3 class="card-title">All Groups</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Sl</th>
                                <th>Name</th>
                                <th>Group Classes</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>

                            @php
                            $i = 0;
                            @endphp
                            @foreach ($groups as $group)
                            <tr>
                                <td>{{++$i}}</td>
                                <td>{{$group->name}}</td>
                                <td class="text-center">
                                    @forelse ( $group->classes as $class )
                                    <span class="badge badge-info"> {{ $class->name }}</span>
                                    @empty

                                    @endforelse
                                </td>
                                <td class="d-flex">
                                    <a class="btn btn-primary btn-sm" href={{route('groups.edit',$group->id)}}><i
                                            class="fa fa-edit"></i></a>&nbsp;
                                    <form action="{{url('admin/groups/'.$group->id)}}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger ml-auto btn-sm"
                                            onclick="return confirm('Are You Sure?')"><i
                                                class="fa fa-trash"></i></button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
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

@endsection
