@extends('layouts.app')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Requests</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('app.dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('app.requests.index') }}">Requests</a></li>
                            <li class="breadcrumb-item active">Show Request</li>
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
                        <h3 class="card-title">Show Request</h3>
                    </div>
                    <!-- /.card-header -->
                    @role('store|admin')
                    <!-- form start -->
                    <form action="{{ route('app.requests.approve', $ref) }}" method="POST">
                        @csrf
                        <!-- form start -->
                        <div class="card-body row">
                            <table width="100%" border="0" id="tblRequest">
                                @foreach ($request as $item)
                                <tr>
                                    <td width="45%">
                                        <label>Item</label>
                                        <input type="text" name="items[]" readonly value="{{$item->name}}" class="form-control">
                                    </td>
                                    <td>
                                        <label>Requested Quantity</label>
                                        <input type="number" name="request_qty[]" readonly value="{{$item->request_qty}}" class="form-control" />
                                    </td>
                                    <td>
                                        <label>Approved Quantity</label>
                                        <input type="number" name="approved_qty[]" value="{{$item->approved_qty}}" class="form-control" />
                                    </td>
                                </tr>
                                @endforeach
                            </table>
                        </div>
                        <!-- /.card-body -->

                        <div class="card-footer">
                            @if ($status == 'pending')
                            <button type="submit" class="btn btn-success">Approve Request</button>
                            @endif
                        </div>
                    </form>
                        @if($status == 'approved')
                         <a href="{{route('app.requests.exports.one', $ref)}}" style="color:#fff;" class="btn btn-success">Export Request</a>
                        @endif
                        @else
                        <div class="card-body">
                        <table class="table">
                            <thead>
                                <th>S/N</th>
                                <th>Item</th>
                                <th>Requested Qty</th>
                                <th>Approved Qty</th>
                                <th>Status</th>
                            </thead>
                            <tbody>
                                @foreach ($request as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->name }}</td>
                                        <td>{{ $item->request_qty }}</td>
                                        <td>{{ $item->approved_qty }}</td>
                                        <td><label class="badge {{$item->status == 'pending' ? 'badge-secondary' : 'badge-success'}}">{{$item->status}}</label></td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        @endrole
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer">
                        @role('user')
                        @if ($status == 'approved')
                        <a href="{{route('app.requests.acknowledge', $ref)}}" class="btn btn-success text-white">Acknowledge</a>
                        @endif
                        @endrole
                    </div>
                </div>
                <!-- /.card -->
                <!-- /.row (main row) -->
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection
