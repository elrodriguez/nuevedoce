@php

if (count($products) > 0) {
    $date = $products[0]['created_at'];
    $origin = $products[0]['origin_name'];
    $destination = $products[0]['destination_name'];
    $description = $products[0]['description'];
    $transfer_quantity = $products[0]['transfer_quantity'];
}

@endphp
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Type" content="application/pdf; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Traslado - {{ $date }}</title>
    <style>
        html {
            font-family: sans-serif;
            font-size: 12px;
        }

        table {
            width: 100%;
            border-spacing: 0;
            border: 1px solid #e9e9e9;
        }

        .celda {
            text-align: center;
            padding: 5px;
            border: 0.1px solid #e9e9e9;
        }

        .celda-left {
            text-align: left;
            padding: 5px;
            border: 0.1px solid #e9e9e9;
        }

        .celda-right {
            text-align: right;
            padding: 5px;
            border: 0.1px solid #e9e9e9;
        }

        th {
            padding: 5px;
            text-align: center;
            border-color: #7a59ad;
            border: 0.1px solid rgba(0, 0, 0, 0.1)
        }

        .title {
            font-weight: bold;
            padding: 5px;
            font-size: 20px !important;
            text-decoration: underline;
        }

        p>strong {
            margin-left: 5px;
            font-size: 12px;
        }

        thead {
            font-weight: bold;
            background: #7a59ad;
            color: white;
            text-align: center;
        }

        .td-custom {
            line-height: 0.1em;
        }

        .width-custom {
            width: 50%
        }

    </style>
</head>

<body>
    <div>
        <p align="center" class="title"><strong>Traslados de Productos</strong></p>
    </div>
    <div style="margin-top:20px; margin-bottom:20px;">


        <table>
            <tr>
                <td class="td-custom width-custom">
                    <p><strong>Fecha Traslado: </strong>{{ \Carbon\Carbon::parse($date)->format('d/m/Y') }}</p>
                </td>
                <td class="td-custom">
                    <p><strong>Productos: </strong>{{ $transfer_quantity }}</p>
                </td>
            </tr>

            <tr>
                <td class="td-custom">
                    <p><strong>{{ __('labels.origin_warehouse') }}: </strong>{{ $origin }}</p>
                </td>
                <td class="td-custom">
                    <p>
                        <strong>{{ __('labels.destination_warehouse') }}: </strong>
                        {{ $destination }}
                    </p>
                </td>
            </tr>

            <tr>
                <td colspan="2" class="td-custom">
                    <p><strong>{{ __('labels.description') }}: </strong>{{ $description }}</p>
                </td>
            </tr>

        </table>
    </div>
    @if (count($products) > 0)
        <div class="">
            <div class=" ">
                <table>
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>{{ __('labels.product') }}</th>
                            <th>{{ __('labels.quantity') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $xtotalp = 0;
                            $c = 1;
                        @endphp
                        @foreach ($products as $item)
                            @if ($item['quantity'] > 0)
                                <tr>
                                    <td class="celda">{{ $c }}</td>
                                    <td class="celda-left">{{ $item['name'] }}</td>
                                    <td class="celda-right">
                                        {{ number_format($item['quantity'], 2, '.', '') }}
                                    </td>
                                </tr>
                                @php
                                    $xtotalp = $xtotalp + $item['quantity'];
                                    $c++;
                                @endphp
                            @endif
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th class="celda-right" colspan="2">{{ __('labels.total') }}</th>
                            <th class="celda-right">{{ number_format($xtotalp, 2, '.', '') }}</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    @else
        <div class="callout callout-info">
            <p>No se encontraron registros.</p>
        </div>
    @endif
</body>

</html>
