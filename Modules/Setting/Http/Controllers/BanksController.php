<?php

namespace Modules\Setting\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class BanksController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        return view('setting::banks.index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('setting::banks.create');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        return view('setting::banks.edit')->with('id',$id);
    }

    public function accounts()
    {
        return view('setting::banks.accounts');
    }

    public function accountsCreate()
    {
        return view('setting::banks.accounts_create');
    }

    public function accountsEdit($id){
        return view('setting::banks.accounts_edit')->with('id',$id);
    }
}
