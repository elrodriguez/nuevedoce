<?php

namespace Modules\Setting\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class RolesController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        return view('setting::roles.index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function permissions($id)
    {
        return view('setting::roles.permissions')->with('id',$id);
    }

}
