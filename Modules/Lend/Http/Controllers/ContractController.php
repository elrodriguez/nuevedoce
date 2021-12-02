<?php

namespace Modules\Lend\Http\Controllers;

use App\Models\Person;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Modules\Lend\Entities\LenContract;
use Modules\Lend\Entities\LenPaymentSchedule;
use PDF;
use Luecano\NumeroALetras\NumeroALetras;
use Illuminate\Support\Facades\Lang;
class ContractController extends Controller
{

    public function index()
    {
        return view('lend::contract.index');
    }

    public function create()
    {
        return view('lend::contract.create');
    }

    public function edit($id)
    {
        return view('lend::contract.edit')->with('id', $id);
    }

    public function dataContract($id){
        $contract = LenContract::join('len_payment_schedules','contract_id','len_contracts.id')
            ->join('people AS customer','customer_id','customer.id')
            ->join('people AS referred','customer_id','referred.id')
            ->join('len_interests','interest_id','len_interests.id')
            ->join('len_payment_methods','payment_method_id','len_payment_methods.id')
            ->join('len_quotas','quota_id','len_quotas.id')
            ->select(
                'customer.full_name AS customer_name',
                'customer.address AS customer_address',
                'customer.number AS customer_number',
                'referred.full_name AS referred_name',
                'referred.address AS referred_address',
                'referred.number AS referred_number',
                'len_interests.description AS interest_description',
                'len_payment_methods.description AS payment_method_description',
                'len_quotas.amount AS quota_amount',
                'len_contracts.additional_information',
                'len_contracts.date_start',
                'len_contracts.date_end',
                'len_contracts.amount_capital',
                'len_contracts.amount_interest',
                'len_contracts.amount_total',
                'len_contracts.penalty',
                'len_contracts.amount_penalty_day',
                DB::raw('DATE_FORMAT(len_contracts.created_at,"%Y-%m-%d") AS created_date'),
                DB::raw('DATE_FORMAT(len_contracts.created_at,"%H:%i") AS created_time')
            )
            ->where('len_contracts.id',$id)
            ->first();
            
            $moneda = 'soles';
            $formatter = new NumeroALetras();
            $capital_words = $formatter->toMoney($contract->amount_capital, 2, 'SOLES', 'CENTIMOS');
            $total_words = $formatter->toMoney($contract->amount_total, 2, 'SOLES', 'CENTIMOS');

        $html_detail = $this->dataDetails($id);

        $html = '<h1 style="text-align: center;">CONTRATO DE PRÉSTAMO ENTRE PARTICULARES</h1>
                <p style="text-align: center;">En '.nameNumerDay($contract->date_start).', a '.$contract->created_time.' de '.nameMonth($contract->date_start).' de '.date("Y", strtotime($contract->date_start)).'</p>
                <div style="padding-left: 10px;">

                    <p style="text-align: center;"><b>REUNIDOS</b></p>
                    <p style="text-align: left;padding: 0px">De una parte, como <b>PRESTAMISTA,</b></p>
                    <p style="text-align: left;padding: 0px">D./D:</p>
                    <p style="text-align: left;padding: 0px">Documento Nacional de Identidad número:</p>
                    <p style="text-align: left;padding: 0px">Domicilio: </p>

                    <p style="text-align: left;padding: 0px">Y de otra, como <b>PRESTATARIO,</b></p>
                    <p style="text-align: left;padding: 0px">D./D: '.$contract->customer_name.'</p>
                    <p style="text-align: left;padding: 0px">Documento Nacional de Identidad número: '.$contract->customer_number.'</p>
                    <p style="text-align: left;padding: 0px">Domicilio: '.$contract->customer_address.'</p>

                    <p style="text-align: justify;">Interviene, asimismo, en el presente contrato, en su propio nombre y derecho. Ambas partes se reconocen la capacidad legal necesaria para formalizar el presente <b>CONTRATO CIVIL DE PRÉSTAMO CON INTERESES</b> en el concepto en el que intervienen en el mismo, y de conformidad con las siguientes</p>

                    <p style="text-align: center;"><b>CLÁUSULAS</b></p>
                    <p style="text-align: justify;"><b>PRÉSTAMO.</b> El <b>PRESTAMISTA</b> presta al <b>PRESTATARIO</b> la cantidad
                    de '.$capital_words.', que se hace efectiva en este acto,
                    mediante.................................., sirviendo la firma de este documento como formal carta de pago
                    y recibo de la citada cantidad. </p>
                    <p style="text-align: justify;"><b>DEVOLUCIÓN DEL CAPITAL E INTERÉS.</b> El <b>PRESTATARIO</b> se obliga
                    frente al <b>PRESTAMISTA</b> a la devolución del capital prestado con interés, pactado por las partes, del '.$contract->interest_description.'.</p>
                    <p style="text-align: justify;"><b>PLAZO DE DEVOLUCIÓN.</b>  El capital prestado más el interés ('.$total_words.') deberá ser pagado
                    como máximo en el plazo de '.$contract->quota_amount.' '.$contract->payment_method_description.' a contar desde el día de de la firma del
                    presente contrato, es decir, como fecha máxima el día '.nameNumerDay($contract->date_end).' de '.nameMonth($contract->date_end).'
                    de '.date("Y", strtotime($contract->date_end)).'</p>
                    '.$html_detail.'
                </div>';
    
        return $html;
    }

    public function dataDetails($id){
        $data = LenPaymentSchedule::where('contract_id',$id)->get();
        $tr = '';
        foreach($data as $item){
            $tr .= '<tr>
                    <td style="font-weight: bold; text-align: center;">'.(\Carbon\Carbon::parse($item->date_to_pay)->format('d/m/Y')).'</td>
                    <td style="font-weight: bold; text-align: center;">'.$item->capital.'</td>
                    <td style="font-weight: bold; text-align: center;">'.$item->interest.'</td>
                    <td style="font-weight: bold; text-align: center;">'.$item->amount_to_pay.'</td>
                </tr>';
        }

        $html = '
            <h1 style="text-align: center;">CRONOGRAMA DE PAGOS</h1>
            <p style="text-align: left;"><b>Código de préstamo: '.$item->contract_id.'</b></p>
            <table style="border-collapse: collapse" border="1">
                <thead>
                    <tr>
                        <th style="font-weight: bold; text-align: center;">'.Lang::get('lend::labels.lbl_date_to_pay').'</th>
                        <th style="font-weight: bold; text-align: center;">'.Lang::get('lend::labels.lbl_principal_amount').'</th>
                        <th style="font-weight: bold; text-align: center;">'.Lang::get('lend::labels.lbl_interest_amount').'</th>
                        <th style="font-weight: bold; text-align: center;">'.Lang::get('lend::labels.lbl_amount_to_pay').'</th>
                    </tr>
                </thead>
                <tbody>
                '.$tr.'
                </tbody>
            </table>';

        return $html;
    }

    public function print($id)
    {
        PDF::SetAuthor('System');
        PDF::SetTitle('Contrato');
        PDF::SetSubject('Contrato particular');
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

        $html = $this->dataContract($id);

        PDF::AddPage();

        PDF::writeHTML($html, true, false, true, false, '');
        // Page number
        //PDF::endPage();
        PDF::Cell(0, 10, 'Página '.PDF::getAliasNumPage().'/'.PDF::getAliasNbPages(), 0, false, 'C', 0, '', 0, false, 'T', 'M');

        PDF::Output('my_contract.pdf', 'D');
        exit;
    }

    public function autocomplete(Request $request){
        $search = $request->input('q');
        $customers    = Person::join('customers', 'customers.person_id', 'people.id')
            ->select(
                'people.id AS value',
                DB::raw("CONCAT(people.number, ' - ', people.full_name) AS text")
            )
            ->where('people.full_name','like','%'.$search.'%')
            ->get();
        return response()->json($customers, 200);
    }
}
