<table>
    <tbody>
    <tr>
        <td>
            <table>
                <tbody>
                <tr>
                    <td style="width: 20%;">Logo</td>
                    <td style="text-align: center; width: 40%;">
                        <label>{{ $name_bussines }}</label><br>
                        <label>{{ $address_bussines }}</label><br>
                        <label>{{ $tradename }}</label><br>
                        <label>{{ $email_bussines }}</label><br>
                        <label>{{ $telephone_bussines }}</label><br>
                        <label>{{ $cell_phone_bussines }}</label>
                    </td>
                    <td style="width: 40%; text-align: center; padding: 5px 5px;">
                        <table style="width: 80%; border: 1px #0b3251 solid;">
                            <tbody>
                                <tr>
                                    <td>
                                        @lang('transferservice::labels.lbl_ruc'): {{ $ruc_company }}
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <label>{{ $name_document }}</label>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <label>{{ $serie }} - {{ $this->number_format }}</label>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>
                </tbody>
            </table>
        </td>
    </tr>
    <tr>
        <td>&nbsp;</td>
    </tr>
    <tr>
        <td>
            <table class="ml-2" style="width: 95%;">
                <tbody>
                <tr>
                    <td style="width: 20%;" class="font-weight-bold">@lang('transferservice::labels.lbl_date_of_issue')</td>
                    <td style="width: 80%;">: {{ $this->date_of_issue_d }}</td>
                </tr>
                <tr>
                    <td class="font-weight-bold">@lang('transferservice::labels.lbl_business_name')</td>
                    <td>: {{ $business_name_d }}</td>
                </tr>
                <tr>
                    <td class="font-weight-bold">@lang('transferservice::labels.lbl_ruc')</td>
                    <td>: {{ $ruc_d }}</td>
                </tr>
                </tbody>
            </table>
        </td>
    </tr>
    <tr>
        <td>&nbsp;</td>
    </tr>
    <tr>
        <td>
            <table class="ml-2" style="width: 95%;">
                <tbody>
                <tr>
                    <td style="width: 20%;" class="font-weight-bold">@lang('transferservice::labels.lbl_shipping_type')</td>
                    <td style="width: 30%;">: {{ $shipping_type }}</td>
                    <td style="width: 20%;" class="font-weight-bold">@lang('transferservice::labels.lbl_shipping_date')</td>
                    <td style="width: 30%;">: {{ $shipping_date_f }}</td>
                </tr>
                <tr>
                    <td style="width: 20%;" class="font-weight-bold">@lang('transferservice::labels.lbl_total_gross_weight')</td>
                    <td style="width: 30%;">: {{ $total_gross_weight }} @lang('transferservice::labels.lbl_kilograms')</td>
                    <td style="width: 20%;" class="font-weight-bold">@lang('transferservice::labels.lbl_number_of_packages')</td>
                    <td style="width: 30%;">: {{ $number_of_packages }}</td>
                </tr>
                <tr>
                    <td class="font-weight-bold">@lang('transferservice::labels.lbl_starting_point')</td>
                    <td colspan="3">: {{ $starting_point }}</td>
                </tr>
                <tr>
                    <td class="font-weight-bold">@lang('transferservice::labels.lbl_arrival_point')</td>
                    <td colspan="3">: {{ $arrival_point }}</td>
                </tr>
                </tbody>
            </table>
        </td>
    </tr>
    <tr>
        <td>&nbsp;</td>
    </tr>
    <tr>
        <td>
            <table class="ml-2" style="width: 95%;">
                <tbody>
                <tr>
                    <td style="width: 20%;" class="font-weight-bold">@lang('transferservice::labels.lbl_type_of_transport')</td>
                    <td style="width: 30%;">: {{ $type_of_transport }}</td>
                    <td style="width: 20%;" class="font-weight-bold">@lang('transferservice::labels.lbl_license_plate')</td>
                    <td style="width: 30%;">: {{ $license_plate }}</td>
                </tr>
                <tr>
                    <td style="width: 20%;" class="font-weight-bold">@lang('transferservice::labels.lbl_carrier')</td>
                    <td style="width: 30%;">: {{ $carrier }}</td>
                    <td style="width: 20%;" class="font-weight-bold">@lang('transferservice::labels.lbl_dni')</td>
                    <td style="width: 30%;">: {{ $document_carrier }}</td>
                </tr>
                </tbody>
            </table>
        </td>
    </tr>
    <tr>
        <td>&nbsp;</td>
    </tr>
    <tr>
        <td>
            <table class="table m-0 table-hover" border="1" style="border: 1px #0b3251 solid; border-collapse: collapse;">
                <thead>
                <tr>
                    <th style="text-align: center; width: 5%;" class="center">#</th>
                    <th style="text-align: center; width: 15%;">@lang('transferservice::labels.lbl_qty')</th>
                    <th style="text-align: center; width: 15%;">@lang('transferservice::labels.lbl_unit')</th>
                    <th style="text-align: center; width: 15%;">@lang('transferservice::labels.lbl_code')</th>
                    <th style="text-align: center; width: 50%;">@lang('transferservice::labels.lbl_description')</th>
                </tr>
                </thead>
                <tbody>
                @foreach($loadorderdetails as $key => $item)
                    <tr>
                        <td style="text-align: center; width: 5%;">{{ $key+1 }}</td>
                        <td style="text-align: center; width: 15%;">{{ $item->quantity }}</td>
                        <td style="text-align: center; width: 15%;">{{ $item->unit }}</td>
                        <td style="text-align: center; width: 15%;">{{ str_pad($item->code, 6, '0', STR_PAD_LEFT) }}</td>
                        <td style="text-align: left; width: 50%;">{{ $item->description }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </td>
    </tr>
    </tbody>
</table>
