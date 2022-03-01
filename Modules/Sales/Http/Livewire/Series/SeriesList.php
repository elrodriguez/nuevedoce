<?php

namespace Modules\Sales\Http\Livewire\Series;

use Livewire\Component;
use Livewire\WithPagination;
use Modules\Sales\Entities\SalSerie;

class SeriesList extends Component
{
    public $show;
    public $search;

    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public function mount(){
        $this->show = 10;
    }

    public function render()
    {
        return view('sales::livewire.series.series-list',['series' => $this->getSeries()]);
    }

    public function seriesSearch()
    {
        $this->resetPage();
    }

    public function getSeries(){
        return SalSerie::join('document_types','document_type_id','document_types.id')
            ->join('set_establishments','establishment_id','set_establishments.id')
            ->select(
                'sal_series.id',
                'sal_series.correlative',
                'sal_series.state',
                'document_types.description',
                'set_establishments.name'
            )
            ->where('sal_series.id','like','%'.$this->search.'%')
            ->paginate($this->show);
    }

    public function deleteserie($id){
        try {
            SalSerie::where('id',$id)->delete();
            $res = 'success';
        } catch (\Illuminate\Database\QueryException $e) {
            $res = 'error';
        }
        $this->dispatchBrowserEvent('set-brand-delete', ['res' => $res]);
    }
}
