<?php

namespace Modules\Setting\Http\Livewire\Parameters;

use App\Models\Parameter;
use Livewire\WithPagination;
use Livewire\Component;
use Illuminate\Support\Facades\Lang;

class ParametersList extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';
    protected $listeners = ['listParameter' => 'updatingListParameter'];

    public $search = '';
    public $value_default = [];

    public function updatingListParameter()
    {
        $this->resetPage();
    }

    public function render()
    {
        return view('setting::livewire.parameters.parameters-list',['parameters'=> $this->list()]);
    }

    public function changeValueDefaultSave($idparamert,$key){
        Parameter::where('id', $idparamert)->update(['value_default' => $this->value_default[$key]]);
        $this->dispatchBrowserEvent('response_parameter_value_default_update', ['message' => Lang::get('labels.was_successfully_updated')]);
    }

    public function list(){
        $data = Parameter::where('description', 'like', '%'.$this->search.'%')->paginate(10);
        foreach($data as $key => $item){
            if($item->type == 5){
                $this->value_default[$key] = (int) $item->value_default;
            }else{
                $this->value_default[$key] = $item->value_default;
            }
        }

        return $data;
    }

    public function deleteparameter($id){
        try {
            Parameter::find($id)->delete();
            $res = 'success';
        } catch (\Illuminate\Database\QueryException $e) {
            $res = 'error';
        }
        $this->dispatchBrowserEvent('set-parameter-delete', ['res' => $res]);
    }
}
