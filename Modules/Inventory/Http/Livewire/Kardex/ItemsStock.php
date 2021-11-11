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

        return InvKardex::query()->join('items','inv_kardexes.item_id','items.id')
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
                ->whereBetween('inv_kardexes.date_of_issue', [$start, $end])
                ->paginate(10);

    }

    public function calculateRemaining()
    {
        $start = $this->start;
        $end = $this->end;
        $item_id = $this->item_id;
        $warehouse_id = $this->establishment_id;

        $page = request()->page;

        dd($page);

        if($page >= 2) {

            //$warehouse = Warehouse::where('establishment_id', auth()->user()->establishment_id)->first();

            if($date_start && $date_end) {
                $records = InventoryKardex::where([
                    ['warehouse_id', $warehouse_id],
                    ['item_id',$item_id],
                    ['date_of_issue', '<=', $date_start]
                ])->first();

                $ultimate = InventoryKardex::select(DB::raw('COUNT(*) AS t, MAX(id) AS id'))
                    ->where([
                        ['warehouse_id', $warehouse_id],
                        ['item_id',$item_id],
                        ['date_of_issue', '<=', $date_start]
                    ])->first();

                if (isset($records->date_of_issue) && Carbon::parse($records->date_of_issue)->eq(Carbon::parse($date_start))) {
                    $quantityOld = InventoryKardex::select(DB::raw('SUM(quantity) AS quantity'))
                        ->where([
                            ['warehouse_id', $warehouse_id],
                            ['item_id',$item_id],
                            ['date_of_issue', '<=', $date_start]
                        ])->first();
                    $quantityOld->quantity = 0;
                }elseif($ultimate->t == 1) {
                    $quantityOld = InventoryKardex::select(DB::raw('SUM(quantity) AS quantity'))
                    ->where([
                        ['warehouse_id', $warehouse_id],
                        ['item_id',$item_id],
                        ['date_of_issue', '<=', $date_start]
                    ])->first();
                } else {
                    $quantityOld = InventoryKardex::select(DB::raw('SUM(quantity) AS quantity'))
                        ->where([
                            ['warehouse_id', $warehouse_id],
                            ['item_id',$item_id],
                            ['date_of_issue', '<=', $date_start]
                        ])->whereNotIn('id', [$ultimate->id])->first();
                }

                $data = InventoryKardex::select('quantity')
                    ->where([['warehouse_id', $warehouse_id],['item_id',$item_id]])
                    ->whereBetween('date_of_issue', [$date_start, $date_end])
                    // ->when($date_start, function ($query) use ($date_start, $date_end){
                    //     return $query->whereBetween('date_of_issue', [$date_start, $date_end]);
                    // })
                    ->limit(($page*$this->visible)-$this->visible)->get();

                for($i=0;$i<=count($data)-1;$i++) {
                    $this->restante += $data[$i]->quantity;
                }

                $this->restante += $quantityOld->quantity;

                $this->balance = $this->restante;

            } else {
                $data = InventoryKardex::where('warehouse_id', $warehouse_id)->where('item_id',$item_id)
                    ->limit(($page*$this->visible)-$this->visible)->get();
                for($i=0;$i<=count($data)-1;$i++) {
                    $this->restante+=$data[$i]->quantity;
                }
            }
            return $this->balance = $this->restante;

        } else {

            if($date_start && $date_end) {

                //$warehouse = Warehouse::where('establishment_id', auth()->user()->establishment_id)->first();

                $records = InventoryKardex::where([
                        ['warehouse_id', $warehouse_id],
                        ['item_id',$item_id],
                        ['date_of_issue', '<=', $date_start]
                    ])->first();

                $ultimate = InventoryKardex::select(DB::raw('COUNT(*) AS t, MAX(id) AS id'))
                    ->where([
                        ['warehouse_id', $warehouse_id],
                        ['item_id',$item_id],
                        ['date_of_issue', '<=', $date_start]
                    ])->first();

                if (isset($records->date_of_issue) && Carbon::parse($records->date_of_issue)->eq(Carbon::parse($date_start))) {
                    $quantityOld = InventoryKardex::select(DB::raw('SUM(quantity) AS quantity'))
                        ->where([
                            ['warehouse_id', $warehouse_id],
                            ['item_id',$item_id],
                            ['date_of_issue', '<=', $date_start]
                        ])->first();
                    $quantityOld->quantity = 0;
                }elseif($ultimate->t == 1) {
                    $quantityOld = InventoryKardex::select(DB::raw('SUM(quantity) AS quantity'))
                    ->where([
                        ['warehouse_id', $warehouse_id],
                        ['item_id',$item_id],
                        ['date_of_issue', '<=', $date_start]
                    ])->first();
                } else {
                    $quantityOld = InventoryKardex::select(DB::raw('SUM(quantity) AS quantity'))
                        ->where([
                            ['warehouse_id', $warehouse_id],
                            ['item_id',$item_id],
                            ['date_of_issue', '<=', $date_start]
                        ])->whereNotIn('id', [$ultimate->id])->first();
                }
                return $this->balance = $quantityOld->quantity;
            }

        }

    }
}
