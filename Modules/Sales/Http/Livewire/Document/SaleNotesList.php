<?php

namespace Modules\Sales\Http\Livewire\Document;

use Livewire\Component;
use Livewire\WithPagination;
use Modules\Setting\Entities\SetEstablishment;
use Elrod\UserActivity\Activity;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Modules\Sales\Entities\SalSaleNote;

class SaleNotesList extends Component
{
    public $show;
    public $search;

    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    protected $listeners = ['refreshlistSaleNotes' => 'updatingSearchSaleNote'];

    public function mount(){
        $this->show = 10;
    }

    public function render()
    {
        return view('sales::livewire.document.sale-notes-list',['notes' => $this->getData()]);
    }

    public function updatingSearchSaleNote()
    {
        $this->resetPage();
    }

    public function getData(){
        return SalSaleNote::join('state_types','state_type_id','state_types.id')
            ->leftJoin('sal_documents','document_id','sal_documents.id')
            ->select(
                'sal_sale_notes.id',
                'sal_sale_notes.date_of_issue',
                'sal_sale_notes.series',
                'sal_sale_notes.number',
                'sal_sale_notes.customer',
                'sal_sale_notes.state_type_id',
                'state_types.description',
                'sal_sale_notes.total',
                'sal_sale_notes.paid',
                DB::raw('CONCAT(sal_documents.series,"-",sal_documents.number) AS voucher')
            )
            ->orderBy('sal_sale_notes.date_of_issue','DESC')
            ->paginate($this->show);
    }
}
