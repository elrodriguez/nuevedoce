<?php

namespace Modules\Inventory\Http\Livewire\Itempart;

use Elrod\UserActivity\Activity;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Lang;
use Livewire\Component;
use Livewire\WithPagination;
use Modules\Inventory\Entities\InvItem;

class ItemPartList extends Component
{
    public $show;
    public $search;
    public $id_item;
    public $name_item;
    public $parts_item;
    public $weight_item;
    public $count_items;
    public $search_parent;

    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public function mount($item_id){
        $item = InvItem::find($item_id);
        $this->search_parent = $item;
        $this->show = 10;
        $this->id_item = $item_id;
        $this->name_item = $item->name;
        $this->parts_item = $item->number_parts;
        $this->weight_item = $item->weight;
    }

    public function render()
    {
        $this->count_items = count($this->getItemParts());
        return view('inventory::livewire.itempart.item-part-list', ['item_parts' => $this->getItemParts(), 'item_name' => $this->name_item]);
    }

    public function getItemParts(){
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
                'inv_items.amount',
                'inv_items.item_id',
                'inv_categories.description AS name_category',
                'inv_brands.description AS name_brand'
            )
            ->where('item_id', '=', $this->id_item)
            ->paginate($this->show);
    }

    public function itemPartsSearch()
    {
        $this->resetPage();
    }

    public function deleteItemPart($id){
        $itemPart = InvItem::find($id);

        $activity = new activity;
        $activity->log('Se eliminó la parte del item');
        $activity->modelOn(InvItem::class,$id,'inv_item');
        $activity->dataOld($itemPart);
        $activity->logType('delete');
        $activity->causedBy(Auth::user());
        $activity->save();

        //Update weight parent
        $weight_parent = $this->search_parent->weight - ($itemPart->weight * $itemPart->amount);
        $parent_item = $this->search_parent->update([
            'weight' => $weight_parent,
            'person_edit' => Auth::user()->person_id
        ]);

        $itemPart->delete();

        $this->dispatchBrowserEvent('set-item-part-delete', ['msg' => Lang::get('inventory::labels.msg_delete')]);
    }
}