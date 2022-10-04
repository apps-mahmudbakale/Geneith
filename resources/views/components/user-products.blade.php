<div>
    <section class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Products</h3>
                    <a href="{{ route('app.products.import') }}" class="btn btn-primary float-right"><i
                        class="fa fa-file-import"></i> Import Products</a>                        
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <div id="users_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
                        <div class="row">
                            <div class="col-sm-12 col-md-6">
                                <div class="dataTables_length" id="users_length"><label>Show <select wire:model="perPage"
                                            aria-controls="users"
                                            class="custom-select custom-select-sm form-control form-control-sm">
                                            <option value="10">10</option>
                                            <option value="25">25</option>
                                            <option value="50">50</option>
                                            <option value="100">100</option>
                                        </select> entries</label></div>
                            </div>
                            <div class="col-sm-12 col-md-6">
                                <div id="users_filter" class="dataTables_filter"><label>Search:<input type="search"
                                            class="form-control form-control-sm" wire:model.debounce.300ms='search' placeholder=""
                                            aria-controls="users"></label></div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <table id="users" class="table table-bordered table-striped dataTable no-footer"
                                    role="grid" aria-describedby="users_info">
                                    <thead>
                                        <tr>
                                            <th>S/N</th>
                                            <th>Name</th>
                                            <th>Selling Price</th>
                                            <th>Quantity</th>
                                            <th>Expiry</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                            @foreach($products as $product)
                                            <tr>
                                            <td>{{$loop->iteration}}</td>
                                            <td>{{$product->name}}</td>
                                            <td>{!! app(App\Settings\StoreSettings::class)->currency !!}  {{number_format($product->selling_price)}}</td>
                                            <td>{{$product->quantity}}</td>
                                            <td>{{\Carbon\Carbon::parse($product->expiry_date)->diffForHumans()}}</td>
                                        </tr>
                                            @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12 col-md-5">
                                <div class="dataTables_info" id="users_info" role="status" aria-live="polite">Showing <b>{{ $products->firstItem() }}</b> to
                                    <b>{{ $products->lastItem() }}</b> out of <b>{{ $products->total() }}</b> entries</div>
                            </div>
                            <div class="col-sm-12 col-md-7">
                                <div class="dataTables_paginate paging_simple_numbers" id="users_paginate">
                                    {{ $products->links() }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div><!-- /.container-fluid -->
    </section>
</div>
