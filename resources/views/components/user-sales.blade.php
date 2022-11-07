<div>
    <section class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Sales</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <div id="users_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
                        <div class="row">
                            <div class="col-sm-12 col-md-6">
                                <div class="dataTables_length" id="users_length"><label>Show <select
                                            wire:model="perPage" aria-controls="users"
                                            class="custom-select custom-select-sm form-control form-control-sm">
                                            <option value="10">10</option>
                                            <option value="25">25</option>
                                            <option value="50">50</option>
                                            <option value="100">100</option>
                                        </select> entries</label></div>
                            </div>
                            <div class="col-sm-12 col-md-6">
                                <div id="users_filter" class="dataTables_filter"><label>Search:<input type="search"
                                            class="form-control form-control-sm" wire:model.debounce.300ms='search'
                                            placeholder="" aria-controls="users"></label></div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <table id="users" class="table table-bordered table-striped dataTable no-footer"
                                    role="grid" aria-describedby="users_info">
                                    <thead>
                                        <tr>
                                            <th>S/N</th>
                                            <th>Invoice</th>
                                            <th>Product Name</th>
                                            <th>Qty Sold</th>
                                            <th>Amount</th>
                                            <th>Qty Remaining</th>
                                            <th>Sold Date</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($sales as $sale)
                                            <tr>
                                            <td>{{$loop->iteration}}</td>
                                            <td>{{$sale->invoice}}</td>
                                            <td>{{$sale->product}}</td>
                                            <td>{{$sale->qty}}</td>
                                            <td>&#8358; {{number_format($sale->amount)}}</td>
                                            <td>{{$sale->remaining}}</td>
                                            <td>{{\Carbon\Carbon::parse($sale->created_at)->diffForHumans()}}</td>
                                        </tr>
                                            @endforeach
                                            <tr>
                                                <td><strong style="font-size: 16px; color: #222222;">Total: </strong></td>
                                                <td><strong style="font-size: 16px; color: #222222;">{!! app(App\Settings\StoreSettings::class)->currency !!}  <span
                                                            id="total">{{number_format((int)$sold)}}</span></strong>
                                                </td>
                                                <td><strong style="font-size: 16px; color: #222222;"><span id="text">
                                                            <?php $words = new NumberFormatter('En', NumberFormatter::SPELLOUT); ?>
                                                            {{ strtoupper($words->format((float)$sold)) . ' NAIRA ONLY' }}
                                                        </span>
                                                    </strong>
                                                </td>
                                            </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12 col-md-5">
                                <div class="dataTables_info" id="users_info" role="status" aria-live="polite">Showing <b>{{ $sales->firstItem() }}</b> to
                                    <b>{{ $sales->lastItem() }}</b> out of <b>{{ $sales->total() }}</b> entries</div>
                            </div>
                            <div class="col-sm-12 col-md-7">
                                <div class="dataTables_paginate paging_simple_numbers" id="users_paginate">
                                    {{ $sales->links() }}
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
