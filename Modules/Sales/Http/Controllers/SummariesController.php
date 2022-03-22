<?php

namespace Modules\Sales\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Exception;

class SummariesController extends Controller
{

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

        $route = 'storage'.DIRECTORY_SEPARATOR.$domain.DIRECTORY_SEPARATOR.$folder.DIRECTORY_SEPARATOR.$filename.'.'.$extension;
        
        return response()->download(public_path($route));
    }
}
