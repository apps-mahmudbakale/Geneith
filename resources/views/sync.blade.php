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
        // const SyncUrl = 'http://localhost:8001/';
        const Url = 'http://localhost:8001/api/';
        let sync = document.getElementById('SyncBtn');
        window.addEventListener('load', function() {
            // alert('hello');
            db.collection('sales_temp').delete();
            fetch(Url + 'getSales/' + {{ auth()->user()->station->id }})
                .then((res) => res.json())
                .then((data) => {
                    console.log(data);
                    data.forEach(element => {
                        Loading.show('Initializing Sync...');
                        db.collection('sales_temp').add({
                            invoice: element.invoice,
                            product_id: element.product_id,
                            amount: element.amount,
                            qty: element.qty,
                            station_id: element.station_id,
                            user_id: element.user_id,
                            created_at: element.created_at
                        });
                    })

                })

        });
        let syncNo = document.getElementById('syncNo');
        db.collection('sales_temp').get().then(snapshot => {
            // console.log(snapshot.length);
            syncNo.innerHTML = snapshot.length;
        });

        sync.addEventListener('click', function() {
            if (navigator.onLine) {
                Loading.show('Getting Ready  for Sync...');
                db.collection('sales_temp').orderBy('product_id').get().then(sales => {
                    if (sales.length >= 1) {
                        let index = 0;
                        const partialObjects = sales.slice(0, 5);
                        partialObjects.forEach(sale => {
                            Loading.show('Syncing Sales Data...');
                            console.log(sale);
                            fetch(SyncUrl + 'syncData?' + new URLSearchParams({
                                    invoice: sale.invoice,
                                    product_id: sale.product_id,
                                    user_id: sale.user_id,
                                    amount: sale.amount,
                                    qty: sale.qty,
                                    station_id: sale.station_id,
                                    created_at: sale.created_at
                                }))
                                .then((res) => res.json())
                                .then((data) => {
                                    console.log(data);
                                    if (data.success == true) {
                                        var csrf = document.querySelector('meta[name="csrf-token"]').content;
                                        $.ajax({
                                            type: "POST",
                                            url: "/synced",
                                            data: {
                                                _token: csrf,
                                                invoice: sale.invoice,
                                                product_id: sale.product_id
                                            },
                                            cache: false,
                                            success: function(html) {
                                                console.log(html)
                                            }
                                        });
                                        $.ajax({
                                            type: "POST",
                                            url: "/api/stationProducts",
                                            data: {
                                                station_id: '{{ auth()->user()->station->id }}'
                                            },
                                            cache: false,
                                            success: function(data) {
                                                console.log(data)
                                                data.forEach(element => {
                                                    $.ajax({
                                                        type: "POST",
                                                        url: SyncUrl +
                                                            "api/syncProducts",
                                                        data: {
                                                            station_id: element
                                                                .station_id,
                                                            quantity: element
                                                                .quantity,
                                                            product_id: element
                                                                .product_id
                                                        },
                                                        cache: false,
                                                        success: function(
                                                            html
                                                        ) {
                                                            console
                                                                .log(
                                                                    html
                                                                )

                                                        }

                                                    });
                                                })

                                            }
                                        });
                                        db.collection('sales_temp').doc({
                                            invoice: sale.invoice
                                        }).delete();
                                        index++;
                                        if (index == sales.length) {
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
