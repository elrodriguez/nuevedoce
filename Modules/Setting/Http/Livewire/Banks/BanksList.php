<?php

namespace Modules\Setting\Http\Livewire\Banks;

use App\Models\Bank;
use Livewire\Component;
use Livewire\WithPagination;

class BanksList extends Component
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
        return view('setting::livewire.banks.banks-list',['banks'=>$this->getBanks()]);
    }

    public function bankSearch()
    {
        $this->resetPage();
    }

    public function getBanks(){
        return Bank::where('description','like','%'.$this->search.'%')
            ->paginate($this->show);
    }

    public function deletebank($id){
        try {
            Bank::find($id)->delete();
            $res = 'success';
        } catch (\Illuminate\Database\QueryException $e) {
            $res = 'error';
        }
        $this->dispatchBrowserEvent('set-bank-delete', ['res' => $res]);
    }
}
