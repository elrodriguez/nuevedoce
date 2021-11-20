<?php

namespace Modules\Inventory\Http\Livewire\Kardex;

use Livewire\Component;
use Livewire\WithPagination;
use Modules\Inventory\Entities\InvAsset;
use Modules\Inventory\Entities\InvBrand;
use Modules\Inventory\Entities\InvCategory;
use Modules\Inventory\Entities\InvItemPart;

class ActiveCodes extends Component
{
    public $show;
    public $search;
    public $families;
    public $brands;
    public $family_id;
    public $brand_id;

    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public function mount(){
        $this->show = 10;
    }

    public function render()
    {
        $this->families = InvCategory::all();
        $this->brands = InvBrand::all();

        return view('inventory::livewire.kardex.active-codes',['items' => $this->getItems()]);
    }

    public function getItems(){
        return  InvAsset::join('inv_items AS parts','inv_assets.item_id','parts.id')
                    ->join('inv_categories','parts.category_id','inv_categories.id')
                    ->leftJoin('inv_locations','inv_assets.location_id','inv_locations.id')
                    ->leftJoin('inv_brands','parts.brand_id','inv_brands.id')
                    ->leftJoin('inv_models','parts.model_id','inv_models.id')
                    ->select(
                        'inv_categories.description AS category_name',
                        'inv_brands.description AS brand_name',
                        'inv_models.description AS model_name',
                        'parts.name AS part_name',
                        'parts.description AS part_description',
                        'inv_assets.patrimonial_code',
                        'inv_locations.name AS location_name',
                        'inv_assets.state'
                    )
                    ->orderBY('inv_categories.description')
                    ->orderBY('parts.name')
                    ->paginate($this->show);
    }
}
