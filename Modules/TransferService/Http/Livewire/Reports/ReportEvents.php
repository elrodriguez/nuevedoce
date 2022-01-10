<?php

namespace Modules\TransferService\Http\Livewire\Reports;

use Carbon\Carbon;
use Livewire\Component;
use Illuminate\Support\Facades\Lang;
use Elrod\UserActivity\Activity;
use Illuminate\Support\Facades\Auth;
use Livewire\WithPagination;
use Modules\TransferService\Entities\SerOdtRequest;
use Modules\TransferService\Exports\EventsExcport;

class ReportEvents extends Component
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
        return view('transferservice::livewire.reports.report-events',['odt_requests' => $this->getOdtRequests()]);
    }

    public function getOdtRequests(){
        $date_start = null;
        $date_end   = null;

        if($this->date_start){
            list($ed,$em,$ey) = explode('/',$this->date_start);
            $date_start = $ey.'-'.$em.'-'.$ed;
        }
        if($this->date_end){
            list($fd,$fm,$fy) = explode('/',$this->date_end);
            $date_end   = $fy.'-'.$fm.'-'.$fd;
        }

        return SerOdtRequest::join('people AS company','company_id','company.id')
                    ->join('customers','customer_id','customers.id')
                    ->join('people AS customer','customers.person_id','customer.id')
                    ->join('ser_locals','local_id','ser_locals.id')
                    ->join('people AS wholesaler','wholesaler_id','wholesaler.id')
                    ->join('sta_employees','supervisor_id','sta_employees.id')
                    ->join('people AS supervisor','sta_employees.person_id','supervisor.id')
                    ->select(
                        'company.full_name AS company_name',
                        'customer.full_name AS customer_name',
                        'ser_locals.name AS local_name',
                        'ser_locals.address',
                        'ser_locals.reference',
                        'wholesaler.full_name AS wholesaler_name',
                        'ser_odt_requests.date_start',
                        'ser_odt_requests.date_end',
                        'ser_odt_requests.description',
                        'ser_odt_requests.additional_information',
                        'ser_odt_requests.file',
                        'ser_odt_requests.state',
                        'ser_odt_requests.backus_id',
                        'ser_odt_requests.internal_id',
                        'supervisor.full_name AS supervisor_name'

                    )
                    ->where('ser_odt_requests.description','like','%'.$this->search.'%')
                    ->when($date_start && $date_end, function ($query) use ($date_start, $date_end) {
                        return $query->where('date_start','=',$date_start)
                                    ->where('date_end','=',$date_end);
                    })
                    ->paginate($this->show);
    }

    public function odtRequestsSearch()
    {
        $this->resetPage();
    }

    public function clearInput(){
        $this->search       = null;
        $this->date_start   = null;
        $this->date_end     = null;
    }

    public function downloadExcel(){

        $date_start = null;
        $date_end   = null;

        if($this->date_start){
            list($ed,$em,$ey) = explode('/',$this->date_start);
            $date_start = $ey.'-'.$em.'-'.$ed;
        }
        if($this->date_end){
            list($fd,$fm,$fy) = explode('/',$this->date_end);
            $date_end   = $fy.'-'.$fm.'-'.$fd;
        }

        $records = SerOdtRequest::join('people AS company','company_id','company.id')
                    ->join('customers','customer_id','customers.id')
                    ->join('people AS customer','customers.person_id','customer.id')
                    ->join('ser_locals','local_id','ser_locals.id')
                    ->join('people AS wholesaler','wholesaler_id','wholesaler.id')
                    ->join('sta_employees','supervisor_id','sta_employees.id')
                    ->join('people AS supervisor','sta_employees.person_id','supervisor.id')
                    ->select(
                        'company.full_name AS company_name',
                        'customer.full_name AS customer_name',
                        'ser_locals.name AS local_name',
                        'ser_locals.address',
                        'ser_locals.reference',
                        'wholesaler.full_name AS wholesaler_name',
                        'ser_odt_requests.date_start',
                        'ser_odt_requests.date_end',
                        'ser_odt_requests.description',
                        'ser_odt_requests.additional_information',
                        'ser_odt_requests.file',
                        'ser_odt_requests.state',
                        'ser_odt_requests.backus_id',
                        'ser_odt_requests.internal_id',
                        'supervisor.full_name AS supervisor_name'

                    )
                    ->where('ser_odt_requests.description','like','%'.$this->search.'%')
                    ->when($date_start && $date_end, function ($query) use ($date_start, $date_end) {
                        return $query->where('date_start','=',$date_start)
                                    ->where('date_end','=',$date_end);
                    })
                    ->get();

        $events_report = new EventsExcport();
        $events_report->records($records);

        return $events_report->download('Reporte_eventos_' . Carbon::now() . '.xlsx');
    }
}
