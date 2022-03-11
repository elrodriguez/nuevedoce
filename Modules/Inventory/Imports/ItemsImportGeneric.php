<?php

namespace Modules\Inventory\Imports;

use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;
use Modules\Inventory\Entities\InvAsset;
use Modules\Inventory\Entities\InvBrand;
use Modules\Inventory\Entities\InvCategory;
use Modules\Inventory\Entities\InvItem;
use Modules\Inventory\Entities\InvItemPart;
use Modules\Inventory\Entities\InvKardex;
use Modules\Inventory\Entities\InvModel;

class ItemsImportGeneric implements ToModel
{
    public function model(array $row)
    {

        if($row[0]){
            $row_10 = ($row[10]?$row[10]:0);
            if(strtolower($row[0]) == 'Descripción' && strtolower($row[1]) == 'Código Interno'){

            }else{
                $model_id           = null;
                $family_id          = null;
                $asset_id           = null;
                $brand_id           = null;
                $brand              = [];

                if($row[13]){
                    $brand  = InvBrand::where('description','=',$row[13])->first();
                    if($brand){
                        $brand_id = $brand->id;
                    }else{
                        $brand = InvBrand::create([
                            'description'   => $row[13],
                            'status'        => true
                        ]);
                        $brand_id = $brand->id;
                    }

                }else{
                    $brand  = InvBrand::where('description','=','SIN MARCA')->first();
                    if($brand){
                        $brand_id = $brand->id;
                    }else{
                        $brand = InvBrand::create([
                            'id'            => 1,
                            'description'   => 'SIN MARCA',
                            'status'        => true
                        ]);
                        $brand_id = $brand->id;
                    }
                }
                
                $family = InvCategory::where('description','=',$row[12])->first();

                // $model  = InvModel::where('description','=',$row[2])->first();

                // $asset  = InvItem::where('name','=',$row[1])->where('description','=',$row[2])->first();
                $asset  = InvItem::where('name','=',$row[0])->first();

                if($family){
                    $family_id = $family->id;
                }else{
                    
                    $family_new = InvCategory::create([
                        'description'   => ($row[12]?$row[12]:'SIN FAMILIA'),
                        'status'        => true
                    ]);

                    $family_id = $family_new->id;
                }

                // if($model){
                //     $model_id = $model->id;
                // }else{
                    
                //     $model_new = InvModel::create([
                //         'description'   => ($row[2]?$row[2]:'SIN MODELO')
                //     ]);

                //     $model_id = $model_new->id;
                // }

                if($asset){
                    
                }else{

                    $asset_new = InvItem::create([
                        'name' => $row[0],
                        'description' => null,
                        'purchase_price' => $row[8],
                        'sale_price' => $row[5],
                        'status' => true,
                        'brand_id' => $brand_id,
                        'category_id' => $family_id,
                        'unit_measure_id' => $row[3],
                        'person_create' => Auth::user()->person_id,
                        'stock_min' => $row[11],
                        'currency_type_id' => $row[4],
                        'sale_affectation_igv_type_id' => $row[6],
                        'item_type_id' => '01',
                        'stock' => $row[10],
                        'internal_id' => $row[1],
                        'item_code' => $row[2],
                        'has_igv'  => $row[7] == 'SI' ? true : false,
                        'purchase_affectation_igv_type_id' => $row[9]
                    ]);
                    
                    InvKardex::create([
                        'date_of_issue'     => Carbon::now()->format('Y-m-d'),
                        'establishment_id'  => 1,
                        'location_id'       => 1,
                        'item_id'           => $asset_new->id,
                        'quantity'          => $row_10,
                        'detail'            => 'stock inicial'
                    ]);

                    InvAsset::create([
                        'patrimonial_code' => $row[1],
                        'item_id' => $asset_new->id,
                        'state' => true,
                        'person_create' => Auth::user()->person_id,
                        'location_id' => 1,
                        'stock' => $row[10]
                    ]);
                }
            }
        }
    }
    public function getRowCount(): int
    {
        return $this->numRows;
    }
}