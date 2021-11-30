<?php

namespace Modules\Lend\Http\Livewire\Contract;

use Livewire\Component;
use Illuminate\Support\Facades\DB;
use Elrod\UserActivity\Activity;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Lang;
use Modules\Lend\Entities\LenContract;
use Modules\Lend\Entities\LenInterest;
use Modules\Lend\Entities\LenPaymentMethod;
use Modules\Lend\Entities\LenPaymentSchedule;
use Modules\Lend\Entities\LenQuota;

class ContractCreate extends Component
{
    //Contract
    public $id_contract;
    public $customer_id;
    public $customer_text;

    public $referred_id;
    public $referred_text;

    public $interest_id;
    public $payment_method_id;
    public $quota_id;
    public $date_start;
    public $date_end;
    public $penalty = false;
    public $amount_penalty_day;
    public $amount_capital;
    public $amount_interest;
    public $amount_total;
    public $additional_information;

    public $interests = [];
    public $payment_methods = [];
    public $quotas = [];

    public function mount(){
        $this->interests = LenInterest::where('state', '=', true)->get();
        $this->payment_methods = LenPaymentMethod::where('state', '=', true)->get();
        $this->quotas = LenQuota::where('state', '=', true)->get();
    }

    public function render(){
        return view('lend::livewire.contract.contract-create');
    }

    public function save(){
        if($this->penalty){
            $this->validate([
                'customer_id'       => 'required|min:1',
                'customer_text'     => 'required|min:3',
                //'referred_id'       => 'required|min:1',
                //'referred_text'     => 'required|min:3',
                'interest_id'       => 'required',
                'payment_method_id' => 'required',
                'quota_id'          => 'required',
                'date_start'        => 'required',
                'amount_capital'    => 'required|numeric',
                'amount_interest'   => 'required|numeric',
                'amount_total'      => 'required|numeric',
                'amount_penalty_day'=> 'required|numeric'
            ]);
        }else{
            $this->validate([
                'customer_id'       => 'required|min:1',
                'customer_text'     => 'required|min:3',
                //'referred_id'       => 'required|min:1',
                //'referred_text'     => 'required|min:3',
                'interest_id'       => 'required',
                'payment_method_id' => 'required',
                'quota_id'          => 'required',
                'date_start'        => 'required',
                'amount_capital'    => 'required|numeric',
                'amount_interest'   => 'required|numeric',
                'amount_total'      => 'required|numeric'
            ]);
        }

        $maxValue = DB::table('len_contracts')->max('id');

        if($maxValue == null){
            $correlativo = '000001';
        }else{
            $numero = (int) substr($maxValue,4,6);
            $correlativo = str_pad($numero + 1,  6, "0", STR_PAD_LEFT);
        }
        $this->id_contract = date('Y').$correlativo;

        $date_start = null;
        if($this->date_start){
            list($d,$m,$y) = explode('/', $this->date_start);
            $date_start = $y.'-'.$m.'-'. $d;
        }

        $date_end = null;
        if($this->date_end){
            list($d,$m,$y) = explode('/', $this->date_end);
            $date_end = $y.'-'.$m.'-'. $d;
        }

        $contract = LenContract::create([
            'id'                    => $this->id_contract,
            'customer_id'           => $this->customer_id,
            'referred_id'           => $this->referred_id,
            'interest_id'           => $this->interest_id,
            'payment_method_id'     => $this->payment_method_id,
            'quota_id'              => $this->quota_id,
            'date_start'            => $date_start,
            'date_end'              => $date_end,
            'penalty'               => $this->penalty,
            'amount_penalty_day'    => ($this->penalty?$this->amount_penalty_day:0.00),
            'amount_capital'        => $this->amount_capital,
            'amount_interest'       => $this->amount_interest,
            'amount_total'          => $this->amount_total,
            'additional_information'=> $this->additional_information,
            'person_create'         => Auth::user()->person_id
        ]);
        $this->saveDetail($this->id_contract);
        $activity = new Activity;
        $activity->modelOn(LenContract::class, $contract->id,'len_contracts');
        $activity->causedBy(Auth::user());
        $activity->routeOn(route('lend_contract_create'));
        $activity->logType('create');
        $activity->log('Se creó un nuevo contrato');
        $activity->save();

        $this->dispatchBrowserEvent('len-contract-save', ['msg' => Lang::get('lend::messages.msg_success')]);
        $this->clearForm();
    }

    public function saveDetail($id){
        $interest   = LenInterest::find($this->interest_id);
        $interest_value = $interest->value; //Por multiplicar %

        $quota      = LenQuota::find($this->quota_id);
        $quota_value = $quota->amount; //Cantidad de Cuotas

        $payment_value    = $this->payment_method_id; //Metodo de pago

        $capital_value    = $this->amount_capital;
        if($interest_value > 1){
            $total_value    = round(($capital_value*$interest_value), 2);
        }else{
            $total_value    = round(($capital_value*(1+$interest_value)), 2);
        }
        $interest_total     = round($total_value - $capital_value, 2);

        $date_start = null;
        if($this->date_start){
            list($d,$m,$y) = explode('/', $this->date_start);
            $date_start = $y.'-'.$m.'-'. $d;
        }

        $detail = $this->paymentDates($payment_value, $date_start, $quota_value, $capital_value, $interest_total, $total_value);
        foreach ($detail as $row){
            $contract_detail = LenPaymentSchedule::create([
                'contract_id'           => $id,
                'amount_to_pay'         => $row['total'], //Monto a Pagar
                'date_to_pay'           => $row['date'], //Fecha de Pago
                'capital'               => $row['capital'], //Capital por cuota
                'interest'              => $row['interest'], //Interes por cuota
                'person_create'         => Auth::user()->person_id
            ]);
        }
    }

    public function paymentDates($payment_value, $fechaIni, $quota_value, $capital_value, $interest_total, $total_value){
        $date_arrays = array();
        $validate_weekend = true; //Validar fin de semana
        $a = $quota_value;

        $total_c_d = round($capital_value/$quota_value, 2);
        $total_i_d = round($interest_total/$quota_value, 2);
        $total_t_d = round($total_value/$quota_value, 2);
        $validate_a = $total_c_d + $total_i_d;
        $flag_validate_totals = true;
        if($validate_a != $total_t_d){
            $flag_validate_totals = false;
        }
        if($total_t_d * $quota_value != $total_value){
            $flag_validate_totals = false;
        }

        if(($total_c_d*$quota_value + $total_i_d*$quota_value) != $total_value){
            $flag_validate_totals = false;
        }
        $last_payment_c = 0.00;
        $last_payment_i = 0.00;
        $last_payment_t = 0.00;
        if(!$flag_validate_totals){
            $v_a = ($total_c_d*$quota_value + $total_i_d*$quota_value);
            $a_validate = 0.00;
            if($v_a > $total_value){
                $a_validate = $v_a - $total_value;
                $last_payment_c = $total_c_d - $a_validate;
                $last_payment_t = $last_payment_c + $total_i_d;
            }else if($v_a < $total_value){
                $a_validate = $total_value - $v_a;
                $last_payment_c = $total_c_d + $a_validate;
                $last_payment_t = $last_payment_c + $total_i_d;
            }
        }

        switch ($payment_value){
            case '1': //Mes
                if($validate_weekend){
                    $date_aux = $fechaIni;
                    while($a > 0){
                        $date_aux = date('Y-m-d', strtotime($date_aux. ' + 1 month'));
                        $day_week = date('l', strtotime($date_aux));

                        //Ultimo Pago
                        if(!$flag_validate_totals){
                            if($a == 1){
                                $total_c_d = $last_payment_c;
                                $total_t_d = $last_payment_t;
                            }
                        }
                        if($day_week != 'Sunday'){
                            array_push($date_arrays, array('date'=>$date_aux, 'capital'=>$total_c_d, 'interest'=> $total_i_d, 'total' => $total_t_d));
                        }else{
                            $day_aux_a = date('Y-m-d', strtotime($date_aux. ' + 1 days'));
                            array_push($date_arrays, array('date'=>$day_aux_a, 'capital'=>$total_c_d, 'interest'=> $total_i_d, 'total' => $total_t_d));
                        }
                        $a--;
                    }
                }else{
                    $date_aux = $fechaIni;
                    while($a > 0){
                        //Ultimo Pago
                        if(!$flag_validate_totals){
                            if($a == 1){
                                $total_c_d = $last_payment_c;
                                $total_t_d = $last_payment_t;
                            }
                        }

                        $date_aux = date('Y-m-d', strtotime($date_aux. ' + 1 month'));
                        array_push($date_arrays, array('date'=>$date_aux, 'capital'=>$total_c_d, 'interest'=> $total_i_d, 'total' => $total_t_d));
                        $a--;
                    }
                }
                break;
            case '2': //Semana
                if($validate_weekend){
                    $date_aux = $fechaIni;
                    while($a > 0){
                        //Ultimo Pago
                        if(!$flag_validate_totals){
                            if($a == 1){
                                $total_c_d = $last_payment_c;
                                $total_t_d = $last_payment_t;
                            }
                        }

                        $date_aux = date('Y-m-d', strtotime($date_aux. ' + 1 week'));
                        $day_week = date('l', strtotime($date_aux));
                        if($day_week != 'Sunday'){
                            array_push($date_arrays, array('date'=>$date_aux, 'capital'=>$total_c_d, 'interest'=> $total_i_d, 'total' => $total_t_d));
                        }else{
                            $date_aux = date('Y-m-d', strtotime($date_aux. ' + 1 days'));
                            array_push($date_arrays, array('date'=>$date_aux, 'capital'=>$total_c_d, 'interest'=> $total_i_d, 'total' => $total_t_d));
                        }
                        $a--;
                    }
                }else{
                    $date_aux = $fechaIni;
                    while($a > 0){
                        //Ultimo Pago
                        if(!$flag_validate_totals){
                            if($a == 1){
                                $total_c_d = $last_payment_c;
                                $total_t_d = $last_payment_t;
                            }
                        }

                        $date_aux = date('Y-m-d', strtotime($date_aux. ' + 1 week'));
                        array_push($date_arrays, array('date'=>$date_aux, 'capital'=>$total_c_d, 'interest'=> $total_i_d, 'total' => $total_t_d));
                        $a--;
                    }
                }
                break;
            case '3': //Dia
                if($validate_weekend){
                    $date_aux = $fechaIni;
                    while($a > 0){
                        //Ultimo Pago
                        if(!$flag_validate_totals){
                            if($a == 1){
                                $total_c_d = $last_payment_c;
                                $total_t_d = $last_payment_t;
                            }
                        }

                        $date_aux = date('Y-m-d', strtotime($date_aux. ' + 1 days'));
                        $day_week = date('l', strtotime($date_aux));

                        if($day_week != 'Sunday'){
                            array_push($date_arrays, array('date'=>$date_aux, 'capital'=>$total_c_d, 'interest'=> $total_i_d, 'total' => $total_t_d));
                            $a--;
                        }
                    }
                }else{
                    $date_aux = $fechaIni;
                    while($a > 0){
                        //Ultimo Pago
                        if(!$flag_validate_totals){
                            if($a == 1){
                                $total_c_d = $last_payment_c;
                                $total_t_d = $last_payment_t;
                            }
                        }

                        $date_aux = date('Y-m-d', strtotime($date_aux. ' + 1 days'));
                        array_push($date_arrays, array('date'=>$date_aux, 'capital'=>$total_c_d, 'interest'=> $total_i_d, 'total' => $total_t_d));
                        $a--;
                    }
                }
                break;
        }
        return $date_arrays;
    }

    public function clearForm(){
        $this->customer_id              = null;
        $this->customer_text            = null;
        $this->referred_id              = null;
        $this->referred_text            = null;
        $this->interest_id              = null;
        $this->payment_method_id        = null;
        $this->quota_id                 = null;
        $this->date_start               = null;
        $this->date_end                 = null;
        $this->penalty                  = false;
        $this->amount_penalty_day       = null;
        $this->amount_capital           = null;
        $this->amount_interest          = null;
        $this->amount_total             = null;
        $this->additional_information   = null;
    }
}
