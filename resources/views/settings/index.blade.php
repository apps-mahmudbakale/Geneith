@extends('layouts.app')

@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Store Settings</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{route('app.dashboard')}}">Dashboard</a></li>
              <li class="breadcrumb-item active">Settings</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <!-- Custom Tabs -->
            <div class="card">
              <div class="card-header d-flex p-0">
                <h3 class="card-title p-3">Store Settings</h3>
                <ul class="nav nav-pills ml-auto p-2">
                  <li class="nav-item"><a class="nav-link active" href="#general_settings" data-toggle="tab">General Settings</a></li>
                  <li class="nav-item"><a class="nav-link" href="#tab_2" data-toggle="tab">Currency</a></li>
                  <li class="nav-item"><a class="nav-link" href="/backup">Backup</a></li>
                </ul>
              </div><!-- /.card-header -->
              <div class="card-body">
                <div class="tab-content">
                  <div class="tab-pane active" id="general_settings">
                   <form action="{{route('app.update.store.settings')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        Store Name
                        <input type="text" name="store_name" value="{{$settings->store_name}}" class="form-control">
                    </div>
                    <div class="form-group">
                        Store Logo
                        <input type="file" name="store_logo" value="" class="form-control">
                    </div>
                    <div class="form-group">
                        Store Name
                       <textarea class="form-control" rows="10" name="store_address">{{$settings->store_address}}</textarea>
                    </div>
                    <div class="form-group">
                        <br>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                   </form>
                  </div>
                  <!-- /.tab-pane -->
                  <div class="tab-pane" id="tab_2">
                     <form action="{{route('app.update.store.currency')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        Store Default Currency
                       <select name="store_currency" id="" class="form-control">
                        <option selected value="{{$settings->currency}}">{!! $settings->currency !!}</option>
                          @foreach ($currencies as $currency)
                              <option value="{{$currency}}">{!! $currency !!}</option>
                          @endforeach
                       </select>
                    </div>
                    <div class="form-group">
                        <br>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                   </form>
                  </div>
                  <!-- /.tab-pane -->
                  <div class="tab-pane" id="tab_3">
                    Lorem Ipsum is simply dummy text of the printing and typesetting industry.
                    Lorem Ipsum has been the industry's standard dummy text ever since the 1500s,
                    when an unknown printer took a galley of type and scrambled it to make a type specimen book.
                    It has survived not only five centuries, but also the leap into electronic typesetting,
                    remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset
                    sheets containing Lorem Ipsum passages, and more recently with desktop publishing software
                    like Aldus PageMaker including versions of Lorem Ipsum.
                  </div>
                  <!-- /.tab-pane -->
                </div>
                <!-- /.tab-content -->
              </div><!-- /.card-body -->
            </div>
            <!-- ./card -->
          </div>
          <!-- /.col -->
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
@endsection
