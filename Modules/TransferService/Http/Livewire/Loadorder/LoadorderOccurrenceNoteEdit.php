<?php

namespace Modules\TransferService\Http\Livewire\Loadorder;

use Livewire\Component;
use Modules\TransferService\Entities\SerNoteOccurrence;
use Elrod\UserActivity\Activity;
use Illuminate\Support\Facades\Lang;
use Modules\TransferService\Entities\SerLoadOrderDetail;
use Modules\TransferService\Entities\SerNoteOccurrenceItem;
use Illuminate\Support\Facades\Auth;

class LoadorderOccurrenceNoteEdit extends Component
{
    public $oc_id;
    public $no_id;
    public $occurrence;
    public $number;
    public $description;
    public $items = [];
    public $ocurrence_types;
    public $missing;

    public function mount($oc_id, $no_id){

        $this->oc_id = $oc_id;
        $this->no_id = $no_id;
        $this->occurrence = SerNoteOccurrence::find($no_id);

        $this->number = $this->occurrence->id;
        $this->description = $this->occurrence->additional_information;

        $this->getItems();

        $this->ocurrence_types = getEnumValues('ser_note_occurrence_items','ocurrence_type');
    }

    public function render()
    {
        return view('transferservice::livewire.loadorder.loadorder-occurrence-note-edit');
    }

    public function save(){
        $this->validate([
            'number' => 'required|unique:ser_note_occurrences,id,'.$this->no_id.'|max:10',
            'description' => 'required|max:500'
        ]);
        $c = 0;
        foreach($this->items as $key => $row){
            if($row['edit']){
                $c++;
            }
        }
        if($c>0){
            $this->occurrence->update([
                'person_edit'             => Auth::user()->person_id,
                'additional_information'    => $this->description
            ]);

            SerNoteOccurrenceItem::where('note_occurrence_id',$this->no_id)->delete();

            foreach($this->items as $key => $row){
                if($row['edit']){
                    $this->validate([
                        'items.'.$key.'.ocurrence_type'    => 'required',
                        'items.'.$key.'.quantity'          => 'required|numeric',
                        'items.'.$key.'.description'       => 'required'
                    ]);
                    SerNoteOccurrenceItem::create([
                        'ocurrence_type'        => $row['ocurrence_type'],
                        'note_occurrence_id'    => $this->no_id,
                        'item_id'               => $row['id'],
                        'quantity'              => $row['quantity'],
                        'description'           => $row['description']
                    ]);
                }
            }
            $activity = new Activity;
            $activity->modelOn(SerNoteOccurrence::class, $this->no_id,'ser_note_occurrences');
            $activity->causedBy(Auth::user());
            $activity->routeOn(route('service_load_order_ocurrencenote_edit',[$this->oc_id,$this->no_id]));
            $activity->logType('create');
            $activity->log('Se edito nota de ocurrencias');
            $activity->save();

            $this->description = null;
            $this->getItems();
            $this->dispatchBrowserEvent('ser-load-order-note-occurrence-create', ['msg' => Lang::get('labels.was_successfully_updated')]);
        
        }else{
            $this->dispatchBrowserEvent('ser-load-order-note-occurrence-error', ['msg' => Lang::get('transferservice::labels.lbl_it_is_necessary_to_mark_the_missing_items')]);
        }
        
    }

    public function getItems(){
        $note_id = $this->no_id;
        $items = SerLoadOrderDetail::join('inv_items AS active','ser_load_order_details.item_id','active.id')
                    ->join('inv_item_parts','inv_item_parts.item_id','active.id')
                    ->join('inv_items AS part','inv_item_parts.part_id','part.id')
                    ->select(
                        'part.name',
                        'part.id'
                    )
                    ->selectSub(function($query) use ($note_id) {
                        $query->from('ser_note_occurrence_items')
                            ->select('ser_note_occurrence_items.description')
                            ->whereColumn('ser_note_occurrence_items.item_id','part.id')
                            ->where('ser_note_occurrence_items.note_occurrence_id', $note_id);
                    }, 'description')
                    ->selectSub(function($query) use ($note_id) {
                        $query->from('ser_note_occurrence_items')
                            ->select('ser_note_occurrence_items.quantity')
                            ->whereColumn('ser_note_occurrence_items.item_id','part.id')
                            ->where('ser_note_occurrence_items.note_occurrence_id', $note_id);
                    }, 'quantity')
                    ->selectSub(function($query) use ($note_id) {
                        $query->from('ser_note_occurrence_items')
                            ->select('ser_note_occurrence_items.ocurrence_type')
                            ->whereColumn('ser_note_occurrence_items.item_id','part.id')
                            ->where('ser_note_occurrence_items.note_occurrence_id', $note_id);
                    }, 'ocurrence_type')
                    ->where('load_order_id',$this->oc_id)
                    ->get();

        foreach($items as $k => $item){
            $this->items[$k] = [
                'edit'          => ($item->quantity ? true : false),
                'id'            => $item->id,
                'name'          => $item->name,
                'description'   => $item->description,
                'quantity'      => $item->quantity,
                'ocurrence_type'=> $item->ocurrence_type
            ];
        }
    }
}
