<?php

namespace Modules\Sales\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
Use App\CoreBilling\Billing;
use App\CoreBilling\Helpers\Storage\StorageDocument;
use Exception;
use Modules\Sales\Entities\SalDocument;

class DocumentsController extends Controller
{
    use StorageDocument;
    protected $route = 'sales/document';
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        return view('sales::index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('sales::document.create');
    }

    public function toPrintInvoice($external_id, $format = null) {


        $document = SalDocument::where('external_id', $external_id)->first();

        if (!$document) throw new Exception("El código {$external_id} es inválido, no se encontro documento relacionado");

        if ($format != null) $this->reloadPDF($document, 'invoice', $format, $this->route);
        $temp = tempnam(sys_get_temp_dir(), 'pdf');
        file_put_contents($temp, $this->getStorage($document->filename, 'pdf',$this->route));

        return response()->file($temp);
    }

    private function reloadPDF($document, $type, $format, $route) {
        $billing = new Billing();
        $billing->createPdf($document,'invoice',$format, $route);
    }

}
