<?php

namespace Modules\Sales\Http\Livewire\Document;

use App\Models\DocumentType;
use App\Models\StateType;
use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;
use Elrod\UserActivity\Activity;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Modules\Sales\Entities\SalDocument;

class DocumentList extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';
    public $document_types;
    public $document_type_id;
    public $states;
    public $state_id;
    public $number;
    public $series;
    public $serie_id;
    public $user_id;
    public $users = [];
    public $start_date;
    public $date_end;
    
    protected $listeners = ['refreshDocumentList' => 'searchDocument'];

    public function mount(){
        $userActivity = new Activity;
        $userActivity->causedBy(Auth::user());
        $userActivity->routeOn(route('sales_document_list'));
        $userActivity->componentOn('sales.document.document-list');
        $userActivity->log('ingresó a la vista lista de comprobantes en market');
        $userActivity->save();
    }

    public function render()
    {
        $user = User::find(Auth::id());

        $this->document_types = DocumentType::whereIn('id',['01','03','07','08'])->get();
        $this->states = StateType::all();
        if($user->hasRole(['TI', 'Administrador'])){
            $this->listUsers();
        }else{
            $this->user_id = Auth::id();
        }
        return view('sales::livewire.document.document-list',['collection' => $this->list()]);
    }

    public function list(){
        $user_id = $this->user_id;
        $document_type_id = $this->document_type_id;
        $state_id = $this->state_id;
        $number = $this->number;
        $serie_id = $this->serie_id;
        $start_date = $this->start_date;
        $date_end = $this->date_end;


        return SalDocument::join('state_types','sal_documents.state_type_id','state_types.id')
            ->join('document_types','sal_documents.document_type_id','document_types.id')
            ->select(
                'document_types.description AS document_type_description',
                'sal_documents.id',
                'sal_documents.has_cdr',
                'sal_documents.sunat_shipping_status',
                'external_id',
                DB::raw('CONCAT(DATE_FORMAT(sal_documents.date_of_issue,"%d/%m/%Y")," ",DATE_FORMAT(sal_documents.created_at,"%H:%i:%s")) AS document_date'),
                'customer',
                'series',
                'number',
                'state_types.description',
                'state_type_id',
                'currency_type_id',
                'total_taxed',
                'total_igv',
                'total',
                'filename'
            )
            ->when($user_id, function ($query) use ($user_id) {
                return $query->where('user_id', $user_id);
            })->when($document_type_id, function ($query) use ($document_type_id) {
                return $query->where('document_type_id', $document_type_id);
            })
            ->when($state_id, function ($query) use ($state_id) {
                return $query->where('state_type_id', $state_id);
            })
            ->when($number, function ($query) use ($number) {
                return $query->where('number', $number);
            })
            ->when($serie_id, function ($query) use ($serie_id) {
                return $query->where('series', $serie_id);
            })
            ->when($start_date, function ($query) use ($start_date,$date_end) {
                return $query->whereBetween('date_of_issue', [$start_date, $date_end]);
            })
            ->orderBy('sal_documents.id','DESC')
            ->paginate(10);
    }

    public function searchDocument()
    {
        $userActivity = new Activity;
        $userActivity->causedBy(Auth::user());
        $userActivity->routeOn(route('sales_document_list'));
        $userActivity->componentOn('sales.document.document-list');
        $userActivity->dataOld(request()->all());
        $userActivity->log('realizó una búsqueda, en listado comprobantes');
        $userActivity->save();
        $this->resetPage();
    }

    public function listUsers(){
        $this->users = User::role(['TI','Administrador','Vendedor'])->get();
    }

}
