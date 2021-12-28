<?php

namespace Modules\TransferService\Http\Livewire\Loadorder;

use Livewire\Component;
use Modules\TransferService\Entities\SerNoteOccurrence;
use Elrod\UserActivity\Activity;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Auth;

class LoadorderOccurrenceNote extends Component
{
    public $oc_id;
    public $noteoccurrences = [];

    public function mount($oc_id){
        $this->oc_id = $oc_id;
    }

    public function render()
    {
        $this->getData();
        return view('transferservice::livewire.loadorder.loadorder-occurrence-note');
    }

    public function getData(){
        $this->noteoccurrences = SerNoteOccurrence::where('load_order_id',$this->oc_id)->get();
    }

    public function deleteNote($id){

        $establishment = SerNoteOccurrence::find($id);
        
        $activity = new activity;
        $activity->log('Elimino la establecimiento');
        $activity->modelOn(SetEstablishment::class,$id,'set_establishments');
        $activity->dataOld($establishment); 
        $activity->logType('delete');
        $activity->causedBy(Auth::user());
        $activity->save();

        $establishment->delete();

        $this->dispatchBrowserEvent('ser-load-order-note-occurrence-delete', ['msg' => Lang::get('labels.was_successfully_removed')]);
       
    }
}
