<?php

namespace Modules\Inventory\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Modules\Inventory\Entities\InvItem;

class KardexController extends Controller
{

    public function itemsstock()
    {
        return view('inventory::kardex.itemsstock');
    }

    public function autocompleteItems(Request $request){
        $search = $request->input('q');
        $customers = InvItem::where('status', true)
            ->select(
                'id AS value',
                DB::raw('CONCAT(name," ",IF(description IS NULL,"",description)) AS text')
            )
            ->where('inv_items.name','like','%'.$search.'%')
            ->get();
        return response()->json($customers, 200);
    }

    public function activecodes(){
        return view('inventory::kardex.activecodes');
    }
}
