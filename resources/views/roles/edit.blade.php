@extends('layouts.app')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Roles</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('app.dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('app.roles.index') }}">Roles</a></li>
                            <li class="breadcrumb-item active">Update Role</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <!-- New Role form elements -->
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Update Role</h3>
                    </div>
                    <!-- /.card-header -->
                    <form action="{{ route('app.roles.update', $role->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <!-- form start -->
                        <div class="card-body">
                            <div class="form-group">
                                <label>Name</label>
                                <input type="text" name="name"
                                    value="{{ old('name', isset($role) ? $role->name : '') }}" class="form-control"
                                    placeholder="Name" id="fullname">
                            </div>
                            <div class="form-group">
                                <label>Station</label>
                                <select name="permissions[]" multiple class="form-control">
                                    @foreach ($permissions as $key => $permission)
                                        <option value="{{ $permission->id }}"
                                            {{ in_array($permission->id, old('permissions', [])) || (isset($role) && $role->permissions->contains($permission->id)) ? 'selected' : '' }}>
                                            {{ $permission->name }}
                                        </option>
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
