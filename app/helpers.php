<?php
function cctom($string){
    return strtolower(preg_replace('([^A-Za-z0-9])', '', $string));
}
function rlang($string){
    return \Illuminate\Support\Facades\Lang::get($string);
}
function ui_avatars_url($name,$size = 50,$background='random',$rounded=true){
    if($background == 'none'){
        $url = 'https://ui-avatars.com/api/?name='.$name.'&size='.$size.'&rounded='.$rounded;
    }else{
        $url = 'https://ui-avatars.com/api/?name='.$name.'&size='.$size.'&background='.$background.'&rounded='.$rounded;
    }

    return $url;
}
function nameNumerDay($date){

    $fechats = strtotime($date); //a timestamp
    $array_date = explode('-',$date);
    $string = '';
    // el parametro w en la funcion date indica que queremos el dia de la semana
    // lo devuelve en numero 0 domingo, 1 lunes,....
    switch (date('w', $fechats)){
        case 0: $string = "Domingo ". $array_date[2]; break;
        case 1: $string = "Lunes ". $array_date[2]; break;
        case 2: $string = "Martes ". $array_date[2]; break;
        case 3: $string = "Miercoles ". $array_date[2]; break;
        case 4: $string = "Jueves ". $array_date[2]; break;
        case 5: $string = "Viernes ". $array_date[2]; break;
        case 6: $string = "Sabado ". $array_date[2]; break;
    } 

    return $string;
}

function nameMonth(){
    $m='08';
    $months = array (1=>'Enero',2=>'Febrero',3=>'Marzo',4=>'Abril',5=>'Mayo',6=>'Junio',7=>'Julio',8=>'Agosto',9=>'Septiembre',10=>'Octubre',11=>'Noviembre',12=>'Diciembre');
    return $months[(int)$m];
}

function getEnumValues($table,$field)
{
    $type = \Illuminate\Support\Facades\DB::select( \Illuminate\Support\Facades\DB::raw("SHOW COLUMNS FROM {$table} WHERE Field = '{$field}'") )[0]->Type;
    preg_match('/^enum\((.*)\)$/', $type, $matches);
    $enum = array();
    foreach( explode(',', $matches[1]) as $value )
    {
        $v = trim( $value, "'" );
        $enum = \Illuminate\Support\Arr::add($enum, $v, $v);
    }
    return $enum;
}
