<?php

namespace Modules\Inventory\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Inventory\Entities\InvItem;

class TransfersController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        return view('inventory::transfers.index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('inventory::transfers.create');
    }

    public function autoCompleteProduc(Request $request)
    {
        $search = $request->input('q');
        $customers = InvItem::where('status', true)
            ->select(
                'id AS value',
                'name AS text'
            )
            ->where('name', 'like', '%' . $search . '%')
            ->get();

        return response()->json($customers, 200);
    }
}
