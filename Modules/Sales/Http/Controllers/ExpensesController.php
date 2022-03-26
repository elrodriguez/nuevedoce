<?php

namespace Modules\Sales\Http\Controllers;

use App\Models\Person;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;

class ExpensesController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        return view('sales::expenses.index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('sales::expenses.create');
    }


    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        return view('sales::expenses.edit')->with('id',$id);
    }

    public function autocompleteCompanies(Request $request){
        $search = $request->input('q');
        $companies = Person::where('identity_document_type_id', '6')
            ->select(
                'id AS value',
                DB::raw('full_name AS text')
            )
            ->where('full_name','like','%'.$search.'%')
            ->orWhere('trade_name','like','%'.$search.'%')
            ->get();

        return response()->json($companies, 200);
    }
}
