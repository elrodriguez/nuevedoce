<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Type" content="application/pdf; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Reporte - {{ $cash->user->name }} - {{ $cash->date_opening }} {{ $cash->time_opening }}</title>
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
        <p align="center" class="title"><strong>Reporte Punto de Venta</strong></p>
    </div>
    <div style="margin-top:20px; margin-bottom:20px;">
        <table>
            <tr>
                <td class="width-custom">
                    <p><strong>Empresa: </strong>{{ $company->name }}</p>
                </td>
                <td class="td-custom">
                    <p><strong>Fecha reporte: </strong>{{ date('Y-m-d') }}</p>
                </td>
            </tr>
            <tr>
                <td class="td-custom">
                    <p><strong>Ruc: </strong>{{ $company->number }}</p>
                </td>
                <td class="width-custom">
                    @if ($establishment)
                        <p><strong>Establecimiento: </strong>{{ $establishment->address }} -
                            {{ $establishment->department->description }} - {{ $establishment->district->description }}
                        </p>
                    @endif
                </td>
            </tr>

            <tr>
                <td class="td-custom">
                    <p><strong>Vendedor: </strong>{{ $cash->user->name }}</p>
                </td>
                <td class="td-custom">
                    <p><strong>Fecha y hora apertura: </strong>{{ $cash->date_opening }} {{ $cash->time_opening }}</p>
                </td>
            </tr>
            <tr>
                <td class="td-custom">
                    <p><strong>Estado de caja: </strong>{{ $cash->state ? 'Aperturada' : 'Cerrada' }}</p>
                </td>
                @if (!$cash->state)
                    <td class="td-custom">
                        <p><strong>Fecha y hora cierre: </strong>{{ $cash->date_closed }} {{ $cash->time_closed }}</p>
                    </td>
                @endif
            </tr>
            <tr>
                <td colspan="2" class="td-custom">
                    <p><strong>Montos de operación: </strong></p>
                </td>
            </tr>


        </table>
    </div>
    @if ($documents->count())
        <div class="">
            <div class=" ">
                <table class="">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Producto</th>
                            <th>Comprobante</th>
                            <th>Cantidad</th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach ($documents as $item)
                            <tr>
                                <td class="celda">{{ $loop->iteration }}</td>
                                <td class="celda-left">{{ $item['description'] }}</td>
                                <td class="celda">{{ $item['number_full'] }}</td>
                                <td class="celda-right">{{ $item['quantity'] }}</td>
                            </tr>
                        @endforeach
                    </tbody>
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
