<?php

namespace Modules\Setting\Http\Livewire\User;

use App\Models\Person;
use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class UserList extends Component
{
    public $show;
    public $search;

    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public function mount(){
        $this->show = 10;
    }

    public function render()
    {
        return view('setting::livewire.user.user-list',['users' => $this->getUsers()]);
    }

    public function userSearch()
    {
        $this->resetPage();
    }

    public function getUsers(){
        return User::where('name','like','%'.$this->search.'%')
            ->where('id','<>',1)
            ->paginate($this->show);
    }

    public function deleteUser($id){
        $user = User::find($id);
        $person_id = $user->person_id;
        $user->delete();
        Person::find($person_id)->delete();
        
        $this->dispatchBrowserEvent('set-user-delete', ['msg' => 'Datos eliminados correctamente.']);
    }
}
