<?php

namespace Modules\Pharmacy\Http\Controllers;

use App\Models\Person;
use Exception;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Modules\Sales\Entities\SalDocument;
Use App\CoreBilling\Billing;
use Modules\Sales\Entities\SalSaleNote;
use App\CoreBilling\Helpers\Storage\StorageDocument;
use App\CoreBilling\Template;
use App\Models\Parameter;
use Mpdf\Mpdf;
use Mpdf\Config\ConfigVariables;
use Mpdf\Config\FontVariables;
use Modules\Setting\Entities\SetCompany;
use Mpdf\HTMLParserMode;
use Illuminate\Support\Facades\Storage;

class SalesController extends Controller
{
    use StorageDocument;

    protected $route;

    public function index()
    {
        return view('pharmacy::index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('pharmacy::sales.create');
    }

    public function searchCustomers(Request $request){
        $search = $request->input('q');
        $persons = Person::select(
                'people.id AS value',
                DB::raw('CONCAT(people.number," - ",people.trade_name) AS text')
            )
            ->where('people.number','=',$search)
            ->orWhere('full_name','like','%'.$search.'%')
            ->limit(200)
            ->get();

        return response()->json($persons, 200);
    }

    public function toPrintInvoice($external_id, $format = null, $type = 'invoice') {

        if($type == 'invoice'){
            $this->route = 'sales/document';
            $document = SalDocument::where('external_id', $external_id)->first();

            if (!$document) throw new Exception("El código {$external_id} es inválido, no se encontro documento relacionado");

            if ($format != null) $this->reloadPDF($document, 'invoice', $format, $this->route);
            $temp = tempnam(sys_get_temp_dir(), 'pdf');
            file_put_contents($temp, $this->getStorage($document->filename, 'pdf',$this->route));

            return response()->file($temp);
        }else{
            $this->route = 'sale_note';
            $document = SalSaleNote::where('external_id', $external_id)->first();

            if (!$document) throw new Exception("El código {$external_id} es inválido, no se encontro documento relacionado");

            if ($format != null) $this->reloadPDFSALENOTE($document, $format);
            $temp = tempnam(sys_get_temp_dir(), 'pdf');

            $new_doc = Storage::disk('public')->get($this->route.DIRECTORY_SEPARATOR.$document->filename.'.pdf');

            file_put_contents($temp, $new_doc); 

            return response()->file($temp);
        }

    }

    private function reloadPDF($document, $type, $format, $route) {
        $billing = new Billing();
        $billing->createPdf($document,$type,$format, $route);
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

    public function reloadPDFSALENOTE($sale_note = null, $format_pdf = null) {

        ini_set("pcre.backtrack_limit", "5000000");
        $template = new Template();
        $pdf = new Mpdf();

        $company = SetCompany::where('main',true)->first();
        $document = $sale_note;

        $base_template = Parameter::where('id_parameter','PRT003THM')->first()->value_default;

        $html = $template->pdf($base_template, "sale_note", $company, $document, $format_pdf);

        if (($format_pdf === 'ticket') OR ($format_pdf === 'ticket_58')) {

            $width = ($format_pdf === 'ticket_58') ? 56 : 78 ;

            $company_logo      = ($company->logo) ? 40 : 0;
            $company_name      = (strlen($company->name) / 20) * 10;
            $company_address   = (strlen($document->establishment->address) / 30) * 10;
            $company_number    = $document->establishment->phone != '' ? '10' : '0';
            $customer_name     = strlen($document->customer->names) > '25' ? '10' : '0';
            $customer_address  = (strlen($document->customer->address) / 200) * 10;
            $p_order           = $document->purchase_order != '' ? '10' : '0';

            $total_exportation = $document->total_exportation != '' ? '10' : '0';
            $total_free        = $document->total_free != '' ? '10' : '0';
            $total_unaffected  = $document->total_unaffected != '' ? '10' : '0';
            $total_exonerated  = $document->total_exonerated != '' ? '10' : '0';
            $total_taxed       = $document->total_taxed != '' ? '10' : '0';
            $quantity_rows     = count($document->items);
            $payments          = $document->payments()->count() * 2;

            $extra_by_item_description = 0;
            $discount_global = 0;
            
            foreach ($document->items as $it) {
                if(strlen(json_decode($it->item)->name)>100){
                    $extra_by_item_description +=24;
                }
                if ($it->discounts) {
                    $discount_global = $discount_global + 1;
                }
            }
            $legends = $document->legends != '' ? '10' : '0';


            $pdf = new Mpdf([
                'mode' => 'utf-8',
                'format' => [
                    $width,
                    40 +
                    (($quantity_rows * 8) + $extra_by_item_description) +
                    ($discount_global * 3) +
                    $company_logo +
                    $payments +
                    $company_name +
                    $company_address +
                    $company_number +
                    $customer_name +
                    $customer_address +
                    $p_order +
                    $legends +
                    $total_exportation +
                    $total_free +
                    $total_unaffected +
                    $total_exonerated +
                    $total_taxed],
                'margin_top' => 0,
                'margin_right' => 2,
                'margin_bottom' => 0,
                'margin_left' => 2
            ]);
        } else if($format_pdf === 'a5'){

            $company_name      = (strlen($company->name) / 20) * 10;
            $company_address   = (strlen($document->establishment->address) / 30) * 10;
            $company_number    = $document->establishment->phone != '' ? '10' : '0';
            $customer_name     = strlen($document->customer->names) > '25' ? '10' : '0';
            $customer_address  = (strlen($document->customer->address) / 200) * 10;
            $p_order           = $document->purchase_order != '' ? '10' : '0';

            $total_exportation = $document->total_exportation != '' ? '10' : '0';
            $total_free        = $document->total_free != '' ? '10' : '0';
            $total_unaffected  = $document->total_unaffected != '' ? '10' : '0';
            $total_exonerated  = $document->total_exonerated != '' ? '10' : '0';
            $total_taxed       = $document->total_taxed != '' ? '10' : '0';
            $quantity_rows     = count($document->items);
            $discount_global = 0;
            foreach ($document->items as $it) {
                if ($it->discounts) {
                    $discount_global = $discount_global + 1;
                }
            }
            $legends           = $document->legends != '' ? '10' : '0';


            $alto = ($quantity_rows * 8) +
                    ($discount_global * 3) +
                    $company_name +
                    $company_address +
                    $company_number +
                    $customer_name +
                    $customer_address +
                    $p_order +
                    $legends +
                    $total_exportation +
                    $total_free +
                    $total_unaffected +
                    $total_exonerated +
                    $total_taxed;
            $diferencia = 148 - (float) $alto;

            $pdf = new Mpdf([
                'mode' => 'utf-8',
                'format' => [
                    210,
                    $diferencia + $alto
                    ],
                'margin_top' => 2,
                'margin_right' => 5,
                'margin_bottom' => 0,
                'margin_left' => 5
            ]);


       } else {

            $pdf_font_regular = env('PDF_NAME_REGULAR');
            $pdf_font_bold = env('PDF_NAME_BOLD');

            if ($pdf_font_regular != false) {
                $defaultConfig = (new ConfigVariables())->getDefaults();
                $fontDirs = $defaultConfig['fontDir'];

                $defaultFontConfig = (new FontVariables())->getDefaults();
                $fontData = $defaultFontConfig['fontdata'];

                $pdf = new Mpdf([
                    'fontDir' => array_merge($fontDirs, [
                        app_path('CoreBilling'.DIRECTORY_SEPARATOR.'Templates'.
                                                DIRECTORY_SEPARATOR.'pdf'.
                                                DIRECTORY_SEPARATOR.$base_template.
                                                DIRECTORY_SEPARATOR.'font')
                    ]),
                    'fontdata' => $fontData + [
                        'custom_bold' => [
                            'R' => $pdf_font_bold.'.ttf',
                        ],
                        'custom_regular' => [
                            'R' => $pdf_font_regular.'.ttf',
                        ],
                    ]
                ]);
            }

        }

        $path_css = app_path('CoreBilling'.DIRECTORY_SEPARATOR.'Templates'.
                                             DIRECTORY_SEPARATOR.'pdf'.
                                             DIRECTORY_SEPARATOR.$base_template.
                                             DIRECTORY_SEPARATOR.'style.css');

        $stylesheet = file_get_contents($path_css);

        $pdf->WriteHTML($stylesheet, HTMLParserMode::HEADER_CSS);
        $pdf->WriteHTML($html, HTMLParserMode::HTML_BODY);

        $footer = true;

        if($footer) {
            $html_footer = $template->pdfFooter($base_template);
            $pdf->SetHTMLFooter($html_footer);
        }

        $this->uploadStorage($document->filename, $pdf->output('', 'S'), 'sale_note');
    
    }
}
