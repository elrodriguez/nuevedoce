<?php

namespace Modules\Inventory\Http\Livewire\Asset;

use Elrod\UserActivity\Activity;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Lang;
use Livewire\Component;
use Modules\Inventory\Entities\InvAssetType;
use Modules\Inventory\Entities\InvAsset;
use Modules\Inventory\Entities\InvItem;
use Modules\Inventory\Entities\InvItemFile;
use Livewire\WithFileUploads;

class AssetEdit extends Component
{
    use WithFileUploads;

    public $patrimonial_code;
    public $patrimonial_code_aux;
    public $item_id;
    public $item_id_aux;
    public $item_text;
    public $asset_type_id;
    public $status;
    public $asset;

    public $asset_types = [];

    public function mount($asset_id){
        $this->asset_types = InvAssetType::where('state',true)->get();
        $this->asset = InvAsset::find($asset_id);
        $this->patrimonial_code = $this->asset->patrimonial_code;
        $this->patrimonial_code_aux = $this->asset->patrimonial_code;
        $this->item_id = $this->asset->item_id;
        $this->item_id_aux = $this->asset->item_id;
        $this->asset_type_id = $this->asset->asset_type_id;
        $this->status = $this->asset->state;

        $nameItem = InvItem::where('id', $this->asset->item_id)->get();
        foreach ($nameItem as $row){
            $this->item_text = $row->name;
        }
    }

    public function render()
    {
        return view('inventory::livewire.asset.asset-edit');
    }

    public function save(){
        $this->validate([
            'item_id'       => 'required',
            'item_text'     => 'required',
            'asset_type_id' => 'required'
        ]);

        $activity = new Activity;
        $activity->dataOld(InvItem::find($this->asset->id));

        $this->asset->update([
            'patrimonial_code'  => $this->patrimonial_code_aux,
            'item_id'           => $this->item_id_aux,
            'asset_type_id'     => $this->asset_type_id,
            'state'             => $this->status,
            'person_edit'       => Auth::user()->person_id
        ]);

        $activity->modelOn(InvAsset::class, $this->asset->id,'inv_assets');
        $activity->causedBy(Auth::user());
        $activity->routeOn(route('inventory_asset_edit', $this->asset->id));
        $activity->logType('edit');
        $activity->dataUpdated($this->asset);
        $activity->log('Se actualizó datos del Activo');
        $activity->save();

        $this->dispatchBrowserEvent('set-asset-save', ['msg' => Lang::get('inventory::labels.msg_update')]);
    }
}
