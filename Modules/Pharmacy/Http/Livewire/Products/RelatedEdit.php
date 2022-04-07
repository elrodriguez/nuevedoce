<?php

namespace Modules\Pharmacy\Http\Livewire\Products;

use Livewire\Component;
use Livewire\WithPagination;
use Modules\Pharmacy\Entities\PharProductRelated;
use Modules\Pharmacy\Entities\PharProductRelatedDetail;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Lang;
use Modules\Inventory\Entities\InvItem;

class RelatedEdit extends Component
{
    public $keyword;
    public $description;
    public $item_id;
    public $item_name;
    public $search_item;
    public $products = [];
    public $related_id;
    public $related;

    use WithPagination;

    public function mount($related_id){
        $this->related_id = $related_id;
        $this->related = PharProductRelated::find($related_id);
        $this->keyword = $this->related->keyword;
        $this->description = $this->related->description;
        $this->item_id = $this->related->item_id;
        $this->item_name = $this->related->item->name;
        $details = $this->related->details;

        foreach($details as $detail){
            array_push($this->products,array('id' => $detail->item_id,'name' => $detail->item->name));
        }

    }
    public function render()
    {
        return view('pharmacy::livewire.products.related-edit',['xitems' => $this->getItems()]);
    }

    public function searchItemsTwo()
    {
        $this->resetPage();
    }

    public function getItems(){
        $id = $this->related_id;
        return InvItem::select('id','name')
            ->where('status',true)
            ->where('name','like','%'.$this->search_item.'%')
            ->whereNotExists(function($query) use ($id){
                $query->select(DB::raw(1))
                      ->from('phar_product_related_details')
                      ->whereColumn('item_id','inv_items.id')
                      ->where('product_related_id',$id);
            })
            ->paginate(10);
    }

    public function paginationView()
    {
        return 'vendor.pagination.short';
    }

    public function addItemRelated($id,$name){
        $key = array_search($id, array_column($this->products, 'id'));
        if($key === false){
            $data = array('id' => $id, 'name' => $name);
            array_push($this->products, $data);
        }else{
            $this->dispatchBrowserEvent('phar-related-exists', ['success' => true]);
        }
    }

    public function save(){
        $this->validate([
            'keyword' => 'required|string|max:15',
            'description' => 'required|string|max:500'
        ]);

        $this->related->update([
            'keyword' => $this->keyword,
            'description' => $this->description
        ]);

        PharProductRelatedDetail::where('product_related_id',$this->related_id)->delete();

        if(count($this->products) > 0){
            foreach($this->products as $product){
                PharProductRelatedDetail::create([
                    'product_related_id' => $this->related_id,
                    'item_id' => $product['id']
                ]);
            }
        }

        $this->dispatchBrowserEvent('phar-related-save', ['msg' => Lang::get('labels.was_successfully_updated')]);
    }

    public function removeItemRelated($key){
        unset($this->products[$key]);
    }
}
