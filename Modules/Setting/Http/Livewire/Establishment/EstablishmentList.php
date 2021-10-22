<?php

namespace Modules\Setting\Http\Livewire\Establishment;

use Livewire\Component;
use Livewire\WithPagination;
use Modules\Setting\Entities\SetEstablishment;
use Elrod\UserActivity\Activity;
use Illuminate\Support\Facades\Auth;
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
        $establishment = SetEstablishment::find($id);
        
        $activity = new activity;
        $activity->log('Elimino la establecimiento');
        $activity->modelOn(SetEstablishment::class,$id,'set_establishments');
        $activity->dataOld($establishment); 
        $activity->logType('delete');
        $activity->causedBy(Auth::user());
        $activity->save();

        $establishment->delete();

        $this->dispatchBrowserEvent('set-establishment-delete', ['msg' => 'Datos eliminados correctamente.']);
    }
}
