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
        return view('sales::document.index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('sales::document.create');
    }

    public function notes($id)
    {
        return view('sales::document.note')->with('external_id',$id);
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

    public function downloadExternal($domain, $type, $filename, $format = null) {
        $extension = 'xml';
        switch ($type) {
            case 'pdf':
                $folder = 'pdf';
                $extension = 'pdf';
                break;
            case 'xml':
                $folder = 'signed';
                $extension = 'xml';
                break;
            case 'cdr':
                $folder = 'cdr';
                $extension = 'zip';
                break;
            case 'quotation':
                $folder = 'quotation';
                break;
            case 'sale_note':
                $folder = 'sale_note';
                break;

            default:
                throw new Exception('Tipo de archivo a descargar es inválido');
        }

        $route = 'storage'.DIRECTORY_SEPARATOR.$domain.DIRECTORY_SEPARATOR.'document'.DIRECTORY_SEPARATOR.$folder.DIRECTORY_SEPARATOR.$filename.'.'.$extension;
        
        return response()->download(public_path($route));
    }
}
