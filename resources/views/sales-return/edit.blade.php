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
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <form action="{{route('app.returns.store')}}" method="POST">
                @csrf
                <table class="table table-bordered">
                  <thead>
                    <th></th>
                    <th>Item</th>
                    <th>Price</th>
                    <th>Qty</th>
                    <th>Return Qty</th>
                  </thead>
                  <tbody>
                    
                    @foreach ($items as $item)
                    <input type="hidden" value="{{$item->invoice}}" name="invoice" id="">
                      <tr>
                        <td>
                          <input type="checkbox" value="{{$item->product_id}}" name="items[]" id="">
                        </td>
                        <td>{{$item->product}}</td>
                        <td>{!! app(App\Settings\StoreSettings::class)->currency !!} {{number_format($item->selling_price)}}</td>
                        <td>{{$item->qty}}</td>
                        <td><input type="number" value="{{$item->qty}}"  class="form-control" name="rqty[]" id=""></td>
                      </tr>                   
                    @endforeach
                  </tbody>
                </table>
                <button type="submit" class="btn btn-success">Submit Return Request</button>
              </form>
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
