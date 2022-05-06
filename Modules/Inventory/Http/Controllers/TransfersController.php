<?php

namespace Modules\Inventory\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Modules\Inventory\Entities\InvKardex;
use Barryvdh\DomPDF\Facade\Pdf;
use Modules\Inventory\Entities\InvItem;
use Modules\Inventory\Entities\InvTransfer;

class TransfersController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        return view('inventory::transfers.index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('inventory::transfers.create');
    }

    public function autoCompleteProduc(Request $request)
    {
        $search = $request->input('q');
        $customers = InvItem::where('status', true)
            ->select(
                'id AS value',
                'name AS text'
            )
            ->where('name', 'like', '%' . $search . '%')
            ->get();

        return response()->json($customers, 200);
    }

    public function exportTransferPDF($id)
    {
        $products = $this->getDataTransfer($id);

        view()->share('products', $products);

        $pdf = PDF::loadView('inventory::transfers.export_pdf', $products);
        return $pdf->download('transfer.pdf');
    }

    public function getDataTransfer($id)
    {
        $products = InvKardex::join('inv_items', 'item_id', 'inv_items.id')
            ->join('inv_transfers', function ($query) {
                $query->on('inv_kardexes.kardexable_id', 'inv_transfers.id')
                    ->where('inv_kardexes.kardexable_type', InvTransfer::class);
            })
            ->join('inv_locations AS origin', 'inv_transfers.warehouse_id', 'origin.id')
            ->join('inv_locations AS destination', 'inv_transfers.warehouse_destination_id', 'destination.id')
            ->select(
                DB::raw('CONCAT(inv_items.name,IF(inv_items.description IS NOT NULL,CONCAT(" - ",inv_items.description),"")) AS name'),
                'inv_kardexes.quantity',
                'inv_transfers.description',
                'inv_transfers.quantity AS transfer_quantity',
                'inv_transfers.created_at',
                'origin.name AS origin_name',
                'destination.name AS destination_name',
            )
            ->where('inv_transfers.id', $id)
            ->get();

        $data = [];

        foreach ($products as $key => $product) {
            $data[$key] = [
                'name' => $product->name,
                'quantity' => $product->quantity,
                'description' => $product->description,
                'transfer_quantity' => $product->transfer_quantity,
                'created_at' => $product->created_at,
                'origin_name' => $product->origin_name,
                'destination_name' => $product->destination_name,
            ];
        }

        return $data;
    }
}
