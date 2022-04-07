<?php

namespace Modules\Sales\Http\Livewire\Dashboard;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Modules\Sales\Entities\SalDocumentPayment;
use Modules\Sales\Entities\SalSaleNotePayment;

class TotalSales extends Component
{
    public $total;
    public function mount(){
        $this->getTotal();
    }
    public function render()
    {
        return view('sales::livewire.dashboard.total-sales');
    }

    public function getTotal(){
        $user = User::find(Auth::id());
        $role = $user->getRoleNames();
        $roles = array('Administrador','Gerente','TI');
        $bool = in_array($role, $roles);
        $user_id = Auth::id();

        $total_vouchers = SalDocumentPayment::join('sal_documents','document_id','sal_documents.id')
                            ->when($bool == false, function ($query) use ($user_id){
                                return $query->where('sal_documents.user_id', $user_id);
                            })
                            ->whereNotIn('sal_documents.state_type_id',['11','13'])
                            ->sum('sal_document_payments.payment');

        $total_sale_notes = SalSaleNotePayment::join('sal_sale_notes','sale_note_id','sal_sale_notes.id')
                            ->when($bool == false, function ($query) use ($user_id){
                                return $query->where('sal_sale_notes.user_id', $user_id);
                            })
                            ->whereNotIn('sal_sale_notes.state_type_id',['11','13'])
                            ->sum('sal_sale_note_payments.payment');

        $this->total = $total_vouchers + $total_sale_notes;
    }
}
