<?php

namespace Modules\TransferService\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Modules\Inventory\Entities\InvItem;
use App\Models\Customer;
use App\Models\Person;
use Modules\Staff\Entities\StaEmployee;
use Modules\TransferService\Entities\SerLocal;

class OdtRequestController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        return view('transferservice::odtrequests.index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('transferservice::odtrequests.create');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        return view('transferservice::odtrequests.edit')->with('id', $id);
    }

    public function autocomplete(Request $request){
        $search = $request->input('q');
        $customers    = Customer::where('state', true)
            ->join('people', 'person_id', 'people.id')
            ->select(
                'customers.id AS value',
                DB::raw("CONCAT(people.number, ' - ', people.full_name) AS text")
            )
            ->where('people.full_name','like','%'.$search.'%')
            ->get();
        return response()->json($customers, 200);
    }

    public function autocompleteItems(Request $request){
        $search = $request->input('q');
        $items = InvItem::where('status', true)
            ->select(
                'id AS value',
                DB::raw('CONCAT(IFNULL(name,description)) AS text')
            )
            ->where('part','=','0')
            ->where('inv_items.name','like','%'.$search.'%')
            ->get();
        return response()->json($items, 200);
    }

    public function autocompleteCompanies(Request $request){
        $search = $request->input('q');
        $companies = Person::where('identity_document_type_id', '6')
            ->select(
                'id AS value',
                DB::raw('names AS text')
            )
            ->where('full_name','like','%'.$search.'%')
            ->orWhere('trade_name','like','%'.$search.'%')
            ->get();

        return response()->json($companies, 200);
    }

    public function autocompleteWholesalers(Request $request){
        $search = $request->input('q');
        $wholesalers = Person::where('identity_document_type_id', '6')
            ->select(
                'id AS value',
                'full_name AS text'
            )
            ->where('full_name','like','%'.$search.'%')
            ->orWhere('trade_name','like','%'.$search.'%')
            ->get();
            
        return response()->json($wholesalers, 200);
    }

    public function autocompleteSupervisors(Request $request){
        $search = $request->input('q');
        $supervisors = StaEmployee::where('state', true)
            ->join('people', 'person_id', 'people.id')
            ->select(
                'sta_employees.id AS value',
                'people.full_name AS text'
            )
            ->where('people.full_name','like','%'.$search.'%')
            ->get();
            
        return response()->json($supervisors, 200);
    }

    public function autocompleteLocals(Request $request){
        $search = $request->input('q');
        $locals = SerLocal::select(
                'id AS value',
                'name AS text'
            )
            ->where('name','like','%'.$search.'%')
            ->get();
            
        return response()->json($locals, 200);
    }
}
