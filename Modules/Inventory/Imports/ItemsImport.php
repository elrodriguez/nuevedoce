<?php

namespace Modules\Inventory\Imports;

use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;
use Modules\Inventory\Entities\InvBrand;
use Modules\Inventory\Entities\InvCategory;
use Modules\Inventory\Entities\InvItem;
use Modules\Inventory\Entities\InvItemPart;
use Modules\Inventory\Entities\InvKardex;
use Modules\Inventory\Entities\InvModel;

class ItemsImport implements ToModel
{
    public function model(array $row)
    {
        if($row[0]){
            $row_5 = ($row[5]?$row[5]:1);
            $row_7 = ($row[7]?$row[7]:1);
            if(strtolower($row[0]) == 'familia' && strtolower($row[1]) == 'subfamilia'){

            }else{
                $model_id           = null;
                $family_id          = null;
                $asset_id           = null;
                $brand_id           = null;
                $brand              = [];

                if($row[4]){
                    $brand  = InvBrand::where('description','=',$row[4])->first();
                    if($brand){
                        $brand_id = $brand->id;
                    }else{
                        $brand = InvBrand::create([
                            'description'   => $row[4],
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
                
                $family = InvCategory::where('description','=',$row[0])->first();

                $model  = InvModel::where('description','=',$row[2])->first();

                $asset  = InvItem::where('name','=',$row[1])->where('description','=',$row[2])->first();

                if($family){
                    $family_id = $family->id;
                }else{
                    
                    $family_new = InvCategory::create([
                        'description'   => ($row[0]?$row[0]:'SIN FAMILIA'),
                        'status'        => true
                    ]);

                    $family_id = $family_new->id;
                }

                if($model){
                    $model_id = $model->id;
                }else{
                    
                    $model_new = InvModel::create([
                        'description'   => ($row[2]?$row[2]:'SIN MODELO')
                    ]);

                    $model_id = $model_new->id;
                }

                if($asset){
                    $asset_id = $asset->id;
                    
                }else{
                    if($row[1]){
                        $asset_new = InvItem::create([
                            'name'          => $row[1],
                            'description'   => $row[2],
                            'part'          => false,
                            'weight'        => 0,
                            'width'         => 0,
                            'high'          => 0,
                            'long'          => 0,
                            'number_parts'  => 0,
                            'status'        => true,
                            'brand_id'      => $brand_id,
                            'category_id'   => $family_id,
                            'person_create' => Auth::user()->person_id,
                            'model_id'      => $model_id
                        ]);
                        
                        InvKardex::create([
                            'date_of_issue'     => Carbon::now()->format('Y-m-d'),
                            'establishment_id'  => 1,
                            'location_id'       => 1,
                            'item_id'           => $asset_new->id,
                            'quantity'          => $row_7,
                            'detail'            => 'stock inicial'
                        ]);
    
                        $asset_id = $asset_new->id;
                    }
                }

                $part_id = null;
                $part = InvItem::where('name','=',$row[3])->first();
                
                $part_sum_db = 0;

                if($part){
                    $part_sum_db = InvItemPart::where('part_id',$part->id)->sum('quantity');
                    InvKardex::where('item_id')->update([
                        'quantity' => $part_sum_db + ($row_5 * $row_7)
                    ]);
                    $part_id = $part->id;
                }else{
                    $part_new = InvItem::create([
                        'name'          => $row[3],
                        'description'   => null,
                        'part'          => ($asset_id ? true : false),
                        'weight'        => 0,
                        'width'         => 0,
                        'high'          => 0,
                        'long'          => 0,
                        'number_parts'  => 0,
                        'status'        => true,
                        'brand_id'      => $brand_id,
                        'category_id'   => $family_id,
                        'person_create' => Auth::user()->person_id
                    ]);

                    InvKardex::create([
                        'date_of_issue'     => Carbon::now()->format('Y-m-d'),
                        'establishment_id'  => 1,
                        'location_id'       => 1,
                        'item_id'           => $part_new->id,
                        'quantity'          => ($row_5 * $row_7),
                        'detail'            => 'stock inicial'
                    ]);

                    $part_id = $part_new->id;
                }

                $exists = InvItemPart::where('item_id',$asset_id)
                            ->where('part_id',$part_id)
                            ->exists();

                if(!$exists){
                    if($asset_id){
                        InvItemPart::create([
                            'item_id'       => $asset_id,
                            'part_id'       => $part_id,
                            'state'         => true,
                            'quantity'      => $row_5,
                            'observations'  => $row[6]
                        ]);
                    }
                }
            }
        }
    }
    public function getRowCount(): int
    {
        return $this->numRows;
    }
}