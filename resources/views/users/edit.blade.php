@extends('layouts.app')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Users</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('app.dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('app.users.index') }}">Users</a></li>
                            <li class="breadcrumb-item active">Update User</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <!-- New User form elements -->
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Update User</h3>
                    </div>
                    <!-- /.card-header -->
                    <form action="{{route('app.users.update', $user->id)}}" method="POST">
                        @csrf
                        @method('PUT')
                        <!-- form start -->
                        <div class="card-body">
                            <div class="form-group">
                                <label>Name</label>
                                <input type="text" name="name" value="{{old('name', isset($user) ? $user->name : '')}}" class="form-control" placeholder="Name" id="fullname">
                            </div>
                            <div class="form-group">
                                <label>Email</label>
                                <input type="text" name="email" value="{{old('email', isset($user) ? $user->email : '')}}" class="form-control" placeholder="Email">
                            </div>
                            <div class="form-group">
                                <label>Phone Number</label>
                                <input type="text" name="phone" value="{{old('phone', isset($user) ? $user->phone : '')}}" class="form-control" placeholder="Phone Number">
                            </div>
                            <div class="form-group">
                                <label>Station</label>
                                <select name="station_id" class="form-control">
                                    <option selected value="{{optional($user->station)->id }}">{{optional($user->station)->name}}</option>
                                    @foreach ($stations as $station)
                                        <option value='{{ $station->id }}'>{{ $station->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Role</label>
                                <select name="role_id" class="form-control">
                                    <option selected value="{{$user->roles->first()->id}}">{{$user->roles->first()->name}}</option>
                                    @foreach ($roles as $role)
                                        <option value='{{ $role->id }}'>{{ $role->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <!-- /.card-body -->

                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
                <!-- /.card -->
                <!-- /.row (main row) -->
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection
