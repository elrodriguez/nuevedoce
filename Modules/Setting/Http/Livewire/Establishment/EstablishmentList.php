<?php

namespace Modules\Setting\Http\Livewire\Establishment;

use Livewire\Component;
use Livewire\WithPagination;
use Modules\Setting\Entities\SetEstablishment;

class EstablishmentList extends Component
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
        return view('setting::livewire.establishment.establishment-list',['establishments' => $this->getEstablishment()]);
    }

    public function getEstablishment(){
        return SetEstablishment::where('address','like','%'.$this->search.'%')->paginate($this->show);
    }

    public function establishmentSearch()
    {
        $this->resetPage();
    }

    public function deleteEstablishment($id){
        
        SetEstablishment::find($id)->delete();

        $this->dispatchBrowserEvent('set-establishment-delete', ['msg' => 'Datos eliminados correctamente.']);
    }
}
