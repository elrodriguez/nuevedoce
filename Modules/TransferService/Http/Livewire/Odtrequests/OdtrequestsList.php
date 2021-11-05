<?php

namespace Modules\TransferService\Http\Livewire\Odtrequests;

use App\Models\Person;
use Livewire\Component;
use Elrod\UserActivity\Activity;
use Illuminate\Support\Facades\Auth;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Lang;
use Modules\TransferService\Entities\SerLocal;
use Modules\TransferService\Entities\SerOdtRequest;

class OdtrequestsList extends Component
{
    public $show;
    public $search;
    public $date_start;
    public $date_end;

    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public function mount(){
        $this->show = 10;
    }

    public function render()
    {
        return view('transferservice::livewire.odtrequests.odtrequests-list', ['odt_requests' => $this->getOdtRequests()]);
    }

    public function getOdtRequests(){
        $date_start = null;
        $date_end = null;

        if($this->date_start){
            list($ds,$ms,$ys) = explode('/',$this->date_start);
            $date_start =  $ys.'-'.$ms.'-'.$ds;
        }
        if($this->date_end){
            list($de,$me,$ye) = explode('/',$this->date_end);
            $date_end =  $ye.'-'.$me.'-'.$de;
        }
        
        return SerOdtRequest::join('people AS companies', 'ser_odt_requests.company_id', 'companies.id')
            ->join('per_employees', 'ser_odt_requests.supervisor_id', 'per_employees.id')
            ->join('people AS employee', 'per_employees.person_id', 'employee.id')
            ->join('ser_customers', 'ser_odt_requests.customer_id', 'ser_customers.id')
            ->join('people AS customer', 'ser_customers.person_id', 'customer.id')
            ->join('ser_locals', 'ser_odt_requests.local_id', 'ser_locals.id')
            ->join('people AS wholesaler', 'ser_odt_requests.wholesaler_id', 'wholesaler.id')
            ->where('ser_odt_requests.description','like','%'.$this->search.'%')
            ->when($date_start && $date_end, function ($query) use ($date_start,$date_end){
                return $query->where([
                    ['ser_odt_requests.date_start', '=', $date_start],
                    ['ser_odt_requests.date_end', '=', $date_end]
                ]);
            })
            ->select(
                'ser_odt_requests.id',
                'companies.id AS id_company',
                'companies.full_name AS name_company',
                'employee.id AS id_employee',
                'employee.full_name AS name_employee',
                'customer.id AS id_customer',
                'customer.full_name AS name_customer',
                'ser_locals.name AS name_local',
                'ser_locals.id AS id_local',
                'wholesaler.full_name AS name_wholesaler',
                'wholesaler.id AS id_wholesaler',
                'ser_odt_requests.date_start',
                'ser_odt_requests.date_end',
                'ser_odt_requests.description',
                'ser_odt_requests.additional_information',
                'ser_odt_requests.file',
                'ser_odt_requests.state',
                'ser_odt_requests.backus_id',
                'ser_odt_requests.internal_id'
            )
            ->orderBy('ser_odt_requests.date_end','DESC')
            ->paginate($this->show);

    }

    public function odtRequestSearch()
    {
        $this->resetPage();
    }

    public function deleteDirectory($dir) {
        if (!file_exists($dir)) {
            return true;
        }

        if (!is_dir($dir)) {
            return unlink($dir);
        }

        foreach (scandir($dir) as $item) {
            if ($item == '.' || $item == '..') {
                continue;
            }

            if (!$this->deleteDirectory($dir . DIRECTORY_SEPARATOR . $item)) {
                return false;
            }

        }

        return rmdir($dir);
    }

    public function deleteOdtRequest($id){
        $odtRequest = SerOdtRequest::find($id);

        $activity = new activity;
        $activity->log('Se eliminó la Solicitud ODT correctamente');
        $activity->modelOn(SerOdtRequest::class,$id,'ser_odt_requests');
        $activity->dataOld($odtRequest);
        $activity->logType('delete');
        $activity->causedBy(Auth::user());
        $activity->save();

        $odtRequest->delete();

        //Eliminar archivos y direcctorio
        $this->deleteDirectory('storage/requests_odt_file/'.$id);

        $this->dispatchBrowserEvent('ser-odtrequests-delete', ['msg' => Lang::get('transferservice::messages.msg_delete')]);
    }

    public function clearInput(){
        $this->search = null;
        $this->date_start = null;
        $this->date_end = null;
    }

    public function openModalDetails($id,$type){
        $body = '';
        $label = '';
        $lat = null;
        $lng = null;

        if($type == '4'){
            $local = SerLocal::find($id);
            $label = $local->name;
            $body .= '<dl class="row">
                        <dt class="col-sm-4">'.Lang::get('labels.address').'</dt>
                        <dd class="col-sm-8">'.$local->address.'</dd>
                        <dt class="col-sm-4">'.Lang::get('transferservice::labels.lbl_reference').'</dt>
                        <dd class="col-sm-8">'.$local->reference.'</dd>
                    </dl>
                    <div>
                        <div id="map" style="height: 300px;" wire:ignore></div>
                    </div>';

            $lat = (double) $local->latitude;
            $lng = (double) $local->longitude;
        }
        if($type == '5' || $type == '3' || $type == '2' || $type == '1'){
            $wholesaler = Person::find($id);
            $label = $wholesaler->full_name;
            
            $body .= '<dl class="row">
                        <dt class="col-sm-4">'.Lang::get('transferservice::labels.lbl_number').'</dt>
                        <dd class="col-sm-8">'.$wholesaler->number.'</dd>
                        <dt class="col-sm-4">'.Lang::get('labels.address').'</dt>
                        <dd class="col-sm-8">'.$wholesaler->address.'</dd>
                        <dt class="col-sm-4">'.Lang::get('labels.email').'</dt>
                        <dd class="col-sm-8">'.$wholesaler->email.'</dd>
                        <dt class="col-sm-4">'.Lang::get('labels.telephone').'</dt>
                        <dd class="col-sm-8">'.$wholesaler->telephone.'</dd>
                    </dl>';
        }

        $this->dispatchBrowserEvent('ser-odtrequests-details', ['body' => $body,'label' => $label,'lat' => $lat,'lng' => $lng]);
    }
}
