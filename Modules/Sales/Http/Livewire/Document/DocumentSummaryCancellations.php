<?php

namespace Modules\Sales\Http\Livewire\Document;

use App\Models\Parameter;
use Carbon\Carbon;
use Livewire\Component;
use Modules\Sales\Entities\SalDocument;
use App\CoreBilling\Billing;
use Exception;
use Elrod\UserActivity\Activity;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Modules\Sales\Entities\SalSummary;
use Modules\Setting\Entities\SetCompany;

class DocumentSummaryCancellations extends Component
{
    protected $listeners = ['openModalSummaryCancellations' => 'openSummaryCancellations'];

    public $tevent;
    public $date_summary_search;
    public $date_summary_new;
    public $documents = [];
    public $soap_type_id;
    public $ubl_version;
    public $summaries = [];

    public function mount(){
        $this->soap_type_id = Parameter::where('id_parameter','PRT005SOP')->value('value_default');
        $this->ubl_version = Parameter::where('id_parameter','PRT009VUL')->value('value_default');
    }

    public function render()
    {
        return view('sales::livewire.document.document-summary-cancellations');
    }

    public function openSummaryCancellations(){
        $this->tevent = 'SL';
        $this->date_summary_search = Carbon::now()->format('d/m/Y');
        $this->date_summary_new = Carbon::now()->format('d/m/Y');
        $this->summaries = [];
        $this->documents = [];
        $this->dispatchBrowserEvent('modal-sales-vaucher-summary-cancellations', ['success' => true]);
    }

    public function getDocuments() {

        list($d,$m,$y) = explode('/',$this->date_summary_new);
        $date_of_issue = $y.'-'.$m.'-'.$d;

        $documents = SalDocument::where('date_of_issue', $date_of_issue)
            ->where('soap_type_id', $this->soap_type_id)
            ->where('group_id', '02')
            ->where('state_type_id', '01')
            ->take(500)
            ->get();
        
        if($documents){
            $this->documents = $documents->toArray();
        }else{
            $this->documents = [];
        }

    }

    public function removeDocument($index){
        unset($this->documents[$index]);
    }

    public function save(){
        if($this->tevent == 'SN'){
            $this->generateSummary();
        }
    }

    public function generateSummary(){

        $this->validate([
            'date_summary_new' => 'required'
        ]);

        $company_number = SetCompany::where('main',true)->value('number');

        if(count($this->documents) > 0){
            list($d,$m,$y) = explode('/',$this->date_summary_new);
            $date_of_issue = $y.'-'.$m.'-'.$d;
            $max = SalSummary::whereRaw('YEAR(date_of_issue) = ?',Carbon::now()->format('Y'))->max('identifier');
            $identifier = 'RC-'.Carbon::now()->format('Ymd').'-'.($max ? 1 : $max + 1);
    
            $documents = [];
    
            foreach($this->documents as $k => $item){
                $documents[$k] = [
                    'document_id' => $item['id']
                ];
            }
    
            $imputs = [
                "type" => "summary",
                "route" => "summary",
                "user_id" => Auth::id(),
                "external_id" => Str::uuid()->toString(),
                "soap_type_id" => $this->soap_type_id,
                "state_type_id" => "01",
                "summary_status_type_id" => "1",
                "ubl_version" => $this->ubl_version,
                "date_of_issue" => Carbon::now()->format('Y-m-d'),
                "date_of_reference" => $date_of_issue,
                "identifier" => $identifier,
                "filename" => $company_number."-".$identifier,
                "documents" => $documents
            ];
    
            try {
                $billing = new Billing();
                $billing->save($imputs);
                $billing->createXmlUnsigned();
                $billing->signXmlUnsigned();
                $billing->senderXmlSignedSummary();
          
                $document = $billing->getDocument();
    
                $this->documents = [];
                $this->date_summary_new = Carbon::now()->format('d/m/Y');
    
                $this->dispatchBrowserEvent('sales-summary-create', ['msg' => "El resumen {$document->identifier} fue creado correctamente",]);
                $this->emit('refreshDocumentList');
            } catch (Exception $e) {
                dd($e->getMessage());
            }
        }else{
            $this->dispatchBrowserEvent('sales-summary-not-documents', ['msg' => "No existen comprobantes para enviar"]);
        }
    }

    public function getSummaries(){
        list($d,$m,$y) = explode('/',$this->date_summary_search);
        $date_of_issue = $y.'-'.$m.'-'.$d;
        $this->summaries = SalSummary::where('date_of_issue',$date_of_issue)->get();
    }

    public function checkStatus($id) {

        $document = SalSummary::find($id);

        try {
            $billing = new Billing();
            $billing->setDocument($document);
            $billing->setType('summary');
            $billing->statusSummary($document->ticket);
      
            $response = $billing->getResponse();
            $this->dispatchBrowserEvent('sales-summary-status', ['msg' => $response['description']]);

        } catch (Exception $e) {
            dd($e->getMessage());
        }

    }

    public function destroy($id)
    {
        $summary = SalSummary::find($id);
        foreach ($summary->documents as $doc)
        {
            $doc->document->update([
                'state_type_id' => ($summary->summary_status_type_id === '1')?'01':'05'
            ]);
        }
        $summary->delete();

        $this->summaries = [];
        $this->documents = [];
        $this->emit('refreshDocumentList');
        
        $this->dispatchBrowserEvent('sales-summary-delete', ['msg' => 'Resumen eliminada con éxito']);

    }
}
