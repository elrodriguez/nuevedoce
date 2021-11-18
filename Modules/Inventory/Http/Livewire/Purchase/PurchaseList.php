<?php

namespace Modules\Inventory\Http\Livewire\Purchase;

use Livewire\Component;
use Elrod\UserActivity\Activity;
use Illuminate\Support\Facades\Auth;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
use Modules\Inventory\Entities\InvPurchase;

class PurchaseList extends Component
{
    public $show;
    public $search;
    public $file;

    use WithPagination;
    use WithFileUploads;
    protected $paginationTheme = 'bootstrap';

    public function mount(){
        $this->show = 10;
    }

    public function render()
    {
        return view('inventory::livewire.purchase.purchase-list', ['purchases'=>$this->getPurchases()]);
    }

    public function purchaseSearch()
    {
        $this->resetPage();
    }

    public function getPurchases(){
        return InvPurchase::where('inv_purchases.number','like','%'.$this->search.'%')
            ->orWhere('document_types.description','like','%'.$this->search.'%')
            ->leftJoin('document_types', 'document_type_id', 'document_types.id')
            ->leftJoin('people', 'supplier_id', 'people.id')
            ->select(
                'inv_purchases.id',
                'document_types.description AS name_document',
                'inv_purchases.serie',
                'inv_purchases.number',
                'inv_purchases.total',
                'people.full_name AS name_supplier'
            )
            ->paginate($this->show);
    }

    public function deletePurchase($id){
        try {
            $item = InvPurchase::find($id);

            $activity = new activity;
            $activity->log('Se eliminó la compra');
            $activity->modelOn(InvPurchase::class,$id,'inv_purchases');
            $activity->dataOld($item);
            $activity->logType('delete');
            $activity->causedBy(Auth::user());
            $activity->save();

            $item->delete();
            $res = 'success';
        } catch (\Illuminate\Database\QueryException $e) {
            $res = 'error';
        }
        $this->dispatchBrowserEvent('inv-purchase-delete', ['res' => $res]);
    }
}
