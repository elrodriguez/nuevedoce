<?php

namespace Modules\Inventory\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class AssetPartController extends Controller
{
    /**
     * Display a listing of the resource.
     * @param int $id_asset
     * @return Renderable
     */
    public function index($id_asset)
    {
        return view('inventory::asset_part.index')->with('id_asset',$id_asset);
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('inventory::asset_part.create');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        return view('inventory::asset_part.edit')->with('id',$id);
    }
}
