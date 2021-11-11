<?php

namespace Modules\Inventory\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Inventory\Entities\InvItem;

class AssetController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        return view('inventory::asset.index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('inventory::asset.create');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        return view('inventory::asset.edit')->with('id',$id);
    }

    public function autocomplete(Request $request){
        $search = $request->input('q');
        $customers    = InvItem::where('status', true)
            ->select(
                'id AS value',
                'name AS text'
            )
            ->where('name','like','%'.$search.'%')
            //->where('part','=','0')
            //->where('item_id','=',NULL)
            ->get();
        return response()->json($customers, 200);
    }
}
