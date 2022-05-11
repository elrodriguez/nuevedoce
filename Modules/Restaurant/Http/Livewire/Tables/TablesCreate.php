<?php

namespace Modules\Restaurant\Http\Livewire\Tables;

use Illuminate\Support\Facades\Lang;
use Livewire\Component;
use Modules\Restaurant\Entities\RestFloor;
use Modules\Restaurant\Entities\RestTable;

class TablesCreate extends Component
{
    public $description;
    public $name;
    public $state = true;
    public $floor_id;
    public $chairs = 2;
    public $occupied = false;

    public $floors = [];

    protected $listeners = ['getFloorRefreshCreate' => 'getFloor'];

    public function mount()
    {
        $this->getFloor();
    }

    public function getFloor()
    {
        $this->floors = RestFloor::where('state', true)->get();
    }
    public function render()
    {
        return view('restaurant::livewire.tables.tables-create');
    }

    public function save()
    {
        $this->validate([
            'name' => 'required|max:255',
            'floor_id' => 'required',
            'chairs' => 'required|numeric',
        ]);

        RestTable::create([
            'floor_id' => $this->floor_id,
            'name' => $this->name,
            'description' => $this->description,
            'chairs' => $this->chairs,
            'occupied' => $this->occupied ? true : false,
            'active' => $this->state ? true : false
        ]);

        $this->floor_id = null;
        $this->name = null;
        $this->description = null;
        $this->chairs = 2;
        $this->occupied = false;
        $this->state = true;

        $this->dispatchBrowserEvent('set-tables-save', ['msg' => Lang::get('labels.successfully_registered')]);
    }
}
