<?php

namespace Modules\Setting\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class SetCompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        return view('setting::company.index');
    }
    public function create()
    {
        return view('setting::company.create');
    }
    public function edit($id)
    {
        return view('setting::company.edit')->with('id',$id);
    }

    public function systemEnvironment($id){
        return view('setting::company.system_environment')->with('id',$id);
    }
}
