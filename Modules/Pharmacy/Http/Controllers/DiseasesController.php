<?php

namespace Modules\Pharmacy\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Pharmacy\Entities\PharDisease;
use Modules\Pharmacy\Entities\PharSymptom;

class DiseasesController extends Controller
{

    public function index()
    {
        return view('pharmacy::diseases.index');
    }

    public function create()
    {
        return view('pharmacy::diseases.create');
    }

    public function edit($id)
    {
        return view('pharmacy::diseases.edit')->with('id',$id);
    }

   public function symptoms($id){
        return view('pharmacy::diseases.symptoms')->with('id',$id);
   }

   public function searchSymptoms(Request $request){
        $search = $request->input('q');

        $like = "%" .str_replace(' ','',$search). "%";

        $items = PharSymptom::whereRaw("REPLACE(description, ' ', '') LIKE ?", [$like])
            ->orderBy('description')
            ->limit(100)
            ->get();
        
        $data = [];

        if(count($items)>0){
            foreach($items as $k => $item){
                $data[$k] = [
                    'value' => $item->id,
                    'text' => $item->description
                ];
            }
        }
        
        return response()->json($data, 200);
   }

   public function searchDiseases(Request $request){
        $search = $request->input('q');

        $like = "%" .str_replace(' ','',$search). "%";

        $items = PharDisease::whereRaw("REPLACE(name, ' ', '') LIKE ?", [$like])
            ->orderBy('name')
            ->limit(100)
            ->get();
        
        $data = [];

        if(count($items)>0){
            foreach($items as $k => $item){
                $data[$k] = [
                    'value' => $item->id,
                    'text' => $item->name
                ];
            }
        }
        
        return response()->json($data, 200);
    }
}
