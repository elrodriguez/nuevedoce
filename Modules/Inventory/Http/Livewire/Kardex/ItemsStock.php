<?php

namespace Modules\Inventory\Http\Livewire\Kardex;

use Carbon\Carbon;
use Livewire\Component;
use Livewire\WithPagination;
use Elrod\UserActivity\Activity;
use Illuminate\Support\Facades\Auth;
use Modules\Inventory\Entities\InvKardex;
use Modules\Inventory\Entities\InvPurchase;
use Modules\Setting\Entities\SetEstablishment;
use Illuminate\Support\Facades\DB;
use Modules\Sales\Entities\SalDocument;
use Modules\Sales\Entities\SalSaleNote;
use Modules\TransferService\Entities\SerLoadOrder;

class ItemsStock extends Component
{
    public $show;
    public $search;
    public $start;
    public $end;
    public $establishments;
    public $location_id;
    public $item_id;
    public $balance = 0;
    public $restante = 0;

    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public function mount()
    {
        $this->show = 10;
        $this->start = Carbon::now()->format('Y-m-d');
        $this->end = Carbon::now()->format('Y-m-d');
    }

    public function getEstablishment()
    {
        $this->establishments = SetEstablishment::join('inv_locations', 'set_establishments.id', 'inv_locations.establishment_id')
            ->select(
                'inv_locations.id',
                DB::raw('CONCAT(set_establishments.name," / ",inv_locations.name) AS description')
            )
            ->where('inv_locations.state', true)
            ->get();
    }
    public function render()
    {
        $this->getEstablishment();
        $this->calculateRemaining();

        return view('inventory::livewire.kardex.items-stock', ['items' => $this->getItems()]);
    }

    public function itemSearch()
    {
        $this->resetPage();
    }

    public function getItems()
    {

        $start = $this->start;
        $end = $this->end;
        $item_id = $this->item_id;
        $location_id = $this->location_id;
        //dd($this->location_id);
        $items = InvKardex::join('inv_items', 'inv_kardexes.item_id', 'inv_items.id')
            ->leftJoin('inv_purchases', function ($query) {
                $query->on('inv_kardexes.kardexable_id', 'inv_purchases.id')
                    ->where('inv_kardexes.kardexable_type', InvPurchase::class);
            })
            ->leftJoin('sal_documents', function ($query) {
                $query->on('inv_kardexes.kardexable_id', 'sal_documents.id')
                    ->where('inv_kardexes.kardexable_type', SalDocument::class);
            })
            ->leftJoin('sal_sale_notes', function ($query) {
                $query->on('inv_kardexes.kardexable_id', 'sal_sale_notes.id')
                    ->where('inv_kardexes.kardexable_type', SalSaleNote::class);
            })
            ->leftJoin('ser_load_orders', function ($query) {
                $query->on('inv_kardexes.kardexable_id', 'ser_load_orders.id')
                    ->where('inv_kardexes.kardexable_type', SerLoadOrder::class);
            })
            ->leftJoin('inv_categories', 'inv_items.category_id', 'inv_categories.id')
            ->leftJoin('inv_brands', 'inv_items.brand_id', 'inv_brands.id')
            ->leftJoin('inv_models', 'inv_items.model_id', 'inv_models.id')
            ->select(
                'inv_categories.description AS category_name',
                'inv_brands.description AS brand_name',
                'inv_models.description AS model_name',
                'inv_items.id',
                'inv_items.name',
                'inv_items.description',
                'inv_kardexes.detail',
                'inv_kardexes.date_of_issue',
                'inv_kardexes.kardexable_type',
                'inv_kardexes.created_at',
                'inv_kardexes.quantity',
                DB::raw("CONCAT(inv_purchases.serie,'-',inv_purchases.number) AS purchase_number"),
                DB::raw("CONCAT(sal_documents.series,'-',sal_documents.number) AS document_number"),
                DB::raw("CONCAT(sal_sale_notes.series,'-',sal_sale_notes.number) AS sale_note_number"),
                'ser_load_orders.uuid AS load_order_number',
            )
            ->where('inv_kardexes.location_id', $location_id)
            ->where('inv_kardexes.item_id', $item_id)
            ->whereBetween('inv_kardexes.date_of_issue', [$start, $end])
            ->orderBy('inv_kardexes.date_of_issue')
            ->paginate($this->show);

        return $items;
    }

    public function calculateRemaining()
    {
        $date_start = $this->start;
        $date_end = $this->end;
        $item_id = $this->item_id;
        $location_id = $this->location_id;
        $this->balance = 0;
        $this->restante = 0;

        $page = $this->page;

        if ($page >= 2) {

            if ($date_start && $date_end) {

                $records = InvKardex::where([
                    ['location_id', $location_id],
                    ['item_id', $item_id],
                    ['date_of_issue', '<=', $date_start]
                ])
                    ->orderBy('date_of_issue')
                    ->first();

                $ultimate = InvKardex::select(DB::raw('COUNT(*) AS t, MAX(id) AS id'))
                    ->where([
                        ['location_id', $location_id],
                        ['item_id', $item_id],
                        ['date_of_issue', '<=', $date_start]
                    ])
                    ->orderBy('date_of_issue')
                    ->first();

                if (isset($records->date_of_issue) && Carbon::parse($records->date_of_issue)->eq(Carbon::parse($date_start))) {
                    $quantityOld = InvKardex::select(DB::raw('SUM(quantity) AS quantity'))
                        ->where([
                            ['location_id', $location_id],
                            ['item_id', $item_id],
                            ['date_of_issue', '<=', $date_start]
                        ])
                        ->orderBy('date_of_issue')
                        ->first();
                    $quantityOld->quantity = 0;
                } elseif ($ultimate->t == 1) {
                    $quantityOld = InvKardex::select(DB::raw('SUM(quantity) AS quantity'))
                        ->where([
                            ['location_id', $location_id],
                            ['item_id', $item_id],
                            ['date_of_issue', '<=', $date_start]
                        ])
                        ->orderBy('date_of_issue')
                        ->first();
                } else {

                    $quantityOld = InvKardex::select(DB::raw('SUM(quantity) AS quantity'))
                        ->where([
                            ['location_id', $location_id],
                            ['item_id', $item_id],
                            ['date_of_issue', '<=', $date_start]
                        ])->whereNotIn('id', [$ultimate->id])
                        ->orderBy('date_of_issue')
                        ->first();
                }

                $data = InvKardex::select('quantity')
                    ->where([['location_id', $location_id], ['item_id', $item_id]])
                    ->whereBetween('date_of_issue', [$date_start, $date_end])
                    ->orderBy('date_of_issue')
                    ->limit(($page * $this->show) - $this->show)
                    ->get();

                for ($i = 0; $i <= count($data) - 1; $i++) {
                    $this->restante += $data[$i]->quantity;
                }

                $this->restante += $quantityOld->quantity;

                $this->balance = $this->restante;
            } else {
                $data = InvKardex::where('location_id', $location_id)->where('item_id', $item_id)
                    ->limit(($page * $this->show) - $this->show)->get();
                for ($i = 0; $i <= count($data) - 1; $i++) {
                    $this->restante += $data[$i]->quantity;
                }
            }
            return $this->balance = $this->restante;
        } else {

            if ($date_start && $date_end) {

                $records = InvKardex::where([
                    ['location_id', $location_id],
                    ['item_id', $item_id],
                    ['date_of_issue', '<=', $date_start]
                ])
                    ->orderBy('date_of_issue')
                    ->first();

                $ultimate = InvKardex::select(DB::raw('COUNT(*) AS t, MAX(id) AS id'))
                    ->where([
                        ['location_id', $location_id],
                        ['item_id', $item_id],
                        ['date_of_issue', '<=', $date_start]
                    ])
                    ->orderBy('date_of_issue')
                    ->first();

                if (isset($records->date_of_issue) && Carbon::parse($records->date_of_issue)->eq(Carbon::parse($date_start))) {
                    $quantityOld = InvKardex::select(DB::raw('SUM(quantity) AS quantity'))
                        ->where([
                            ['location_id', $location_id],
                            ['item_id', $item_id],
                            ['date_of_issue', '<=', $date_start]
                        ])
                        ->orderBy('date_of_issue')
                        ->first();

                    $quantityOld->quantity = 0;
                } elseif ($ultimate->t == 1) {
                    $quantityOld = InvKardex::select(DB::raw('SUM(quantity) AS quantity'))
                        ->where([
                            ['location_id', $location_id],
                            ['item_id', $item_id],
                            ['date_of_issue', '<=', $date_start]
                        ])
                        ->orderBy('date_of_issue')
                        ->first();
                } else {
                    $quantityOld = InvKardex::select(DB::raw('SUM(quantity) AS quantity'))
                        ->where([
                            ['location_id', $location_id],
                            ['item_id', $item_id],
                            ['date_of_issue', '<=', $date_start]
                        ])->whereNotIn('id', [$ultimate->id])
                        ->orderBy('date_of_issue')
                        ->first();
                }
                return $this->balance = $quantityOld->quantity;
            }
        }
    }
}
