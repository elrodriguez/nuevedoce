<?php

namespace Modules\Sales\Http\Livewire\Document;

use App\Models\DocumentType;
use Livewire\Component;
use Modules\Sales\Entities\SalDocument;
use Modules\Setting\Entities\SetCompany;

class DocumentSearch extends Component
{
    public $company;
    public $document_type_id;
    public $document_types = [];
    public $serie;
    public $number;
    public $date_of_issue;
    public $customer_number;
    public $total;
    private $document;
    public $filename = 0;

    public function mount(){
        $this->company = SetCompany::where('main',true)->first();
        $this->document_types = DocumentType::whereIn('id',['01','03','07','08'])->get();
    }

    public function render()
    {
        return view('sales::livewire.document.document-search');
    }
    public function search(){
        list($d,$m,$y) = explode('/',$this->date_of_issue);
        $date_of_issue = $y.'-'.$m.'-'.$d;
        $this->document = SalDocument::join('people','customer_id','people.id')
            ->where('sal_documents.series',$this->serie)
            ->where('sal_documents.number',$this->number)
            ->where('sal_documents.document_type_id',$this->document_type_id)
            ->where('sal_documents.total',$this->total)
            ->where('people.number',$this->customer_number)
            ->where('sal_documents.date_of_issue',$date_of_issue)
            ->first();
        if($this->document){
            $this->filename = $this->document->filename;
            $this->dispatchBrowserEvent('sal-response_success_document_modal', ['success' => true]);
        }else{
            $this->dispatchBrowserEvent('sal-response_success_document_search', ['message' => 'No se encontró documento']);
        }
    }

}
