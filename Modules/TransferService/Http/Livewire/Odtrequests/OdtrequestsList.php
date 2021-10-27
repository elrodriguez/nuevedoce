<?php

namespace Modules\TransferService\Http\Livewire\Odtrequests;

use Livewire\Component;
use Elrod\UserActivity\Activity;
use Illuminate\Support\Facades\Auth;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Lang;
use Modules\TransferService\Entities\SerOdtRequest;

class OdtrequestsList extends Component
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
        return view('transferservice::livewire.odtrequests.odtrequests-list', ['odt_requests' => $this->getOdtRequests()]);
    }

    public function getOdtRequests(){
        return SerOdtRequest::where('ser_odt_requests.description','like','%'.$this->search.'%')
            ->join('people AS companies', 'ser_odt_requests.company_id', 'companies.id')
            ->join('per_employees', 'ser_odt_requests.supervisor_id', 'per_employees.id')
            ->join('people AS employee', 'per_employees.person_id', 'employee.id')
            ->join('ser_customers', 'ser_odt_requests.customer_id', 'ser_customers.id')
            ->join('people AS customer', 'ser_customers.person_id', 'customer.id')
            ->join('ser_locals', 'ser_odt_requests.local_id', 'ser_locals.id')
            ->join('people AS wholesaler', 'ser_odt_requests.wholesaler_id', 'wholesaler.id')
            ->select(
                'ser_odt_requests.id',
                'companies.full_name AS name_company',
                'employee.full_name AS name_employee',
                'customer.full_name AS name_customer',
                'ser_locals.name AS name_local',
                'wholesaler.full_name AS name_wholesaler',
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
}
