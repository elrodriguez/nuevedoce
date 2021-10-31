<?php

namespace Modules\Inventory\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class ItemPartController extends Controller
{
    /**
     * Display a listing of the resource.
     * @param int $id_item
     * @return Renderable
     */
    public function index($item_id)
    {
        return view('inventory::itempart.index')->with('item_id', $item_id);
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create($item_id)
    {
        return view('inventory::itempart.create')->with('item_id', $item_id);
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        return view('inventory::itempart.edit')->with('id',$id);
    }
}
