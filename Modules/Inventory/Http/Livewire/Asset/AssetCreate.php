<?php

namespace Modules\Inventory\Http\Livewire\Asset;

use Livewire\Component;
use Modules\Inventory\Entities\InvCategory;
use Modules\Inventory\Entities\InvBrand;
use Modules\Inventory\Entities\InvAsset;
use Modules\Inventory\Entities\InvAssetFile;
use Livewire\WithFileUploads;

class AssetCreate extends Component
{

    use WithFileUploads;

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

    public function mount(){
        $this->categories = InvCategory::where('status',true)->get();
        $this->brands = InvBrand::where('status',true)->get();
       
    }

    public function render()
    {
        return view('inventory::livewire.asset.asset-create');
    }


    public function save(){

        $this->validate([
            'name' => 'required|min:3|max:255',
            'description' => 'required',
            'images.*' => 'image|max:1024'
            
            //'photo' => 'nullable|image|max:1024',
        ]);
        
        $this->asset_save = InvAsset::create([
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
            'category_id' => $this->category_id,
            'brand_id' => $this->brand_id
        ]);
         
         if($this->image){
            $this->extension_photo = $this->image->extension();
            
                InvAssetFile::create([
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

        $this->clearForm();
        $this->dispatchBrowserEvent('set-asset-save', ['msg' => 'Datos guardados correctamente.']);
    }
    
    
    
    public function clearForm(){
        $this->name = null;
        $this->description = null;
        $this->part = false;
        $this->weight = null;
        $this->width = null;
        $this->high = null;
        $this->long = null;
        $this->number_parts = null;
        $this->status = true;
        $this->asset_id = null;
        $this->brand_id = null;
        $this->category_id = null;
        $this->image = '';
        
    }

}
