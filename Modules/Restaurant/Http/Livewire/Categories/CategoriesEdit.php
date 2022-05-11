<?php

namespace Modules\Restaurant\Http\Livewire\Categories;

use Illuminate\Support\Facades\Lang;
use Livewire\Component;
use Modules\Inventory\Entities\InvCategory;
use Modules\Restaurant\Entities\RestCategoryCommand;
use Modules\Setting\Entities\SetModule;

class CategoriesEdit extends Component
{
    public $category_id_old;
    public $category_id_new;
    public $description;
    public $status = true;
    public $xcategory_id;
    public $categories = [];
    public $module_id;
    public $category;

    public function mount($category_id)
    {
        $this->xcategory_id = $category_id;

        $this->module_id = SetModule::where('uuid', 'rest')->value('id');
        $this->categories = $this->getCategories();

        $this->category = RestCategoryCommand::find($category_id);

        $this->category_id_old = $this->category->category_id;
        $this->description = $this->category->description;
        $this->status = $this->category->status;
    }

    public function render()
    {
        return view('restaurant::livewire.categories.categories-edit');
    }

    public function updateCategory()
    {

        $this->validate([
            'description' => 'required'
        ]);

        $category_id  = null;

        if (is_array($this->category_id_new)) {
            $category_id = $this->category_id_new[0];
        } else {
            $category_id = $this->category_id_old;
        }

        $this->category->update([
            'category_id'   => $category_id,
            'description'   => $this->description,
            'status'        => $this->status ? true : false
        ]);
        //dd('ddd');
        $this->dispatchBrowserEvent('set-category-update', ['msg' => Lang::get('labels.was_successfully_updated')]);
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
                'isSelectable'  => ($this->xcategory_id == $category->id ? false : true),
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
                    'isSelectable'  => ($this->xcategory_id == $category->id ? false : true),
                    'subs'          => $this->getSubCategories($category->id)
                );
            }
        }

        return $data;
    }
}
