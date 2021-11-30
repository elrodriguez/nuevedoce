<?php

namespace Modules\Lend\Http\Controllers;

use App\Models\Person;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;

class ContractController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        return view('lend::contract.index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('lend::contract.create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('lend::contract.show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        return view('lend::contract.edit')->with('id', $id);
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        //
    }

    public function autocomplete(Request $request){
        $search = $request->input('q');
        $customers    = Person::where('identity_document_type_id', '<>', '0')
            ->select(
                'people.id AS value',
                DB::raw("CONCAT(people.number, ' - ', people.full_name) AS text")
            )
            ->where('people.full_name','like','%'.$search.'%')
            ->get();
        return response()->json($customers, 200);
    }
}