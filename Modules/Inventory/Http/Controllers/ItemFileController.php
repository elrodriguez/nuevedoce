<?php

namespace Modules\Inventory\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Modules\Inventory\Entities\InvItemFile;

class ItemFileController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        return view('inventory::item_file.index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('inventory::item_file.create');
    }


    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        return view('inventory::item.file')->with('item_id', $id);
    }

    public function dropZone(Request $request){
        $file = $request->file('file');
        $item_id = $request['item_id'];
//        $archivo = $_FILES['xyzFileUpload'];

//        $archivo_temnombre  = $archivo['tmp_name'];
//        $archivo_nombre     = basename($archivo['name']);
//        $archivo_tamanho    = $archivo['size'];
//        $archivo_tipo       = $archivo['type'];
//        $extension          = explode('.', $archivo_nombre);
//        $extension          = $extension[1];
        $extension          = $file->extension();
        $fileName           = time().'.'.$extension;
        $route_img          = 'item_images/Activo_'.$item_id.'/';

//        if(move_uploaded_file($archivo_temnombre, public_path('storage/'.$route_img.$fileName))) {
        if($fileName != '') {
            $file->storeAs($route_img, $fileName,'public');
            $item_file = InvItemFile::create([
                'name' => $fileName,
                'route' => $route_img.$fileName,
                'extension' => $extension,
                'item_id' => $item_id,
                'person_create'=> Auth::user()->person_id
            ]);
            $msg = 'OK';
        } else {
            $msg    = "error";
        }
        return response()->json(['result'=>$msg]);
    }
}

