<?php

namespace Modules\TransferService\Http\Livewire\Loadorder;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Lang;
use Livewire\Component;
use Modules\Inventory\Entities\InvAsset;
use Modules\Inventory\Entities\InvItemPart;
use Modules\Setting\Entities\SetCompany;
use Modules\TransferService\Entities\SerGuide;
use Modules\TransferService\Entities\SerGuideDetail;
use Modules\TransferService\Entities\SerLoadOrder;
use Modules\TransferService\Entities\SerLoadOrderDetail;
use Modules\TransferService\Entities\SerLoadOrderDetailAsset;
use Modules\TransferService\Entities\SerSerie;
use Modules\TransferService\Entities\SerVehicle;

class LoadorderGuides extends Component
{
    //Config
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
    public $id_serie_search;
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
    public $transports = [];
    public $license_plate_r;
    public $carrier_r;
    public $document_carrier_r;
    public $starting_point_r; //Punto de partida
    public $arrival_point_r; //punto de llegada

    public $loadorderdetails = [];

    public function mount($id){
        $this->loadorder_id = $id;
        $this->getDataBusiness();
        $data_exist = SerGuide::where('loadorder_id','=', $this->loadorder_id)
            //->where('guide_type', '=', 'S')
            ->get();

        if(count($data_exist) > 0){
            $id_guide_a = '';
            $id_guide_b = '';
            $a = 0;
            foreach ($data_exist as $item) {
                if($a == 0){
                    $id_guide_a = $item->id;
                }else{
                    $id_guide_b = $item->id;
                }
                $a++;
            }
            $data_guide_exist = SerGuide::find($id_guide_a);
            $data_guide_exist_b = SerGuide::find($id_guide_b);
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

            //For return
            $this->id_guide_entry = $data_guide_exist_b->id;
            $this->number_return_format = $data_guide_exist_b->number;
            $this->license_plate_r = $data_guide_exist_b->license_plate;
            $this->carrier_r = $data_guide_exist_b->carrier;
            $this->document_carrier_r = $data_guide_exist_b->document_carrier;
            $this->starting_point_r = $data_guide_exist_b->starting_point;
            $this->arrival_point_r = $data_guide_exist_b->arrival_point;

            $loadorderdetails = SerGuideDetail::where('guide_id', '=', $this->id_guide_exit)->get();

            if($loadorderdetails){
                $this->loadorderdetails = $loadorderdetails->toArray();
            }
            
        }else {
            $this->getSerie();
            $this->getDataAddressee();

            $this->search_order = SerLoadOrder::where('ser_load_orders.id', '=', $id)
                ->join('ser_vehicles', 'vehicle_id', 'ser_vehicles.id')
                ->join('ser_vehicle_types', 'vehicle_type_id', 'ser_vehicle_types.id')
                ->leftjoin('ser_vehicle_crewmen', 'ser_vehicles.id', 'ser_vehicle_crewmen.vehicle_id')
                ->leftjoin('sta_employees', 'ser_vehicle_crewmen.employee_id', 'sta_employees.id')
                ->join('people', 'sta_employees.person_id', 'people.id')
                ->select(
                    'ser_vehicles.license_plate',
                    'ser_vehicle_types.name',
                    'ser_load_orders.id',
                    'ser_load_orders.charge_maximum',
                    'ser_load_orders.charge_weight',
                    'ser_load_orders.upload_date',
                    'ser_load_orders.charging_time',
                    'ser_load_orders.departure_date',
                    'ser_load_orders.departure_time',
                    'ser_load_orders.return_date',
                    'ser_load_orders.return_time',
                    'ser_load_orders.uuid',
                    'people.full_name AS carrier',
                    'people.number AS document_carrier',
                    'ser_load_orders.state',
                    'ser_vehicles.id AS id_vehicle',
                )
                ->where('sta_employees.occupation_id', '=', $this->occupation_crewmen)
                ->get();

            $this->date_of_issue_d = date('d-m-Y');

            foreach ($this->search_order as $row) {
                $this->type_of_transport = 'Privado';
                $this->license_plate = $row->license_plate;
                $this->carrier = $row->carrier;
                $this->document_carrier = $row->document_carrier;
                $this->total_gross_weight = $row->charge_weight;
                $this->shipping_date = ($row->departure_date == null ? $row->upload_date : $row->departure_date);
                
                if ($this->shipping_date != '') {
                    $this->shipping_date_f = $this->shipping_date;
                }

                //For return
                $this->vehicle_id_r = $row->id_vehicle;
                $this->license_plate_r = $row->license_plate;
                $this->carrier_r = $row->carrier;
                $this->document_carrier_r = $row->document_carrier;
                break;
            }
            //dd($this->shipping_date_f);
            $this->getLoadOrderDetails();
            #dd($this->loadorderdetails);
            $this->number_of_packages = count($this->loadorderdetails);
        }
    }

    public function render(){
        //Get Data vehicles:
        $this->transports = SerVehicle::where('ser_vehicles.state', '=', true)
            ->join('ser_vehicle_crewmen', 'ser_vehicles.id', 'ser_vehicle_crewmen.vehicle_id')
            ->join('sta_employees', 'ser_vehicle_crewmen.employee_id', 'sta_employees.id')
            ->join('people', 'sta_employees.person_id', 'people.id')
            ->where('sta_employees.occupation_id', '=', $this->occupation_crewmen)
            ->select(
                'ser_vehicles.license_plate',
                'people.full_name',
                'people.number',
                'ser_vehicles.mark',
                'ser_vehicles.model',
                'ser_vehicles.color',
                'ser_vehicles.id'
            )
            ->get();
        return view('transferservice::livewire.loadorder.loadorder-guides');
    }

    public function getSerie() {
        $this->search_serie = SerSerie::where('document_type_id', '=', $this->idDocumentGuide)
            ->where('ser_series.state', '=', true)
            ->join('document_types', 'document_type_id', 'document_types.id')
            ->select(
                'ser_series.id',
                'ser_series.serie AS serie',
                'ser_series.year AS year',
                'ser_series.current_number AS current_number',
                'ser_series.final_number AS final_number',
                'ser_series.number_digits AS number_digits',
                'document_types.description'
            )
            ->get();
        foreach ($this->search_serie as $item) {
            $this->id_serie_search = $item->id;
            $this->serie = $item->serie;
            $this->year = $item->year;
            $this->number = (int) $item->current_number + 1;
            $this->number_return = (int) $item->current_number + 2;
            $this->final_number = $item->final_number;
            $this->number_digits = (int) $item->number_digits;
            $this->name_document = $item->description;
            if($this->number <= $item->final_number){
                $this->number_format = str_pad($this->number, $this->number_digits, "0", STR_PAD_LEFT);
            }

            if($this->number_return <= $item->final_number){
                $this->number_return_format = str_pad($this->number_return, $this->number_digits, "0", STR_PAD_LEFT);
            }
        }
    }

    public function getDataAddressee(){
        $data = SerLoadOrderDetail::where('ser_load_order_details.load_order_id','=', $this->loadorder_id)
            ->join('ser_odt_requests','ser_load_order_details.odt_request_id','ser_odt_requests.id')
            ->join('customers','ser_odt_requests.customer_id','customers.id')
            ->join('people','customers.person_id','people.id')
            ->join('ser_locals','ser_odt_requests.local_id','ser_locals.id')
            ->select(
                'people.full_name AS business_name',
                'people.number AS ruc_bussines',
                'ser_locals.name AS name_local',
                'ser_locals.address AS arrival_point'
            )->get();

        $this->starting_point = $this->address_bussines;
        $this->arrival_point_r = $this->address_bussines;

        foreach ($data as $row){
            $this->business_name_d = $row->business_name;
            $this->ruc_d = $row->ruc_bussines;
            $this->arrival_point = $row->arrival_point;
            $this->starting_point_r = $row->arrival_point;
            break;
        }
    }

    public function getLoadOrderDetails(){
        $loadorderdetailsparts = InvItemPart::join('inv_items AS part','inv_item_parts.part_id','part.id')
            ->join('inv_items AS asset','inv_item_parts.item_id','asset.id')
            ->join('inv_categories','asset.category_id','inv_categories.id')
            ->join('ser_load_order_details','asset.id','ser_load_order_details.item_id')
            ->join('inv_unit_measures','part.unit_measure_id','inv_unit_measures.id')
            ->select(
                'part.id AS code',
                'inv_categories.description AS category_name',
                'asset.name AS asset_name',
                'inv_unit_measures.abbreviation AS unit',
                'asset.description AS asset_description',
                'part.name AS part_name',
                'inv_item_parts.quantity',
                'ser_load_order_details.load_order_id'
            )
            ->where('ser_load_order_details.load_order_id', $this->loadorder_id)
            ->where('inv_item_parts.show_guides',true)
            ->get();

        $loadorderdetailsasset = SerLoadOrderDetail::join('inv_items','ser_load_order_details.item_id','inv_items.id')
            ->join('inv_categories','inv_items.category_id','inv_categories.id')
            ->join('inv_unit_measures','inv_items.unit_measure_id','inv_unit_measures.id')
            ->select(
                'inv_items.id AS code',
                'inv_categories.description AS category_name',
                'inv_items.name AS asset_name',
                'inv_unit_measures.abbreviation AS unit',
                'inv_items.description AS asset_description',
                'inv_items.name AS part_name',
                'ser_load_order_details.amount AS quantity',
                'ser_load_order_details.load_order_id'
            )
            ->where('ser_load_order_details.load_order_id', $this->loadorder_id)
            ->whereNotExists(function ($query) {
                $query->select(DB::raw(1))
                      ->from('inv_item_parts')
                      ->whereColumn('inv_item_parts.item_id', 'inv_items.id');
            })
            ->get();

        $t = 0;    
        foreach($loadorderdetailsparts as $k => $row){

            $assets = InvAsset::where('item_id',$row->code)->select('id','patrimonial_code')->get();
            $codes = SerLoadOrderDetailAsset::where('load_order_id',$row->load_order_id)->pluck('asset_id');

            $this->loadorderdetails[$k] = [
                'code'                  => $row->code,
                'category_name'         => $row->category_name,
                'asset_name'            => $row->asset_name,
                'unit'                  => $row->unit,
                'asset_description'     => $row->asset_description,
                'part_name'             => $row->part_name,
                'quantity'              => $row->quantity,
                'assets'                => $assets ? $assets->toArray() : [],
                'codes'                 => $codes ? $codes->toArray() : []
            ];
            $t = $k;
        }

        foreach($loadorderdetailsasset as $row){
            $t = $t + 1;

            $assets = InvAsset::where('item_id',$row->code)->select('id','patrimonial_code')->get();
            $codes = SerLoadOrderDetailAsset::where('load_order_id',$row->load_order_id)->pluck('asset_id');

            $this->loadorderdetails[$t] = [
                'code'                  => $row->code,
                'category_name'         => $row->category_name,
                'asset_name'            => $row->asset_name,
                'unit'                  => $row->unit,
                'asset_description'     => $row->asset_description,
                'part_name'             => $row->part_name,
                'quantity'              => $row->quantity,
                'assets'                => $assets ? $assets->toArray() : [],
                'codes'                 => $codes ? $codes->toArray() : []
            ];
        }

        //$this->dispatchBrowserEvent('ser-load-order-select-assets', ['success' => true]);
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

    public function saveExit(){
        $this->getSerie();
        $result = 'OK';
        if($this->shipping_date == '' || $this->vehicle_id_r == ""){
            $result = 'ERROR';
            $message = Lang::get('transferservice::messages.msg_0014');
        }else{
            $data_exist = SerGuide::where('loadorder_id','=', $this->loadorder_id)
                ->where('guide_type', '=', 'S')
                ->get();
            if(count($data_exist) == 0) {
                //Guide Exit
                $save_guide_exit = SerGuide::create([
                    'loadorder_id' => $this->loadorder_id,
                    'name_document' => $this->name_document,
                    'serie' => $this->serie,
                    'guide_type' => 'S',
                    'number' => $this->number_format,
                    'date_of_issue' => $this->date_of_issue_d,
                    'addressee' => $this->business_name_d,
                    'document_number' => $this->ruc_d,
                    'shipping_type' => $this->shipping_type,
                    'shipping_date' => $this->shipping_date_f,
                    'total_gross_weight' => $this->total_gross_weight,
                    'number_of_packages' => $this->number_of_packages,
                    'starting_point' => $this->starting_point,
                    'arrival_point' => $this->arrival_point,
                    'type_of_transport' => $this->type_of_transport,
                    'license_plate' => $this->license_plate,
                    'carrier' => $this->carrier,
                    'document_carrier' => $this->document_carrier,
                    'person_create' => Auth::user()->person_id
                ]);

                //Save Detail
                $this->getLoadOrderDetails();
                
                foreach ($this->loadorderdetails as $row) {
                    SerGuideDetail::create([
                        'guide_id' => $save_guide_exit->id,
                        'quantity' => $row['quantity'],
                        'unit' => $row['unit'],
                        'code' => str_pad($row['code'], 6, '0', STR_PAD_LEFT),
                        'description' => $row['asset_name'] . ' - ' . $row['part_name'],
                        'person_create' => Auth::user()->person_id
                    ]);
                }
                //Guide Entry
                $save_guide_entry = SerGuide::create([
                    'loadorder_id' => $this->loadorder_id,
                    'name_document' => $this->name_document,
                    'serie' => $this->serie,
                    'guide_type' => 'I',
                    'number' => $this->number_return_format,
                    'date_of_issue' => $this->date_of_issue_d,
                    'addressee' => $this->business_name_d,
                    'document_number' => $this->ruc_d,
                    'shipping_type' => $this->shipping_type,
                    'shipping_date' => $this->shipping_date_f,
                    'total_gross_weight' => $this->total_gross_weight,
                    'number_of_packages' => $this->number_of_packages,
                    'starting_point' => $this->starting_point_r,
                    'arrival_point' => $this->arrival_point_r,
                    'type_of_transport' => $this->type_of_transport,
                    'license_plate' => $this->license_plate_r,
                    'carrier' => $this->carrier_r,
                    'document_carrier' => $this->document_carrier_r,
                    'person_create' => Auth::user()->person_id
                ]);

                //Save Detail
                $this->getLoadOrderDetails();
                foreach ($this->loadorderdetails as $row) {
                    SerGuideDetail::create([
                        'guide_id' => $save_guide_entry->id,
                        'quantity' => $row['quantity'],
                        'unit' => $row['unit'],
                        'code' => str_pad($row['code'], 6, '0', STR_PAD_LEFT),
                        'description' => $row['asset_name'] . ' - ' . $row['part_name'],
                        'person_create' => Auth::user()->person_id
                    ]);
                }

                //Save number serie:
                $serie_edit = SerSerie::find($this->id_serie_search);
                $serie_edit->update([
                    'current_number'        => (int) $this->number_return_format,
                    'person_edit'           => Auth::user()->person_id
                ]);
                //end guides
                $message = Lang::get('transferservice::messages.msg_success');
            }else{
                $result = 'ERROR';
                $message = Lang::get('transferservice::messages.msg_0015');
            }
        }
        $this->dispatchBrowserEvent('ser-guide-save', ['result'=> $result, 'msg' => $message]);
    }

    public function deleteGuideExit($id){
        $guideExit = SerGuide::find($id);
        $guideDetail = SerGuideDetail::where('guide_id', '=', $id)->get();
        foreach ($guideDetail as $key=>$row){
            SerGuideDetail::find($row->id)->delete();
        }
        $guideExit->delete();
        $this->id_guide_exit = '';
        //Eliminado la guia de retorno:
        $guideEntry = SerGuide::find($this->id_guide_entry);
        $guideDetailEntry = SerGuideDetail::where('guide_id', '=', $this->id_guide_entry)->get();
        foreach ($guideDetailEntry as $key=>$row){
            SerGuideDetail::find($row->id)->delete();
        }
        $guideEntry->delete();
        $this->id_guide_entry = '';
        $this->dispatchBrowserEvent('ser-guide-delete', ['msg' => Lang::get('transferservice::messages.msg_delete')]);
    }
}
