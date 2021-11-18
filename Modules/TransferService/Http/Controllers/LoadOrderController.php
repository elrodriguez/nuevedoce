<?php

namespace Modules\TransferService\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Lang;
use Modules\TransferService\Entities\SerLoadOrderDetail;
use PDF;

class LoadOrderController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        return view('transferservice::loadorder.index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('transferservice::loadorder.create');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        return view('transferservice::loadorder.edit')->with('id', $id);
    }

    public function dataPdf($id){
        $data = SerLoadOrderDetail::where('ser_load_order_details.load_order_id', '=', $id)
            ->join('ser_load_orders', 'ser_load_order_details.load_order_id', 'ser_load_orders.id')
            ->join('ser_vehicles', 'vehicle_id', 'ser_vehicles.id')
            ->join('ser_odt_requests', 'ser_load_order_details.odt_request_id', 'ser_odt_requests.id')
            ->join('ser_locals', 'ser_odt_requests.local_id', 'ser_locals.id')
            ->join('ser_customers', 'ser_odt_requests.customer_id', 'ser_customers.id')
            ->join('people', 'ser_customers.person_id', 'people.id')
            ->join('people as wholesales', 'ser_odt_requests.wholesaler_id', 'wholesales.id')
            ->join('inv_items', 'ser_load_order_details.item_id', 'inv_items.id')
            ->leftJoin('ser_vehicle_crewmen', 'ser_vehicle_crewmen.vehicle_id', 'ser_vehicles.id')
            ->leftJoin('per_employees', 'ser_vehicle_crewmen.employee_id', 'per_employees.id')
            ->leftJoin('people as vehicle_crewmen', 'per_employees.person_id', 'vehicle_crewmen.id')
            ->select(
                'ser_load_orders.uuid',
                'ser_load_orders.upload_date',
                'ser_load_orders.charging_time',
                'ser_vehicles.license_plate',
                'vehicle_crewmen.full_name AS name_vehicle_crewmen',
                'ser_odt_requests.description AS name_event',
                'ser_odt_requests.date_start',
                'ser_odt_requests.date_end',
                'ser_locals.name AS local',
                'ser_locals.address AS address',
                'people.full_name AS name_customer',
                'people.number AS dni',
                'people.telephone AS cel_customer',
                'wholesales.full_name AS name_wholesale',
                'wholesales.telephone AS cel_wholesale',
                'ser_load_order_details.amount',
                'inv_items.name',
                'ser_odt_requests.internal_id'
            )
            ->get();
        return $data;
    }

    public function htmlPdf($head_report, $htmlDetail){
        $html = '
        <table align="center" width="100%">
            <thead>
                <tr>
                    <th style="text-align: center; font-size: 14px; font-weight: bold; text-transform: uppercase;">'.mb_strtoupper(Lang::get('transferservice::labels.lbl_load_order')).'</th>
                </tr>
                <tr>
                    <th style="text-align: center; font-size: 14px; font-weight: bold">'.date('d/m/Y', strtotime($head_report->upload_date)).' '.$head_report->charging_time.'</th>
                </tr>
                <tr>
                    <th style="text-align: center; font-size: 14px; font-weight: bold">&nbsp;</th>
                </tr>
                <tr>
                    <th style="text-align: center; font-size: 14px; font-weight: bold">&nbsp;</th>
                </tr>
            </thead>
        </table>
        <table align="center" width="100%">
            <tbody>
                <tr>
                    <td style="text-align: left; width: 80px;">'.Lang::get('transferservice::labels.lbl_driver').'</td>
                    <td style="text-align: left; width: 280px;">: '.$head_report->name_vehicle_crewmen.'</td>
                    <td style="text-align: left; width: 80px;">'.Lang::get('transferservice::labels.lbl_license_plate').'</td>
                    <td style="text-align: left; width: 280px;">: '.$head_report->license_plate.'</td>
                </tr>
                 <tr>
                    <td style="text-align: left;" colspan="4">&nbsp;</td>
                </tr>
                <tr>
                    <td style="text-align: left; width: 80px;">'.Lang::get('transferservice::labels.lbl_code').'</td>
                    <td style="text-align: left; width: 560px;" colspan="3">: '.$head_report->uuid.'</td>
                </tr>
                <tr>
                    <td style="text-align: left; width: 80px;">'.Lang::get('transferservice::labels.lbl_event').'</td>
                    <td style="text-align: left; width: 560px;" colspan="3">: '.$head_report->name_event.'</td>
                </tr>
                <tr>
                    <td style="text-align: left; width: 80px;">'.Lang::get('transferservice::labels.lbl_date').'</td>
                    <td style="text-align: left; width: 280px;">: '.date('d/m/Y', strtotime($head_report->date_start)).' AL '.date('d/m/Y', strtotime($head_report->date_end)).'</td>
                    <td style="text-align: left; width: 80px;">'.Lang::get('transferservice::labels.lbl_mobile').'</td>
                    <td style="text-align: left; width: 280px;">: '.$head_report->cel_customer.'</td>
                </tr>
                <tr>
                    <td style="text-align: left; width: 80px;">'.Lang::get('transferservice::labels.lbl_local').'</td>
                    <td style="text-align: left; width: 560px;" colspan="3">: '.$head_report->local.'</td>
                </tr>
                <tr>
                    <td style="text-align: left; width: 80px;">'.Lang::get('transferservice::labels.lbl_address').'</td>
                    <td style="text-align: left; width: 280px;">: '.$head_report->address.'</td>
                    <td style="text-align: left; width: 80px;">'.Lang::get('transferservice::labels.lbl_district').'</td>
                    <td style="text-align: left; width: 280px;">: -- </td>
                </tr>
                <tr>
                    <td style="text-align: left; width: 80px;">'.Lang::get('transferservice::labels.lbl_customer').'</td>
                    <td style="text-align: left; width: 280px;">: '.$head_report->name_customer.'</td>
                    <td style="text-align: left; width: 80px;">'.Lang::get('transferservice::labels.lbl_dni').'</td>
                    <td style="text-align: left; width: 280px;">: '.$head_report->dni.'</td>
                </tr>
                <tr>
                    <td style="text-align: left; width: 80px;">'.Lang::get('transferservice::labels.lbl_wholesaler').'</td>
                    <td style="text-align: left; width: 280px;">: '.$head_report->name_wholesale.'</td>
                    <td style="text-align: left; width: 80px;">'.Lang::get('transferservice::labels.lbl_mobile').'</td>
                    <td style="text-align: left; width: 280px;">: '.$head_report->cel_wholesale.'</td>
                </tr>
                <tr>
                    <th style="text-align: center;" colspan="4">&nbsp;</th>
                </tr>
                <tr>
                    <th style="text-align: center;" colspan="4">&nbsp;</th>
                </tr>
            </tbody>
        </table>
        <table style="border-collapse: collapse" border="1">
            <thead>
                <tr>
                    <th style="font-weight: bold; text-align: center; width: 80px;">'.Lang::get('transferservice::labels.lbl_code').'</th>
                    <th style="font-weight: bold; text-align: center; width: 380px;">'.Lang::get('transferservice::labels.lbl_load_order_detail').'</th>
                    <th style="font-weight: bold; text-align: center; width: 80px;">'.Lang::get('transferservice::labels.lbl_amount').'</th>
                </tr>
            </thead>
            <tbody>
            '.$htmlDetail.'
            </tbody>
        </table>
        ';
        return $html;
    }

    public function htmlDetailPdf($a, $row){
        $html ='
        <tr>
            <td style="text-align: center; width: 80px;">'.$a.'</td>
            <td style="width: 380px;">'.$row->name.'</td>
            <td style="text-align: center; width: 80px;">'.$row->amount.'</td>
        </tr>
        ';
        return $html;
    }

    public function print($id){
        PDF::SetAuthor('System');
        PDF::SetTitle('Orden de Carga');
        PDF::SetSubject('Reporte Orden de Carga');
        PDF::SetMargins(7, 18, 7);
        // set default header data
        PDF::SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE.' 006', PDF_HEADER_STRING);
        PDF::setFooterData(array(0,64,0), array(0,64,128));

        // set header and footer fonts
        PDF::setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
        PDF::setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

        PDF::SetFooterMargin(10);// Intervalo inferior del pie de página

        PDF::SetFontSubsetting(false);
        PDF::SetFontSize('10px');
        PDF::SetAutoPageBreak(true, 25);

        PDF::SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
        $data = $this->dataPdf($id);
        $head_report = array();
        PDF::AddPage();
        $aux_odt = '';
        $bp = false;
        $detail_html = '';
        $a = 1;
        foreach ($data as $row){
            if($aux_odt != $row['internal_id']){
                if($bp){
                    PDF::writeHTML($this->htmlPdf($head_report, $detail_html), true, false, true, false, '');
                    PDF::Cell(0, 10, 'Página '.PDF::getAliasNumPage().'/'.PDF::getAliasNbPages(), 0, false, 'C', 0, '', 0, false, 'T', 'M');
                    PDF::AddPage();
                }
                $head_report = $row;
                $detail_html = '';
                $bp = true;
                $a = 1;
            }
            $detail_html .= $this->htmlDetailPdf($a, $row);
            $a++;
            $array_aux_detail[] = $row;
            $aux_odt = $row['internal_id'];
        }
        PDF::writeHTML($this->htmlPdf($head_report, $detail_html), true, false, true, false, '');
        // Page number
        //PDF::endPage();
        PDF::Cell(0, 10, 'Página '.PDF::getAliasNumPage().'/'.PDF::getAliasNbPages(), 0, false, 'C', 0, '', 0, false, 'T', 'M');

        PDF::Output('my_loar_order.pdf', 'D');
        exit;
    }
}
