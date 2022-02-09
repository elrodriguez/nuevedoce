<?php

namespace Modules\Sales\Http\Livewire\Cash;


use App\Models\User;
use Livewire\Component;
use Elrod\UserActivity\Activity;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\WithPagination;
use Modules\Sales\Entities\SalCash;

class CashList extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    protected $listeners = ['listCashReset'];
    public $cash_id;

    public function mount(){
        $this->cash_id = null;
        $userActivity = new Activity;
        $userActivity->causedBy(Auth::user());
        $userActivity->routeOn(route('sales_administration_cash'));
        $userActivity->componentOn('sales.cash.cash-list');
        $userActivity->log('ingresó a la vista caja chica en ventas');
        $userActivity->save();
    }

    public function render()
    {
        return view('sales::livewire.cash.cash-list',['collection'=>$this->listCash()]);
    }

    public function listCash(){
        $user = User::find(Auth::id());
        $role = $user->getRoleNames();
        $roles = array('Administrador','SuperAdmin');
        $bool = in_array($role, $roles);
        $user_id = $user ->id;

        return SalCash::join('users','sal_cashes.user_id','users.id')
            ->select(
                'sal_cashes.id',
                'sal_cashes.date_opening',
                'sal_cashes.time_opening',
                'sal_cashes.date_closed',
                'sal_cashes.time_closed',
                'sal_cashes.beginning_balance',
                'sal_cashes.final_balance',
                'sal_cashes.income',
                'sal_cashes.state',
                'sal_cashes.reference_number',
                'users.name'
            )
            ->when($bool == true, function ($query) use ($user_id){
                return $query->where('sal_cashes.user_id', $user_id);
            })
            ->orderBy('sal_cashes.id','DESC')
            ->paginate(10);
    }

    public function showEdit($cash_id){
        $this->cash_id = $cash_id;
        $this->emit('updateCash', $this->cash_id);
    }
    public function listCashReset()
    {
        $this->listCash();
    }
}
