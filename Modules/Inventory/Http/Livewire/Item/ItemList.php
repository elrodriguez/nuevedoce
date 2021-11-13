<?php

namespace Modules\Inventory\Http\Livewire\Item;

use Elrod\UserActivity\Activity;
use Exception;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;
use Modules\Inventory\Entities\InvItem;
use Modules\Inventory\Imports\ItemsImport;
use Maatwebsite\Excel\Facades\Excel;
use Livewire\WithFileUploads;
class ItemList extends Component
{
    public $show;
    public $search;
    public $file;
    public $loading_import = false;

    use WithPagination;
    use WithFileUploads;
    protected $paginationTheme = 'bootstrap';

    public function mount(){
        $this->show = 10;
    }

    public function render()
    {
        return view('inventory::livewire.item.item-list', ['items'=>$this->getItems()]);
    }

    public function itemSearch()
    {
        $this->resetPage();
    }

    public function getItems(){
        return InvItem::where('inv_items.name','like','%'.$this->search.'%')
            ->leftJoin('inv_categories', 'category_id', 'inv_categories.id')
            ->leftJoin('inv_brands', 'brand_id', 'inv_brands.id')
            ->select(
                'inv_items.id',
                'inv_items.name',
                'inv_items.description',
                'inv_items.part',
                'inv_items.weight',
                'inv_items.width',
                'inv_items.high',
                'inv_items.long',
                'inv_items.number_parts',
                'inv_items.status',
                'inv_categories.description AS name_category',
                'inv_brands.description AS name_brand'
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
        try {

            if(Excel::import(new ItemsImport, $this->file)) {
                $this->loading_import = true;
            } else {
                $this->loading_import = false;
            }
        } catch (Exception $e) {
            $this->loading_import = false;
            dd($e->getMessage());
        }
    }
}
