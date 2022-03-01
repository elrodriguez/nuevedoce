<?php

namespace Modules\Setting\Http\Livewire\User;

use App\Models\User;
use App\Models\UserEstablishment as ModelsUserEstablishment;
use Livewire\Component;
use Modules\Setting\Entities\SetEstablishment;

class UserEstablishment extends Component
{
    public $establishment_id = null;
    public $establishments = [];
    public $main = false;
    public $user_id;
    public $user_establishments = [];


    protected $listeners = ['openModalUserEstablishment' => 'openModal'];
 
    public function mount(){
        $this->establishments = SetEstablishment::where('state',true)->get();
    }

    public function openModal($user_id)
    {
        $user = User::where('id',$user_id)->first();

        $this->user_id = $user_id;

        $this->getEstablishments();

        $this->dispatchBrowserEvent('open-modal-user-establishment', ['user_name' => $user->name]);
    }

    public function save(){
        $this->validate([
            'establishment_id' => 'required|unique:user_establishments,establishment_id,null,id,user_id,' . $this->user_id
        ]);

        if($this->main){
            ModelsUserEstablishment::where('user_id',$this->user_id)
                ->update(['main' => false]);
        }

        ModelsUserEstablishment::create([
            'user_id' => $this->user_id,
            'establishment_id' => $this->establishment_id,
            'main' => $this->main
        ]);
        
        $this->dispatchBrowserEvent('set-user-establishment-save', ['msg' => 'Datos guardados correctamente.']);
    }

    public function render()
    {
        $this->getEstablishments();
        return view('setting::livewire.user.user-establishment');
    }

    public function getEstablishments(){
        $this->user_establishments = ModelsUserEstablishment::join('set_establishments','establishment_id','set_establishments.id')
                                    ->select(
                                        'user_establishments.id',
                                        'set_establishments.name',
                                        'user_establishments.main'
                                    )
                                    ->where('user_id',$this->user_id)
                                    ->get();
    }

    public function delete($id){
        ModelsUserEstablishment::find($id)->delete();
    }

    public function activeMain($id){
        ModelsUserEstablishment::where('user_id',$this->user_id)
                ->where('id','<>',$id)
                ->update(['main' => false]);
        ModelsUserEstablishment::where('id',$id)
                ->update(['main' => true]);
    }
    public function inactiveMain($id){
        ModelsUserEstablishment::where('id',$id)
                ->update(['main' => false]);
    }
}
