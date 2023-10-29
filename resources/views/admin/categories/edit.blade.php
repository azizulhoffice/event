@extends('layouts.main')
@section('content')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Manage Category</a></li>
                    <li class="breadcrumb-item active">Category</li>
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
                    <h3 class="card-title">Edit Category</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form action="{{route('categories.update',$category->id)}}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-10">
                                <div class="form-group {{$errors->has('name') ? 'has-error' : '' }}">
                                    <label for="exampleFormControlFile1" class="required"> Category Name:</label>
                                    <input type="text" name="name" class="form-control" value="{{ $category->name }}">
                                    @if($errors->has('name'))
                                    <span class="help-block text-danger">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                <div class="form-group {{$errors->has('is_optional') ? 'has-error' : '' }}">
                                    <label for="exampleFormControlFile1" class="required">Category Type:</label>
                                    <select name="is_optional" id="is_optional" class="form-control">
                                        <option value="">Select</option>
                                        <option value="Optional" {{ $category->is_optional=="Optional"?"selected":"" }}>Optional</option>
                                        <option value="Not Optional" {{ $category->is_optional=="Not Optional"?"selected":"" }}>Not Optional</option>
                                    </select>
                                    @if($errors->has('classes'))
                                    <span class="help-block text-danger">
                                        <strong>{{ $errors->first('is_optional') }}</strong>
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
                    <h3 class="card-title">All Category</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Sl</th>
                                <th>Name</th>
                                <th>Type</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>

                            @php
                            $i = 0;
                            @endphp
                            @foreach ($categories as $category)
                            <tr>
                                <td>{{++$i}}</td>
                                <td>{{$category->name}}</td>
                                <td class="text-center">
                                    <td class="text-center">
                                        <span class="badge badge-info"> {{ $category->is_optional }}</span>
                                    </td>
                                </td>
                               <td class="d-flex">
                                    <a class="btn btn-primary btn-sm" href={{route('categories.edit',$category->id)}}><i
                                            class="fa fa-edit"></i></a>&nbsp;
                                    <form action="{{url('admin/categories/'.$category->id)}}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger ml-auto btn-sm" onclick="return confirm('Are You Sure?')"><i
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
