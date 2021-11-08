<?php

namespace Modules\Inventory\Http\Livewire\Kardex;

use Livewire\Component;
use Livewire\WithPagination;
use Elrod\UserActivity\Activity;
use Illuminate\Support\Facades\Auth;
use Modules\Inventory\Entities\InvKardex;
use Modules\Inventory\Entities\InvPurchase;
use Modules\Setting\Entities\SetEstablishment;
use Illuminate\Support\Facades\DB;

class ItemsStock extends Component
{
    public $show;
    public $search;
    public $start;
    public $end;
    public $establishments;
    public $establishment_id;
    public $item_id;

    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public function mount(){
        $this->show = 10;
        $this->getEstablishment();
    }

    public function getEstablishment(){
        $this->establishments = SetEstablishment::where('state',true)->get();
    }
    public function render()
    {
        return view('inventory::livewire.kardex.items-stock',['items'=>$this->getItems()]);
    }

    public function itemSearch()
    {
        $this->resetPage();
    }

    public function getItems(){
        $start = $this->start;
        $end = $this->end;
        $item_id = $this->item_id;
        $warehouse_id = $this->establishment_id;

        $items = InvKardex::query()->join('items','inv_kardexes.item_id','items.id')
                ->leftJoin('inv_purchases', function($query)
                {
                    $query->on('inv_kardexes.kardexable_id','inv_purchases.id')
                        ->where('inv_kardexes.kardexable_type', InvPurchase::class);
                })
                ->select(
                    'items.id',
                    'items.internal_id',
                    'items.description',
                    'inv_kardexes.detail',
                    'inv_kardexes.date_of_issue',
                    'inv_kardexes.kardexable_type',
                    'inv_kardexes.created_at',
                    'inv_kardexes.quantity',
                    DB::raw("CONCAT(inv_purchases.series,'-',inv_purchases.number) AS purchase_number")
                )
                ->where('inv_kardexes.warehouse_id',$warehouse_id)
                ->where('inv_kardexes.item_id',$item_id)
                ->whereBetween('inv_kardexes.date_of_issue', [$start, $end]);

        return $items;
    }

    
}
