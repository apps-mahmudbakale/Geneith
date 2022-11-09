@extends('layouts.app')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Monthly Report</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('app.dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active">Monthly Report</li>
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
                        <h3 class="card-title">Monthly Report</h3>
                    </div>
                    <!-- /.card-header -->
                    <form action="{{route('app.monthly.report.download')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <!-- form start -->
                        <div class="card-body row">
                            <div class="col-lg-4 form-group">
                                <label>Station</label>
                               <select name="station" id="" class="form-control">
                                @foreach($stations as $station)
                                    <option value="{{$station->id}}">{{$station->name}}</option>
                                @endforeach
                               </select>
                            </div>
                            <div class="col-lg-4 form-group">
                                <label>From Date</label>
                                <input type="date" name="from" class="form-control">
                            </div>
                            <div class="col-lg-4 form-group">
                                <label>To Date</label>
                                <input type="date" name="to" class="form-control">
                            </div>
                        </div>
                        <!-- /.card-body -->

                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Download Report</button>
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
