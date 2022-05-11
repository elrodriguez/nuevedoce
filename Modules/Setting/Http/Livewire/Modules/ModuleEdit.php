<?php

namespace Modules\Setting\Http\Livewire\Modules;

use Livewire\Component;
use Modules\Setting\Entities\SetModule;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Str;
use Elrod\UserActivity\Activity;
use Illuminate\Support\Facades\Auth;

class ModuleEdit extends Component
{
    public $module;
    public $logo;
    public $label;
    public $destination_route;
    public $status;
    public $xuuid;

    protected $listeners = ['iconAdded' => 'selecticon'];

    public function mount($module_id)
    {
        $this->module = SetModule::find($module_id);
        $this->logo = $this->module->logo;
        $this->label = $this->module->label;
        $this->destination_route = $this->module->destination_route;
        $this->status = $this->module->status;
        $this->xuuid = $this->module->uuid;
    }

    public function render()
    {
        return view('setting::livewire.modules.module-edit');
    }
    public function save()
    {
        $this->validate([
            'logo' => 'required',
            'label' => 'required|max:255',
            'destination_route' => 'required|max:255',
            'xuuid' => 'required|max:10|unique:set_modules,uuid,' . $this->module->id
        ]);

        $activity = new Activity;
        $activity->dataOld(SetModule::find($this->module->id));

        $this->module->update([
            'logo' => $this->logo,
            'label' => $this->label,
            'destination_route' => $this->destination_route,
            'status' => $this->status
        ]);

        $activity->modelOn(SetModule::class, $this->module->id, 'set_modules');
        $activity->causedBy(Auth::user());
        $activity->routeOn(route('setting_modules_edit', $this->module->id));
        $activity->logType('edit');
        $activity->dataUpdated($this->module);
        $activity->log('se actualizo datos del modulo');
        $activity->save();

        $this->dispatchBrowserEvent('set-modules-save', ['msg' => Lang::get('setting::labels.msg_update')]);
    }

    public function selecticon($icon)
    {
        $this->logo = $icon;
    }
}
