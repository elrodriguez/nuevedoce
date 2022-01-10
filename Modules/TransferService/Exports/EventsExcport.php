<?php
namespace Modules\TransferService\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class EventsExcport implements FromView, ShouldAutoSize
{
    use Exportable;

    public function records($records) {
        $this->records = $records;
        return $this;
    }

    public function view(): View
    {
        return view('transferservice::reports.exports.events', [
            'records' => $this->records
        ]);
    }
}