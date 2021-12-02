<?php

namespace Modules\Lend\Http\Livewire\Customers;

use Elrod\UserActivity\Activity;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Person;
use Illuminate\Support\Facades\Lang;
use App\Models\Customer;

class CustomersList extends Component
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
        return view('lend::livewire.customers.customers-list', ['customers' => $this->getCustomers()]);
    }

    public function getCustomers(){
        return Customer::where('people.full_name','like','%'.$this->search.'%')
            ->join('people', 'person_id', 'people.id')
            ->join('identity_document_types', 'people.identity_document_type_id', 'identity_document_types.id')
            ->select(
                'customers.id',
                'people.full_name',
                'identity_document_types.description as name_type_document',
                'people.number',
                'customers.direct',
                'customers.state'
            )
            ->paginate($this->show);
    }

    public function people(){
        return $this->hasOne(Person::class); #belongsTo
    }

    public function customersSearch()
    {
        $this->resetPage();
    }

    public function deleteDirectory($dir) {
        if (!file_exists($dir)) {
            return true;
        }

        if (!is_dir($dir)) {
            return unlink($dir);
        }

        foreach (scandir($dir) as $item) {
            if ($item == '.' || $item == '..') {
                continue;
            }

            if (!$this->deleteDirectory($dir . DIRECTORY_SEPARATOR . $item)) {
                return false;
            }

        }

        return rmdir($dir);
    }

    public function deleteCustomer($id){
        $employee = Customer::find($id);
        $person_id = $employee->person_id;

        $activity = new activity;
        $activity->log('Eliminó el Cliente');
        $activity->modelOn(SerVehicle::class,$id,'customers');
        $activity->dataOld($employee);
        $activity->logType('delete');
        $activity->causedBy(Auth::user());
        $activity->save();

        $employee->delete();
        #Person::find($person_id)->delete();
        //Eliminar archivos y direcctorio
        $this->deleteDirectory('storage/customers_photo/'.$id);

        $this->dispatchBrowserEvent('ser-customers-delete', ['msg' => Lang::get('lend::messages.msg_delete')]);
    }
}
