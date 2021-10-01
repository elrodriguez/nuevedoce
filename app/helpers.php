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