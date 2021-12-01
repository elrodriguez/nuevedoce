<?php

namespace Modules\Staff\Http\Livewire\Companies;

use Livewire\Component;
use Illuminate\Support\Facades\Lang;
use App\Models\Person;

class CompaniesSearch extends Component
{
    public $person_search;
    public $number_search;

    public function render()
    {
        return view('staff::livewire.companies.companies-search');
    }

    public function searchPerson(){
        $this->validate([
            'number_search' => 'required|numeric|min:11'
        ]);
        $this->person_search = Person::where('number',$this->number_search)->get();
        $encuentra = '';
        foreach ($this->person_search as $key => $personSearch){
            $encuentra = $personSearch->id;
        }
        if($encuentra == ''){
            $this->dispatchBrowserEvent('per-companies-search_a', ['msg' => Lang::get('staff::labels.msg_search_company_not'), 'numberPerson' => $this->number_search]);
        }else{
            $this->dispatchBrowserEvent('per-companies-search_b', ['msg' => Lang::get('staff::labels.msg_search_company_ok'), 'personId' => $encuentra]);
        }
    }
}
