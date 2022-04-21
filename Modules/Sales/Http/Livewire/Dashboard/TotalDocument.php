<?php

namespace Modules\Sales\Http\Livewire\Dashboard;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Modules\Sales\Entities\SalDocument;
use Modules\Sales\Entities\SalSaleNote;

class TotalDocument extends Component
{
    public $xtotal;
    public $data_pie = [];
    public $date_start;
    public $date_end;

    public function mount(){
        $this->date_start = SalDocument::min('date_of_issue');
        $this->date_end = SalDocument::max('date_of_issue');
    }

    public function render()
    {
        $this->getDocuments();
        return view('sales::livewire.dashboard.total-document');
    }

    public function getDocuments(){
        $user = User::find(Auth::id());
        $role = $user->getRoleNames();
        $roles = array('Administrador','Gerente','TI');
        $bool = in_array($role, $roles);
        $user_id = Auth::id();

        $vouchers = SalDocument::join('document_types','document_type_id','document_types.id')
                    ->selectRaw('
                        sal_documents.document_type_id,
                        document_types.description,
                        COUNT(document_type_id) as total
                    ')
                    ->when($bool == false, function ($query) use ($user_id){
                        return $query->where('sal_documents.user_id', $user_id);
                    })
                    ->groupBy(['sal_documents.document_type_id','document_types.description'])
                    ->orderBy('document_types.description')
                    ->get();

        $sale_notes = SalSaleNote::select(
                        DB::raw('"80" AS document_type_id'),
                        DB::raw('"NOTA DE VENTA" AS description'),
                        DB::raw('COUNT(id) as total')
                    )
                    ->when($bool == false, function ($query) use ($user_id){
                        return $query->where('sal_sale_notes.user_id', $user_id);
                    })
                    ->get();

        $dataSetPie = [];

        $color = array(
            '01' => '#886ab5',
            '03' => '#2196f3',
            '07' => '#ffc241',
            '08' => '#fd3995',
            '09' => '#1dc9b7',
            '20' => '#5d5d5d',
            '31' => '#563d7c',
            '40' => '#0960a5',
            '71' => '#da9400',
            '72' => '#ce0262',
            'GU75' => '#107066',
            'NE76' => '#1d1d1d',
            '80' => '#909090'
        );
        $dataSetPie = [];
        if(count($vouchers) > 0 && count($sale_notes) > 0){
            $vs = $vouchers->toArray();
            $nv = $sale_notes->toArray();

            $array = array_merge($vs, $nv);
            foreach($array as $k => $row){
                $this->xtotal = $this->xtotal + $row['total'];
            }
            foreach($array as $k => $row){
                $dataSetPie[$k] = [
                    'label'=> $row['description'],
                    'data' => ($row['total']/$this->xtotal) * 100,
                    'color' => $color[$row['document_type_id']]
                ];
            }
        }
        $this->data_pie = $dataSetPie;

    }
}
