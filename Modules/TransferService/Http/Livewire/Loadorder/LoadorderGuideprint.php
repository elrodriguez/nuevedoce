<?php

namespace Modules\TransferService\Http\Livewire\Loadorder;

use Livewire\Component;
use Modules\Setting\Entities\SetCompany;
use Modules\TransferService\Entities\SerGuide;
use Modules\TransferService\Entities\SerGuideDetail;

class LoadorderGuideprint extends Component
{
    public $idDocumentGuide = '09';
    public $business_id = 1; //Empresa default
    public $search_order;
    public $search_serie;
    public $loadorder_id;
    public $occupation_crewmen = 6; //id Ocupacion del chofer

    public $id_guide_exit = '';
    public $id_guide_entry = '';

    //Data bussiness
    public $name_bussines; //Nombre
    public $tradename; //Nombre Comercial
    public $address_bussines; //Direccion
    public $email_bussines; //Email
    public $telephone_bussines; //Telefono
    public $cell_phone_bussines; //Email

    //Data Serie numero:
    public $ruc_company;
    public $name_document;
    public $serie;
    public $year;
    public $number;
    public $final_number;
    public $number_digits;
    public $number_format;
    public $number_return;
    public $number_return_format;

    //Data Destinatario
    public $date_of_issue_d; //Fecha de Emision
    public $business_name_d; //Razon social cliente
    public $ruc_d;  //RUC cliente

    //Data Envio
    public $shipping_type = 'Alquiler'; //Tipo de envio
    public $shipping_date; //Fecha de envio
    public $shipping_date_f; //Fecha de envio
    public $total_gross_weight; //Peso Bruto total
    public $number_of_packages; //Numero de bultos
    public $starting_point; //Punto de partida
    public $arrival_point; //punto de llegada

    //Data Transporte
    public $type_of_transport; //Tipo de transporte
    public $license_plate; //Placa
    public $carrier; //Transportista
    public $document_carrier; //Dni

    //Transporte Retorno:
    public $vehicle_id_r;
    public $license_plate_r;
    public $carrier_r;
    public $document_carrier_r;
    public $starting_point_r; //Punto de partida
    public $arrival_point_r; //punto de llegada

    public $loadorderdetails = [];

    public function mount($id){
        $this->getDataBusiness();
        $data_guide_exist = SerGuide::find($id);

        $this->id_guide_exit = $data_guide_exist->id;
        $this->serie = $data_guide_exist->serie;
        $this->name_document = $data_guide_exist->name_document;
        $this->number_format = $data_guide_exist->number;
        $this->date_of_issue_d = $data_guide_exist->date_of_issue;
        $this->business_name_d = $data_guide_exist->addressee;
        $this->ruc_d = $data_guide_exist->document_number;
        $this->shipping_type = $data_guide_exist->shipping_type;
        $this->shipping_date_f = $data_guide_exist->shipping_date;
        $this->total_gross_weight = $data_guide_exist->total_gross_weight;
        $this->number_of_packages = $data_guide_exist->number_of_packages;
        $this->starting_point = $data_guide_exist->starting_point;
        $this->arrival_point = $data_guide_exist->arrival_point;
        $this->type_of_transport = $data_guide_exist->type_of_transport;
        $this->license_plate = $data_guide_exist->license_plate;
        $this->carrier = $data_guide_exist->carrier;
        $this->document_carrier = $data_guide_exist->document_carrier;

        $this->loadorderdetails = SerGuideDetail::where('guide_id', '=', $this->id_guide_exit)->get();
    }

    public function render()
    {
        return view('transferservice::livewire.loadorder.loadorder-guideprint');
    }

    public function getDataBusiness(){
        $data = SetCompany::where('set_companies.id', '=', $this->business_id)
            ->join('set_establishments', 'company_id', 'set_establishments.id')
            ->select(
                'set_companies.name',
                'set_companies.tradename',
                'set_companies.phone',
                'set_companies.phone_mobile',
                'set_companies.email',
                'set_companies.number AS ruc',
                'set_establishments.address'
            )
            ->get();

        foreach ($data as $row){
            $this->name_bussines = $row->name;
            $this->tradename = $row->tradename;
            $this->telephone_bussines = $row->phone;
            $this->cell_phone_bussines = $row->phone_mobile;
            $this->email_bussines = $row->email;
            $this->address_bussines = $row->address;
            $this->ruc_company = $row->ruc;
        }
    }
}
