<?php

namespace Modules\Inventory\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
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
                DB::raw('CONCAT(name," ",IFNULL(description,"")) AS text')
            )
            ->where('name','like','%'.$search.'%')
            //->where('part','=','0')
            //->where('item_id','=',NULL)
            ->get();
        return response()->json($customers, 200);
    }

    public function parts($item_id,$asset_id){
        return view('inventory::asset.parts')
                    ->with('item_id',$item_id)
                    ->with('asset_id',$asset_id);
    }
}
