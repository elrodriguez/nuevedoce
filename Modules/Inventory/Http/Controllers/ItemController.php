<?php

namespace Modules\Inventory\Http\Controllers;

use App\Models\Parameter;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Modules\Inventory\Entities\InvItem;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $PRT0001GN = Parameter::where('id_parameter','PRT0001GN')->first()->value_default;

        return view('inventory::item.index')->with('interfaz',$PRT0001GN);
        
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        $PRT0001GN = Parameter::where('id_parameter','PRT0001GN')->first()->value_default;
        return view('inventory::item.create')->with('interfaz',$PRT0001GN);
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        $PRT0001GN = Parameter::where('id_parameter','PRT0001GN')->first()->value_default;
        return view('inventory::item.edit')->with('id',$id)->with('interfaz',$PRT0001GN);
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function getDownload()
    {
        $file= public_path(). "/storage/items.xlsx";
        return response()->download($file, 'items.xlsx');
    }


    public function autocomplete(Request $request){
        $search = $request->input('q');
        $customers    = InvItem::where('status', true)
            ->select(
                'id AS value',
                'name AS text',
                'weight'
            )
            ->where('name','like','%'.$search.'%')
            ->where('part','=','1')
            ->get();
            
        return response()->json($customers, 200);
    }
}
