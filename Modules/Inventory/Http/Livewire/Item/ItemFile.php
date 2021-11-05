<?php

namespace Modules\Inventory\Http\Livewire\Item;

use http\Env\Response;
use Illuminate\Http\Request;
use Livewire\Component;
use Modules\Inventory\Entities\InvItem;
use Modules\Inventory\Entities\InvItemFile;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;

class ItemFile extends Component
{
    use WithFileUploads;

    public $photo;
    public $photos = [];
    public $item_id;
    public $files = [];
    public $files_a;
    public $files_b = array();
    public $id_item;
    public $name_item;

    public function mount($item_id){
        $item = InvItem::find($item_id);
        $this->id_item = $item_id;
        $this->name_item = $item->name;

        $this->item_id = $item_id;
        $this->files = InvItemFile::where('item_id', '=', $item_id)->get();
        $result = array();
        foreach ($this->files as $row){
            $obj['id'] =  $row->id;
            $obj['name'] =  $row->name;
            $obj['server_name'] = $row->name;
            if(file_exists(public_path('storage/'.$row->route))){
                $image_url = url('storage/'.$row->route);
                $fileSize = \File::size(public_path('storage/'.$row->route));
                $obj['size'] = $fileSize;
                $obj['route'] = $image_url;
            }
            $obj['extension'] = $row->extension;
            $result[] = $obj;
        }
        $this->files_a = $result;
    }

    public function render()
    {
        return view('inventory::livewire.item.item-file', ['result' => $this->files_a]);
    }

    public function deleteFile($id, $narchivo, $url_file){
        $file_search = InvItemFile::find($id);
        if(file_exists(public_path('storage/item_images/Activo_'.$this->item_id.'/'.$narchivo))){
            unlink(public_path('storage/item_images/Activo_'.$this->item_id.'/'.$narchivo));
            $file_search->delete();
            $msg = 'OK';
        }else{
            $msg = 'ERROR';
        }
        $this->dispatchBrowserEvent('set-file-delete', ['res' => $msg]);
    }
}
