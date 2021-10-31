<?php

namespace Modules\Inventory\Http\Livewire\Asset;

use Livewire\Component;
use Modules\Inventory\Entities\InvCategory;
use Modules\Inventory\Entities\InvBrand;
use Modules\Inventory\Entities\InvAsset;
use Modules\Inventory\Entities\InvItemFile;
use Livewire\WithFileUploads;

class AssetEdit extends Component
{
    public $asset;
    public $name;
    public $description;
    public $part = false;
    public $weight;
    public $width;
    public $high;
    public $long;
    public $number_parts;
    public $status = true;
    public $asset_id;
    public $brand_id;
    public $category_id;
    //images
    public $images = [];
    public $image;
    public $extension_photo;
    //Brand
    public $brands;
    //Category
    public $categories;
    public $asset_save;

    public function mount($asset_id){
        $this->categories = InvCategory::where('status',true)->get();
        $this->brands = InvBrand::where('status',true)->get();

        $this->asset = InvAsset::find($asset_id);
        $this->name = $this->asset->name;
        $this->description = $this->asset->description;
        $this->part = $this->asset->part;
        $this->weight = $this->asset->weight;
        $this->width = $this->asset->width;
        $this->high = $this->asset->high;
        $this->long = $this->asset->long;
        $this->number_parts = $this->asset->number_parts;
        $this->status = $this->asset->status;
        $this->brand_id = $this->asset->brand_id;
        $this->category_id = $this->asset->category_id;
    }

    public function render()
    {
        return view('inventory::livewire.asset.asset-edit');
    }


    public function save(){

        $this->validate([
            'name' => 'required|min:3|max:255',
            'description' => 'required',
            'images.*' => 'image|max:1024'

            //'photo' => 'nullable|image|max:1024',
        ]);

        $this->asset->update([
            'name' => $this->name,
            'description' => $this->description,
            'part' => $this->part,
            'weight' => $this->weight,
            'width' => $this->width,
            'high' => $this->high,
            'long' => $this->long,
            'number_parts' => $this->number_parts,
            'status' => $this->status,
            'asset_id' => $this->asset_id,
            'brand_id' => $this->brand_id,
            'category_id' => $this->category_id
        ]);

         if($this->image){
            $this->extension_photo = $this->image->extension();

                InvItemFile::update([
                'name' => $this->image->getClientOriginalName(),
                'route' => 'asset_images/'.$this->name.'/',
                'extension' => $this->extension_photo,
                'asset_id' => $this->asset_save->id
            ]);

            $this->image->storeAs('asset_images/'.$this->name.'/', $this->asset_save->id.'.'.$this->extension_photo,'public');
        }


        /*
        if($this->images){
            foreach ($this->images as $image) {
            $this->extension_photo = $image->extension();
            //dd($this->extension_photo);
                $this->image->storeAs('asset_images/'.$this->employee_id.'/', $this->employee_id.'.'.$this->extension_photo,'public');
            }
        }*/

        $this->dispatchBrowserEvent('set-asset-save', ['msg' => 'Datos actualizados correctamente.']);
    }


}
