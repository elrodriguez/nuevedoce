<?php

namespace Modules\TransferService\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Modules\Inventory\Entities\InvAsset;
use Modules\Inventory\Entities\InvItem;
use Modules\TransferService\Entities\SerCustomer;

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
        $customers    = SerCustomer::where('state', true)
            ->join('people', 'person_id', 'people.id')
            ->select(
                'ser_customers.id AS value',
                DB::raw("CONCAT(people.number, ' - ', people.full_name) AS text")
            )
            ->where('people.full_name','like','%'.$search.'%')
            ->get();
        return response()->json($customers, 200);
    }

    public function autocompleteItems(Request $request){
        $search = $request->input('q');
        $customers = InvItem::where('status', true)
            ->select(
                'id AS value',
                DB::raw('CONCAT(name," ",description) AS text')
            )
            ->where('part','=','0')
            ->where('inv_items.name','like','%'.$search.'%')
            ->get();
        return response()->json($customers, 200);
    }
}
