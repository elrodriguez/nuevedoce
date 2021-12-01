<?php

namespace Modules\Staff\Http\Livewire\Companies;

use Elrod\UserActivity\Activity;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Person;
use Illuminate\Support\Facades\Lang;

class CompaniesList extends Component
{
    public $show;
    public $search;
    public $doc_ruc = '6';

    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public function render()
    {
        return view('staff::livewire.companies.companies-list', ['companies' => $this->getCompanies()]);
    }

    public function getCompanies(){
        return Person::where('identity_document_type_id', '=', $this->doc_ruc)->where('full_name','like','%'.$this->search.'%')
            ->join('identity_document_types', 'identity_document_type_id', 'identity_document_types.id')
            ->join('sta_person_types', 'type_person_id', 'sta_person_types.id')
            ->select(
                'people.id',
                'people.full_name',
                'people.identity_document_type_id',
                'identity_document_types.description AS name_document_type',
                'people.number',
                'people.telephone',
                'people.email',
                'people.type_person_id',
                'sta_person_types.name AS name_type_person'
            )
            ->paginate($this->show);
    }

    public function people(){
        return $this->hasOne(Person::class); #belongsTo
    }

    public function companiesSearch()
    {
        $this->resetPage();
    }

    public function deleteCompany($id){
        $people = Person::find($id);

        $activity = new activity;
        $activity->log('Se eliminó la Empresa');
        $activity->modelOn(Person::class,$id,'people');
        $activity->dataOld($people);
        $activity->logType('delete');
        $activity->causedBy(Auth::user());
        $activity->save();

        $people->delete();

        $this->dispatchBrowserEvent('per-companies-delete', ['msg' => Lang::get('staff::labels.msg_delete')]);
    }
}
