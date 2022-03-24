<?php

namespace Modules\Sales\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Modules\Inventory\Entities\InvItem;
use Modules\Inventory\Entities\InvLocation;

class ItemsController extends Controller
{
    public function searchItems(Request $request){
        $establishment_id = $request->input('est');
        $search = $request->input('qry');

        $warehouse_id = InvLocation::where('establishment_id',$establishment_id)->value('id');

        $items = InvItem::leftJoin('inv_brands','inv_items.brand_id','inv_brands.id')
            ->leftJoin('inv_assets','inv_assets.item_id','inv_items.id')
            ->select(
                'inv_items.id',
                'inv_assets.patrimonial_code',
                'inv_items.name',
                'inv_brands.description',
                'inv_items.has_plastic_bag_taxes',
                'inv_items.sale_price'
            )
            ->selectSub(function($query) {
                $query->from('inv_kardexes')->selectRaw('SUM(quantity)')
                ->whereColumn('inv_kardexes.item_id','inv_items.id')
                ->whereColumn('inv_kardexes.location_id','inv_assets.location_id');
            }, 'stock')
            ->where('inv_assets.location_id',$warehouse_id)
            ->where(function($query) use ($search){
                $query->where('inv_assets.patrimonial_code','=', $search)
                    ->orWhere(DB::raw("REPLACE(inv_items.name, ' ', '')"), 'like', "%" .str_replace(' ','',$search). "%");
            })
            ->orderBy('inv_items.name')
            ->limit(100)
            ->get();
        
        $data = [];

        if(count($items)>0){
            foreach($items as $k => $item){
                $data[$k] = [
                    'value' => $item->id,
                    'text' => ($item->patrimonial_code ? $item->patrimonial_code.' - ' : '').$item->name.
                            ($item->description ? ' - Marca: '.$item->description : '').
                            ($item->sale_price ? ' - Precio: '.$item->sale_price : '').
                            ($item->stock ? ' - Stock: '.$item->stock : ''),
                    'icbper' => $item->has_plastic_bag_taxes,
                    'sale_price' => $item->sale_price
                ];
            }
        }
        
        return response()->json($data, 200);
    }
}
