<?php

namespace Modules\Setting\Http\Livewire\Modules;

use Illuminate\Support\Facades\Lang;
use Livewire\Component;
use Modules\Setting\Entities\SetModule;
use Illuminate\Support\Str;

class ModuleCreate extends Component
{
    public $logo;
    public $label;
    public $destination_route;
    public $status = true;
    public $xuuid;

    protected $listeners = ['iconAdded' => 'selecticon'];

    public function render()
    {
        return view('setting::livewire.modules.module-create');
    }

    public function save()
    {
        $this->validate([
            'logo'              => 'required',
            'label'             => 'required|max:255',
            'destination_route' => 'required|max:255',
            'xuuid'             => 'required|max:10|unique:set_modules,uuid'
        ]);

        SetModule::create([
            'uuid' => $this->xuuid,
            'logo' => $this->logo,
            'label' => $this->label,
            'destination_route' => $this->destination_route,
            'status' => $this->status
        ]);

        $this->clearForm();
        $this->dispatchBrowserEvent('set-modules-save', ['msg' => Lang::get('setting::labels.msg_success')]);
    }

    public function selecticon($icon)
    {
        $this->logo = $icon;
    }

    public function clearForm()
    {
        $this->xuuid = null;
        $this->logo = null;
        $this->label = null;
        $this->destination_route = null;
        $this->status = true;
    }
}
