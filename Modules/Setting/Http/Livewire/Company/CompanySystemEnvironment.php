<?php

namespace Modules\Setting\Http\Livewire\Company;

use App\CoreBilling\Helpers\Certificate\GenerateCertificate;
use App\Models\SoapType;
use Exception;
use Illuminate\Support\Facades\Lang;
use Livewire\Component;
use Modules\Setting\Entities\SetCompany;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;

class CompanySystemEnvironment extends Component
{
    use WithFileUploads;

    public $company_id;
    public $soap_types = [];
    public $soap_type_id;
    public $certificate_file;
    public $certificate_show;
    public $certificate_password;
    public $soap_send;
    public $soap_user;
    public $soap_password;
    public $soap_send_id = '01';
    public $company;
    public $progress = 0;

    public function mount($company_id){
        $this->company_id = $company_id;
        $this->company = SetCompany::find($company_id);
        $this->soap_type_id = $this->company->soap_type_id;
        $this->soap_send_id = $this->company->soap_send_id;
        $this->soap_user = $this->company->soap_user;
        $this->soap_password = $this->company->soap_password;
        $this->certificate_password = $this->company->certificate_password;
        $this->certificate_show = $this->company->certificate_pem;
    }
    public function render()
    {

        $this->soap_types = SoapType::all();
        return view('setting::livewire.company.company-system-environment');
    }

    public function saveSoap(){

        $this->validate([
            'soap_type_id' => 'required',
            'soap_send_id' => 'required',
            'soap_user' => 'required',
            'soap_password' => 'required'
        ]);

        $this->company->update([
            'soap_type_id' => $this->soap_type_id,
            'soap_send_id' => $this->soap_send_id,
            'soap_user' => $this->soap_type_id == '01' ? $this->soap_user : null,
            'soap_password' => $this->soap_type_id == '01' ? $this->soap_password : null
        ]);
        
        $this->dispatchBrowserEvent('set-company-tools', ['msg' => Lang::get('setting::labels.msg_success')]);
    }

    public function saveFileCertificate(){
        $this->bar = 10;
        $this->validate([
            'certificate_file' => ['required'],
            'certificate_password' => ['required']
        ]);

        try {
            $password = $this->certificate_password;

            $folder = storage_path('app'.DIRECTORY_SEPARATOR.'certificates');
            
            if(!file_exists($folder)) {
                mkdir($folder);
            }
         
            $certificate_pfx = $this->certificate_file->storeAs('certificates',$this->company->number.'.pfx');

            $url_file = storage_path('app'.DIRECTORY_SEPARATOR.$certificate_pfx);
            
            $pfx = file_get_contents($url_file,FILE_USE_INCLUDE_PATH);

            $pem = GenerateCertificate::typePEM($pfx, $password);
            
            $certificate_pem = 'certificate_'.$this->company->number.'.pem';
            file_put_contents(storage_path('app'.DIRECTORY_SEPARATOR.'certificates'.DIRECTORY_SEPARATOR.$certificate_pem), $pem);
            $this->company->update([
                'certificate_pfx' => $certificate_pfx,
                'certificate_pem' => $certificate_pem,
                'certificate_password' => $this->certificate_password
            ]);
            $success = true;
            $message =  'Certificado .pem creado correctamente';
        } catch (Exception $e) {
            $success = false;
            $message =  $e->getMessage();
        }

        $this->dispatchBrowserEvent('set-company-certificate-upload', ['success' => $success,'message' => $message]);
    }

    public function deleteCertificate(){
        $pfx = storage_path('app'.DIRECTORY_SEPARATOR.$this->company->certificate_pfx);
        $pem = storage_path('app'.DIRECTORY_SEPARATOR.'certificates'.DIRECTORY_SEPARATOR.$this->company->certificate_pem);
        Storage::delete([$pfx,$pem]);
        $this->company->update([
            'certificate_pfx' => null,
            'certificate_pem' => null,
            'certificate_password' => null
        ]);

        $this->dispatchBrowserEvent('set-company-certificate-upload', ['success' => true,'message' => Lang::get('labels.was_successfully_removed')]);
    }
}
