@extends('layouts.app')

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Sync Activities</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('app.dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active">Sync</li>
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
                                <h3 class="card-title p-3">Sync Activities</h3>
                            </div><!-- /.card-header -->
                            <div class="card-body">
                                <span id="syncNo" class="badge badge-warning">0</span> Activities Awaiting Sync
                                <hr>
                                <p>Note: You can only Synchronize 10 Activities at a time. Please Keep Syncing until you
                                    exceed your beneficiaries count. </p>
                                <hr>
                                <button id="SyncBtn" class="btn btn-primary btn-block"><i class="fa fa-sync"></i> Sync
                                    Now</button>
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
    <script src="{{ asset('js/localbase.dev.js') }}"></script>
    <script src="{{ asset('js/script.js') }}"></script>
    <script>
        let db = new Localbase('uduth_sync');
        const SyncUrl = 'https://www.uduth.geneith-okma.com.ng/';
        // const Url = 'http://localhost:8001/api/';
        const Url = 'http://geneith.test/api/';
        let sync = document.getElementById('SyncBtn');
        window.addEventListener('load', function() {
            // alert('hello');
            db.collection('products_temp').delete();
            fetch(Url + 'getProducts')
                .then((res) => res.json())
                .then((data) => {
                    console.log(data);
                    data.forEach(element => {
                        Loading.show('Initializing Sync...');
                        db.collection('products_temp').add({
                            store_id: element.store_id,
                            name: element.name,
                            buying_price: element.buying_price,
                            selling_price: element.selling_price,
                            qty: element.qty,
                            expiry_date: element.expiry_date,
                        });
                    })

                })

        });
        let syncNo = document.getElementById('syncNo');
        db.collection('products_temp').get().then(snapshot => {
            // console.log(snapshot.length);
            syncNo.innerHTML = snapshot.length;
        });

        sync.addEventListener('click', function() {
            if (navigator.onLine) {
                Loading.show('Getting Ready  for Sync...');
                $.ajax({
                    url: "/api/requests",
                    type: 'GET',
                    dataType: 'json', // added data type
                    success: function(res) {
                        console.log(res);
                        // alert(res);
                        res.forEach(req => {
                            $.ajax({
                                type: "POST",
                                url: SyncUrl +
                                    "api/syncRequest",
                                data: {
                                    station_id: req.station_id,
                                    user_id: req.user_id,
                                    request_qty: req.request_qty,
                                    approved_qty: req.approved_qty,
                                    product_id: req.product_id,
                                    request_ref: req.request_ref,
                                    status: req.status
                                },
                                cache: false,
                                success: function(html) {
                                    console.log(html)
                                }

                            });
                        })
                    }
                });
                db.collection('products_temp').orderBy('name').get().then(products => {
                    if (products.length >= 1) {
                        let index = 0;
                        const partialObjects = products.slice(0, 5);
                        partialObjects.forEach(product => {
                            Loading.show('Syncing Products Data...');
                            console.log(product);
                            fetch(SyncUrl + 'syncStore?' + new URLSearchParams({
                                    store_id: product.store_id,
                                    name: product.name,
                                    buying_price: product.buying_price,
                                    selling_price: product.selling_price,
                                    qty: product.qty,
                                    expiry_date: product.expiry_date,
                                }))
                                .then((res) => res.json())
                                .then((data) => {
                                    console.log(data);
                                    if (data.success == true) {
                                        db.collection('products_temp').doc({
                                            name: product.name
                                        }).delete();
                                        index++;
                                        if (index == products.length) {
                                            Loading.hide();
                                            setTimeout(() => {
                                                Swal.fire({
                                                    position: 'center',
                                                    icon: 'success',
                                                    title: 'Sync Successfull',
                                                    showConfirmButton: true,
                                                    timer: 5500
                                                })
                                            }, 5000);
                                        }
                                    }
                                })
                            // db.collection('beneficiaries').doc({ id: sales.id }).delete();


                        });
                    } else {
                        Swal.fire({
                            position: 'center',
                            icon: 'error',
                            title: 'No Data to Sync',
                            showConfirmButton: true,
                            timer: 5500
                        })
                    }
                });
            } else {
                Swal.fire({
                    position: 'center',
                    icon: 'error',
                    title: 'You are not Connected',
                    showConfirmButton: true,
                    timer: 5500
                })
            }
        })
    </script>
@endsection
