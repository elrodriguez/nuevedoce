<?php

namespace Modules\Sales\Http\Livewire\Document;

use Livewire\Component;
use Livewire\WithPagination;
use Modules\Setting\Entities\SetEstablishment;
use Elrod\UserActivity\Activity;
use Illuminate\Support\Facades\Auth;
use Modules\Sales\Entities\SalSaleNote;

class SaleNotesList extends Component
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
        return view('sales::livewire.document.sale-notes-list',['notes' => $this->getData()]);
    }

    public function getData(){
        return SalSaleNote::paginate($this->show);
    }
}
