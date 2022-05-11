<?php

namespace Modules\Restaurant\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class CategoriesController extends Controller
{
    public function index()
    {
        return view('restaurant::categories.index');
    }

    public function create()
    {
        return view('restaurant::categories.create');
    }

    public function edit($id)
    {
        return view('restaurant::categories.edit')->with('id', $id);
    }
}
