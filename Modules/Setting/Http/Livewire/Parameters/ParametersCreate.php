<?php

namespace Modules\Setting\Http\Livewire\Parameters;

use App\Models\Parameter;
use Illuminate\Support\Facades\Lang;
use Livewire\Component;

class ParametersCreate extends Component
{
    public $types;
    public $id_type;
    public $id_parameter;
    public $value_default;
    public $code_sql;
    public $description;
    public $display;

    protected $listeners = ['openModelParameterCreate' => 'openModelParameter'];

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

    public function openModelParameter(){
        $this->dispatchBrowserEvent('open-modal-paramter',['valor' => true]);
    }
    public function render()
    {
        return view('setting::livewire.parameters.parameters-create');
    }

    public function store(){
        $this->validate([
            'id_type' => 'required',
            'id_parameter' => 'required|min:8|unique:parameters',
            'value_default' => 'required|max:255',
            'description' => 'required|max:500'
        ]);

        Parameter::create([
            'type' => $this->id_type,
            'code_sql' =>  $this->code_sql,
            'id_parameter' => strtoupper($this->id_parameter),
            'description' => $this->description,
            'value_default' => $this->value_default
        ]);

        $this->clearInput();
        $this->emit('listParameter');
        $this->dispatchBrowserEvent('message-confir-modal-paramter',['message' => Lang::get('labels.successfully_registered')]);
    }

    public function clearInput(){
        $this->id_type = null;
        $this->code_sql = null;
        $this->id_parameter = null;
        $this->description = null;
        $this->value_default = null;
    }

    public function changeType(){
        if($this->id_type == '1' || $this->id_type == '8'){
            $this->display = false;
        }else{
            $this->display = true;
        }
    }
}
