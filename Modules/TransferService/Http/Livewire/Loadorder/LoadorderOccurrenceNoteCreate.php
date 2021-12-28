<?php

namespace Modules\TransferService\Http\Livewire\Loadorder;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Modules\TransferService\Entities\SerNoteOccurrence;
use Elrod\UserActivity\Activity;
use Illuminate\Support\Facades\Lang;
use Modules\TransferService\Entities\SerLoadOrderDetail;
use Modules\TransferService\Entities\SerNoteOccurrenceItem;

class LoadorderOccurrenceNoteCreate extends Component
{
    public $oc_id;
    public $number;
    public $description;
    public $items = [];
    public $ocurrence_types;

    public function mount($oc_id){
        $this->oc_id = $oc_id;
        $this->getItems();

        $this->ocurrence_types = getEnumValues('ser_note_occurrence_items','ocurrence_type');
    }

    public function render()
    {
        $number = SerNoteOccurrence::where('year_created',date('Y'))->max('id');

        $this->number = $number ? ($number + 1) : date('Y').str_pad(1, 6, "0", STR_PAD_LEFT);

        return view('transferservice::livewire.loadorder.loadorder-occurrence-note-create');
    }

    public function save(){
        $this->validate([
            'number' => 'required|unique:ser_note_occurrences,id|max:10',
            'description' => 'required|max:500'
        ]);
        $c = 0;
        foreach($this->items as $key => $row){
            if($row['edit']){
                $c++;
            }
        }
        if($c>0){
            $note = SerNoteOccurrence::create([
                'id'                        => $this->number,
                'year_created'              => date('Y'),
                'person_create'             => Auth::user()->person_id,
                'load_order_id'             => $this->oc_id,
                'additional_information'    => $this->description
            ]);
    
            foreach($this->items as $key => $row){
                if($row['edit']){
                    $this->validate([
                        'items.'.$key.'.ocurrence_type'    => 'required',
                        'items.'.$key.'.quantity'          => 'required|numeric',
                        'items.'.$key.'.description'       => 'required'
                    ]);
                    SerNoteOccurrenceItem::create([
                        'ocurrence_type'        => $row['ocurrence_type'],
                        'note_occurrence_id'    => $note->id,
                        'item_id'               => $row['id'],
                        'quantity'              => $row['quantity'],
                        'description'           => $row['description']
                    ]);
                }
            }
            $activity = new Activity;
            $activity->modelOn(SerNoteOccurrence::class, $note->id,'ser_note_occurrences');
            $activity->causedBy(Auth::user());
            $activity->routeOn(route('service_load_order_ocurrencenote_create',$this->oc_id));
            $activity->logType('create');
            $activity->log('Se creó una nueva nota de ocurrencias');
            $activity->save();

            $this->description = null;
            $this->getItems();
            $this->dispatchBrowserEvent('ser-load-order-note-occurrence-create', ['msg' => Lang::get('labels.successfully_registered')]);
        
        }else{
            $this->dispatchBrowserEvent('ser-load-order-note-occurrence-error', ['msg' => Lang::get('transferservice::labels.lbl_it_is_necessary_to_mark_the_missing_items')]);
        }
        
    }

    public function getItems(){

        $items = SerLoadOrderDetail::join('inv_items AS active','ser_load_order_details.item_id','active.id')
                    ->join('inv_item_parts','inv_item_parts.item_id','active.id')
                    ->join('inv_items AS part','inv_item_parts.part_id','part.id')
                    ->select(
                        'part.name',
                        'part.id'
                    )
                    ->where('load_order_id',$this->oc_id)
                    ->get();

        foreach($items as $k => $item){
            $this->items[$k] = [
                'edit'          => false,
                'id'            => $item->id,
                'name'          => $item->name,
                'description'   => null,
                'quantity'      => 0,
                'ocurrence_type'=> null
            ];
        }
    }
}
