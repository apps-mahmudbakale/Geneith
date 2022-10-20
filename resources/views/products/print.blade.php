<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Store</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div class="container">
        <h2>Store Products</h2>
<table id="users" class="table table-bordered table-striped dataTable no-footer"
                                    role="grid" aria-describedby="users_info">
        <thead>
            <tr>
                <th>S/N</th>
                <th>Name</th>
                <th>Buying Price</th>
                <th>Selling Price</th>
                <th>Quantity</th>
                <th>Expiry</th>
                <th>Store</th>
            </tr>
        </thead>
        <tbody>
                @foreach($products as $product)
                <tr>
                <td>{{$loop->iteration}}</td>
                <td>{{$product->name}}</td>
                <td>{!! app(App\Settings\StoreSettings::class)->currency !!} {{number_format($product->buying_price)}}</td>
                <td>{!! app(App\Settings\StoreSettings::class)->currency !!}  {{number_format($product->selling_price)}}</td>
                <td>{{$product->qty}}</td>
                <td>{{\Carbon\Carbon::parse($product->expiry_date)->diffForHumans()}}</td>
                <td>{{$product->store->name}}</td>
            </tr>
                @endforeach
        </tbody>
    </table>
    <button id="btnPrint" class="hidden-print">Print</button>
    <script>
        const $btnPrint = document.querySelector("#btnPrint");
        $btnPrint.addEventListener("click", () => {
            window.print();
        });
    </script>
    </div>

</body>
</html>
