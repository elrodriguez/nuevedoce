<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Type"
          content="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet; charset=utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Reporte Eventos</title>
</head>
<body>
<div>
    <h3 align="center" class="title"><strong>Reporte Eventos</strong></h3>
</div>
<br>
@if(!empty($records))
    <div class="">
        <div class=" ">
            <table class="">
                <thead>
                    <tr>
                        <th class="text-center">ID</th>
                        <th>@lang('transferservice::labels.lbl_company')</th>
                        <th>@lang('transferservice::labels.lbl_customer')</th>
                        <th>@lang('transferservice::labels.lbl_local')</th>
                        <th>@lang('transferservice::labels.lbl_address')</th>
                        <th>@lang('transferservice::labels.lbl_reference')</th>
                        <th>@lang('transferservice::labels.lbl_supervisor')</th>
                        <th>@lang('transferservice::labels.lbl_wholesaler')</th>
                        <th>@lang('transferservice::labels.lbl_event_date')</th>
                        <th>@lang('transferservice::labels.lbl_event')</th>
                        <th>@lang('labels.code')</th>
                        <th class="text-center">{{ __('setting::labels.state') }}</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($records as $key => $value)
                    <tr>
                        <td class="text-center align-middle">{{ $value->internal_id }}</td>
                        <td class="align-middle">{{ $value->company_name }}</td>
                        <td class="align-middle">{{ $value->customer_name }}</td>
                        <td class="align-middle">{{ $value->local_name }}</td>
                        <td class="align-middle">{{ $value->address }}</td>
                        <td class="align-middle">{{ $value->reference }}</td>
                        <td class="align-middle">{{ $value->supervisor_name }}</td>
                        <td class="align-middle">{{ $value->wholesaler_name }}</td>
                        <td class="align-middle text-center">{{ $value->date_start }} HASTA {{ $value->date_end }}</td>
                        <td class="align-middle">{{ $value->description }}</td>
                        <td class="align-middle">{{ $value->backus_id }}</td>
                        <td class="text-center align-middle">
                            @if($value->state)
                                <span class="badge badge-success">{{ __('transferservice::labels.lbl_active') }}</span>
                            @else
                                <span class="badge badge-danger">{{ __('transferservice::labels.lbl_inactive') }}</span>
                            @endif
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@else
    <div>
        <p>No se encontraron registros.</p>
    </div>
@endif
</body>
</html>
