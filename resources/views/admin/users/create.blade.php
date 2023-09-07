@extends('layouts.main')
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Add User</a></li>
                        <li class="breadcrumb-item active">Users</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <section class="content">

        <div class="row">
            <div class="col-md-12">
                @include('flash-message')
            </div>
            <!-- left column -->
            <div class="col-md-12">
                <div class="card card-primary">
                    <div class="card-header bg-info">
                        <h3 class="card-title">Create New User</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form action="{{route('users.store')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-6 col-12 offset-lg-3">

                                    <div class="col-12">
                                    <div class="form-group">
                                        <label>Name:</label>
                                        <input type="text" name="name" class="form-control filter-input" placeholder="First Name">
                                        @error('name')
                                        <p class="text-danger">{{$message}}</p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <label>User Name:</label>
                                        <input type="text" name="username" class="form-control filter-input" placeholder="User Name">
                                        @error('username')
                                        <p class="text-danger">{{$message}}</p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <label>Email:</label>
                                        <input type="email" name="email" class="form-control filter-input" placeholder="Email">
                                        @error('email')
                                        <p class="text-danger">{{$message}}</p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <label>Role:</label>
                                        <select name="role" class="form-control" required>
                                                <option value="admin">admin</option>
                                                <option value="judge">judge</option>
                                                <option value="event-manager">event-manager</option>
                                                <option value="user">user</option>
                                        </select>
                                        @error('role')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <label>Password:</label>
                                        <input type="password" name="password" class="form-control filter-input" placeholder="Password">
                                        @error('password')
                                        <p class="text-danger">{{$message}}</p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <label>Confirm Password:</label>
                                        <input type="password" name="password_confirmation" class="form-control filter-input" placeholder="Confirm Password">
                                        @error('password_confirmation')
                                        <p class="text-danger">{{$message}}</p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-4 offset-4 justify-content-center">
                                    <button class="btn btn-success">SAVE</button>
                                </div>
                            </div>
                        </div>
                        </div>
                        <!-- /.card-body -->

                        {{-- <div class="card-footer">

                            <a href="{{route('users.index')}}" class="btn btn-primary">Back</a>
                        </div> --}}
                    </form>
                </div>
            </div>

        </div>
    </section>
@stop
@section('js')

@endsection
