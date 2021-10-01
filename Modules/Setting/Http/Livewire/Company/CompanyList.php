<?php

namespace Modules\Setting\Http\Livewire\Company;

use Livewire\Component;
use Livewire\WithPagination;
use Modules\Setting\Entities\SetCompany;

class CompanyList extends Component
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
        return view('setting::livewire.company.company-list',['companies' => $this->getCompanies()]);
    }

    public function getCompanies(){
        return SetCompany::where('name','like','%'.$this->search.'%')->paginate($this->show);
    }

    public function companiesSearch()
    {
        $this->resetPage();
    }

    public function deleteCompanies($id){
        try {
            SetCompany::find($id)->delete();
            $res = 'success';
        } catch (\Illuminate\Database\QueryException $e) {
            $res = 'error';
        }
       
        $this->dispatchBrowserEvent('set-company-delete', ['res' => $res]);
    }
}
