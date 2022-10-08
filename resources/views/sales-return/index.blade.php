@extends('layouts.app')

@section('content')
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">Return Sale</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{route('app.dashboard')}}">Dashboard</a></li>
            <li class="breadcrumb-item active">Sales</li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Items</h3>
                @role('user')
                <a href="{{route('app.returns.create')}}" class="btn btn-success float-right"><i class="fa fa-plus-circle"></i></a>
                @endrole
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              @role('admin')
              <table class="table table-bordered">
                <thead>
                  <th>S/N</th>
                  <th>Invoice</th>
                  <th>Status</th>
                  <th></th>
                </thead>
                <tbody> 
                  @foreach ($requests as $request)
                    <tr>
                      <td>{{$loop->iteration}}</td>
                      <td>{{$request->invoice}}</td>
                      <td>
                        @if($request->status == true)
                        <label class="badge badge-success">approved</label>
                        @else
                        <label class="badge badge-secondary">pending</label>
                        @endif
                      </td>
                      <td><a href="{{route('app.returns.show', $request->invoice)}}" class="btn btn-sm btn-success"><i class="fa fa-eye"></i></a></td>
                    </tr>                          
                  @endforeach
                </tbody>
              </table>
              @else
                  <table class="table table-bordered">
                    <thead>
                      <th>S/N</th>
                      <th>Invoice</th>
                      <th>Status</th>
                    </thead>
                    <tbody> 
                      @foreach ($requests as $request)
                        <tr>
                          <td>{{$loop->iteration}}</td>
                          <td>{{$request->invoice}}</td>
                          <td>
                            @if($request->status == true)
                            <label class="badge badge-success">approved</label>
                            @else
                            <label class="badge badge-secondary">pending</label>
                            @endif
                          </td>
                          <td><a href="{{route('app.returns.show', $request->invoice)}}" class="btn btn-sm btn-success"><i class="fa fa-eye"></i></a></td>
                        </tr>                          
                      @endforeach
                    </tbody>
                  </table>
                  @endrole
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div><!-- /.container-fluid -->
</section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->
@endsection
