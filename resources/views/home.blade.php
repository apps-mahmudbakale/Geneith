@extends('layouts.app')

@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Dashboard</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Dashboard</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
          @role('admin')
          <div class="col-lg-4 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <h3>{{$users}}</h3>

                <p>Users</p>
              </div>
              <div class="icon">
                <i class="fa fa-users"></i>
              </div>
              <a href="{{route('app.users.index')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-4 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h3>{{$products}}</h3>

                <p>Products</p>
              </div>
              <div class="icon">
                <i class="fa fa-cubes"></i>
              </div>
              <a href="{{route('app.products.index')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-4 col-6">
            <!-- small box -->
            <div class="small-box bg-primary">
              <div class="inner">
                <h3>{!! app(App\Settings\StoreSettings::class)->currency !!}  {{number_format($products_cash)}}</h3>

                <p>Total Products in Cash</p>
              </div>
              <div class="icon">
                <i class="fa fa-money-bill"></i>
              </div>
              <a href="{{route('app.products.index')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
           <!-- ./col -->
           <div class="col-lg-4 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">
                <h3>{{$sales}}</h3>

                <p>Total Sales</p>
              </div>
              <div class="icon">
                <i class="fa fa-shopping-cart"></i>
              </div>
              <a href="{{route('app.sales.index')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <div class="col-lg-4 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
              <div class="inner">
                <h3>{!! app(App\Settings\StoreSettings::class)->currency !!}  {{number_format($sales_cash)}}</h3>

                <p>Total Sale in Cash</p>
              </div>
              <div class="icon">
                <i class="fa fa-money-bill"></i>
              </div>
              <a href="{{route('app.sales.index')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <div class="col-lg-4 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h3>{!! app(App\Settings\StoreSettings::class)->currency !!}  {{number_format($profit)}}</h3>

                <p>Total Profit in Cash</p>
              </div>
              <div class="icon">
                <i class="fa fa-money-bill"></i>
              </div>
              <a href="{{route('app.sales.index')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          @endrole
          <!-- ./col -->
          <div class="col-lg-12">
            <div class="card">
              <div class="card-header">
                <h6>Notifications</h6>
              </div>
              <div class="card-body">
               
              </div>
            </div>
          </div>
          <!-- ./col -->
        </div>
        <!-- /.row -->
        
        <!-- /.row (main row) -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
@endsection
