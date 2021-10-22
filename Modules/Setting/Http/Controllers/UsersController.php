<?php

namespace Modules\Setting\Http\Controllers;

use App\Models\User;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */


    public function index()
    {
        return view('setting::user.index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('setting::user.create');
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function roles($id)
    {
        return view('setting::user.roles')->with('id',$id);
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        return view('setting::user.edit')->with('id',$id);
    }

    public function activities($id = null){
        return view('setting::user.activities')->with('id',$id);
    }

    public function autocomplete(Request $request){
        $search = $request->input('q');
        $user = User::select(
                'id AS value',
                'name AS text'
            )
            ->where('name','like','%'.$search.'%')
            ->where('username','=',$search)
            ->get();
        return response()->json($user, 200);
    }
}
