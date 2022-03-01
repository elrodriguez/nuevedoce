<?php

namespace Modules\Sales\Http\Controllers;

use App\Models\Person;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;

class CustomersController extends Controller
{
    public function searchCustomers(Request $request){
        $persons = Person::where('trade_name','like','%'.$request->input('q').'%')
            ->select(
                'people.id AS value',
                DB::raw('CONCAT(people.number," - ",people.trade_name) AS text')
            )
            ->limit(200)
            ->get();

        return response()->json($persons, 200);
    }
}
