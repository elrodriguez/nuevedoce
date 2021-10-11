<?php

namespace Modules\Setting\Http\Livewire\Modules;

use Illuminate\Support\Facades\Lang;
use Livewire\Component;
use Livewire\WithPagination;
use Modules\Setting\Entities\SetModule;
use Elrod\UserActivity\Activity;
use Illuminate\Support\Facades\Auth;
class ModuleList extends Component
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
        return view('setting::livewire.modules.module-list',['modules' => $this->getModules()]);
    }

    public function getModules(){
        return SetModule::where('label','like','%'.$this->search.'%')->paginate($this->show);
    }

    public function moduleSearch()
    {
        $this->resetPage();
    }

    public function deleteModule($id){
        
        $module = SetModule::find($id);

        $activity = new activity;
        $activity->log('Elimino un modulo');
        $activity->modelOn(SetModule::class,$id,'set_modules');
        $activity->dataOld($module); 
        $activity->logType('delete');
        $activity->causedBy(Auth::user());
        $activity->save();

        $module->delete();

        $this->dispatchBrowserEvent('set-module-delete', ['msg' => Lang::get('setting::labels.msg_delete')]);
    }
}
