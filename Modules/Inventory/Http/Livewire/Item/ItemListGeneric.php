<?php

namespace Modules\Inventory\Http\Livewire\Item;

use Livewire\Component;
use Modules\Inventory\Entities\InvItem;
use Modules\Inventory\Imports\ItemsImportGeneric;
use Elrod\UserActivity\Activity;
use Exception;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Auth;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class ItemListGeneric extends Component
{
    public $show;
    public $search;
    public $file_excel;
    public $loading_import = false;

    use WithFileUploads;
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public function mount(){
        $this->show = 10;
    }

    public function render()
    {
        return view('inventory::livewire.item.item-list-generic', ['items'=>$this->getItems()]);
    }

    public function itemSearch()
    {
        $this->resetPage();
    }
    public function getItems(){
        return InvItem::where('inv_items.name','like','%'.$this->search.'%')
            ->leftJoin('inv_categories', 'category_id', 'inv_categories.id')
            ->leftJoin('inv_brands', 'brand_id', 'inv_brands.id')
            ->leftJoin('inv_unit_measures', 'unit_measure_id', 'inv_unit_measures.id')
            ->select(
                'inv_items.id',
                'inv_items.name',
                'inv_items.description',
                'inv_items.purchase_price',
                'inv_items.sale_price',
                'inv_items.stock',
                'inv_items.stock_min',
                'inv_items.status',
                'inv_categories.description AS name_category',
                'inv_brands.description AS name_brand',
                'inv_unit_measures.name AS unit_measure',
                'inv_unit_measures.abbreviation AS unit_measure_abr'
            )
            ->paginate($this->show);
    }

    public function deleteItem($id){
        try {
            $item = InvItem::find($id);

            $activity = new activity;
            $activity->log('Se eliminó el item');
            $activity->modelOn(InvItem::class,$id,'inv_item');
            $activity->dataOld($item);
            $activity->logType('delete');
            $activity->causedBy(Auth::user());
            $activity->save();

            $item->delete();
            $res = 'success';
        } catch (\Illuminate\Database\QueryException $e) {
            $res = 'error';
        }
        $this->dispatchBrowserEvent('set-item-delete', ['res' => $res]);
    }

    public function import(){
        ini_set('memory_limit', '2048M');
        ini_set('max_execution_time', '400');
        try {
            if($this->file_excel){
                
                if(Excel::import(new ItemsImportGeneric, $this->file_excel)) {
                    $this->loading_import = true;
                } else {
                    $this->loading_import = false;
                }
            }
        } catch (Exception $e) {
            $this->loading_import = false;
            dd($e->getMessage());
        }
    }
}
