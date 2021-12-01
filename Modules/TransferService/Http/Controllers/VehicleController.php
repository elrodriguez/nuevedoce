<?php

namespace Modules\TransferService\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Staff\Entities\StaEmployee;

class VehicleController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        return view('transferservice::vehicles.index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('transferservice::vehicles.create');
    }
    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('transferservice::vehicles.index');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        return view('transferservice::vehicles.edit')->with('id', $id);
    }


    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function crew($id)
    {
        return view('transferservice::vehicles.crew')->with('id', $id);
    }

    public function searchEmployee(Request $request){
        $search = $request->input('q');
        $employees = StaEmployee::join('people','person_id','people.id')
            ->select('sta_employees.id AS value')
            ->selectRaw('CONCAT(people.number," - ",people.full_name) AS text')
            ->where('people.full_name','like','%'.$search.'%')
            ->get();
        return response()->json($employees, 200);
    }
}
