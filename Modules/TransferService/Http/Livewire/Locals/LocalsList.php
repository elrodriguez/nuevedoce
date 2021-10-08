<?php

namespace Modules\TransferService\Http\Livewire\Locals;

use Livewire\Component;
use Livewire\WithPagination;
use Modules\TransferService\Entities\SerLocal;
use Illuminate\Support\Facades\Lang;

class LocalsList extends Component
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
        return view('transferservice::livewire.locals.locals-list', ['locals' => $this->getLocals()]);
    }

    public function getLocals(){
        return SerLocal::where('name','like','%'.$this->search.'%')->paginate($this->show);
    }

    public function localsSearch()
    {
        $this->resetPage();
    }

    public function deleteLocal($id){
        SerLocal::find($id)->delete();

        $this->dispatchBrowserEvent('ser-locals-delete', ['msg' => Lang::get('transferservice::messages.msg_delete')]);
    }
}
