<?php

namespace Modules\Restaurant\Http\Livewire\Commands;

use Illuminate\Support\Facades\Lang;
use Livewire\Component;
use Modules\Restaurant\Entities\RestCategoryCommand;
use Modules\Restaurant\Entities\RestComCatDetail;
use Modules\Restaurant\Entities\RestCommand;
use Livewire\WithFileUploads;

class CommandsEdit extends Component
{
    public $command;

    public $description;
    public $status = true;
    public $category_id_old = [];
    public $category_id_new;
    public $categories = [];
    public $price;
    public $stock;
    public $internal_id;
    public $has_igv = true;
    public $web_show = false;
    public $image;

    use WithFileUploads;

    public function mount($command_id)
    {
        $this->categories = $this->getCategories();

        $this->command = RestCommand::find($command_id);

        $restComCatDetails = RestComCatDetail::where('command_id', $command_id)->get();

        if (count($restComCatDetails) > 0) {
            foreach ($restComCatDetails as $k => $restComCatDetail) {
                $this->category_id_old[$k] = $restComCatDetail->category_id;
            }
        }

        $this->description = $this->command->description;

        $this->price = $this->command->price;
        $this->stock = $this->command->stock;
        $this->internal_id = $this->command->internal_id;
        $this->has_igv = $this->command->has_igv;
        $this->web_show = $this->command->web_show;
    }

    public function render()
    {
        return view('restaurant::livewire.commands.commands-edit');
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
            'category_id_new.*' => 'required',
            'price' => 'required',
            'stock' => 'required',
            'internal_id' => 'required'
        ]);


        $this->command->update([
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
            $image_name = $this->image->storeAs('commands', $this->command->id . '.' . $this->extension_photo, 'public');
            $this->command->update([
                'image' => 'storage/' . $image_name
            ]);
        }

        $category_ids  = null;

        if (is_array($this->category_id_new)) {
            $category_ids = $this->category_id_new;
        } else {
            $category_ids = $this->category_id_old;
        }

        RestComCatDetail::where('command_id', $this->command->id)->delete();

        foreach ($category_ids as $category_id) {

            RestComCatDetail::create([
                'category_id' => $category_id,
                'command_id' => $this->command->id
            ]);
        }


        $this->dispatchBrowserEvent('set-command-save', ['msg' => Lang::get('labels.successfully_registered')]);
    }
}
