<?php

namespace Modules\Inventory\Http\Livewire\Asset;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Lang;
use Livewire\Component;
use Modules\Inventory\Entities\InvAssetType;
use Modules\Inventory\Entities\InvAsset;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\DB;

class AssetCreate extends Component
{

    use WithFileUploads;

    public $patrimonial_code;
    public $item_id;
    public $item_text;
    public $asset_type_id;
    public $state = true;

    public $asset_types = [];

    public function mount(){
        $this->asset_types = InvAssetType::where('state',true)->get();
    }

    public function render()
    {
        return view('inventory::livewire.asset.asset-create');
    }

    public function save(){
        $this->validate([
            'item_id' => 'required',
            'item_text' => 'required',
            'asset_type_id' => 'required'
        ]);

        $maxValue = DB::table('inv_assets')->max('patrimonial_code');

        if($maxValue == null){
            $correlativo = '000001';
        }else{
            $numero = (int) substr($maxValue,4,6);
            $correlativo = str_pad($numero + 1,  6, "0", STR_PAD_LEFT);
        }
        $this->patrimonial_code = date('Y').$correlativo;

        $asset_save = InvAsset::create([
            'patrimonial_code' => $this->patrimonial_code,
            'item_id' => $this->item_id,
            'asset_type_id' => $this->asset_type_id,
            'state' => $this->state,
            'person_create'=> Auth::user()->person_id
        ]);

        $this->clearForm();
        $this->dispatchBrowserEvent('set-asset-save', ['msg' => Lang::get('inventory::labels.msg_success')]);
    }

    public function clearForm(){
        $this->item_id = null;
        $this->item_text = null;
        $this->asset_type_id = null;
        $this->patrimonial_code = false;
        $this->state = true;
    }
}
