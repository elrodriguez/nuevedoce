<?php

namespace Modules\Pharmacy\Http\Livewire\Products;

use Livewire\Component;
use Modules\Pharmacy\Entities\PharProductRelated;

class RelatedList extends Component
{
    public $show;
    public $search;

    public function searchRelated()
    {
        $this->resetPage();
    }

    public function render()
    {
        return view('pharmacy::livewire.products.related-list',['relateds' => $this->getRelated()]);
    }

    public function getRelated(){
        return PharProductRelated::where('description','like','%'.$this->search.'%')->paginate($this->show);
    }

    public function destroyRelated($id){
        try {
            PharProductRelated::where('id',$id)->delete();
            $res = 'success';
        } catch (\Illuminate\Database\QueryException $e) {
            $res = 'error';
        }
        $this->dispatchBrowserEvent('phar-related-delete', ['res' => $res]);
    }
}
