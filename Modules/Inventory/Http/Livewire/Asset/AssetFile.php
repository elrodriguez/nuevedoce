<?php

namespace Modules\Inventory\Http\Livewire\Asset;

use Livewire\Component;

class AssetFile extends Component
{
    public $photo;
    public $photos = [];
    public $asset_id;

    public function mount($asset_id){
        $this->asset_id = $asset_id;
    }

    public function render()
    {
        return view('inventory::livewire.asset.asset-file');
    }
}
