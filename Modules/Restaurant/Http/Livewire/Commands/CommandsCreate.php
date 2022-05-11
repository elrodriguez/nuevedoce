<?php

namespace Modules\Restaurant\Http\Livewire\Commands;

use Illuminate\Support\Facades\Lang;
use Livewire\Component;
use Modules\Inventory\Entities\InvCategory;
use Modules\Restaurant\Entities\RestCategoryCommand;
use Modules\Restaurant\Entities\RestComCatDetail;
use Modules\Restaurant\Entities\RestCommand;
use Modules\Setting\Entities\SetModule;
use Livewire\WithFileUploads;

class CommandsCreate extends Component
{
    public $description;
    public $status = true;
    public $category_id;
    public $categories = [];
    public $module_id;
    public $price;
    public $stock;
    public $internal_id;
    public $has_igv = true;
    public $web_show = false;
    public $image;

    use WithFileUploads;

    public function mount()
    {
        $this->categories = $this->getCategories();
    }

    public function render()
    {
        return view('restaurant::livewire.commands.commands-create');
    }

    public function getCategories()
    {
        $categories = RestCategoryCommand::whereNull('category_id')
            ->get();

        $data = [];

        foreach ($categories as $k => $category) {
            $data[$k] = array(
                'id'            => $category->id,
                'title'         => $category->description,
                //'isSelectable'  => false,
                'subs'          => $this->getSubCategories($category->id)
            );
        }
        return $data;
    }

    public function getSubCategories($id)
    {
        $subcategories = RestCategoryCommand::where('category_id', $id)
            ->get();

        $data = [];

        if (count($subcategories) > 0) {
            foreach ($subcategories as $k => $category) {
                $data[$k] = array(
                    'id'            => $category->id,
                    'title'         => $category->description,
                    //'isSelectable'  => false,
                    'subs'          => $this->getSubCategories($category->id)
                );
            }
        }

        return $data;
    }

    public function saveCommand()
    {

        $this->validate([
            'description' => 'required',
            'category_id' => 'required',
            'price' => 'required',
            'stock' => 'required',
            'internal_id' => 'required'
        ]);


        $command = RestCommand::create([
            'description' => $this->description,
            'price' => $this->price,
            'stock' => $this->stock,
            'internal_id' => $this->internal_id,
            'has_igv' => $this->has_igv,
            'web_show' => $this->web_show
        ]);

        $image_name = null;
        if ($this->image) {
            $this->extension_photo = $this->image->extension();
            $image_name = $this->image->storeAs('commands', $command->id . '.' . $this->extension_photo, 'public');
            $command->update([
                'image' => 'storage/' . $image_name
            ]);
        }
        $category_ids  = null;
        if ($this->category_id) {
            $category_ids = $this->category_id;
        }

        foreach ($category_ids as $category_id) {
            RestComCatDetail::create([
                'category_id' => $category_id,
                'command_id' => $command->id
            ]);
        }
        $this->clearForm();
        $this->dispatchBrowserEvent('set-command-save', ['msg' => Lang::get('labels.successfully_registered')]);
    }

    public function clearForm()
    {
        $this->description = null;
        $this->category_id = null;
        $this->price = null;
        $this->stock = null;
        $this->internal_id = null;
        $this->has_igv = true;
        $this->web_show = false;
    }
}
