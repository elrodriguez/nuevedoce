<?php

namespace Modules\Restaurant\Http\Livewire\Commands;

use Livewire\Component;
use Modules\Inventory\Entities\InvCategory;
use Modules\Restaurant\Entities\RestCategoryCommand;
use Modules\Restaurant\Entities\RestCommand;
use Modules\Setting\Entities\SetModule;
use Livewire\WithPagination;

class CommandsList extends Component
{
    public $category_id;
    public $categories = [];
    public $module_id;
    public $search;

    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public function mount()
    {
        $this->categories = $this->getCategories();
    }

    public function searchCommands()
    {
        $this->resetPage();
    }
    public function render()
    {

        return view('restaurant::livewire.commands.commands-list', ['commands' => $this->getCommands()]);
    }

    public function getCategories()
    {
        $categories = RestCategoryCommand::whereNull('category_id')
            ->get();

        $data[0] = array(
            'id' => null,
            'title' => 'TODOS'
        );
        $k = 1;
        foreach ($categories as $category) {
            $data[$k] = array(
                'id'            => $category->id,
                'title'         => $category->description,
                //'isSelectable'  => false,
                'subs'          => $this->getSubCategories($category->id)
            );
            $k++;
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

    public function getCommands()
    {
        $ids  = null;
        if (is_array($this->category_id)) {
            if ($this->category_id[0] == 'null') {
                $ids = null;
            } else {
                $ids = $this->category_id;
            }
        }

        return RestCommand::join('rest_com_cat_details', 'command_id', 'rest_commands.id')
            ->select(
                'rest_commands.id',
                'rest_commands.description',
                'rest_commands.price',
                'rest_commands.image',
                'rest_commands.stock',
                'rest_commands.internal_id',
                'rest_commands.has_igv',
                'rest_commands.web_show'
            )
            ->when(is_array($ids), function ($query) use ($ids) {
                $query->whereIn('rest_com_cat_details.category_id', array_values($ids));
            })
            ->where('rest_commands.description', 'like', '%' . $this->search . '%')
            ->groupBy([
                'rest_commands.id',
                'rest_commands.description',
                'rest_commands.price',
                'rest_commands.image',
                'rest_commands.stock',
                'rest_commands.internal_id',
                'rest_commands.has_igv',
                'rest_commands.web_show'
            ])
            ->paginate(10);
    }
}
