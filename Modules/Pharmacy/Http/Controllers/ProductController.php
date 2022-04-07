<?php

namespace Modules\Pharmacy\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Modules\Inventory\Entities\InvItem;
use Modules\Inventory\Entities\InvLocation;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function related()
    {
        return view('pharmacy::products.related');
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function relatedCreate()
    {
        return view('pharmacy::products.related_create');
    }
    public function searchItems(Request $request){
        $search = $request->input('q');

        $like = "%" .str_replace(' ','',$search). "%";
        $items = InvItem::leftJoin('inv_brands','inv_items.brand_id','inv_brands.id')
            ->select(
                'inv_items.id',
                'inv_items.name',
                'inv_brands.description',
                'inv_items.has_plastic_bag_taxes',
                'inv_items.sale_price'
            )
            ->whereRaw("REPLACE(inv_items.name, ' ', '') LIKE ?", [$like])
            ->orderBy('inv_items.name')
            ->limit(100)
            ->get();
        
        $data = [];

        if(count($items)>0){
            foreach($items as $k => $item){
                $data[$k] = [
                    'value' => $item->id,
                    'text' => $item->name.($item->description ? ' - Marca: '.$item->description : '')

                ];
            }
        }
        
        return response()->json($data, 200);
    }

    public function relatedEdit($id){
        return view('pharmacy::products.related_edit')->with('id',$id);
    }
}
