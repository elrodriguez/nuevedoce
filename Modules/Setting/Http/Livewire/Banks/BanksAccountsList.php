<?php

namespace Modules\Setting\Http\Livewire\Banks;

use App\Models\BankAccount;
use Livewire\Component;
use Livewire\WithPagination;

class BanksAccountsList extends Component
{
    public $show;
    public $search;

    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    
    public function mount(){
        $this->show = 10;
    }
    public function bankAccountsSearch()
    {
        $this->resetPage();
    }
    
    public function render()
    {
        return view('setting::livewire.banks.banks-accounts-list',['accounts' => $this->getAccounts()]);
    }

    public function getAccounts(){
        return BankAccount::paginate($this->show);
    }

    public function deletebankaccount($id){
        try {
            BankAccount::find($id)->delete();
            $res = 'success';
        } catch (\Illuminate\Database\QueryException $e) {
            $res = 'error';
        }
        $this->dispatchBrowserEvent('set-brand-account-delete', ['res' => $res]);
    }
}
