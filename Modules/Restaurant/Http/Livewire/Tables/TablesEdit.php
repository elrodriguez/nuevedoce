<?php

namespace Modules\Restaurant\Http\Livewire\Tables;

use Illuminate\Support\Facades\Lang;
use Livewire\Component;
use Modules\Restaurant\Entities\RestFloor;
use Modules\Restaurant\Entities\RestTable;

class TablesEdit extends Component
{
    public $description;
    public $name;
    public $state = true;
    public $floor_id;
    public $chairs = 2;
    public $occupied = false;

    public $floors = [];

    protected $listeners = ['getFloorRefreshEdit' => 'getFloor'];

    public function mount($table_id)
    {
        $this->getFloor();

        $this->floors = RestFloor::where('state', true)->get();

        $this->table = RestTable::find($table_id);

        $this->floor_id = $this->table->floor_id;
        $this->name = $this->table->name;
        $this->description = $this->table->description;
        $this->chairs = $this->table->chairs;
        $this->occupied = $this->table->occupied;
        $this->state = $this->table->active;
    }

    public function getFloor()
    {
        $this->floors = RestFloor::where('state', true)->get();
    }

    public function render()
    {
        return view('restaurant::livewire.tables.tables-edit');
    }
    public function update()
    {
        $this->validate([
            'name' => 'required|max:255',
            'floor_id' => 'required',
            'chairs' => 'required|numeric',
        ]);

        $this->table->update([
            'floor_id' => $this->floor_id,
            'name' => $this->name,
            'description' => $this->description,
            'chairs' => $this->chairs,
            'occupied' => $this->occupied ? true : false,
            'active' => $this->state ? true : false
        ]);

        $this->dispatchBrowserEvent('set-tables-update', ['msg' => Lang::get('labels.was_successfully_updated')]);
    }
}
