<?php

namespace Modules\Setting\Http\Livewire\Parameters;

use App\Models\Parameter;
use Illuminate\Support\Facades\Lang;
use Livewire\Component;

class ParametersEdit extends Component
{
    protected $listeners = ['openModelParameterEdit' => 'modelParameterEdit'];

    public $types;
    public $id_type;
    public $id_parameter;
    public $value_default;
    public $code_sql;
    public $description;
    public $display;
    public $p_id;

    public function render()
    {
        return view('setting::livewire.parameters.parameters-edit');
    }

    public function mount(){
        $this->types = [
            ['id' => 1,'name' => 'Input'],
            ['id' => 2,'name' => 'Select Array'],
            ['id' => 3,'name' => 'Select Tabla'],
            ['id' => 4,'name' => 'Radio'],
            //['id' => 5,'name' => 'Chekbox'],
            ['id' => 6,'name' => 'Chekbox Multipe Array'],
            ['id' => 7,'name' => 'Chekbox Multipe Tabla'],
            ['id' => 8,'name' => 'Textarea']
        ];
    }
    public function modelParameterEdit($id){
        $this->p_id = $id;
        $parameter = Parameter::find($id);

        $this->id_type = $parameter->type;
        $this->id_parameter = $parameter->id_parameter;
        $this->value_default = $parameter->value_default;
        $this->code_sql = $parameter->code_sql;
        $this->description = $parameter->description;

        if($this->id_type == '1' || $this->id_type == '8'){
            $this->display = false;
        }else{
            $this->display = true;
        }

        $this->dispatchBrowserEvent('open-modal-paramter-edit',['valor' => true]);
    }

    public function update(){
        $this->validate([
            'id_type' => 'required',
            'id_parameter' => 'string|required|min:8|unique:parameters,id,'.$this->p_id,
            'value_default' => 'required|max:255',
            'description' => 'required|max:500'
        ]);

        Parameter::find($this->p_id)->update([
            'type' => $this->id_type,
            'code_sql' =>  $this->code_sql,
            'description' => $this->description,
            'value_default' => $this->value_default
        ]);

        $this->emit('listParameter');
        $this->dispatchBrowserEvent('message-confir-modal-paramter-edit',['message' => Lang::get('labels.was_successfully_updated')]);
    }
}
