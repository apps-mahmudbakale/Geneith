<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Purchase Receipt</title>
    <style>
        * {
            font-size: 12px;
            font-family: 'Times New Roman';
        }

        td,
        th,
        tr,
        table {
            border-top: 1px solid black;
            border-collapse: collapse;
        }

        td.description,
        th.description {
            width: 75px;
            max-width: 75px;
        }

        td.quantity,
        th.quantity {
            width: 40px;
            max-width: 40px;
            word-break: break-all;
        }

        td.price,
        th.price {
            width: 40px;
            max-width: 40px;
            word-break: break-all;
        }

        .centered {
            text-align: center;
            align-content: center;
        }

        .ticket {
            width: 155px;
            max-width: 155px;
        }

        img {
            max-width: inherit;
            width: inherit;
        }

        @media print {

            .hidden-print,
            .hidden-print * {
                display: none !important;
            }
        }
    </style>
</head>

<body>
    <div class="ticket" align="center" style="max-width: 1000px; width: 328px;">
        <img src="{{ !empty(app(App\Settings\StoreSettings::class)->store_logo) ? asset('storage/settings/store/' . app(App\Settings\StoreSettings::class)->store_logo) : asset('assets/img/logo.png') }}"
            alt="Logo" style="width: 100px">
        <br>
        {{ app(App\Settings\StoreSettings::class)->store_name ?: 'Storeify' }}
        <p class="centered">PURCHASE RECEIPT
            <br>Birnin Kebbi, Kebbi State
            <br>
            Date: <?php echo date('d/m/Y'); ?>
        <table style="font-size: 24px; font-weight: bold; width: inherit;">
            <thead>
                <tr>
                    <th class="description">Description</th>
                    <th class="quantity">Q.</th>
                    <th class="price">&#8358;</th>
                    <th class="price" style="max-width: 50px; width: 51px;">Subtotal</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($items as $item)
                <tr>
                    <td class="description" style="text-align: center;">{{$item->name}}</td>
                    <td class="quantity" style="text-align: center;">{{$item->qty}}</td>
                    <td class="price" style="text-align: center;">&#8358; {{$item->selling_price}}</td>
                    <td class="price" style="text-align: center;">&#8358; {{$item->amount}}</td>
                  </tr>
                @endforeach
            </tbody>
        </table>
        <br>

        <p class="centered">Thanks for your purchase!
            <br>Geneith Okma
        </p>
    </div>
    <button id="btnPrint" class="hidden-print">Print</button>
    <button onclick="window.history.back()" class="hidden-print">Back</button>
    <script>
        const $btnPrint = document.querySelector("#btnPrint");
        $btnPrint.addEventListener("click", () => {
            window.print();
        });
    </script>
</body>
