<?php

namespace Modules\Pharmacy\Http\Controllers;

use App\Models\Person;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;

class SalesController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        return view('pharmacy::index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('pharmacy::sales.create');
    }

    public function searchCustomers(Request $request){
        $search = $request->input('q');
        $persons = Person::select(
                'people.id AS value',
                DB::raw('CONCAT(people.number," - ",people.trade_name) AS text')
            )
            ->where('people.number','=',$search)
            ->orWhere('full_name','like','%'.$search.'%')
            ->limit(200)
            ->get();

        return response()->json($persons, 200);
    }
}
