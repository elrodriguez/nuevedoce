<?php

namespace Modules\Sales\Http\Livewire\Dashboard;

use Livewire\Component;
use Modules\Sales\Entities\SalSerie;

class Series extends Component
{
    public $series = [];

    public function mount(){
        $this->getSeries();
    }
    public function render()
    {
        return view('sales::livewire.dashboard.series');
    }

    public function getSeries(){
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

        $series = SalSerie::join('document_types','document_type_id','document_types.id')
            ->select(
                'sal_series.id',
                'sal_series.correlative',
                'document_types.description',
                'sal_series.document_type_id'
            )
            ->get();

        if($series){
            foreach($series->toArray() as $k => $row){
                $this->series[$k] = [
                    'id'=> $row['id'],
                    'correlative' => $row['correlative'],
                    'description' => $row['description'],
                    'color' => $color[$row['document_type_id']]
                ];
            }
        }

    }
}
