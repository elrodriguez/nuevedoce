<?php

namespace Modules\Pharmacy\Http\Livewire\Products;

use Illuminate\Support\Facades\Lang;
use Livewire\Component;
use Modules\Inventory\Entities\InvItem;
use Livewire\WithPagination;
use Modules\Pharmacy\Entities\PharProductRelated;
use Modules\Pharmacy\Entities\PharProductRelatedDetail;

class RelatedCreate extends Component
{
    public $keyword;
    public $description;
    public $item_id;
    public $search_item;
    public $products = [];

    use WithPagination;
    //protected $paginationTheme = 'bootstrap';

    public function render()
    {
        return view('pharmacy::livewire.products.related-create',['xitems' => $this->getItems()]);
    }

    public function searchItemsTwo()
    {
        $this->resetPage();
    }

    public function getItems(){
        return InvItem::select('id','name')
            ->where('status',true)
            ->where('name','like','%'.$this->search_item.'%')
            // ->whereNotExists(function($query)
            // {
            //     $query->select(DB::raw(1))
            //           ->from('phar_product_related_details')
            //           ->whereRaw('A.id = B.id');
            // })
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
            'description' => 'required|string|max:500',
            'item_id' => 'required'
        ]);

        $related = PharProductRelated::create([
            'item_id' => $this->item_id,
            'keyword' => $this->keyword,
            'description' => $this->description
        ]);

        if(count($this->products) > 0){
            foreach($this->products as $product){
                PharProductRelatedDetail::create([
                    'product_related_id' => $related->id,
                    'item_id' => $product['id']
                ]);
            }
        }

        $this->dispatchBrowserEvent('phar-related-save', ['msg' => Lang::get('labels.successfully_registered')]);
    }

    public function removeItemRelated($key){
        unset($this->products[$key]);
    }
}
